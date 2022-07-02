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
        Schema::create('signal_users', function (Blueprint $table) {
              $table->id();
              $table->string('message');
              $table->string('image')->nullable();
              $table->foreignId('user_id') // id de user signalé
                   ->constrained()
                   ->onUpdate('cascade')
                   ->onDelete('cascade');
             $table->foreignId('user') // id du signaleur
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
        Schema::dropIfExists('signal_user');
    }
};
