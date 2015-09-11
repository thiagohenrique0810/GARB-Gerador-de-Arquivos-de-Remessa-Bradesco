<?php
/**
 * 
 * GARB - GERADOR DE ARQUIVOS DE REMESSA BRADESCO
 * 
 * @author Thiago Henrique
 * 
 * PATA TESTE
 * Para a realização do teste, poderá ser transmitido quantos Arquivos Remessa lhes convier,
 * porém, gravados com todos os dados fictícios, exigidos no Lay-out, e deverá conter no
 * máximo 10 registros a vencer. Após a oficialização, os Arquivos Remessa poderão conter
 * quantos registros lhes convier. Os arquivos não devem em hipótese alguma seres compactados
 * e sim zonados, bem como os registros devem ser de acordo com as especificações do Lay-out.
 * 
 * CBDDMM??.REM
 *	CB – Cobrança Bradesco
 *	DD – O Dia geração do arquivo
 *	MM – O Mês da geração do Arquivo
 *	?? - variáveis alfanumérico-Numéricas
 *	Ex.: 01, AB, A1 etc.
 * Nota: Quando se tratar de arquivo remessa para teste, a extensão deverá ser TST.
 */

//REALIZANDO TESTES
include 'src/HeaderLabel.php';
include 'src/Trailler.php';

$cabecalho = new HeaderLabel();

//TESTANDO O HEADERLABEL
$cabecalho->setCodigo_empresa('105508');
$cabecalho->setNome_empresa('Agnetech Soluções empresariais');
$cabecalho->setNumero_sequencial_remessa('0000219');
$cabecalho->setData_gravacao('280815'); 

echo "<pre>";
echo $cabecalho->montar_linha();
//FIM DO TESTE HEADERLABEL

//TESTANDO O TRAILLER
$trailler = new Trailler();

echo '<br>';
$trailler->setNumero_sequencial_regsitro('132');

echo $trailler->montar_linha();
echo '</pre>';
//FIM DO TESTE TRAILLER
