<?php
namespace App\Entities\Sep;

use GuzzleHttp\Client;
use GuzzleHttp\Psr7;
use Guzzle\Http\Message\Request;
use Guzzle\Http\Message\Response;
use GuzzleHttp\Exception\RequestException;
use GuzzleHttp\Exception\ClientException;

class Sep extends Bpjs 
{

    protected $header;

    public function __construct()
    {
        Parent::__construct();
        $this->header = array('Content-Type' => 'Application/json');
        // $urlencode = array('Content-Type' => 'Application/x-www-form-urlencoded');
        // $this->headers = array_merge($this->header, $urlencode);
    }

    public function cariSep($sep)
    {
        // dd($sep);
        try {
            $url = $this->api_url . "sep/". $sep;
            $response = $this->client->get($url, ['headers' => $this->header]);
            $result = $response->getBody();
            return $result;
        } catch (RequestException $e) {
            return Psr7\str($e->getRequest());
            if ($e->hasResponse()) {
                return Psr7\str($e->getResponse());
            }
        } 
    }

    public function saveSep($data)
    {
	    $data = file_get_contents("php://input");
        try {
            $url = $this->api_url . "SEP/insert";
            $response = $this->client->post($url, ['headers' => $this->header, 'body' => $data]);
            return $response;
        } catch (RequestException $e) {
           return Psr7\str($e->getRequest());
            if ($e->hasResponse()) {
            return Psr7\str($e->getResponse());
            }
        } 
   
    }

    public function updateSep($data)
    {
        $data = file_get_contents("php://input");
        try {
            $url = $this->api_url . "Sep/Update";
            $response = $this->client->put($url, ['headers' => $this->headers, 'body' => $data]);
            return $response;
        } catch (RequestException $e) {
            return Psr7\str($e->getRequest());
            if ($e->hasResponse()) {
            return Psr7\str($e->getResponse());
            }
        } 
    }

    public function deleteSep($data)
    {
        // dd($data);
        // $data = file_get_contents("php://input");
        $data = json_decode($data);
        try {
            $url = $this->api_url . "sep/delete";
            $response = $this->client->delete($url, ['json' => $data]);
            $result = $response->getBody();
            return $result;
        } catch (RequestException $e) {
            echo "coba saja";
        } 
    }

    public function updatePulang($data)
    {
        $data = file_get_contents("php://input");
        // dd($data);
        try {
            $url = $this->api_url . "Sep/updtglplg";
            $response = $this->client->put($url, ['headers' => $this->headers, 'body' => $data]);
            return $response;
        } catch (RequestException $e) {
            return Psr7\str($e->getRequest());
            if ($e->hasResponse()) {
            return Psr7\str($e->getResponse());
            }
        } 
    }
}
