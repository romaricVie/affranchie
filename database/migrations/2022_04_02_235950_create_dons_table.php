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
        Schema::create('dons', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('firstname');
            $table->string('email');
            $table->string('phone');
            $table->string('nom_produit');
            $table->longText('description');
            $table->string('type');
            $table->string('etat_don')->nullable();
            $table->string('point_relais');
            $table->string('images');      
            $table->enum('status', ['ACTIF', 'INACTIF'])->default('INACTIF');
            $table ->dateTime('start_at')->useCurrent();
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
        Schema::dropIfExists('dons');
    }
};
