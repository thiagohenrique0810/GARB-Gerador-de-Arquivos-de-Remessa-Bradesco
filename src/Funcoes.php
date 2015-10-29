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
		if($tamanho > 0 && $qtd_value <= $tamanho) {
			
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
	
	/**
	 * metodo para remover formação de moedas: pontos e virgulas
	 * @param unknown $valor
	 * @return mixed|boolean
	 */
	public function remove_formatacao_moeda($valor) {
		if(is_numeric($valor)) {
			$return = str_replace(".", "", $valor);
			$return = str_replace(",", "", $valor);
			
			return $return;
		}else {
			throw new Exception('Error - O valor ' . $valor . ' não é um numero.');
		}
	}
	
	/**
	 * metodo para validar o CPF
	 * @param string $cpf
	 * @return boolean
	 */
	public function validaCPF($cpf = null) {
	
		// Verifica se um número foi informado
		if(empty($cpf)) {
			return false;
		}
	
		// Elimina possivel mascara
		$cpf = preg_replace('[^0-9]', '', $cpf);
		$cpf = str_pad($cpf, 11, '0', STR_PAD_LEFT);
		 
		// Verifica se o numero de digitos informados é igual a 11
		if (strlen($cpf) != 11) {
			return false;
		}
		// Verifica se nenhuma das sequências invalidas abaixo
		// foi digitada. Caso afirmativo, retorna falso
		else if ($cpf == '00000000000' ||
				 $cpf == '11111111111' ||
				 $cpf == '22222222222' ||
				 $cpf == '33333333333' ||
			 	 $cpf == '44444444444' ||
				 $cpf == '55555555555' ||
				 $cpf == '66666666666' ||
				 $cpf == '77777777777' ||
				 $cpf == '88888888888' ||
				 $cpf == '99999999999') {
					return false;
					// Calcula os digitos verificadores para verificar se o
					// CPF é válido
		} else {
			 
			for ($t = 9; $t < 11; $t++) {
				 
				for ($d = 0, $c = 0; $c < $t; $c++) {
					$d += $cpf{$c} * (($t + 1) - $c);
				}
				$d = ((10 * $d) % 11) % 10;
				if ($cpf{$c} != $d) {
					return false;
				}
			}

			return true;
		}
	}
}