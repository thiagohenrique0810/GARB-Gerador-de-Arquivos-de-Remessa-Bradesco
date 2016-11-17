<?php

/**
 * classe com as funções para criar o boleto
 * @author Thiago
 *
 */
class Funcoes_bradesco {

    public function digitoVerificador_nossonumero($numero) {
        $resto2 = $this->modulo_11($numero, 7, 1);
        $digito = 11 - $resto2;
        if ($digito == 10) {
            $dv = "P";
        } elseif($digito == 11) {
            $dv = 0;
        } else {
            $dv = $digito;
        }
        return $dv;
    }
    
    public function digitoVerificador_barra($numero) {
        $resto2 = $this->modulo_11($numero, 9, 1);
        if ($resto2 == 0 || $resto2 == 1 || $resto2 == 10) {
            $dv = 1;
        } else {
            $dv = 11 - $resto2;
        }
        return $dv;
    }
    
    // FUNÇÕES
    // Algumas foram retiradas do Projeto PhpBoleto e modificadas para atender as particularidades de cada banco
    public function formata_numero($numero,$loop,$insert,$tipo = "geral") {
        if ($tipo == "geral") {
            $numero = str_replace(",","",$numero);
            while(strlen($numero)<$loop){
                $numero = $insert . $numero;
            }
        }
        if ($tipo == "valor") {
            /*
             retira as virgulas
             formata o numero
             preenche com zeros
             */
            $numero = str_replace(",","",$numero);
            while(strlen($numero)<$loop){
                $numero = $insert . $numero;
            }
        }
        if ($tipo == "convenio") {
            while(strlen($numero)<$loop){
                $numero = $numero . $insert;
            }
        }
        return $numero;
    }
    
    public function fbarcode($valor){
        $fino = 1 ;
        $largo = 3 ;
        $altura = 50 ;
        $barcodes[0] = "00110" ;
        $barcodes[1] = "10001" ;
        $barcodes[2] = "01001" ;
        $barcodes[3] = "11000" ;
        $barcodes[4] = "00101" ;
        $barcodes[5] = "10100" ;
        $barcodes[6] = "01100" ;
        $barcodes[7] = "00011" ;
        $barcodes[8] = "10010" ;
        $barcodes[9] = "01010" ;
        for($f1=9;$f1>=0;$f1--){
            for($f2=9;$f2>=0;$f2--){
                $f = ($f1 * 10) + $f2 ;
                $texto = "" ;
                for($i=1;$i<6;$i++){
                    $texto .=  substr($barcodes[$f1],($i-1),1) . substr($barcodes[$f2],($i-1),1);
                }
                $barcodes[$f] = $texto;
            }
        }
        //Desenho da barra
        //Guarda inicial
        ?><img src=imagens/p.png width=<?php echo $fino?> height=<?php echo $altura?> border=0><img
    src=imagens/b.png width=<?php echo $fino?> height=<?php echo $altura?> border=0><img 
    src=imagens/p.png width=<?php echo $fino?> height=<?php echo $altura?> border=0><img 
    src=imagens/b.png width=<?php echo $fino?> height=<?php echo $altura?> border=0><img 
    <?php
    $texto = $valor ;
    if((strlen($texto) % 2) <> 0){
    	$texto = "0" . $texto;
    }
    
    // Draw dos dados
    while (strlen($texto) > 0) {
      $i = round($this->esquerda($texto,2));
      $texto = $this->direita($texto,strlen($texto)-2);
      $f = $barcodes[$i];
      for($i=1;$i<11;$i+=2){
        if (substr($f,($i-1),1) == "0") {
          $f1 = $fino ;
        }else{
          $f1 = $largo ;
        }
    ?>
        src=imagens/p.png width=<?php echo $f1?> height=<?php echo $altura?> border=0><img 
    <?php
        if (substr($f,$i,1) == "0") {
          $f2 = $fino ;
        }else{
          $f2 = $largo ;
        }
    ?>
        src=imagens/b.png width=<?php echo $f2?> height=<?php echo $altura?> border=0><img 
    <?php
      }
    }
    
    // Draw guarda final
    ?>
    src=imagens/p.png width=<?php echo $largo?> height=<?php echo $altura?> border=0><img 
    src=imagens/b.png width=<?php echo $fino?> height=<?php echo $altura?> border=0><img 
    src=imagens/p.png width=<?php echo 1?> height=<?php echo $altura?> border=0> 
      <?php
    } //Fim da função
    
    public function esquerda($entra,$comp){
    	return substr($entra,0,$comp);
    }
    
    public function direita($entra,$comp){
    	return substr($entra,strlen($entra)-$comp,$comp);
    }
    
    public function fator_vencimento($data) {
    	$data = explode("/",$data);
    	$ano = $data[2];
    	$mes = $data[1];
    	$dia = $data[0];
        return(abs(($this->_dateToDays("1997","10","07")) - ($this->_dateToDays($ano, $mes, $dia))));
    }
    
    public function _dateToDays($year,$month,$day) {
        $century = substr($year, 0, 2);
        $year = substr($year, 2, 2);
        if ($month > 2) {
            $month -= 3;
        } else {
            $month += 9;
            if ($year) {
                $year--;
            } else {
                $year = 99;
                $century --;
            }
        }
        return ( floor((  146097 * $century)    /  4 ) +
                floor(( 1461 * $year)        /  4 ) +
                floor(( 153 * $month +  2) /  5 ) +
                    $day +  1721119);
    }
    
    public function modulo_10($num) { 
    		$numtotal10 = 0;
            $fator = 2;
            // Separacao dos numeros
            for ($i = strlen($num); $i > 0; $i--) {
                // pega cada numero isoladamente
                $numeros[$i] = substr($num,$i-1,1);
                // Efetua multiplicacao do numero pelo (falor 10)
                // 2002-07-07 01:33:34 Macete para adequar ao Mod10 do Itaú
                $temp = $numeros[$i] * $fator; 
                $temp0=0;
                foreach (preg_split('//',$temp,-1,PREG_SPLIT_NO_EMPTY) as $k=>$v){ $temp0+=$v; }
                $parcial10[$i] = $temp0; //$numeros[$i] * $fator;
                // monta sequencia para soma dos digitos no (modulo 10)
                $numtotal10 += $parcial10[$i];
                if ($fator == 2) {
                    $fator = 1;
                } else {
                    $fator = 2; // intercala fator de multiplicacao (modulo 10)
                }
            }
    		
            // várias linhas removidas, vide função original
            // Calculo do modulo 10
            $resto = $numtotal10 % 10;
            $digito = 10 - $resto;
            if ($resto == 0) {
                $digito = 0;
            }
    		
            return $digito;
    		
    }
    
    public function modulo_11($num, $base=9, $r=0)  {
        /**
         *   Autor:
         *           Pablo Costa <pablo@users.sourceforge.net>
         *
         *   Função:
         *    Calculo do Modulo 11 para geracao do digito verificador 
         *    de boletos bancarios conforme documentos obtidos 
         *    da Febraban - www.febraban.org.br 
         *
         *   Entrada:
         *     $num: string numérica para a qual se deseja calcularo digito verificador;
         *     $base: valor maximo de multiplicacao [2-$base]
         *     $r: quando especificado um devolve somente o resto
         *
         *   Saída:
         *     Retorna o Digito verificador.
         *
         *   Observações:
         *     - Script desenvolvido sem nenhum reaproveitamento de código pré existente.
         *     - Assume-se que a verificação do formato das variáveis de entrada é feita antes da execução deste script.
         */                                        
        $soma = 0;
        $fator = 2;
        /* Separacao dos numeros */
        for ($i = strlen($num); $i > 0; $i--) {
            // pega cada numero isoladamente
            $numeros[$i] = substr($num,$i-1,1);
            // Efetua multiplicacao do numero pelo falor
            $parcial[$i] = $numeros[$i] * $fator;
            // Soma dos digitos
            $soma += $parcial[$i];
            if ($fator == $base) {
                // restaura fator de multiplicacao para 2 
                $fator = 1;
            }
            $fator++;
        }
        /* Calculo do modulo 11 */
        if ($r == 0) {
            $soma *= 10;
            $digito = $soma % 11;
            if ($digito == 10) {
                $digito = 0;
            }
            return $digito;
        } elseif ($r == 1){
            $resto = $soma % 11;
            return $resto;
        }
    }
    
    public function monta_linha_digitavel($codigo) {
    	// 01-03    -> Código do banco sem o digito
    	// 04-04    -> Código da Moeda (9-Real)
    	// 05-05    -> Dígito verificador do código de barras
    	// 06-09    -> Fator de vencimento
    	// 10-19    -> Valor Nominal do Título
    	// 20-44    -> Campo Livre (Abaixo)
    	
    	// 20-23    -> Código da Agencia (sem dígito)
    	// 24-05    -> Número da Carteira
    	// 26-36    -> Nosso Número (sem dígito)
    	// 37-43    -> Conta do Cedente (sem dígito)
    	// 44-44    -> Zero (Fixo)
            
            // 1. Campo - composto pelo código do banco, código da moéda, as cinco primeiras posições
            // do campo livre e DV (modulo10) deste campo
            
            $p1 = substr($codigo, 0, 4);							// Numero do banco + Carteira
            $p2 = substr($codigo, 19, 5);						// 5 primeiras posições do campo livre
            $p3 = $this->modulo_10("$p1$p2");						// Digito do campo 1
            $p4 = "$p1$p2$p3";								// União
            $campo1 = substr($p4, 0, 5).'.'.substr($p4, 5);
            // 2. Campo - composto pelas posiçoes 6 a 15 do campo livre
            // e livre e DV (modulo10) deste campo
            $p1 = substr($codigo, 24, 10);						//Posições de 6 a 15 do campo livre
            $p2 = $this->modulo_10($p1);								//Digito do campo 2	
            $p3 = "$p1$p2";
            $campo2 = substr($p3, 0, 5).'.'.substr($p3, 5);
            // 3. Campo composto pelas posicoes 16 a 25 do campo livre
            // e livre e DV (modulo10) deste campo
            $p1 = substr($codigo, 34, 10);						//Posições de 16 a 25 do campo livre
            $p2 = $this->modulo_10($p1);								//Digito do Campo 3
            $p3 = "$p1$p2";
            $campo3 = substr($p3, 0, 5).'.'.substr($p3, 5);
            // 4. Campo - digito verificador do codigo de barras
            $campo4 = substr($codigo, 4, 1);
            // 5. Campo composto pelo fator vencimento e valor nominal do documento, sem
            // indicacao de zeros a esquerda e sem edicao (sem ponto e virgula). Quando se
            // tratar de valor zerado, a representacao deve ser 000 (tres zeros).
    		$p1 = substr($codigo, 5, 4);
    		$p2 = substr($codigo, 9, 10);
    		$campo5 = "$p1$p2";
            return "$campo1 $campo2 $campo3 $campo4 $campo5"; 
    }
    
    public function geraCodigoBanco($numero) {
        $parte1 = substr($numero, 0, 3);
        $parte2 = $this->modulo_11($parte1);
        return $parte1 . "-" . $parte2;
    }
}
