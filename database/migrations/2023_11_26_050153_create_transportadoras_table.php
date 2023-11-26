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
      Schema::create('transportadoras', function (Blueprint $table) {
         $table->string("id")->unique()->primary();
         $table->string("cnpj");
         $table->string("nome_fantasia");
      });
   }

   /**
    * Reverse the migrations.
    */
   public function down(): void
   {
      Schema::dropIfExists('transportadoras');
   }
};
