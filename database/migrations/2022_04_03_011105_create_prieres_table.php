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
        Schema::create('prieres', function (Blueprint $table) {
            $table->id();
            $table->text('subject');
            $table->string('phone');
            $table->string('email');
            $table->string('image')->nullable();
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
        Schema::dropIfExists('prieres');
    }
};
