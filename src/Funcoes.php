<?php

class Funcoes {
	
	/**
	 * metodo para montar uma string com espaços em branco
	 * @param unknown $string
	 * @param unknown $tamanho
	 * @param string $posicao
	 * @return string|boolean
	 */
	public function montar_branco($string, $tamanho, $posicao = 'left') {
		//contanto tamanho da string
		$qtd_value = (int) strlen($string);
		
		//verificando se existem numeros
		if($tamanho > 0) {
			$result = '';
			$qtd_zeros = $tamanho - $qtd_value;
			
			for ($i = 0; $i < $qtd_zeros; $i++) {
				$result .= ' ' ;
			}
				
			//verificando posição dos zeros
			if($posicao == 'left') {
				$result = $result . $string;
			}elseif($posicao == 'right') {
				$result = $string . $result;
			}
				
			return $result;
		}else {
			throw new Exception('Error - tamanho da quantidade de espaços não especificado.');
		}
	}
	
	/**
	 * Preenche com zeros a esqueda da string
	 * @param unknown $string
	 * @param unknown $tamanho
	 * @return string
	 */
	public function add_zeros($string, $tamanho, $posicao = 'left') {
		//contanto tamanho da string
		$qtd_value = (int) strlen($string);
		
		//verificando se existem numeros
		if($tamanho > 0) {
			
			$result = '';
			$qtd_zeros = $tamanho - $qtd_value;
	
			for ($i = 0; $i < $qtd_zeros; $i++) {
				$result .= '0' ; 
			}
			
			//verificando posição dos zeros
			if($posicao == 'left') {
				$result = $result . $string;
			}elseif($posicao == 'right') {
				$result = $string . $result;
			}
			
			return $result;
		}else {
			return false;
		}
	}
	
	/**
	 * validando linha
	 * @param unknown $string
	 * @return string
	 */
	public function valid_linha($string) {
		$return  = $this->removeAccents($string);
		
		//convertendo string para maiúscula
		$return = strtoupper($return);

		if ($this->valid_tamanho_campo($return, 400)) {
			return $return;
		}else {
			throw new Exception('Erro - Informações de linha invalidas.');
		}
	}
	
	
	/**
	 * metodo para remover acentos
	 * @param unknown $string
	 * @return mixed
	 */
	public function removeAccents($string, $slug = false)
	{
		$string = strtolower($string);

		// Código ASCII das vogais
		$ascii['a'] = range(224, 230);
		$ascii['e'] = range(232, 235);
		$ascii['i'] = range(236, 239);
		$ascii['o'] = array_merge(range(242, 246), array(240, 248));
		$ascii['u'] = range(249, 252);
	
		// Código ASCII dos outros caracteres
		$ascii['b'] = array(223);
		$ascii['c'] = array(231);
		$ascii['d'] = array(208);
		$ascii['n'] = array(241);
		$ascii['y'] = array(253, 255);
	
		foreach ($ascii as $key=>$item) {
			$acentos = '';
			foreach ($item AS $codigo) $acentos .= chr($codigo);
			$troca[$key] = '/['.$acentos.']/i';
		}
	
		$string = preg_replace(array_values($troca), array_keys($troca), $string);
	
		// Slug?
		if ($slug) {
			// Troca tudo que não for letra ou número por um caractere ($slug)
			$string = preg_replace('/[^a-z0-9]/i', $slug, $string);
			// Tira os caracteres ($slug) repetidos
			$string = preg_replace('/' . $slug . '{2,}/i', $slug, $string);
			$string = trim($string, $slug);
		}
	
		return $string;
	}
	
	/**
	 * valida o tamanho do campo
	 * @param unknown $string
	 * @param unknown $tamanho
	 * @return boolean
	 */
	public function valid_tamanho_campo($string, $tamanho) {
		$length = (int) strlen($string);
		if($length == $tamanho) {
			return true;
		}else {
			return false;
		}
	}
	
	
}