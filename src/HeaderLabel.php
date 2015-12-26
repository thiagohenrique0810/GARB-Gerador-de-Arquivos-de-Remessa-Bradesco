<?php
/**
 * Lay-out do Arquivo-Remessa - Registro Header Label
 * Lay-out para Cobran�a com Registro e sem Registro com Emiss�o do Boleto pelo 
 * Banco ou pela Empresa
 * Descri��o de Registro - Tamanho 400 Bytes
 * A - Alfanum�rico - Conte�do em Caixa Alta (Letras Mai�sculas)
 * N - Num�rico
 */
require_once 'Funcoes.php';
require_once 'IFuncoes.php';

class HeaderLabel extends Funcoes implements IFuncoes {
	//001 - 001 - 1 -  N CONSTANTE
	private $identificacao_registro = 0;		
	//002 - 002 - 1 - N CONSTANTE
	private $identificacao_arquivo_remessa = 1;	
	//003 - 009 - 7 - A CONSTANTE
	private $literal_remessa = 'REMESSA'; 		
	//010 - 011 - 2 - N CONSTANTE
	private $codigo_servico = '01';				
	//012 - 026 - 15 - A CONSTANTE - COMPLETAR COM ESPA�OS EM BRANCO A DIREITA
	private $literal_servico = 'COBRANCA';		
	//027 - 046 - 20 - N COMPLETAR COM ZEROS A ESQUERDA
	private $codigo_empresa = ''; 				//<---- verificar observa��es
	//047 - 076 - 30 - A - COMPLETAR COM ESPA�OS EM BRANCO A DIREITA
	private $nome_empresa = '';
	//077 - 079 - 3 - N CONSTANTE
	private $numero_bradesco_compensacao = 237;	
	//080 - 094 - 15 - A CONSTANTE - COMPLETAR COM ESPA�OES EM BRANCO A DIREITA
	private $nome_banco = 'Bradesco';			
	//095 - 100 - 6 - N
	private $data_gravacao = ''; 				//<---- verificar observa��es
	//101 - 108 - 8 - A
	//CAMPO EM BRANCO COM 8 POSI��ES
	//109 - 110 - 2 - A
	private $identificacao_sistema = 'MX';
	//111 - 117 - 7 - N  - COMPLETAR COM ZEROS A ESQUERDA - DEVE SER AUTOINCREMENTADA +1 - VALOR UNICO PARA CADA NOVO ARQUIVO
	private $numero_sequencial_remessa = '';
	//118 - 394 - 277 - A
	//CAMPO EM BRANCO COM 277 POSI��ES
	//395 - 400 - 6 - N CONSTANTE
	private $numero_sequencial_regsitro = '000001';
	
	
	/**
	 * @return the $codigo_empresa
	 */
	public function getCodigo_empresa() {
		return $this->codigo_empresa;
	}

	/**
	 * @return the $nome_empresa
	 */
	public function getNome_empresa() {
		return $this->nome_empresa;
	}

	/**
	 * @return the $data_gravacao
	 */
	public function getData_gravacao() {
		//verifica se a variavel esta vazia, se sim poe a data atual como default
		if(empty($this->data_gravacao)) {
			$this->setData_gravacao(date('dmy'));
		}
		
		return $this->data_gravacao;
	}

	/**
	 * @return the $numero_sequencial_remessa
	 */
	public function getNumero_sequencial_remessa() {
		return $this->numero_sequencial_remessa;
	}

	/**
	 * @param string $codigo_empresa
	 */
	public function setCodigo_empresa($codigo_empresa) {
		if(is_numeric($codigo_empresa)) {
			$this->codigo_empresa = $this->add_zeros($codigo_empresa, 20);
		}else {
			throw new Exception('Error - N�o � um numero');
		}
	}

	/**
	 * @param string $nome_empresa
	 */
	public function setNome_empresa($nome_empresa) {
		$length = (int) strlen($nome_empresa);
		
		if($length > 0 && $length <= 30) {
			$this->nome_empresa = $this->montar_branco($nome_empresa, 30, 'right');
		}else {
			throw new Exception('Error - Tamanho de texto invalido, para o nome da empresa.');
		}
	}
	
	/**
	 * @param string $data_gravacao
	 */
	public function setData_gravacao($data_gravacao) {
		if(is_numeric($data_gravacao)) {
			$this->data_gravacao = $data_gravacao;
		}else {
			throw new Exception('Error - O campo data de grava��o n�o � um numero.');
		}
	}
	
	/**
	 * @param string $numero_sequencial_remessa
	 */
	public function setNumero_sequencial_remessa($numero_sequencial_remessa) {
		//verificando se � um numero
		if(is_numeric($numero_sequencial_remessa)) {
			//completando a string com zeros
			$numero_sequencial_remessa = $this->add_zeros($numero_sequencial_remessa, 7);
			if($this->valid_tamanho_campo($numero_sequencial_remessa, 7)) {
				$this->numero_sequencial_remessa = $numero_sequencial_remessa;
			}else {
				throw new Exception('Error - Tamanho de texto invalido, para o campo numero sequencial remessa.');
			}
		}else {
			throw new Exception('Error - O campo numero sequencial remessa n�o � um numero.');
		}
	}
	
	/* (non-PHPdoc)
	 * @see IFuncoes::montar_linha()
	 */
	public function montar_linha() {
		
		//motando linha do cabe�alho da remessa
			$linha = 	
			$this->identificacao_registro 			.
			$this->identificacao_arquivo_remessa 	.
			$this->literal_remessa					.
			$this->codigo_servico					.
			$this->literal_servico					.
			$this->montar_branco('',7)				.
			$this->getCodigo_empresa()				.
			$this->getNome_empresa()				.
			$this->numero_bradesco_compensacao		.
			$this->nome_banco						.
			$this->montar_branco('',7)				.
			$this->getData_gravacao()				.
			$this->montar_branco('',8)				.
			$this->identificacao_sistema			.
			$this->getNumero_sequencial_remessa()	.
			$this->montar_branco('',277)			.
			$this->numero_sequencial_regsitro;

			return $this->valid_linha($linha);
	}
	
}