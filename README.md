# GARB---Gerador-de-Arquivos-de-Remessa-Bradesco
Gerador de arquivos de remessa CNAB 400p para o banco Bradesco

## Introdução
Essa biblioteca foi desenvolvida com a finalidade de ser integrada ao sistema de asseguradoras e
cooperativas SAV, no qual tem como objetivo principal criar Arquivos de Remessa CNAB 400 posições Bradesco, para que seja
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
