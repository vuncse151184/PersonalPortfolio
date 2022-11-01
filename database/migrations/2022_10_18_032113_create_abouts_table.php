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
        Schema::create('abouts', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullalbe();
            $table->string('photo')->nullalbe();
            $table->string('email')->nullalbe();
            $table->string('phone')->nullalbe();
            $table->string('address')->nullalbe();
            $table->string('description')->nullalbe();
            $table->string('tagline')->nullalbe();
            $table->string('cv')->nullalbe();
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
        Schema::dropIfExists('abouts');
    }
};
