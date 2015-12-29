<?php
/**
 * Lay-out do Arquivo-Remessa - Registro de Transa��o - Tipo 1
 * Lay-out para Cobran�a com Registro e sem Registro com Emiss�o do Boleto pelo 
 * Banco ou pela Empresa
 * Descri��o de Registro - Tamanho 400 Bytes
 * A - Alfanum�rico - Conte�do em Caixa Alta (Letras Mai�sculas)
 * N � Num�rico
 */
require_once 'Funcoes.php';
require_once 'IFuncoes.php';

class Detalhes extends Funcoes implements IFuncoes {
	
	//001 - 001 - 1 -  N CONSTANTE
	private $identificacao_registro = 1;
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
	private $condicao_emissao_papeleta_cobranca = 2; //<--- verificar observa��es
	//094 - 094 - 1 - A - CONSTANTE
	private $ident_debito_automatico = 'N'; //<---- ver observa��es
	//095 - 104 - 10 - A
	//PREENCHER ESPA�OS EM BRANCO
	//105 - 105 - 1 - A
	private $indicador_rateio_credito;
	//106 - 106 - 1 - N - CONSTANTE
	private $enderecamento_aviso_debito = '0'; //<---- ver observa��es 
	//107 - 108 - 2 - A
	//PREENCHER ESPA�OS EM BRANCO
	//109 - 110 - 2 - N - CONSTANTE
	private $identificacao_ocorrencia = '01'; //<---- ver observa��es 
	//111 - 120 - 10 - A
	private $numero_documento;
	//121 - 126 - 6 - N
	private $data_vencimento_titulo;
	//127 - 139 - 13 - N
	private $valor_titulo;//<---- ver observa��es 
	//140 - 142 - 3 - N
	private $banco_encarregado_cobranca = "000";
	//143 - 147 - 5 - N
	private $agencia_depositaria = "00000";
	//148 - 149 - 2 - N - CONSTRANTE
	private $especie_titulo = '01';//<---- ver observa��es 
	//150 - 150 - 1 - A
	private $identificacao = "N";
	//151 - 156 - 6 - N
	private $data_emissao_titulo;
	//157 -  158 - 2 - N
	private $instrucao_1 = '00';//<---- ver observa��es FUN��O INTERESSANTE POIS PODE SER USADA PARA QUE O SISTEMA GERE AUTOMATICAMENTE O PROTESTO DE ACORDO COM O SOLICITADO
	//159 - 160 - 2 - N
	private $instrucao_2 = '00';//<---- ver observa��es 
	//161 - 173 - 13 - N
	private $valo_cobrado_dia_atraso;//<---- ver observa��es 
	//174 - 179 - 6 - N
	private $data_limite_desconto;//<---- ver observa��es 
	//180 - 192 - 13 - N
	private $valor_desconto;
	//192 - 205 - 13 N
	private $valor_iof;
	//206 - 218 - 13 - N
	private $valor_abatimento_concedido_cancelado;
	//219 - 220 - 2 - N
	private $identificacao_tipo_incricao_pagador;//<---- ver observa��es 
	//221 - 234 - 14 - N
	private $numero_inscricao_pagador;//<---- ver observa��es 
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
	private $sacador_segunda_mensagem;//<---- ver observa��es 
	//395 - 400 - 6 - N - AUTOINCREMENTADO E UNICO
	private $numero_sequencial_registro;
	
	//EXTRA
	private $carteira;

	
	/**
	 * @return the $carteira
	 */
	public function getCarteira() {
		return $this->carteira;
	}

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
		/*
		 * montando numero de identificacao da empresa
		 * exemplo: 0|009|01800|0018399|7
		 */
		$identificacao_empresa_benificiario_banco = '0' . 
													$this->getCarteira() . 
													$this->getAgencia_debito() . 
													$this->getConta_corrente() . 
													$this->getDigito_conta_corrente();
		
		return $identificacao_empresa_benificiario_banco;
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
		return $this->digito_verificador_nosso_numero($this->getCarteira() . $this->getIdentificacao_titulo_banco());
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
	 * @return the $condicao_emissao_papeleta_cobranca
	 */
	public function getCondicao_emissao_papeleta_cobranca() {
		return $this->condicao_emissao_papeleta_cobranca;
	}
	
	/**
	 * @return the $ident_debito_automatico
	 */
	public function getIdent_debito_automatico() {
		return $this->ident_debito_automatico;
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
	 * @return the $identificacao_registro
	 */
	public function getIdentificacao_registro() {
		return $this->identificacao_registro;
	}

	/**
	 * @param field_type $agencia_debito
	 */
	public function setAgencia_debito($agencia_debito) {
		//verificando se � um numero
		if(is_numeric($agencia_debito)) {
			//completando o campo
			$agencia_debito = $this->add_zeros($agencia_debito, 5);
			//realizando valida��es
			if($this->valid_tamanho_campo($agencia_debito, 5)) {
				$this->agencia_debito = $agencia_debito;
			}else {
				throw new Exception('Error: A quantidade dos digito do numero da agencia excedido.');
			}
		}else {
			throw new Exception('Error: O campo Agencia_debito n�o � um numero.');
		}
		
	}

	/**
	 * @param field_type $digito_debito_debito
	 */
	public function setDigito_debito_debito($digito_debito_debito) {
		//verifica se � numerico
		if(is_numeric($digito_debito_debito)) {
			//validando a quantidade de caracteres
			if($this->valid_tamanho_campo($digito_debito_debito, 1)) {
				$this->digito_debito_debito = $digito_debito_debito;
			}else {
				throw new Exception('Error: Quantidade de digitos para o campo Digito Agencia Debito invalidos.');
			}
		}else {
			throw new Exception('Error: O campo Digito Agencia debito n�o � um numero.');
		}
	}

	/**
	 * @param field_type $razao_conta_corrente
	 */
	public function setRazao_conta_corrente($razao_conta_corrente) {
		//validando para ver se � um numero
		if(is_numeric($razao_conta_corrente)) {
			//completando com zeros a string
			$razao_conta_corrente = $this->add_zeros($razao_conta_corrente, 5);
			//validando o tamanho da string
			if($this->valid_tamanho_campo($razao_conta_corrente, 5)) {
				$this->razao_conta_corrente = $razao_conta_corrente;
			}else {
				throw new Exception('Error: Quantidade de caracteres do campo Raz�o Conta Corrente invalidos.');
			}
		}else {
			throw new Exception('Error: O campo Raz�o Conta Corrente n�o � um numero.');
		}
	}

	/**
	 * @param field_type $conta_corrente
	 */
	public function setConta_corrente($conta_corrente) {
		//verificando se � um numero
		if(is_numeric($conta_corrente)) {
			$conta_corrente = $this->add_zeros($conta_corrente, 7);
			
			if($this->valid_tamanho_campo($conta_corrente, 7)) {
				$this->conta_corrente = $conta_corrente;
			}else {
				throw new Exception('Error: Quantidade d ecaracteres do campo Conta Corrente invalidos.');
			}
		}else {
			throw new Exception('Error: O campo Conta Corrente n�o � um numero.');
		}
	}

	/**
	 * @param field_type $digito_conta_corrente
	 */
	public function setDigito_conta_corrente($digito_conta_corrente) {
		//verificando se � numerico
		if(is_numeric($digito_conta_corrente)) {
			if($this->valid_tamanho_campo($digito_conta_corrente, 1)) {
				$this->digito_conta_corrente = $digito_conta_corrente;
			}else {
				throw new Exception('Error: Quantidade de caracteres do campo Digito Conta Conrrente.');
			}
		}else {
			throw new Exception('Error: O campo Digito Conta Corrente n�o � um numero.');
		}
	}

	/**
	 * semelhante ao numero do documento - pode ser uma chave unica de identifica��o de cada boleto da remessa
	 * @param field_type $numero_controle_participante
	 */
	public function setNumero_controle_participante($numero_controle_participante) {
		//verificando e � um numero
		if(is_numeric($numero_controle_participante)) {
			//adicionando caracteres zeros
			$numero_controle_participante = $this->add_zeros($numero_controle_participante, 25);
			//verificando tamanho da string
			if($this->valid_tamanho_campo($numero_controle_participante, 25)) {
				$this->numero_controle_participante = $numero_controle_participante;
			}else {
				throw new Exception('Error: Quantidade de caracteres do campo Numero Controle Participante invalidos.');
			}
		}else {
			throw new Exception('Error: O campo Numero Controle Participante n�o � um numero.');
		}
	}

	/**
	 * se existir debito automatico para o beneficiario, dever� ser passado como parametro TRUE
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
		//verificando e o campo multa foi setado como verdadeiro
		if($this->getCampo_multa()) {
			//verificando se � um numero
			if(is_numeric($percentual_multa)) {
				//adicionando caracteres zeros na string
				$percentual_multa = $this->add_zeros($percentual_multa, 4);
				//verificando o tamnho da string
				if($this->valid_tamanho_campo($percentual_multa, 4)) {
					$this->percentual_multa = $percentual_multa;
				}else {
					throw new Exception('Error: Quantidade de caracteres do campo Percentual Multa invalidos.');
				}
			}else {
				throw new Exception('Error: O campo Percentual Multa n�o � um numero.');
			}
		}else {
			$this->percentual_multa = '0000';
		}
	}

	/**
	 * campo de NOSSO NUMERO, identificador unico para cada boleto gerado
	 * @param field_type $identificacao_titulo_banco
	 */
	public function setIdentificacao_titulo_banco($identificacao_titulo_banco) {
		//verificando se � um numero
		if(is_numeric($identificacao_titulo_banco)) {
			//adicionando zeros na string
			$identificacao_titulo_banco = $this->add_zeros($identificacao_titulo_banco, 11);
			//verificando o tamnho da string
			if($this->valid_tamanho_campo($identificacao_titulo_banco, 11)) {
				$this->identificacao_titulo_banco = $identificacao_titulo_banco;
			}else {
				throw new Exception('Error: Quantidade de caracteres do campo Identifica��o Titulo Banco invalidos.');
			}
		}else {
			throw new Exception('Error: O campo Identifica��o Titulo Banco n�o � um numero.');
		}
	}

	/**
	 * valor de bonifica��o por dia
	 * @param field_type $desconto_bonificacao_dia
	 */
	public function setDesconto_bonificacao_dia($desconto_bonificacao_dia) {
		//verificando se � um numero
		if(is_numeric($desconto_bonificacao_dia)) {
			//adicionando zeros na string 
			$desconto_bonificacao_dia = $this->add_zeros($desconto_bonificacao_dia, 10);
			//verificando quantidade de caracteres
			if($this->valid_tamanho_campo($desconto_bonificacao_dia, 10)) {
				$this->desconto_bonificacao_dia = $desconto_bonificacao_dia;
			}else {
				throw new Exception('Error: Quantidade de caracteres do campo Desconto Bonifica��o Dia invalidos');
			}
		}else {
			throw new Exception('Error: O campo Desconto Bonifica��o Dia  n�o � um numero.');
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
		//verificando se � alfanumerico
		if(ctype_alnum($numero_documento)) {
			//adicionando zeros na string
			$numero_documento = $this->add_zeros($numero_documento, 10);
			//verificando quantidade de caracteres
			if($this->valid_tamanho_campo($numero_documento, 10)) {
				$this->numero_documento = $numero_documento;
			}else {
				throw new Exception('Error: Quantidade de caracteres do campo Numero Documento invalidos.');
			}
		}else {
			throw new Exception('Error: O campo Numero Documento n�o � alfanumerico.');
		}
	}

	/**
	 * @param field_type $data_vencimento_titulo
	 */
	public function setData_vencimento_titulo($data_vencimento_titulo) {
		//verificando se � um numero
		if(is_numeric($data_vencimento_titulo)) {
			//adicionando zeros na string
			$data_vencimento_titulo = $this->add_zeros($data_vencimento_titulo, 6);
			//verificando a quantidade de caracteres
			if($this->valid_tamanho_campo($data_vencimento_titulo, 6)) {
				$this->data_vencimento_titulo = $data_vencimento_titulo;
			}else {
				throw new Exception('Error: Quantidade de caracteres do campo Data Vencimento Titulo invalidos.');
			}
		}else {
			throw new Exception('Error: O campo Data Vencimento Titulo n�o � um numero.');
		}
	}

	/**
	 * @param field_type $valor_titulo
	 */
	public function setValor_titulo($valor_titulo) {
		//verificando se � um numero
		if(is_numeric($valor_titulo)) {	
			//adicionando zeros na string
			$valor_titulo = $this->add_zeros($valor_titulo, 13);
			//verificando quantidade de caracteres
			if($this->valid_tamanho_campo($valor_titulo, 13)) {
				$this->valor_titulo = $this->remove_formatacao_moeda($valor_titulo);
			}else {
				throw new Exception('Error: Quantidade de caracteres do campo Valor Titulo invalidos.');
			}
		}else {
			throw new Exception('Error: O campo Valor Titulo n�o � um numero.');
		}
	}

	/**
	 * @param field_type $data_emissao_titulo
	 */
	public function setData_emissao_titulo($data_emissao_titulo) {
		//verificando se � um numero
		if(is_numeric($data_emissao_titulo)) {
			//adicionando zeros
			$data_emissao_titulo = $this->add_zeros($data_emissao_titulo, 6);
			//verificando a quantidade de caracteres
			if($this->valid_tamanho_campo($data_emissao_titulo, 6)) {
				$this->data_emissao_titulo = $data_emissao_titulo;
			}else {
				throw new Exception('Error: Quantidade de caracteres do campo Data Emiss�o Titulo invalidos.');
			}
		}else {
			throw new Exception('Error: O campo Data Emissao Titulo n�o � um numero.');
		}
	}

	/**
	 * @param field_type $valo_cobrado_dia_atraso
	 */
	public function setValo_cobrado_dia_atraso($valo_cobrado_dia_atraso) {
		//verifica se � um numero
		if(is_numeric($valo_cobrado_dia_atraso)) {
			//adicionando caracteres na string
			$valo_cobrado_dia_atraso = $this->add_zeros($valo_cobrado_dia_atraso, 13);
			//verificando a quantidade de caracteres
			if($this->valid_tamanho_campo($valo_cobrado_dia_atraso, 13)) {
				$this->valo_cobrado_dia_atraso = $this->remove_formatacao_moeda($valo_cobrado_dia_atraso);
			}else {
				throw new Exception('Error: Quantidade de caracteres do campo Valor Cobrado Dia Atraso invalidos.');
			}
		}else {
			throw new Exception('Error: O campo Valor Cobrado Dia Atraso n�o � um numero.');
		}
	}

	/**
	 * @param field_type $data_limite_desconto
	 */
	public function setData_limite_desconto($data_limite_desconto) {
		//verificando se � um numero
		if(is_numeric($data_limite_desconto)) {
			//verificando quantidade de caracteres
			if($this->valid_tamanho_campo($data_limite_desconto, 6)) {
				$this->data_limite_desconto = $data_limite_desconto;
			}else {
				throw new Exception('Error: Quantidade de caracteres do campo Data Limite Desconto invalidos.');
			}
		}else {
			throw new Exception('Error: O campo Data Limite Desconto n�o � um numero.');
		}
	}

	/**
	 * @param field_type $valor_desconto
	 */
	public function setValor_desconto($valor_desconto) {
		//verificando se � um numero
		if(is_numeric($valor_desconto)) {
			//adicionando zeros na string
			$valor_desconto = $this->add_zeros($valor_desconto, 13);
			//verificando a quantidade de caracteres 
			if($this->valid_tamanho_campo($valor_desconto, 13)) {
				$this->valor_desconto = $this->remove_formatacao_moeda($valor_desconto);
			}else {
				throw new Exception('Error: Quantidade de caracteres do campo Valor Desconto invalidos.');
			}
		}else {
			throw new Exception('Error: O campo Valor Desconto n�o � um numero.');
		}
	}

	/**
	 * @param field_type $valor_iof
	 */
	public function setValor_iof($valor_iof = 0) {
		//verificando se � um numero
		if(is_numeric($valor_iof)) {
			//adicionando zeros na string
			$valor_iof = $this->add_zeros($valor_iof, 13);
			//verificando a quantidade de caracteres 
			if($this->valid_tamanho_campo($valor_iof, 13)) {
				$this->valor_iof = $this->remove_formatacao_moeda($valor_iof);
			}else {
				throw new Exception('Error: Quantidade de caracteres do campo Valor IOF invalidos.');
			}
		}else {
			throw new Exception('Error: O campo Valor IOF n�o � um numero.');
		}
	}

	/**
	 * @param field_type $valor_abatimento_concedido_cancelado
	 */
	public function setValor_abatimento_concedido_cancelado($valor_abatimento_concedido_cancelado = 0) {
		//verifica se � um numero
		if(is_numeric($valor_abatimento_concedido_cancelado)) {
			//adicionando zeros na string
			$valor_abatimento_concedido_cancelado = $this->add_zeros($valor_abatimento_concedido_cancelado, 13);
			//verificando quantidade de caracteres
			if($this->valid_tamanho_campo($valor_abatimento_concedido_cancelado, 13)) {
				$this->valor_abatimento_concedido_cancelado = $this->remove_formatacao_moeda($valor_abatimento_concedido_cancelado);
			}else {
				throw new Exception('Error: Quantidade de caracteres do campo Valor Concedido Cancelado invalidos.');
			}
		}else {
			throw new Exception('Error: O campo Valor Abatimento Concedido Cancelado n�o � um numero.');
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
		//verifica se � um numero
		if(is_numeric($numero_inscricao_pagador)) {
			//verificando o tipo de pagador
			if($this->getIdentificacao_tipo_incricao_pagador() == '01') {
				//verificando tamanho do campo
				//if($this->valid_tamanho_campo($numero_inscricao_pagador, 11) && $this->validaCPF($numero_inscricao_pagador) == true) {//DESABILITADO PARA VERIFICAÇÃO
				if($this->valid_tamanho_campo($numero_inscricao_pagador, 11)) {
					//completando campo
					$numero_inscricao_pagador  = '000' . $numero_inscricao_pagador;
					
					$this->numero_inscricao_pagador = $numero_inscricao_pagador;
				}else {
					throw new Exception('Error -  CPF do campo Numero Inscrição Pagador Invalido.');
				}
			}elseif($this->getIdentificacao_tipo_incricao_pagador() == '02') {
				//verificando o tamanho do campo
				if($this->valid_tamanho_campo($numero_inscricao_pagador, 14)) {
					$this->numero_inscricao_pagador = $numero_inscricao_pagador;
				}else {
					throw new Exception('Error -  CNPJ do campo Numero Inscrição Pagador Invalido.');
				}
			}else {
				throw new Exception('Error -  O campo Numero Inscrição é invalido.');
			}
		}else {
			throw new Exception('Error -  O campo Numero Inscrição Pagador não é um numero.');
		}
	}

	/**
	 * @param field_type $nome_pagador
	 */
	public function setNome_pagador($nome_pagador) {
		//adiciona brancos na string
		$nome_pagador = $this->montar_branco($nome_pagador, 40, 'right');
		//verifica a quantidade de caracteres
		if($this->valid_tamanho_campo($nome_pagador, 40)) { 
			$this->nome_pagador = $nome_pagador;
		}else{
			throw new Exception('Error - Nome do pagador invalido, excedido o tamanho maximo de 40 caracteres.');
		}
	}

	/**
	 * @param field_type $endereco_pagador
	 */
	public function setEndereco_pagador($endereco_pagador) {
		//	die($endereco_pagador);
			$tamanho = strlen($endereco_pagador);
			if($tamanho > 40) {
				
				$endereco_pagador = $this->resume_texto($endereco_pagador, 39);
				
				$endereco_pagador = $this->montar_branco($endereco_pagador, 40, 'right');
				
				if($this->valid_tamanho_campo($endereco_pagador, 40)) {
					$this->endereco_pagador = $endereco_pagador;
				}else {
					throw new Exception('Error - Endereço do pagador invalido, excedido o tamanho maximo de 40 caracteres.');
				}
			}else {
				
				$endereco_pagador = $this->montar_branco($endereco_pagador, 40, 'right');
				
				if($this->valid_tamanho_campo($endereco_pagador, 40)) {
						
					$this->endereco_pagador = $endereco_pagador;
				}else {
					throw new Exception('Error - Endereço do pagador invalido, excedido o tamanho maximo de 40 caracteres.');
				}
			}
	}

	/**
	 * @param field_type $primeira_mensagem
	 */
	public function setPrimeira_mensagem($primeira_mensagem) {
		//preenchendo com brancos
		$primeira_mensagem = $this->montar_branco($primeira_mensagem, 12, 'right');
		
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
		//verificando se � um numero
		if(is_numeric($cep)) {
			//verificando o tamanho da string
			if($this->valid_tamanho_campo($cep, 5)) {
				$this->cep = $this->add_zeros($cep, 5);
			}else {
				throw new Exception('Error - Quantidade de caracteres do compo CEP invalidos.');
			}
		}else {
			throw new Exception('Error - O campos CEP n�o � um numero.');
		}
	}

	/**
	 * @param field_type $sufixo_cep
	 */
	public function setSufixo_cep($sufixo_cep) {
		//verificando se � um numero
		if(is_numeric($sufixo_cep)) {
			//verificando o tamanho da string
			if($this->valid_tamanho_campo($sufixo_cep, 3)) {
				$this->sufixo_cep = $this->add_zeros($sufixo_cep, 3);
			}else {
				throw new Exception('Error - Quantidade de caracteres do campo Sufixo invalidos.');
			}
		}else {
			throw new Exception('Error - O campos Sufixo CEP n�o � um numero.');
		}
	}

	/**
	 * N�o utilizar as express�es 'taxa banc�ria' ou 'tarifa banc�ria' nos boletos de 
	 * cobran�a, pois essa tarifa refere-se � negociada pelo Banco com seu cliente 
	 * benefici�rio. Orienta��o da FEBRABAN (Comunicado FB-170/2005).
	 * 
	 * @param field_type $sacador_segunda_mensagem
	 */
	public function setSacador_segunda_mensagem($sacador_segunda_mensagem) {
		//preenchendo com brancos
		$sacador_segunda_mensagem = $this->montar_branco($sacador_segunda_mensagem, 60);
		
		if($this->valid_tamanho_campo($sacador_segunda_mensagem, 60)) {
			$this->sacador_segunda_mensagem = $sacador_segunda_mensagem;
		}else {
			throw new Exception('Error - Dados da segunda mensagem est�o invalidos.');
		}
	}

	/**
	 * @param field_type $numero_sequencial_registro
	 */
	public function setNumero_sequencial_registro($numero_sequencial_registro) {
		//verificando se � um numero
		if(is_numeric($numero_sequencial_registro)) {
			//completando com zeros na string
			$numero_sequencial_registro = $this->add_zeros($numero_sequencial_registro, 6);
			//verificando o tamanho da string
			if($this->valid_tamanho_campo($numero_sequencial_registro, 6)) {
				$this->numero_sequencial_registro = $numero_sequencial_registro;
			}else {
				throw new Exception('Error - Quantidade de caracteres do campo Numero Sequencial Registro invalidos.');
			}
		}else {
			throw new Exception('Error - O campos Numero Sequencial Registro n�o � um numero.');
		}		
	}

	/**
	 * @param field_type $carteira
	 */
	public function setCarteira($carteira) {
		//verificando se � um numero
		if(is_numeric($carteira)) {
			$carteira = $this->add_zeros($carteira, 3);
			if($this->valid_tamanho_campo($carteira, 3)) {
				$this->carteira = $carteira;
			}else {
				throw new Exception('Error - Quantidade de caracteres do campo Carteira est�o invalidos.');
			}
		}else {
			throw new Exception('Error - O campos Carteira n�o � um numero.');
		}
		
	}

	/* (non-PHPdoc)
	 * Medotos para gerar a linha dos detalhes dos boletos que seram gerados
	 * @see IFuncoes::montar_linha()
	 */
	public function montar_linha() {
		
		//Montando a linha 
		$linha = 
			$this->getIdentificacao_registro() . //nao seta
			//opcional para pagador debito em conta corrente
			$this->add_zeros('', 5) . 
			$this->add_zeros('', 1) .  
			$this->add_zeros('', 5) .  
			$this->add_zeros('', 7) .  
			$this->add_zeros('', 1) .  
			//
			$this->getIdentificacao_empresa_benificiario_banco() . 
			$this->montar_branco('', 25) .  
			$this->getCodigo_banco_debito_compensacao() . 
			$this->getCampo_multa() .  
			$this->getPercentual_multa() . 
			$this->getIdentificacao_titulo_banco() .  
			$this->getDigito_auto_consferencia_bancaria() .  
			$this->getDesconto_bonificacao_dia() . 
			$this->getCondicao_emissao_papeleta_cobranca() .  //nao seta
			$this->getIdent_debito_automatico() .  //nao seta
			$this->montar_branco('', 10) .  //nao seta
			$this->getIndicador_rateio_credito() .  
			$this->getEnderecamento_aviso_debito() .  //nao seta
			$this->montar_branco('', 2) .  //nao seta
			$this->getIdentificacao_ocorrencia() .  //nao seta
			$this->getNumero_documento() .  
			$this->getData_vencimento_titulo() .  
			$this->getValor_titulo() .  
			$this->getBanco_encarregado_cobranca() .  //nao seta
			$this->getAgencia_depositaria() .  //nao seta
			$this->getEspecie_titulo() .  //nao seta
			$this->getIdentificacao() .   //nao seta
			$this->getData_emissao_titulo() .  
			$this->getInstrucao_1() .  //nao seta
			$this->getInstrucao_2() .  //nao seta
			$this->getValo_cobrado_dia_atraso() .  
			$this->getData_limite_desconto() .  
			$this->getValor_desconto() .  
			$this->getValor_iof() . 
			$this->getValor_abatimento_concedido_cancelado() .  
			$this->getIdentificacao_tipo_incricao_pagador() .  
			$this->getNumero_inscricao_pagador() .  
			$this->getNome_pagador() .  
			$this->getEndereco_pagador() .  
			$this->getPrimeira_mensagem() .  
			$this->getCep() .  
			$this->getSufixo_cep() .  
			$this->getSacador_segunda_mensagem() . 
			$this->getNumero_sequencial_registro();
			
			return $this->valid_linha($linha);
	}
	
}