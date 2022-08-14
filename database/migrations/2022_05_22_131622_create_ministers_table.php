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
        Schema::create('ministers', function (Blueprint $table) {
            $table->id();
            $table->integer('appearance');
            $table->string('name', 500);
            $table->string('slug', 600);
            $table->text('about')->nullable();
            $table->string('position', 255);
            $table->string('phone', 255)->nullable();
            $table->string('email', 255)->nullable();
            $table->boolean('status');
            $table->string('filepath', 255);
            $table->string('compressed', 255);
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
        Schema::dropIfExists('ministers');
    }
};
