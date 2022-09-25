<?php

use App\Models\Minister;
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
        Schema::table('devotionals', function (Blueprint $table) {
            $table->foreignIdFor(Minister::class, 'minister_id')->after('id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('devotionals', function (Blueprint $table) {
            $table->dropColumn('minister_id');
        });
    }
};
