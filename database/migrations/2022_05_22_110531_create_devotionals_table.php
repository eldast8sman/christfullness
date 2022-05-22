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
        Schema::create('devotionals', function (Blueprint $table) {
            $table->id();
            $table->date('devotional_date');
            $table->string('topic', 1000);
            $table->string('bible_text', 255);
            $table->string('memory_verse_text', 255);
            $table->text('memory_verse');
            $table->longText('devotional');
            $table->longText('further_reading');
            $table->text('prayers');
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
        Schema::dropIfExists('devotionals');
    }
};
