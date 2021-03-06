<?php

use App\Models\Series;
use App\Models\Minister;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('messages', function (Blueprint $table) {
            $table->id();
            $table->string('title', 255);
            $table->string('slug', 255);
            $table->foreignIdFor(Series::class, 'series_id');
            $table->text('description');
            $table->foreignIdFor(Minister::class, 'minister_id');
            $table->date('date_preached');
            $table->string('image_path', 1000);
            $table->string('compressed_image', 1000);
            $table->string('audio_path', 1000);
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
        Schema::dropIfExists('messages');
    }
};
