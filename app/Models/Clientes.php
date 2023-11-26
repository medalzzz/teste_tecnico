<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Clientes extends Model
{
   use HasFactory;

   protected $table = 'clientes';
   public $incrementing = false; //primary id não é autoincrement
   protected $keyType = 'string';

   protected $fillable = ['cliente_cpf', 'cliente_nome', 'cliente_endereco', "cliente_estado", 'cliente_cep', "cliente_pais", "cliente_lat", "cliente_lng"];
}
