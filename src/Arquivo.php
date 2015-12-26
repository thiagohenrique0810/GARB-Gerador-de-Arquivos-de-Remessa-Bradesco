<?php
include 'HeaderLabel.php';
include 'Detalhes.php';
include 'Trailler.php';

class Arquivo {
	private $header_label;
	private $filename;
	private $trailler;
	const   QUEBRA_LINHA = "\r\n";
	private  $detalhes = array();
	
	/**
	 * @return the $filename
	 */
	public function getFilename() {
		return $this->filename;
	}

	/**
	 * @param field_type $filename
	 */
	public function setFilename($filename) {
		$this->filename = $filename;
	}

	/**
	 * @return the $detalhes
	 */
	public function getDetalhes() {
		return $this->detalhes;
	}

	/**
	 * @param multitype: $detalhes
	 */
	public function setDetalhes($detalhes) {
		$this->detalhes[] = $detalhes;
	}

	/**
	 * @return the $header_label
	 */
	public function getHeader_label() {
		return $this->header_label;
	}

	/**
	 * @return the $trailler
	 */
	public function getTrailler() {
		return $this->trailler;
	}

	/**
	 * @param field_type $header_label
	 */
	public function setHeader_label($header_label) {
		$this->header_label = $header_label;
	}

	/**
	 * @param field_type $trailler
	 */
	public function setTrailler($trailler) {
		$this->trailler = $trailler;
	}

	/**
	 * metodo para adicionar boletos na remessa
	 * @param unknown $boleto
	 */
	public function add_boleto($boleto) {
		//preenchendo dados dos detalhes
		$detalhes = new Detalhes();
		
		//informações da conta
		$detalhes->setAgencia_debito($boleto['agencia']);
		$detalhes->setDigito_debito_debito($boleto['agencia_dv']);
		$detalhes->setConta_corrente($boleto['conta']);
		$detalhes->setDigito_conta_corrente($boleto['conta_dv']);
		$detalhes->setCarteira($boleto['carteira']);
		
		//informações do boleto
		$detalhes->setCodigo_banco_debito_compensacao($boleto['habilitar_debito_compensacao']);
		$detalhes->setIdentificacao_titulo_banco($boleto['nosso_numero']);
		$detalhes->setDesconto_bonificacao_dia($boleto['desconto_dia']);
		$detalhes->setIndicador_rateio_credito($boleto['rateio']);
		$detalhes->setNumero_documento($boleto['numero_documento']);
		$detalhes->setData_vencimento_titulo($boleto['vencimento']);
		$detalhes->setValor_titulo($boleto['valor']);
		$detalhes->setData_emissao_titulo($boleto['data_emissao_titulo']);
		
		//taxas do boleto
		$detalhes->setCampo_multa($boleto['habilitar_multa']);
		$detalhes->setPercentual_multa($boleto['percentual_multa']);
		$detalhes->setValo_cobrado_dia_atraso($boleto['valor_dia_atraso']);
		$detalhes->setData_limite_desconto($boleto['data_limite_desconto']);
		$detalhes->setValor_desconto($boleto['valor_desconto']);
		$detalhes->setValor_iof($boleto['valor_iof']);
		$detalhes->setValor_abatimento_concedido_cancelado($boleto['valor_abatimento_concedido']);
		
		//informações do pagador
		$detalhes->setIdentificacao_tipo_incricao_pagador($boleto['tipo_inscricao_pagador']);
		$detalhes->setNumero_inscricao_pagador($boleto['numero_inscricao']);
		$detalhes->setNome_pagador($boleto['nome_pagador']);
		$detalhes->setEndereco_pagador($boleto['endereco_pagador']);
		$detalhes->setPrimeira_mensagem($boleto['primeira_mensagem']);
		$detalhes->setCep($boleto['cep_pagador']);
		$detalhes->setSufixo_cep($boleto['sufixo_cep_pagador']);
		$detalhes->setSacador_segunda_mensagem($boleto['sacador_segunda_mensagem']);
		
		//adicionando boleto
		$this->setDetalhes($detalhes);
	}
	
	/**
	 * metodo para configurar a remessa
	 * @param unknown $dados
	 */
	public function config($dados) {
		$cabecalho = new HeaderLabel();
		//TESTANDO O HEADERLABEL
		$cabecalho->setCodigo_empresa($dados['codigo_empresa']);
		$cabecalho->setNome_empresa($dados['razao_social']);
		$cabecalho->setNumero_sequencial_remessa($dados['numero_remessa']);
		$cabecalho->setData_gravacao($dados['data_gravacao']);

		$this->setHeader_label($cabecalho);
	}
	
	/**
	 * metodo para criar o texto inteiro da remessa
	 */
	public function get_text() {
		//Montando texto
		$dados = $this->getHeader_label()->montar_linha() . self::QUEBRA_LINHA;
		//montando linhas dos boletos
		$numero_sequencial = 2;
		foreach ($this->getDetalhes() as $detalhe) {
			$detalhe->setNumero_sequencial_registro($numero_sequencial++);
			$dados .= $detalhe->montar_linha() . self::QUEBRA_LINHA;
		}
		//montando rodap�
		$trailler = new Trailler();
		$trailler->setNumero_sequencial_regsitro($numero_sequencial++);
		$this->setTrailler($trailler);
		$dados .= $this->getTrailler()->montar_linha();
		
		return $dados;
	}
	
	/**
	 * metodo para fazer download do arquivo de remessa
	 */
	public function save() {
		$text = $this->get_text();
		//die($text);
		//atribuindo um nome do arquivo
		if($this->getFilename() == '') {
			$this->setFilename('CB' . date('dm') . 'A1');
		}
		
		file_put_contents($this->getFilename() . '.REM', $text);
	}
	
	/**
	 * Metodo para retornar a quantida de detalhes inseridos na remessa
	 * @return number
	 */
	public function count_detalhes() {
		return count($this->detalhes);
	}
	
}