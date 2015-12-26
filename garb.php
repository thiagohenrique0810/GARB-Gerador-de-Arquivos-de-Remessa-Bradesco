<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

require_once 'src/Arquivo.php';

/**
 * 
 * GARB - GERADOR DE ARQUIVOS DE REMESSA BRADESCO
 * 
 * @author Thiago Henrique
 * 
 * PATA TESTE
 * Para a realiza��o do teste, poder� ser transmitido quantos Arquivos Remessa lhes convier,
 * por�m, gravados com todos os dados fict�cios, exigidos no Lay-out, e dever� conter no
 * m�ximo 10 registros a vencer. Ap�s a oficializa��o, os Arquivos Remessa poder�o conter
 * quantos registros lhes convier. Os arquivos n�o devem em hip�tese alguma seres compactados
 * e sim zonados, bem como os registros devem ser de acordo com as especifica��es do Lay-out.
 * 
 * CBDDMM??.REM
 *	CB � Cobran�a Bradesco
 *	DD � O Dia gera��o do arquivo
 *	MM � O M�s da gera��o do Arquivo
 *	?? - vari�veis alfanum�rico-Num�ricas
 *	Ex.: 01, AB, A1 etc.
 * Nota: Quando se tratar de arquivo remessa para teste, a extens�o dever� ser TST.
 */

class Garb extends Arquivo {

	public function __construct() {
		 
	}

}

/* End of file Someclass.php */