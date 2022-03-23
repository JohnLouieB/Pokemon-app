<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PokemonController extends Controller
{
    protected $url = 'https://pokeapi.co/api/v2/pokemon';
    protected $headers = [];

    public function getPokemon() {
        $this->headers[] = 'Content-Type: application/json';
        $curl = new CurlController($this->headers);
        $result = $curl->getRequest($this->url);
        return response()->json($result);
    }

}
