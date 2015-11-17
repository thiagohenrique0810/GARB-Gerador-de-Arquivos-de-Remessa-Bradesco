<?php
include 'HeaderLabel.php';
include 'Detalhes.php';
include 'Trailler.php';

class Arquivo {
	private $header_label;
	private $trailler;
	const   QUEBRA_LINHA = "\r\n";
	private  $detalhes = array();
	
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
		
		$detalhes->setAgencia_debito($boleto['agencia']);
		$detalhes->setDigito_debito_debito($boleto['agencia_dv']);
		$detalhes->setRazao_conta_corrente($boleto['razao_conta_corrente']);
		$detalhes->setConta_corrente($boleto['conta']);
		$detalhes->setDigito_conta_corrente($boleto['conta_dv']);
		$detalhes->setIdentificacao_empresa_benificiario_banco($boleto['identificacao_empresa']);
		$detalhes->setNumero_controle_participante($boleto['numero_controle']);
		$detalhes->setCodigo_banco_debito_compensacao($boleto['habilitar_debito_compensacao']);
		$detalhes->setCampo_multa($boleto['habilitar_multa']);
		$detalhes->setPercentual_multa($boleto['percentual_multa']);
		$detalhes->setIdentificacao_titulo_banco($boleto['nosso_numero']);
		$detalhes->setDigito_auto_consferencia_bancaria($boleto['nosso_numero_dv']);
		$detalhes->setDesconto_bonificacao_dia($boleto['desconto_dia']);
		$detalhes->setIndicador_rateio_credito($boleto['rateio']);
		$detalhes->setNumero_documento($boleto['numero_documento']);
		$detalhes->setData_vencimento_titulo($boleto['vencimento']);
		$detalhes->setValor_titulo($boleto['valor']);
		$detalhes->setData_emissao_titulo($boleto['data_emissao_titulo']);
		$detalhes->setValo_cobrado_dia_atraso($boleto['valor_dia_atraso']);
		$detalhes->setData_limite_desconto($boleto['data_limite_desconto']);
		$detalhes->setValor_desconto($boleto['valor_desconto']);
		$detalhes->setValor_iof($boleto['valor_iof']);
		$detalhes->setValor_abatimento_concedido_cancelado($boleto['valor_abatimento_concedido']);
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
		//montando rodapé
		$dados .= $this->getTrailler();
		
		return $dados;
	}
	
	/**
	 * metodo para fazer download do arquivo de remessa
	 */
	public function save() {
		$text = $this->get_text();
		
		die($text);
		
		file_put_contents($filename, $text);
	}
	
	/**
	 * Metodo para retornar a quantida de detalhes inseridos na remessa
	 * @return number
	 */
	public function count_detalhes() {
		return count($this->detalhes);
	}
	
}