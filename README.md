# GARB---Gerador-de-Arquivos-de-Remessa-Bradesco
Gerador de arquivos de remessa CNAB 400p para o banco Bradesco

## Introdução
Essa biblioteca foi desenvolvida com a finalidade de ser integrada ao sistema de seguradoras e
associações de proteção veicular Sistema SAV (www.sistemasav.com.br), no qual tem como objetivo principal criar Arquivos de Remessa CNAB 400 posições Bradesco, para que seja
processados todos os boletos de cobrança pelo banco.

##Descrição do arquivo de remessa Formato CNAB
 - Registro 0 : Header Label
 - Registro 1 : Transação
 - Registro 2 : Mensagem (opcional)
 - Registro 3 : Rateio de Crédito (opcional)
 - Registro 7 : Pagador Avalista (opcional)
 - Registro 9 : Trailler
 
 ##Procedimentos para criação do arquivo e envio
 ###Procedimentos da Empresa
 Para a realização do teste, poderá ser transmitido quantos Arquivos Remessa lhes convier, 
 porém, gravados com todos os dados fictícios, exigidos no Lay-out, e deverá conter no máximo 
 10 registros a vencer. Após a oficialização, os Arquivos Remessa poderão conter quantos 
 registros lhes convier. Os arquivos não devem em hipótese alguma seres compactados e sim 
 zonados, bem como os registros devem ser de acordo com as especificações do Lay-out.


 ###Exemplo de teste
```PHP
 include 'src/Arquivo.php';

 //configurando o arquivo de remessa
 $config['codigo_empresa'] = '1234567';
 $config['razao_social'] = 'Agnetech Soluções empresariais';
 $config['numero_remessa'] = '2165';
 $config['data_gravacao'] = '280815';

 $arquivo = new Arquivo();
 //configurando remessa
 $arquivo->config($config);

 for ($i = 0; $i < 20; $i++) {
	//adicionando boleto
	$boleto['agencia'] 						= '1800';
	$boleto['agencia_dv'] 					= '7';
	$boleto['razao_conta_corrente']			= '1250';
	$boleto['conta'] 						= '0018399';
	$boleto['conta_dv'] 					= '7';
	$boleto['identificacao_empresa'] 		= '6559654968';
	$boleto['numero_controle'] 				= '5219';
	$boleto['habilitar_debito_compensacao'] = true;
	$boleto['habilitar_multa'] 				= true;
	$boleto['percentual_multa'] 			= '5';
	$boleto['nosso_numero'] 				= '61551964';
	$boleto['nosso_numero_dv'] 				= 'P';
	$boleto['desconto_dia']	 				= '0';
	$boleto['rateio'] 						= false;
	$boleto['numero_documento'] 			= '56541654';
	$boleto['vencimento'] 					= '201115';
	$boleto['valor'] 						= '1200';
	$boleto['data_emissao_titulo'] 			= '161115';
	$boleto['valor_dia_atraso'] 			= '0';
	$boleto['data_limite_desconto'] 		= '201115';
	$boleto['valor_desconto'] 				= '0';
	$boleto['valor_iof'] 					= '0';
	$boleto['valor_abatimento_concedido'] 	= '0';
	$boleto['tipo_inscricao_pagador'] 		= 'CPF';
	$boleto['numero_inscricao'] 			= '09191112322';
	$boleto['nome_pagador'] 				= 'thiago henrique';
	$boleto['endereco_pagador'] 			= 'rua capitao lima, recife, pernambuco';
	$boleto['primeira_mensagem'] 			= '';
	$boleto['cep_pagador'] 					= '54100';
	$boleto['sufixo_cep_pagador'] 			= '000';
	$boleto['sacador_segunda_mensagem'] 	= '';
	
	//adicionando boleto
	$arquivo->add_boleto($boleto);
 }

 $arquivo->setFilename('C:/Ampps/www/GARB---Gerador-de-Arquivos-de-Remessa-Bradesco/src/CB171101');

 $arquivo->save();
```
 ###Procedimentos do Banco
 Independentemente da quantidade de Arquivos Remessa transmitidos, referente a um único código 
 de Empresa (Pos. 27 a 46 Reg. Header Label), será gerado somente um arquivo retorno.
Mesmo que no dia anterior não tenha sido enviado nenhum Arquivo Remessa, será gerado um Arquivo 
Retorno contendo as ocorrências sobre os Títulos registrados anteriormente. Ex.: Títulos pagos, 
baixados por decurso de prazo, com instrução de protesto, enviados para cartório etc..

###Nome dos Arquivos Remessa 
Bradesco Net Empresa/Webta: O Arquivo Remessa deverá ter a seguinte formatação:
CBDDMM??.REM
CB : Cobrança Bradesco
DD : O Dia geração do arquivo
MM : O Mês da geração do Arquivo
?? : variáveis alfanumérico-Numéricas
Ex.: 01, AB, A1 etc.

.Rem : Extensão do arquivo.

Exemplo: CB010501. REM ou CB0105AB. REM ou CB0105A1.REM
Nota: Quando se tratar de arquivo remessa para teste, a extensão deverá ser TST.

Exemplo: CB010501. TST, o retorno será disponibilizado como CB010501. RST.
