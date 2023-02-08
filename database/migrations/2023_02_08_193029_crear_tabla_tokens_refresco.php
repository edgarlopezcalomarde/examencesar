<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
   
    public function up()
    {
        Schema::create('refresh_tokens', function (Blueprint $table) {
            $table->id();
            $table->integer("id_usuario");
            $table->string("token");
            $table->timestamp("expires_in");
            $table->boolean("activo");
            $table->timestamps();
        });
    }


    public function down()
    {
        Schema::dropIfExists('refresh_tokens');
    }
};
