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
        //create page for communauty
        Schema::create('communautes', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('image');
            $table->string('slug',50)->unique();
            $table->longText('description');
            $table->enum('status', ['ON', 'OFF'])->default('ON');
            $table ->dateTime('start_at')->useCurrent();
            $table->foreignId('user_id')   //Admin
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
        Schema::dropIfExists('communautes');
    }
};
