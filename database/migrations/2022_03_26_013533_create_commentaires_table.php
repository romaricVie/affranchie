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
        Schema::create('commentaires', function (Blueprint $table) {
            $table->id();
            $table->text('comment');  // commentaire
            $table->foreignId('user_id') // id commenteur,
                    ->constrained()
                    ->onUpdate('cascade')
                    ->onDelete('cascade');
            $table->Integer('commentable_id'); // id de l'article ou topic
            $table->string('commentable_type'); // le model parent 
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
        Schema::dropIfExists('commentaires');
    }
};
