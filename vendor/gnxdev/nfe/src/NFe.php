<?php
namespace Gnxdev\NFe;

use GuzzleHttp\Client;
use GuzzleHttp\Psr7\Request as ClientRequest;

class NFe
{
    public $client;

    public $urls = {
        'auth'    => 'https://homologacao.nfce.fazenda.pr.gov.br/nfce/NFeAutorizacao3',
        'receipt' => 'https://homologacao.nfce.fazenda.pr.gov.br/nfce/NFeRetAutorizacao3',
        'check_access_key' => 'https://homologacao.nfce.fazenda.pr.gov.br/nfce/NFeConsulta3',
        'destruction' => 'https://homologacao.nfce.fazenda.pr.gov.br/nfce/NFeInutilizacao3',
        'service_status' => 'https://homologacao.nfce.fazenda.pr.gov.br/nfce/NFeStatusServico3',
        'history' => 'https://homologacao.nfce.fazenda.pr.gov.br/nfce/NFeRecepcaoEvento'
    };

    public $soap;

    public function __construct()
    {
        View::addNamespace('gnx.nfe', __DIR__ . '/views/');

        $this->client = new Client([
            'base_uri' => $this->baseUrl,
            'timeout'  => 2.0,
        ]);
    }

    public function buildSoap($data)
    {
        $this->soap = new SoapClient(url('/xml/soap.' . $type . '.wsdl'));

        return $result;
    }

    public function buildXML($type, $data)
    {
        return view('gnx.nfe::' . $type . '.xml', compress('data'))->render();
    }

    public function sendRequest($type, $data)
    {

        $xml = $this->buildSoap( $this->buildXML($type, $data) );
        $this->client;
    }

    public function reciveRequest()
    {

    }
}