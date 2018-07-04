<?php
namespace App\Entities\Sep;

use App\Helpers\Signature;
use GuzzleHttp\Client;

class Bpjs
{
    protected $client = null;
    protected $api_url;
    protected $header;

    public function __construct()
    {
       $this->client = new Client(['cookies' => true]); 
       $this->api_url = config('bpjs.api.enpoint');
    }
}