<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CurlController extends Controller
{
  protected $basicRoot = 'https://';

  protected $ch = null;
  protected $headers = array();

  public function __construct($headers) {
    $this->headers = $headers;
    $this->ch = curl_init();

    curl_setopt($this->ch, CURLOPT_VERBOSE, 0);
    curl_setopt($this->ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($this->ch, CURLOPT_SSL_VERIFYPEER, FALSE);
    curl_setopt($this->ch, CURLOPT_HTTPHEADER, $this->headers);
  }
  

  public function postRequest($url, $body) {
    curl_setopt($this->ch, CURLOPT_URL, $url);
    curl_setopt($this->ch, CURLOPT_POST, 1);
    curl_setopt($this->ch, CURLOPT_POSTFIELDS, $body);

    $result = curl_exec($this->ch);
    curl_close($this->ch);

    return json_decode($result, true);
  }


  public function getRequest($url) {
    curl_setopt($this->ch, CURLOPT_URL, $url);

    $result = curl_exec($this->ch);
    curl_close($this->ch);
    
    \Log::info(json_decode($result, true));

    return json_decode($result, true);
  }

  public function putRequest($url, $body) {
    curl_setopt($this->ch, CURLOPT_URL, $url);
    curl_setopt($this->ch, CURLOPT_CUSTOMREQUEST, 'PUT');
    curl_setopt($this->ch, CURLOPT_POSTFIELDS, $body);
    curl_setopt($this->ch, CURLOPT_RETURNTRANSFER, true);

    $result = curl_exec($this->ch);
    curl_close($this->ch);

    return  json_decode($result, true);
  }
    
}
