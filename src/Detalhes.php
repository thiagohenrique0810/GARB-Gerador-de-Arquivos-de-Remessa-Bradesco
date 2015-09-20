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
	//094 - 094 - 1 - A - CONSTANTE
	private $ident_debito_automatico = 'N'; //<---- ver observações
	//095 - 104 - 10 - A
	//PREENCHER ESPAÇOS EM BRANCO
	//105 - 105 - 1 - A
	private $indicador_rateio_credito;
	//106 - 106 - 1 - N - CONSTANTE
	private $enderecamento_aviso_debito = '0'; //<---- ver observações 
	//107 - 108 - 2 - A
	//PREENCHER ESPAÇOS EM BRANCO
	//109 - 110 - 2 - N - CONSTANTE
	private $identificacao_ocorrencia = '01'; //<---- ver observações 
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
	//148 - 149 - 2 - N - CONSTRANTE
	private $especie_titulo = '01';//<---- ver observações 
	//150 - 150 - 1 - A
	private $identificacao = "N";
	//151 - 156 - 6 - N
	private $data_emissao_titulo;
	//157 -  158 - 2 - N
	private $instrucao_1 = '00';//<---- ver observações FUNÇÃO INTERESSANTE POIS PODE SER USADA PARA QUE O SISTEMA GERE AUTOMATICAMENTE O PROTESTO DE ACORDO COM O SOLICITADO
	//159 - 160 - 2 - N
	private $instrucao_2 = '00';//<---- ver observações 
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
	 * @return the $indicador_rateio_credito
	 */
	public function getIndicador_rateio_credito() {
		return $this->indicador_rateio_credito;
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
		if($this->valid_tamanho_campo($identificacao_empresa_benificiario_banco, 17)) {
			$this->identificacao_empresa_benificiario_banco = '0' . $identificacao_empresa_benificiario_banco;
		}else {
			throw new Exception('Error: Informações sobre a indentificação de empresa benificiario estão invalidos..');
		}
	}

	/**
	 * semelhante ao numero do documento - pode ser uma chave unica de identificação de cada boleto da remessa
	 * @param field_type $numero_controle_participante
	 */
	public function setNumero_controle_participante($numero_controle_participante) {
		if($this->valid_tamanho_campo($numero_controle_participante, 25)) {
			$this->numero_controle_participante = $numero_controle_participante;
		}else {
			throw new Exception('Error - Dados do numero de controle do participante estãos incorretos');
		}
	}

	/**
	 * se existir debito automatico para o beneficiario, deverá ser passado como parametro TRUE
	 * @param string $codigo_banco_debito_compensacao
	 */
	public function setCodigo_banco_debito_compensacao($codigo_banco_debito_compensacao = false) {
		if($codigo_banco_debito_compensacao == true) {
			$this->codigo_banco_debito_compensacao = '237';
		}else {
			$this->codigo_banco_debito_compensacao = '000';
		}
	}

	/**
	 * habilita o campo para receber a porcentagem de multas por atraso de pagamento
	 * @param field_type $campo_multa
	 */
	public function setCampo_multa($campo_multa = true) {
		if($campo_multa == true) {
			$this->campo_multa = 2;
		}else {
			$this->campo_multa = '0';
		}
	}

	/**
	 * @param field_type $percentual_multa
	 */
	public function setPercentual_multa($percentual_multa) {
		if($this->getCampo_multa() == true && is_numeric($percentual_multa) && $this->valid_tamanho_campo($percentual_multa, 4)) {
			$this->percentual_multa = $percentual_multa;
		}else {
			$this->percentual_multa = '0000';
		}
	}

	/**
	 * campo de NOSSO NUMERO, identificador unico para cada boleto gerado
	 * @param field_type $identificacao_titulo_banco
	 */
	public function setIdentificacao_titulo_banco($identificacao_titulo_banco) {
		if($this->valid_tamanho_campo($identificacao_titulo_banco, 11) && is_numeric($identificacao_titulo_banco)) {
			$this->identificacao_titulo_banco = $identificacao_titulo_banco;
		}else {
			throw new Exception('Error - Dados do nosso numero estãos incorretos');
		}
	}

	/**
	 * digito verificador do nosso numero
	 * sendo de responsabilidade de quem ira inserir-lo 
	 * @param field_type $digito_auto_consferencia_bancaria
	 */
	public function setDigito_auto_consferencia_bancaria($digito_auto_consferencia_bancaria) {
		if($this->valid_tamanho_campo($digito_auto_consferencia_bancaria, 1) && ctype_alnum($digito_auto_consferencia_bancaria)) {
			$this->digito_auto_consferencia_bancaria = $digito_auto_consferencia_bancaria;
		}else {
			throw new Exception('Error - Problemas na verificação do digito verificado do Nosso numero');
		}
	}

	/**
	 * valor de bonificação por dia
	 * @param field_type $desconto_bonificacao_dia
	 */
	public function setDesconto_bonificacao_dia($desconto_bonificacao_dia) {
		if($this->valid_tamanho_campo($desconto_bonificacao_dia, 10) && is_numeric($desconto_bonificacao_dia)) {
			$this->desconto_bonificacao_dia = $desconto_bonificacao_dia;
		}else {
			throw new Exception('Error - Dados de valor de desconto de bonificação incorretos.');
		}
	}

	/**
	 * @param string $indicador_rateio_credito
	 */
	public function setIndicador_rateio_credito($indicador_rateio_credito) {
		if($indicador_rateio_credito){
			$this->indicador_rateio_credito = 'R';
		}else {
			$this->indicador_rateio_credito = ' ';
		}
	}

	/**
	 * @param field_type $numero_documento
	 */
	public function setNumero_documento($numero_documento) {
		if($this->valid_tamanho_campo($numero_documento, 10) && ctype_alnum($numero_documento)) {
			$this->numero_documento = $numero_documento;
		}else {
			throw new Exception('Error - Dados de número do documento estão incorretos.');
		}
	}

	/**
	 * @param field_type $data_vencimento_titulo
	 */
	public function setData_vencimento_titulo($data_vencimento_titulo) {
		if($this->valid_tamanho_campo($data_vencimento_titulo, 6) && is_numeric($data_vencimento_titulo)) {
			$this->data_vencimento_titulo = $data_vencimento_titulo;
		}else{
			throw new Exception('Error - Dados da data de vencimento estão incorretos.');
		}
	}

	/**
	 * @param field_type $valor_titulo
	 */
	public function setValor_titulo($valor_titulo) {
		if($this->valid_tamanho_campo($valor_titulo, 13)) {
			$this->valor_titulo = $this->remove_formatacao_moeda($valor_titulo);
		}else{
			throw new Exception('Error - Dados do valor do titulo estão incorretos.');
		}
	}

	/**
	 * @param field_type $data_emissao_titulo
	 */
	public function setData_emissao_titulo($data_emissao_titulo) {
		if($this->valid_tamanho_campo($data_emissao_titulo, 6) && is_numeric($data_emissao_titulo)) {
			$this->data_emissao_titulo = $data_emissao_titulo;
		}else {
			throw new Exception('Error - Data de emissão de titulo incorreta.');
		}
	}

	/**
	 * @param field_type $valo_cobrado_dia_atraso
	 */
	public function setValo_cobrado_dia_atraso($valo_cobrado_dia_atraso) {
		if($this->valid_tamanho_campo($valo_cobrado_dia_atraso, 13)) {
			$this->valo_cobrado_dia_atraso = $this->remove_formatacao_moeda($valo_cobrado_dia_atraso);
		}else {
			throw new Exception('Error - Valor cobrado por dia de atraso esta incorreto.');
		}
	}

	/**
	 * @param field_type $data_limite_desconto
	 */
	public function setData_limite_desconto($data_limite_desconto) {
		if($this->valid_tamanho_campo($data_limite_desconto, 6) && is_numeric($data_limite_desconto)) {
			$this->data_limite_desconto = $data_limite_desconto;
		}else {
			throw new Exception('Error - Data limite de desconto esta incorreta.');
		}
	}

	/**
	 * @param field_type $valor_desconto
	 */
	public function setValor_desconto($valor_desconto) {
		if($this->valid_tamanho_campo($valor_desconto, 13)) {
			$this->valor_desconto = $this->remove_formatacao_moeda($valor_desconto);
		}else {
			throw new Exception('Error - Valor de desconto incorreto.');
		}
	}

	/**
	 * @param field_type $valor_iof
	 */
	public function setValor_iof($valor_iof) {
		if($this->valid_tamanho_campo($valor_iof, 13)) {
			$this->valor_iof = $this->remove_formatacao_moeda($valor_iof);
		}else {
			throw new Exception('Error - Valor de desconto incorreto.');
		}
	}

	/**
	 * @param field_type $valor_abatimento_concedido_cancelado
	 */
	public function setValor_abatimento_concedido_cancelado($valor_abatimento_concedido_cancelado) {
		if($this->valid_tamanho_campo($valor_abatimento_concedido_cancelado)) {
			$this->valor_abatimento_concedido_cancelado = $this->remove_formatacao_moeda($valor_abatimento_concedido_cancelado);
		}else {
			throw new Exception('Error - Valor de desconto incorreto.');
		}
	}

	/**
	 * @param field_type $identificacao_tipo_incricao_pagador
	 */
	public function setIdentificacao_tipo_incricao_pagador($identificacao_tipo_incricao_pagador) {
		if($identificacao_tipo_incricao_pagador == 'CPF') {
			
			$this->identificacao_tipo_incricao_pagador = '01';
			
		}elseif ($identificacao_tipo_incricao_pagador == 'CNPJ') {
			
			$this->identificacao_tipo_incricao_pagador = '02';
			
		}elseif ($identificacao_tipo_incricao_pagador == 'PIS') {
			
			$this->identificacao_tipo_incricao_pagador = '03';
			
		}elseif ($identificacao_tipo_incricao_pagador == 'NAO_TEM') {
			
			$this->identificacao_tipo_incricao_pagador = '98';
			
		}elseif ($identificacao_tipo_incricao_pagador == 'OUTROS') {
			
			$this->identificacao_tipo_incricao_pagador = '99';
			
		}else {
			throw new Exception('Error - Valor do tipo de pagador esta incorreto.');
		}
	}

	/**
	 * @param field_type $numero_inscricao_pagador
	 */
	public function setNumero_inscricao_pagador($numero_inscricao_pagador) {
		if(is_numeric($numero_inscricao_pagador)) {
			if($this->valid_tamanho_campo($numero_inscricao_pagador, 14)) {
				$this->numero_inscricao_pagador = $numero_inscricao_pagador;
			}elseif($this->valid_tamanho_campo($numero_inscricao_pagador, 11)) {
				$this->numero_inscricao_pagador = $numero_inscricao_pagador;
			}
		}else {
			throw new Exception('Error - Numero de inscrição de pagador esta incorreto.');
		}
	}

	/**
	 * @param field_type $nome_pagador
	 */
	public function setNome_pagador($nome_pagador) {
		if($this->valid_tamanho_campo($nome_pagador, 40)) {
			$this->nome_pagador = $nome_pagador;
		}else {
			throw new Exception('Error - Nome do pagador invalido, excedido o tamanho maximo de 40 caracteres.');
		}
	}

	/**
	 * @param field_type $endereco_pagador
	 */
	public function setEndereco_pagador($endereco_pagador) {
		if($this->valid_tamanho_campo($endereco_pagador, 40)) {
			$this->endereco_pagador = $endereco_pagador;
		}else {
			throw new Exception('Error - Endereço do pagador invalido, excedido o tamanho maximo de 40 caracteres.');
		}
	}

	/**
	 * @param field_type $primeira_mensagem
	 */
	public function setPrimeira_mensagem($primeira_mensagem) {
		if($this->valid_tamanho_campo($primeira_mensagem, 12)) {
			$this->primeira_mensagem = $primeira_mensagem;
		}else {
			throw new Exception('Error - Primeira mensagem invalida, excedido o tamanho maximo de 12 caracteres.');
		}
	}

	/**
	 * @param field_type $cep
	 */
	public function setCep($cep) {
		if($this->valid_tamanho_campo($cep, 5) && is_numeric($cep)) {
			$this->cep = $cep;
		}else {
			throw new Exception('Error - Valor do CEP do pagador invalido.');
		}
	}

	/**
	 * @param field_type $sufixo_cep
	 */
	public function setSufixo_cep($sufixo_cep) {
		if($this->valid_tamanho_campo($sufixo_cep, 3) && is_numeric($sufixo_cep)) {
			$this->sufixo_cep = $sufixo_cep;
		}else {
			throw new Exception('Error - Valor do sufixo do CEP do pagador invalido.');
		}
	}

	/**
	 * Não utilizar as expressões 'taxa bancária' ou 'tarifa bancária' nos boletos de 
	 * cobrança, pois essa tarifa refere-se à negociada pelo Banco com seu cliente 
	 * beneficiário. Orientação da FEBRABAN (Comunicado FB-170/2005).
	 * 
	 * @param field_type $sacador_segunda_mensagem
	 */
	public function setSacador_segunda_mensagem($sacador_segunda_mensagem) {
		if($this->valid_tamanho_campo($sacador_segunda_mensagem, 60)) {
			$this->sacador_segunda_mensagem = $sacador_segunda_mensagem;
		}else {
			throw new Exception('Error - Dados da segunda mensagem estão invalidos.');
		}
	}

	/**
	 * @param field_type $numero_sequencial_registro
	 */
	public function setNumero_sequencial_registro($numero_sequencial_registro) {
		if($this->valid_tamanho_campo($numero_sequencial_registro, 6) && is_numeric($numero_sequencial_registro)) {
			$this->numero_sequencial_registro = $numero_sequencial_registro;
		}else {
			throw new Exception('Error - Valor do sequencial invalido ou excedeu o limite maximo de 6 digitos.');
		}
	}

	/* (non-PHPdoc)
	 * @see IFuncoes::montar_linha()
	 */
	public function montar_linha() {
		// TODO Auto-generated method stub
	}

}