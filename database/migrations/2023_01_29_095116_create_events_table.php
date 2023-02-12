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
        Schema::create('events', function (Blueprint $table) {
            $table->id();
            $table->string('event', 255);
            $table->string('slug', 255);
            $table->string('theme', 255);
            $table->date('start_date');
            $table->date('end_date')->nullable();
            $table->text('timing');
            $table->text('venue', 500);
            $table->longText('details');
            $table->string('filename', 255);
            $table->string('compressed', 255);
            $table->longText('all_details');
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
        Schema::dropIfExists('events');
    }
};
