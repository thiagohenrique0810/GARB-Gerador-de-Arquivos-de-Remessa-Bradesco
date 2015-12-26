<?php
/**
 * 
 * @author Thiago
 * 
 * GARB - GERADOR DE ARQUIVOS DE REMESSA BRADESCO
 * 
 * Lay-out do Arquivo-Remessa - Registro Trailler
 * Descri��o de Registro - Tamanho 400 Bytes
 * A - Alfanum�rico - Conte�do em Caixa Alta (Letras Mai�sculas)
 * N - Num�rico
 */
require_once 'Funcoes.php';

class Trailler extends Funcoes implements IFuncoes{
	//001 - 001 - 1 - N CONSTANTE
	private $identificacao_registro = 9;
	//002 - 394 - 393 - A 
	//CAMPO EM BRANCO COM 393 POSI��ES
	//395 - 400 - 6 - N 
	private $numero_sequencial_regsitro = ''; //ultima numero do sequencial dado pelo gerador
	
	/**
	 * @return the $numero_sequencial_regsitro
	 */
	public function getNumero_sequencial_regsitro() {
		return $this->numero_sequencial_regsitro;
	}

	/**
	 * @param string $numero_sequencial_regsitro
	 */
	public function setNumero_sequencial_regsitro($numero_sequencial_regsitro) {
		if(is_numeric($numero_sequencial_regsitro)) {
			$numero_sequencial_regsitro = $this->add_zeros($numero_sequencial_regsitro, 6);
			
			if( $this->valid_tamanho_campo($numero_sequencial_regsitro, 6)) {
				$this->numero_sequencial_regsitro = $numero_sequencial_regsitro;
			}else {
				throw new Exception('Error - Numero do sequencial invalido.');
			}
		}else {
			throw new Exception('Error - Numero do sequencial invalido.');
		}
	}

	/* (non-PHPdoc)
	 * @see IFuncoes::montar_linha()
	 */
	public function montar_linha() {
		// TODO Auto-generated method stub
		$linha = 
		$this->identificacao_registro	.
		$this->montar_branco('', 393)	.
		$this->getNumero_sequencial_regsitro();
		
		return $this->valid_linha($linha);
	}

	
}