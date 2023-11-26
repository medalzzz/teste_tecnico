<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ListagemTransportadoras;
use Illuminate\Support\Facades\Http;

class TransportadorasController extends Controller
{
   public function index(){
      $transportadoras = Http::get('https://run.mocky.io/v3/e8032a9d-7c4b-4044-9d00-57733a2e2637');

      // return view("consulta_entregas", [
      //    "entregas" => $transportadoras->json(),
      //    "title" => "Consulta de Pacotes"
      // ]);
   }
}
