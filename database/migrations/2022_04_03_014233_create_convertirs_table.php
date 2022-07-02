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
        Schema::create('convertirs', function (Blueprint $table) {
            $table->id();
            $table->string('pays');
            $table->string('ville');
            $table->string('habitation');
            $table->string('email');
            $table->string('phone');
            $table->longText('motivation');
            $table->string('image');
            $table->foreignId('user_id')
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
        Schema::dropIfExists('convertirs');
    }
};
