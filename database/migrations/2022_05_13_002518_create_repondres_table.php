<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('repondres', function (Blueprint $table) {
            $table->id();
             $table->text('reply');  // reponse
             $table->foreignId('user_id') //id du repondeur
                    ->constrained()
                    ->onUpdate('cascade')
                    ->onDelete('cascade');
             $table->foreignId('commentaire_id') //id du commentaire
                    ->constrained()
                    ->onUpdate('cascade')
                    ->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('repondres');
    }
};
