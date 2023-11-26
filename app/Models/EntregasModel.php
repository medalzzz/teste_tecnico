<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Rastreamento;
use App\Models\Clientes;

class EntregasModel extends Model
{
   use HasFactory;

   protected $table = 'entregas';
   public $incrementing = false; //primary id não é autoincrement
   protected $keyType = 'string';

   protected $fillable = ['id', 'id_transportadora', 'volumes', "remetente_nome", 'cliente_cpf'];

   // public function rastreamentos()
   // {
   //    return $this->hasMany(Rastreamento::class, 'entrega_id', 'id');
   // }

   public function cliente()
   {
      return $this->hasOne(Clientes::class, 'cliente_cpf', 'cliente_cpf');
   }

   public function transportadora()
   {
      return $this->hasOne(Transportadoras::class, 'id', 'id_transportadora');
   }
}
