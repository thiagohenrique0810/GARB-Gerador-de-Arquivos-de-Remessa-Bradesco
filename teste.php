<?php
//REALIZANDO TESTES
include 'src/Arquivo.php';
echo "<pre>";

//configurando o arquivo de remessa
$config['codigo_empresa'] = '1054508';
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
	$boleto['numero_inscricao'] 			= '09191332400';
	$boleto['nome_pagador'] 				= 'thiago henrique pequeno da silva';
	$boleto['endereco_pagador'] 			= 'rua capitao lima, recife, pernambuco';
	$boleto['primeira_mensagem'] 			= '';
	$boleto['cep_pagador'] 					= '54100';
	$boleto['sufixo_cep_pagador'] 			= '230';
	$boleto['sacador_segunda_mensagem'] 	= '';
	
	//adicionando boleto
	$arquivo->add_boleto($boleto);
}

$arquivo->save();


echo "</pre>";