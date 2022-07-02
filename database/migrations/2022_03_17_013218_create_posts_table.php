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
        Schema::create('posts', function (Blueprint $table) {
            
            $table->id();
            $table->longText('message');
            $table->string('image')->nullable();
            $table->string('video')->nullable(); //new
            $table->string('title')->nullable(); //new
             $table->dateTime('date')->nullable();//new
             $table->string('lieu')->nullable(); //new
            $table->string('menu');
            $table->enum('status', ['ACTIF', 'INACTIF'])->default('ACTIF');
            $table ->dateTime('start_at')->useCurrent();
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
        Schema::dropIfExists('posts');
    }
};
