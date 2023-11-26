<?php

namespace App\Http\Controllers;


use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Http\Client\ConnectionException;
use Illuminate\Http\Client\RequestException;

use App\Models\Transportadoras;
use App\Models\Clientes;
use App\Models\EntregasModel;
use App\Models\Rastreamento;

class MigrarDados extends Controller
{
   public static function migrar()
   {
      //trata da adição de dados vindos da API de entregas nas tables
      try {
         $response = Http::get('https://run.mocky.io/v3/6334edd3-ad56-427b-8f71-a3a395c5a0c7'); //busca entregas na api informada

         //se status 2xx
         if ($response->successful()) {
            $response->json(); //pega body da request acima
            $entregas = $response["data"]; //pega data key do json

            //para cada entrega
            foreach ($entregas as $item) {
               //adiciona novo cliente se não for duplicado
               Clientes::firstOrCreate(
                  [
                     "cliente_cpf" => $item['_destinatario']["_cpf"] //primary key
                  ],
                  [
                     "cliente_nome" => $item['_destinatario']["_nome"],
                     "cliente_endereco" => $item['_destinatario']["_endereco"],
                     "cliente_estado" => $item['_destinatario']["_estado"],
                     "cliente_cep" => $item['_destinatario']["_cep"],
                     "cliente_pais" => $item['_destinatario']["_pais"],
                     "cliente_lat" => $item['_destinatario']["_geolocalizao"]["_lat"],
                     "cliente_lng" => $item['_destinatario']["_geolocalizao"]["_lng"],
                  ]
               );

               // =========================================== //

               //adiciona nova entrega se não for duplicada
               EntregasModel::firstOrCreate(
                  [
                     "id" => $item['_id'] //primary key
                  ],
                  [
                     "id_transportadora" => $item['_id_transportadora'],
                     "volumes" => $item['_volumes'],
                     "remetente_nome" => $item['_remetente']["_nome"],
                     "cliente_cpf"  => $item['_destinatario']["_cpf"],
                  ]
               );

               // =========================================== //

               //para cada atualização de rastreamento de cada entrega
               foreach ($item['_rastreamento'] as $key) {
                  //busca rastreamento com id e mensagem especificos
                  $rastreamento = Rastreamento::where('entrega_id', $item['_id'])->where('message', $key['message'])->first();

                  //se rastreamento não existir
                  if (!$rastreamento) {
                     //converte datetime string pra formato certo
                     $date = new DateTime($key["date"]);
                     $date = $date->format('Y-m-d H:i:s');

                     //adiciona novo dado de rastreio se não for duplicado
                     Rastreamento::create([
                        "entrega_id" => $item['_id'],
                        "message" => $key["message"],
                        "date" => $date
                     ]);
                  }
               }
            }
         }
         else{
            //erro 4xx ou 5xx
         }
      } 
      catch (ConnectionException $e) {
         //erro de network
      } 
      catch (RequestException $e) {
         //erro na request
      }

      //trata da adição de dados vindos da API de transportadoras nas tables
      try {
         $response = Http::get('https://run.mocky.io/v3/e8032a9d-7c4b-4044-9d00-57733a2e2637'); //busca transportadoras na api informada

         if ($response->successful()){
            $response->json(); //pega body da request acima
            // print_r($response);

            $transportadoras = $response["data"]; //pega data key do json
            // print_r($transportadoras);

            //para cada transportadora
            foreach ($transportadoras as $item){
               // print_r($item);

               //adiciona nova transportadora se não for duplicada
               Transportadoras::firstOrCreate(
                  [
                     "id" => $item['_id'] //primary key
                  ],
                  [
                     "cnpj" => $item['_cnpj'],
                     "nome_fantasia" => $item['_fantasia']
                  ]
               );
            }
         }
         else{
            //erro 4xx ou 5xx
         }
      }
      catch (ConnectionException $e) {
         //erro de network
      } 
      catch (RequestException $e) {
         //erro na request
      }
   }
}
