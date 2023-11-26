<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
   /**
    * Run the migrations.
    */
   public function up(): void
   {
      Schema::create('entregas', function (Blueprint $table) {
         $table->string("id")->unique()->primary();
         $table->string("id_transportadora");
         $table->integer("volumes");
         $table->string("remetente_nome");

         $table->string("cliente_cpf");
         // $table->foreign('cliente_cpf')->references('cliente_cpf')->on('sys_clientes');
         $table->foreign('cliente_cpf')->references('cliente_cpf')->on('clientes');
         
         $table->timestamps();
      });
   }

   /**
    * Reverse the migrations.
    */
   public function down(): void
   {
      Schema::dropIfExists('sys_entregas');
   }
};
