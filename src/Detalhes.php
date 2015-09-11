<?php
/**
 * Lay-out do Arquivo-Remessa - Registro de Transação - Tipo 1
 * Lay-out para Cobrança com Registro e sem Registro com Emissão do Boleto pelo 
 * Banco ou pela Empresa
 * Descrição de Registro - Tamanho 400 Bytes
 * A - Alfanumérico - Conteúdo em Caixa Alta (Letras Maiúsculas)
 * N – Numérico
 */
require_once 'src/Funcoes.php';
require_once 'src/IFuncoes.php';

class Detalhes extends Funcoes implements IFuncoes {
	
	//001 - 001 - 1 -  N CONSTANTE
	private $identificacao_registro = 0;
	//002 - 006 - 5 - N
	private $agencia_debito;
	//007 - 007 - 1 - A
	private $digito_debito_debito;
	//008 - 012 - 5 N
	private $razao_conta_corrente;
	//013 - 019 - 7 - N
	private $conta_corrente;
	//020 - 020 - 1 - A
	private $digito_conta_corrente;
	//021 - 037 - 17 - A
	private $identificacao_empresa_benificiario_banco;
	//038 - 062 - 25 - A
	private $numero_controle_participante;
	//063 - 065 - 3 - N
	private $codigo_banco_debito_compensacao;
	//066 - 066 - 1 - N
	private $campo_multa;
	//067 - 070 - 4 - N
	private $percentual_multa;
	//071 - 081 - 11 - N
	private $identificacao_titulo_banco;
	//082 - 082 - 1 - A
	private $digito_auto_consferencia_bancaria;
	//083 - 092 - 10 - N
	private $desconto_bonificacao_dia;
	//093 - 093 - 1 - CONSTANTE
	private $condicao_emissao_papeleta_cobranca = 2; //<--- verificar observações
	//094 - 094 - 1 - A
	private $ident_debito_automatico; //<---- ver observações
	//095 - 104 - 10 - A
	private $identificacao_operacao_banco;
	//105 - 105 - 1 - A
	private $indicador_rateio_credito = 'R';
	//106 - 106 - 1 - N
	private $enderecamento_aviso_debito; //<---- ver observações 
	//107 - 108 - 2 - A
	//PREENCHER ESPAÇOS EM BRANCO
	//109 - 110 - 2 - N
	private $identificacao_ocorrencia; //<---- ver observações 
	//111 - 120 - 10 - A
	private $numero_documento;
	//121 - 126 - 6 - N
	private $data_vencimento_titulo;
	//127 - 139 - 13 - N
	private $valor_titulo;//<---- ver observações 
	//140 - 142 - 3 - N
	private $banco_encarregado_cobranca = "000";
	//141 - 147 - 5 - N
	private $agencia_depositaria = "00000";
	//148 - 149 - 2 - N
	private $especie_titulo;//<---- ver observações 
	//150 - 150 - 1 - A
	private $identificacao = "N";
	//151 - 156 - 6 - N
	private $data_emissao_titulo;
	//157 -  158 - 2 - N
	private $instrucao_1;//<---- ver observações 
	//159 - 160 - 2 - N
	private $instrucao_2;//<---- ver observações 
	//161 - 173 - 13 - N
	private $valo_cobrado_dia_atraso;//<---- ver observações 
	//174 - 179 - 6 - N
	private $data_limite_desconto;//<---- ver observações 
	//180 - 192 - 13 - N
	private $valor_desconto;
	//192 - 205 - 13 N
	private $valor_iof;
	//206 - 218 - 13 - N
	private $valor_abatimento_concedido_cancelado;
	//219 - 220 - 2 - N
	private $identificacao_tipo_incricao_pagador;//<---- ver observações 
	//221 - 234 - 14 - N
	private $numero_inscricao_pagador;//<---- ver observações 
	//235 - 274 - 40 - A
	private $nome_pagador;
	//275 - 314 - 40 - A
	private $endereco_pagador;
	//315 - 326 - 12 - A
	private $primeira_mensagem;
	//327 - 331 - 5 - N
	private $cep;
	//332 - 334 - 3 - N
	private $sufixo_cep;
	//335 - 394 - 60 - A
	private $sacador_segunda_mensagem;//<---- ver observações 
	//395 - 400 - 6 - N - AUTOINCREMENTADO E UNICO
	private $numero_sequencial_registro;

	
	/**
	 * @return the $agencia_debito
	 */
	public function getAgencia_debito() {
		return $this->agencia_debito;
	}

	/**
	 * @return the $digito_debito_debito
	 */
	public function getDigito_debito_debito() {
		return $this->digito_debito_debito;
	}

	/**
	 * @return the $razao_conta_corrente
	 */
	public function getRazao_conta_corrente() {
		return $this->razao_conta_corrente;
	}

	/**
	 * @return the $conta_corrente
	 */
	public function getConta_corrente() {
		return $this->conta_corrente;
	}

	/**
	 * @return the $digito_conta_corrente
	 */
	public function getDigito_conta_corrente() {
		return $this->digito_conta_corrente;
	}

	/**
	 * @return the $identificacao_empresa_benificiario_banco
	 */
	public function getIdentificacao_empresa_benificiario_banco() {
		return $this->identificacao_empresa_benificiario_banco;
	}

	/**
	 * @return the $numero_controle_participante
	 */
	public function getNumero_controle_participante() {
		return $this->numero_controle_participante;
	}

	/**
	 * @return the $codigo_banco_debito_compensacao
	 */
	public function getCodigo_banco_debito_compensacao() {
		return $this->codigo_banco_debito_compensacao;
	}

	/**
	 * @return the $campo_multa
	 */
	public function getCampo_multa() {
		return $this->campo_multa;
	}

	/**
	 * @return the $percentual_multa
	 */
	public function getPercentual_multa() {
		return $this->percentual_multa;
	}

	/**
	 * @return the $identificacao_titulo_banco
	 */
	public function getIdentificacao_titulo_banco() {
		return $this->identificacao_titulo_banco;
	}

	/**
	 * @return the $digito_auto_consferencia_bancaria
	 */
	public function getDigito_auto_consferencia_bancaria() {
		return $this->digito_auto_consferencia_bancaria;
	}

	/**
	 * @return the $desconto_bonificacao_dia
	 */
	public function getDesconto_bonificacao_dia() {
		return $this->desconto_bonificacao_dia;
	}

	/**
	 * @return the $ident_debito_automatico
	 */
	public function getIdent_debito_automatico() {
		return $this->ident_debito_automatico;
	}

	/**
	 * @return the $identificacao_operacao_banco
	 */
	public function getIdentificacao_operacao_banco() {
		return $this->identificacao_operacao_banco;
	}

	/**
	 * @return the $indicador_rateio_credito
	 */
	public function getIndicador_rateio_credito() {
		return $this->indicador_rateio_credito;
	}

	/**
	 * @return the $enderecamento_aviso_debito
	 */
	public function getEnderecamento_aviso_debito() {
		return $this->enderecamento_aviso_debito;
	}

	/**
	 * @return the $identificacao_ocorrencia
	 */
	public function getIdentificacao_ocorrencia() {
		return $this->identificacao_ocorrencia;
	}

	/**
	 * @return the $numero_documento
	 */
	public function getNumero_documento() {
		return $this->numero_documento;
	}

	/**
	 * @return the $data_vencimento_titulo
	 */
	public function getData_vencimento_titulo() {
		return $this->data_vencimento_titulo;
	}

	/**
	 * @return the $valor_titulo
	 */
	public function getValor_titulo() {
		return $this->valor_titulo;
	}

	/**
	 * @return the $banco_encarregado_cobranca
	 */
	public function getBanco_encarregado_cobranca() {
		return $this->banco_encarregado_cobranca;
	}

	/**
	 * @return the $agencia_depositaria
	 */
	public function getAgencia_depositaria() {
		return $this->agencia_depositaria;
	}

	/**
	 * @return the $especie_titulo
	 */
	public function getEspecie_titulo() {
		return $this->especie_titulo;
	}

	/**
	 * @return the $identificacao
	 */
	public function getIdentificacao() {
		return $this->identificacao;
	}

	/**
	 * @return the $data_emissao_titulo
	 */
	public function getData_emissao_titulo() {
		return $this->data_emissao_titulo;
	}

	/**
	 * @return the $instrucao_1
	 */
	public function getInstrucao_1() {
		return $this->instrucao_1;
	}

	/**
	 * @return the $instrucao_2
	 */
	public function getInstrucao_2() {
		return $this->instrucao_2;
	}

	/**
	 * @return the $valo_cobrado_dia_atraso
	 */
	public function getValo_cobrado_dia_atraso() {
		return $this->valo_cobrado_dia_atraso;
	}

	/**
	 * @return the $data_limite_desconto
	 */
	public function getData_limite_desconto() {
		return $this->data_limite_desconto;
	}

	/**
	 * @return the $valor_desconto
	 */
	public function getValor_desconto() {
		return $this->valor_desconto;
	}

	/**
	 * @return the $valor_iof
	 */
	public function getValor_iof() {
		return $this->valor_iof;
	}

	/**
	 * @return the $valor_abatimento_concedido_cancelado
	 */
	public function getValor_abatimento_concedido_cancelado() {
		return $this->valor_abatimento_concedido_cancelado;
	}

	/**
	 * @return the $identificacao_tipo_incricao_pagador
	 */
	public function getIdentificacao_tipo_incricao_pagador() {
		return $this->identificacao_tipo_incricao_pagador;
	}

	/**
	 * @return the $numero_inscricao_pagador
	 */
	public function getNumero_inscricao_pagador() {
		return $this->numero_inscricao_pagador;
	}

	/**
	 * @return the $nome_pagador
	 */
	public function getNome_pagador() {
		return $this->nome_pagador;
	}

	/**
	 * @return the $endereco_pagador
	 */
	public function getEndereco_pagador() {
		return $this->endereco_pagador;
	}

	/**
	 * @return the $primeira_mensagem
	 */
	public function getPrimeira_mensagem() {
		return $this->primeira_mensagem;
	}

	/**
	 * @return the $cep
	 */
	public function getCep() {
		return $this->cep;
	}

	/**
	 * @return the $sufixo_cep
	 */
	public function getSufixo_cep() {
		return $this->sufixo_cep;
	}

	/**
	 * @return the $sacador_segunda_mensagem
	 */
	public function getSacador_segunda_mensagem() {
		return $this->sacador_segunda_mensagem;
	}

	/**
	 * @return the $numero_sequencial_registro
	 */
	public function getNumero_sequencial_registro() {
		return $this->numero_sequencial_registro;
	}

	/**
	 * @param field_type $agencia_debito
	 */
	public function setAgencia_debito($agencia_debito) {
		if($this->valid_tamanho_campo($agencia_debito, 5) && is_numeric($agencia_debito)) {
			$this->agencia_debito = $agencia_debito;
		}else {
			throw new Exception('Error: Quantidade dos digito da agencia excedido ou não é numerico.');
		}
	}

	/**
	 * @param field_type $digito_debito_debito
	 */
	public function setDigito_debito_debito($digito_debito_debito) {
		if($this->valid_tamanho_campo($digito_debito_debito, 1) && is_numeric($digito_debito_debito)) {
			$this->digito_debito_debito = $digito_debito_debito;
		}else {
			throw new Exception('Error: Quantidade do digito excedido ou não é numerico.');
		}
	}

	/**
	 * @param field_type $razao_conta_corrente
	 */
	public function setRazao_conta_corrente($razao_conta_corrente) {
		if($this->valid_tamanho_campo($razao_conta_corrente, 5) && is_numeric($razao_conta_corrente)) {
			$this->razao_conta_corrente = $razao_conta_corrente;
		}else {
			throw new Exception('Error: Quantidade do digito excedido ou não é numerico.');
		}
	}

	/**
	 * @param field_type $conta_corrente
	 */
	public function setConta_corrente($conta_corrente) {
		if($this->valid_tamanho_campo($conta_corrente, 7)) {
			$this->conta_corrente = $conta_corrente;
		}else {
			throw new Exception('Error: Informações sobre o numero da conta corrente invalido..');
		}
		
	}

	/**
	 * @param field_type $digito_conta_corrente
	 */
	public function setDigito_conta_corrente($digito_conta_corrente) {
		if($this->valid_tamanho_campo($digito_conta_corrente, 1)) {
			$this->digito_conta_corrente = $digito_conta_corrente;
		}else {
			throw new Exception('Error: Informações sobre o numero da conta corrente invalido..');
		}
	}

	/**
	 * @param field_type $identificacao_empresa_benificiario_banco
	 */
	public function setIdentificacao_empresa_benificiario_banco($identificacao_empresa_benificiario_banco) {
		if($this->valid_tamanho_campo($identificacao_empresa_benificiario_banco, 17) && is_numeric($identificacao_empresa_benificiario_banco)) {
			$this->identificacao_empresa_benificiario_banco = $identificacao_empresa_benificiario_banco;
		}else {
			throw new Exception('Error: Informações sobre a indentificação de empresa benificiario estão invalidos..');
		}
	}

	/**
	 * @param field_type $numero_controle_participante
	 */
	public function setNumero_controle_participante($numero_controle_participante) {
		$this->numero_controle_participante = $numero_controle_participante;
	}

	/**
	 * @param field_type $codigo_banco_debito_compensacao
	 */
	public function setCodigo_banco_debito_compensacao($codigo_banco_debito_compensacao) {
		$this->codigo_banco_debito_compensacao = $codigo_banco_debito_compensacao;
	}

	/**
	 * @param field_type $campo_multa
	 */
	public function setCampo_multa($campo_multa) {
		$this->campo_multa = $campo_multa;
	}

	/**
	 * @param field_type $percentual_multa
	 */
	public function setPercentual_multa($percentual_multa) {
		$this->percentual_multa = $percentual_multa;
	}

	/**
	 * @param field_type $identificacao_titulo_banco
	 */
	public function setIdentificacao_titulo_banco($identificacao_titulo_banco) {
		$this->identificacao_titulo_banco = $identificacao_titulo_banco;
	}

	/**
	 * @param field_type $digito_auto_consferencia_bancaria
	 */
	public function setDigito_auto_consferencia_bancaria($digito_auto_consferencia_bancaria) {
		$this->digito_auto_consferencia_bancaria = $digito_auto_consferencia_bancaria;
	}

	/**
	 * @param field_type $desconto_bonificacao_dia
	 */
	public function setDesconto_bonificacao_dia($desconto_bonificacao_dia) {
		$this->desconto_bonificacao_dia = $desconto_bonificacao_dia;
	}

	/**
	 * @param field_type $ident_debito_automatico
	 */
	public function setIdent_debito_automatico($ident_debito_automatico) {
		$this->ident_debito_automatico = $ident_debito_automatico;
	}

	/**
	 * @param field_type $identificacao_operacao_banco
	 */
	public function setIdentificacao_operacao_banco($identificacao_operacao_banco) {
		$this->identificacao_operacao_banco = $identificacao_operacao_banco;
	}

	/**
	 * @param string $indicador_rateio_credito
	 */
	public function setIndicador_rateio_credito($indicador_rateio_credito) {
		$this->indicador_rateio_credito = $indicador_rateio_credito;
	}

	/**
	 * @param field_type $enderecamento_aviso_debito
	 */
	public function setEnderecamento_aviso_debito($enderecamento_aviso_debito) {
		$this->enderecamento_aviso_debito = $enderecamento_aviso_debito;
	}

	/**
	 * @param field_type $identificacao_ocorrencia
	 */
	public function setIdentificacao_ocorrencia($identificacao_ocorrencia) {
		$this->identificacao_ocorrencia = $identificacao_ocorrencia;
	}

	/**
	 * @param field_type $numero_documento
	 */
	public function setNumero_documento($numero_documento) {
		$this->numero_documento = $numero_documento;
	}

	/**
	 * @param field_type $data_vencimento_titulo
	 */
	public function setData_vencimento_titulo($data_vencimento_titulo) {
		$this->data_vencimento_titulo = $data_vencimento_titulo;
	}

	/**
	 * @param field_type $valor_titulo
	 */
	public function setValor_titulo($valor_titulo) {
		$this->valor_titulo = $valor_titulo;
	}

	/**
	 * @param string $banco_encarregado_cobranca
	 */
	public function setBanco_encarregado_cobranca($banco_encarregado_cobranca) {
		$this->banco_encarregado_cobranca = $banco_encarregado_cobranca;
	}

	/**
	 * @param string $agencia_depositaria
	 */
	public function setAgencia_depositaria($agencia_depositaria) {
		$this->agencia_depositaria = $agencia_depositaria;
	}

	/**
	 * @param field_type $especie_titulo
	 */
	public function setEspecie_titulo($especie_titulo) {
		$this->especie_titulo = $especie_titulo;
	}

	/**
	 * @param string $identificacao
	 */
	public function setIdentificacao($identificacao) {
		$this->identificacao = $identificacao;
	}

	/**
	 * @param field_type $data_emissao_titulo
	 */
	public function setData_emissao_titulo($data_emissao_titulo) {
		$this->data_emissao_titulo = $data_emissao_titulo;
	}

	/**
	 * @param field_type $instrucao_1
	 */
	public function setInstrucao_1($instrucao_1) {
		$this->instrucao_1 = $instrucao_1;
	}

	/**
	 * @param field_type $instrucao_2
	 */
	public function setInstrucao_2($instrucao_2) {
		$this->instrucao_2 = $instrucao_2;
	}

	/**
	 * @param field_type $valo_cobrado_dia_atraso
	 */
	public function setValo_cobrado_dia_atraso($valo_cobrado_dia_atraso) {
		$this->valo_cobrado_dia_atraso = $valo_cobrado_dia_atraso;
	}

	/**
	 * @param field_type $data_limite_desconto
	 */
	public function setData_limite_desconto($data_limite_desconto) {
		$this->data_limite_desconto = $data_limite_desconto;
	}

	/**
	 * @param field_type $valor_desconto
	 */
	public function setValor_desconto($valor_desconto) {
		$this->valor_desconto = $valor_desconto;
	}

	/**
	 * @param field_type $valor_iof
	 */
	public function setValor_iof($valor_iof) {
		$this->valor_iof = $valor_iof;
	}

	/**
	 * @param field_type $valor_abatimento_concedido_cancelado
	 */
	public function setValor_abatimento_concedido_cancelado($valor_abatimento_concedido_cancelado) {
		$this->valor_abatimento_concedido_cancelado = $valor_abatimento_concedido_cancelado;
	}

	/**
	 * @param field_type $identificacao_tipo_incricao_pagador
	 */
	public function setIdentificacao_tipo_incricao_pagador($identificacao_tipo_incricao_pagador) {
		$this->identificacao_tipo_incricao_pagador = $identificacao_tipo_incricao_pagador;
	}

	/**
	 * @param field_type $numero_inscricao_pagador
	 */
	public function setNumero_inscricao_pagador($numero_inscricao_pagador) {
		$this->numero_inscricao_pagador = $numero_inscricao_pagador;
	}

	/**
	 * @param field_type $nome_pagador
	 */
	public function setNome_pagador($nome_pagador) {
		$this->nome_pagador = $nome_pagador;
	}

	/**
	 * @param field_type $endereco_pagador
	 */
	public function setEndereco_pagador($endereco_pagador) {
		$this->endereco_pagador = $endereco_pagador;
	}

	/**
	 * @param field_type $primeira_mensagem
	 */
	public function setPrimeira_mensagem($primeira_mensagem) {
		$this->primeira_mensagem = $primeira_mensagem;
	}

	/**
	 * @param field_type $cep
	 */
	public function setCep($cep) {
		$this->cep = $cep;
	}

	/**
	 * @param field_type $sufixo_cep
	 */
	public function setSufixo_cep($sufixo_cep) {
		$this->sufixo_cep = $sufixo_cep;
	}

	/**
	 * @param field_type $sacador_segunda_mensagem
	 */
	public function setSacador_segunda_mensagem($sacador_segunda_mensagem) {
		$this->sacador_segunda_mensagem = $sacador_segunda_mensagem;
	}

	/**
	 * @param field_type $numero_sequencial_registro
	 */
	public function setNumero_sequencial_registro($numero_sequencial_registro) {
		$this->numero_sequencial_registro = $numero_sequencial_registro;
	}

	/* (non-PHPdoc)
	 * @see IFuncoes::montar_linha()
	 */
	public function montar_linha() {
		// TODO Auto-generated method stub
	}

}