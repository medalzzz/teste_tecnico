<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\EntregasModel;

class Rastreamento extends Model
{
   use HasFactory;

   protected $table = 'rastreamentos';
   // protected $primaryKey = 'id';
   public $timestamps = false;

   protected $fillable = ['entrega_id', 'message', 'date'];

   public function entrega()
   {
      return $this->belongsTo(EntregasModel::class, 'entrega_id', 'id');
   }
}
