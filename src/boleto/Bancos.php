<?php
require_once(dirname(__FILE__).'/html2pdf/html2pdf.class.php');
require_once 'funcoes/Funcoes_bradesco.php';

/**
 * classe de contrução das informações do boleto de acordo com o banco
 * @author Thiago
 *
 */
class Bancos {
    
    // DADOS DO BOLETO PARA O SEU CLIENTE
    private $dias_prazo_para_pagamento;
    private $taxa_boleto;
    private $data_vencimento;
    private $valor_boleto;
    private $inicio_nosso_numero;
    private $nosso_numero;
    private $numero_documento;
    private $data_documento;
    private $data_processamento;
    
    // DADOS DO SEU CLIENTE
    private $pagador;
    private $endereco1;
    private $endereco2;
    
    // INFORMACOES PARA O CLIENTE
    private $demonstrativo1;
    private $demonstrativo2;
    private $demonstrativo3;
    
    // INSTRUÇÕES PARA O CAIXA
    private $intrucoes1;
    private $intrucoes2;
    private $intrucoes3;
    private $intrucoes4;
    
    // DADOS OPCIONAIS DE ACORDO COM O BANCO OU CLIENTE
    private $quantidade;
    private $valor_unitario;
    private $aceite;
    private $especie;
    private $especie_doc;
    
    // ---------------------- DADOS FIXOS DE CONFIGURAÇÃO DO SEU BOLETO --------------- //
    
    // DADOS DA SUA CONTA
    private $agencia;
    private $conta;
    private $conta_dv;
    private $carteira;
    
    // DADOS PERSONALIZADOS - SICREDI
    private $posto;
    private $byte_idt;
    
    // SEUS DADOS
    private $identificacao;
    private $cpf_cnpj;
    private $endereco;
    private $cidade_uf;
    private $beneficiario;
    
    /**
     * @return the $dias_prazo_para_pagamento
     */
    public function getDias_prazo_para_pagamento()
    {
        return $this->dias_prazo_para_pagamento;
    }

    /**
     * @return the $taxa_boleto
     */
    public function getTaxa_boleto()
    {
        return $this->taxa_boleto;
    }

    /**
     * @return the $data_vencimento
     */
    public function getData_vencimento()
    {
        return $this->data_vencimento;
    }

    /**
     * @return the $valor_boleto
     */
    public function getValor_boleto()
    {
        return $this->valor_boleto;
    }

    /**
     * @return the $inicio_nosso_numero
     */
    public function getInicio_nosso_numero()
    {
        return $this->inicio_nosso_numero;
    }

    /**
     * @return the $nosso_numero
     */
    public function getNosso_numero()
    {
        return $this->nosso_numero;
    }

    /**
     * @return the $numero_documento
     */
    public function getNumero_documento()
    {
        return $this->numero_documento;
    }

    /**
     * @return the $data_documento
     */
    public function getData_documento()
    {
        return $this->data_documento;
    }

    /**
     * @return the $data_processamento
     */
    public function getData_processamento()
    {
        return $this->data_processamento;
    }

    /**
     * @return the $pagador
     */
    public function getPagador()
    {
        return $this->pagador;
    }

    /**
     * @return the $endereco1
     */
    public function getEndereco1()
    {
        return $this->endereco1;
    }

    /**
     * @return the $endereco2
     */
    public function getEndereco2()
    {
        return $this->endereco2;
    }

    /**
     * @return the $demonstrativo1
     */
    public function getDemonstrativo1()
    {
        return $this->demonstrativo1;
    }

    /**
     * @return the $demonstrativo2
     */
    public function getDemonstrativo2()
    {
        return $this->demonstrativo2;
    }

    /**
     * @return the $demonstrativo3
     */
    public function getDemonstrativo3()
    {
        return $this->demonstrativo3;
    }

    /**
     * @return the $intrucoes1
     */
    public function getIntrucoes1()
    {
        return $this->intrucoes1;
    }

    /**
     * @return the $intrucoes2
     */
    public function getIntrucoes2()
    {
        return $this->intrucoes2;
    }

    /**
     * @return the $intrucoes3
     */
    public function getIntrucoes3()
    {
        return $this->intrucoes3;
    }

    /**
     * @return the $intrucoes4
     */
    public function getIntrucoes4()
    {
        return $this->intrucoes4;
    }

    /**
     * @return the $quantidade
     */
    public function getQuantidade()
    {
        return $this->quantidade;
    }

    /**
     * @return the $valor_unitario
     */
    public function getValor_unitario()
    {
        return $this->valor_unitario;
    }

    /**
     * @return the $aceite
     */
    public function getAceite()
    {
        return $this->aceite;
    }

    /**
     * @return the $especie
     */
    public function getEspecie()
    {
        return $this->especie;
    }

    /**
     * @return the $especie_doc
     */
    public function getEspecie_doc()
    {
        return $this->especie_doc;
    }

    /**
     * @return the $agencia
     */
    public function getAgencia()
    {
        return $this->agencia;
    }

    /**
     * @return the $conta
     */
    public function getConta()
    {
        return $this->conta;
    }

    /**
     * @return the $conta_dv
     */
    public function getConta_dv()
    {
        return $this->conta_dv;
    }

    /**
     * @return the $carteira
     */
    public function getCarteira()
    {
        return $this->carteira;
    }

    /**
     * @return the $posto
     */
    public function getPosto()
    {
        return $this->posto;
    }

    /**
     * @return the $byte_idt
     */
    public function getByte_idt()
    {
        return $this->byte_idt;
    }

    /**
     * @return the $identificacao
     */
    public function getIdentificacao()
    {
        return $this->identificacao;
    }

    /**
     * @return the $cpf_cnpj
     */
    public function getCpf_cnpj()
    {
        return $this->cpf_cnpj;
    }

    /**
     * @return the $endereco
     */
    public function getEndereco()
    {
        return $this->endereco;
    }

    /**
     * @return the $cidade_uf
     */
    public function getCidade_uf()
    {
        return $this->cidade_uf;
    }

    /**
     * @return the $beneficiario
     */
    public function getBeneficiario()
    {
        return $this->beneficiario;
    }

    /**
     * @param field_type $dias_prazo_para_pagamento
     */
    public function setDias_prazo_para_pagamento($dias_prazo_para_pagamento)
    {
        $this->dias_prazo_para_pagamento = $dias_prazo_para_pagamento;
    }

    /**
     * @param field_type $taxa_boleto
     */
    public function setTaxa_boleto($taxa_boleto)
    {
        $this->taxa_boleto = $taxa_boleto;
    }

    /**
     * @param field_type $data_vencimento
     */
    public function setData_vencimento($data_vencimento)
    {
        $this->data_vencimento = $data_vencimento;
    }

    /**
     * @param field_type $valor_boleto
     */
    public function setValor_boleto($valor_boleto)
    {
        $this->valor_boleto = $valor_boleto;
    }

    /**
     * @param field_type $inicio_nosso_numero
     */
    public function setInicio_nosso_numero($inicio_nosso_numero)
    {
        $this->inicio_nosso_numero = $inicio_nosso_numero;
    }

    /**
     * @param field_type $nosso_numero
     */
    public function setNosso_numero($nosso_numero)
    {
        $this->nosso_numero = $nosso_numero;
    }

    /**
     * @param field_type $numero_documento
     */
    public function setNumero_documento($numero_documento)
    {
        $this->numero_documento = $numero_documento;
    }

    /**
     * @param field_type $data_documento
     */
    public function setData_documento($data_documento)
    {
        $this->data_documento = $data_documento;
    }

    /**
     * @param field_type $data_processamento
     */
    public function setData_processamento($data_processamento)
    {
        $this->data_processamento = $data_processamento;
    }

    /**
     * @param field_type $pagador
     */
    public function setPagador($pagador)
    {
        $this->pagador = $pagador;
    }

    /**
     * @param field_type $endereco1
     */
    public function setEndereco1($endereco1)
    {
        $this->endereco1 = $endereco1;
    }

    /**
     * @param field_type $endereco2
     */
    public function setEndereco2($endereco2)
    {
        $this->endereco2 = $endereco2;
    }

    /**
     * @param field_type $demonstrativo1
     */
    public function setDemonstrativo1($demonstrativo1)
    {
        $this->demonstrativo1 = $demonstrativo1;
    }

    /**
     * @param field_type $demonstrativo2
     */
    public function setDemonstrativo2($demonstrativo2)
    {
        $this->demonstrativo2 = $demonstrativo2;
    }

    /**
     * @param field_type $demonstrativo3
     */
    public function setDemonstrativo3($demonstrativo3)
    {
        $this->demonstrativo3 = $demonstrativo3;
    }

    /**
     * @param field_type $intrucoes1
     */
    public function setIntrucoes1($intrucoes1)
    {
        $this->intrucoes1 = $intrucoes1;
    }

    /**
     * @param field_type $intrucoes2
     */
    public function setIntrucoes2($intrucoes2)
    {
        $this->intrucoes2 = $intrucoes2;
    }

    /**
     * @param field_type $intrucoes3
     */
    public function setIntrucoes3($intrucoes3)
    {
        $this->intrucoes3 = $intrucoes3;
    }

    /**
     * @param field_type $intrucoes4
     */
    public function setIntrucoes4($intrucoes4)
    {
        $this->intrucoes4 = $intrucoes4;
    }

    /**
     * @param field_type $quantidade
     */
    public function setQuantidade($quantidade)
    {
        $this->quantidade = $quantidade;
    }

    /**
     * @param field_type $valor_unitario
     */
    public function setValor_unitario($valor_unitario)
    {
        $this->valor_unitario = $valor_unitario;
    }

    /**
     * @param field_type $aceite
     */
    public function setAceite($aceite)
    {
        $this->aceite = $aceite;
    }

    /**
     * @param field_type $especie
     */
    public function setEspecie($especie)
    {
        $this->especie = $especie;
    }

    /**
     * @param field_type $especie_doc
     */
    public function setEspecie_doc($especie_doc)
    {
        $this->especie_doc = $especie_doc;
    }

    /**
     * @param field_type $agencia
     */
    public function setAgencia($agencia)
    {
        $this->agencia = $agencia;
    }

    /**
     * @param field_type $conta
     */
    public function setConta($conta)
    {
        $this->conta = $conta;
    }

    /**
     * @param field_type $conta_dv
     */
    public function setConta_dv($conta_dv)
    {
        $this->conta_dv = $conta_dv;
    }

    /**
     * @param field_type $carteira
     */
    public function setCarteira($carteira)
    {
        $this->carteira = $carteira;
    }

    /**
     * @param field_type $posto
     */
    public function setPosto($posto)
    {
        $this->posto = $posto;
    }

    /**
     * @param field_type $byte_idt
     */
    public function setByte_idt($byte_idt)
    {
        $this->byte_idt = $byte_idt;
    }

    /**
     * @param field_type $identificacao
     */
    public function setIdentificacao($identificacao)
    {
        $this->identificacao = $identificacao;
    }

    /**
     * @param field_type $cpf_cnpj
     */
    public function setCpf_cnpj($cpf_cnpj)
    {
        $this->cpf_cnpj = $cpf_cnpj;
    }

    /**
     * @param field_type $endereco
     */
    public function setEndereco($endereco)
    {
        $this->endereco = $endereco;
    }

    /**
     * @param field_type $cidade_uf
     */
    public function setCidade_uf($cidade_uf)
    {
        $this->cidade_uf = $cidade_uf;
    }

    /**
     * @param field_type $beneficiario
     */
    public function setBeneficiario($beneficiario)
    {
        $this->beneficiario = $beneficiario;
    }

    /**
     * metodo que converte o boleto em PDF
     */
    public function get_boleto_pdf($content) {
        try
        {
            $html2pdf = new HTML2PDF('P','A4','fr', array(0, 0, 0, 0));
            /* Abre a tela de impressão */
            //$html2pdf->pdf->IncludeJS("print(true);");
        
            $html2pdf->pdf->SetDisplayMode('real');
        
            /* Parametro vuehtml = true desabilita o pdf para desenvolvimento do layout */
            $html2pdf->writeHTML($content, isset($_GET['vuehtml']));
        
            /* Abrir no navegador */
            $html2pdf->Output('boleto.pdf');
        
            /* Salva o PDF no servidor para enviar por email */
            //$html2pdf->Output('caminho/boleto.pdf', 'F');
        
            /* Força o download no browser */
            //$html2pdf->Output('boleto.pdf', 'D');
        }
        catch(HTML2PDF_exception $e) {
            echo $e;
            exit;
        }
    }
    
    /**
     * metodo para criar boleto do bradesco
     */
    public function bradesco($data) {
        /*
         * configurando boleto
         */
        $boleto = new Bancos();
        
        $funcoes = new Funcoes_bradesco();
        
        $codigobanco = "237";
        $codigo_banco_com_dv = $funcoes->geraCodigoBanco($codigobanco);
        $nummoeda = "9";
        $fator_vencimento = $funcoes->fator_vencimento($dadosboleto["data_vencimento"]);
        //valor tem 10 digitos, sem virgula
        $valor = $funcoes->formata_numero($dadosboleto["valor_boleto"],10,0,"valor");
        //agencia é 4 digitos
        $agencia = $funcoes->formata_numero($dadosboleto["agencia"],4,0);
        //conta é 6 digitos
        $conta = $funcoes->formata_numero($dadosboleto["conta"],6,0);
        //dv da conta
        $conta_dv = $funcoes->formata_numero($dadosboleto["conta_dv"],1,0);
        //carteira é 2 caracteres
        $carteira = $dadosboleto["carteira"];
        //nosso número (sem dv) é 11 digitos
        $nnum = $funcoes->formata_numero($dadosboleto["carteira"],2,0).$funcoes->formata_numero($dadosboleto["nosso_numero"],11,0);
        //dv do nosso número
        $dv_nosso_numero = $funcoes->digitoVerificador_nossonumero($nnum);
        //conta cedente (sem dv) é 7 digitos
        $conta_cedente = $funcoes->formata_numero($dadosboleto["conta_cedente"],7,0);
        //dv da conta cedente
        $conta_cedente_dv = $funcoes->formata_numero($dadosboleto["conta_cedente_dv"],1,0);
        //$ag_contacedente = $agencia . $conta_cedente;
        // 43 numeros para o calculo do digito verificador do codigo de barras
        $dv = $funcoes->digitoVerificador_barra("$codigobanco$nummoeda$fator_vencimento$valor$agencia$nnum$conta_cedente".'0', 9, 0);
        // Numero para o codigo de barras com 44 digitos
        $linha = "$codigobanco$nummoeda$dv$fator_vencimento$valor$agencia$nnum$conta_cedente"."0";
        $nossonumero = substr($nnum,0,2).'/'.substr($nnum,2).'-'.$dv_nosso_numero;
        $agencia_codigo = $agencia."-".$dadosboleto["agencia_dv"]." / ". $conta_cedente ."-". $conta_cedente_dv;
        $dadosboleto["codigo_barras"] = $linha;
        $dadosboleto["linha_digitavel"] = $funcoes->monta_linha_digitavel($linha);
        $dadosboleto["agencia_codigo"] = $agencia_codigo;
        $dadosboleto["nosso_numero"] = $nossonumero;
        $dadosboleto["codigo_banco_com_dv"] = $codigo_banco_com_dv;
        
        
    }
    
}