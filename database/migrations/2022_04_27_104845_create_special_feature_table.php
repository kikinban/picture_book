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
        Schema::create('special_features', function (Blueprint $table) {
            $table->id();
            $table->string('special_feture_title');
            $table->string('special_feture_text');
            $table->string('special_feture_image');
            $table->string('special_feture_start_date');
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
        Schema::dropIfExists('special_features');
    }
};
