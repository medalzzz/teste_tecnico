<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transportadoras extends Model
{
   use HasFactory;

   public $incrementing = false; //primary id não é autoincrement
   protected $keyType = 'string';
   public $timestamps = false;

   protected $fillable = ['id', 'cnpj', 'nome_fantasia'];
}
