<?php

namespace App\Http\Controllers;

use App\Models\Clientes;
use App\Models\EntregasModel;
use App\Models\Rastreamento;
use App\Http\Controllers\MigrarDados;

use Illuminate\Http\Request;

class EntregasController extends Controller
{
   //método que é chamado para consulta de múltiplas entregas
   public function consulta(Request $request)
   {
      MigrarDados::migrar(); //pega os dados das APIs e salva nas tables

      $cpf = str_replace(".", "", str_replace("-", "", $request->query('cpf'))); //ajusta formatação do cpf

      //busca entregas por cpf informado
      if(!empty($cpf))
         $entregas = EntregasModel::where('cliente_cpf', $cpf)->with('cliente')->get();
         // $entregas = EntregasModel::where('cliente_cpf', $cpf)->get();
      else
         $entregas = EntregasModel::with('cliente')->get();
         // $entregas = EntregasModel::all();

      // \DB::enableQueryLog();
      // $entregas = EntregasModel::with('rastreamentos')->get();
      // $queries = \DB::getQueryLog();
      // print_r($queries);
      
      $entregas = $entregas->toJSON(); //transforma dados em json
      $entregas = json_decode($entregas, true);

      foreach ($entregas as $key => $entrega) {
         $ultimo_rastreio = Rastreamento::where("entrega_id", $entrega["id"])->orderBy('date', 'asc')->first();

         if ($ultimo_rastreio) 
            $entregas[$key]["rastreamento"] = $ultimo_rastreio->toArray();
         else 
            $entregas[$key]["rastreamento"] = null;
      }

      //renderiza view com entregas encontradas
      return view("consulta_entregas", [
         "entregas" => $entregas,
         "title" => "Consulta de Pacotes"
      ]);
   }

   //método que é chamado para mostrar dados de entrega única
   public function entrega($id, Request $request){
      MigrarDados::migrar(); //pega os dados das APIs e salva nas tables

      $entrega = EntregasModel::with('cliente')->with('transportadora')->find($id); //pega dados da entrega junto com dados de cliente e transportadora
      $rastreios = Rastreamento::where("entrega_id", $id)->orderBy('date', 'desc')->get(); //pega todos os dados de rastreamento da entrega

      if(is_null($entrega)) abort(404); //mostrar 404 caso entrega não seja encontrada
         
      $entrega = $entrega->toArray();

      if ($rastreios) 
         $entrega["rastreamento"] = $rastreios->toArray(); //inclui os dados de rastreamento no array principal
      else 
         $entrega["rastreamento"] = null; //caso não haja dados de rastreamento, poe null

      // print_r($entrega);

      //renderiza view com entregas encontradas
      return view("entrega", [
         "entrega" => $entrega,
         "title" => "Dados do Pacote"
      ]);
   }
}
