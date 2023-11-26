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
      Schema::create('clientes', function (Blueprint $table) {
         $table->string("cliente_cpf")->unique()->primary();
         $table->string("cliente_nome");
         $table->string("cliente_endereco");
         $table->string("cliente_estado");
         $table->string("cliente_cep")->nullable();
         $table->string("cliente_pais")->default("Brasil");
         $table->string("cliente_lat")->nullable()->comment("latitude");
         $table->string("cliente_lng")->nullable()->comment("longitude");
         $table->timestamps();
      });
   }

   /**
    * Reverse the migrations.
    */
   public function down(): void
   {
      Schema::dropIfExists('clientes');
   }
};
