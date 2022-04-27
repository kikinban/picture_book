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
        Schema::table('special_features', function (Blueprint $table) {
            //カラム名のスペルミスがあった為、修正
            $table->renameColumn('special_feture_title', 'special_feature_title');
            $table->renameColumn('special_feture_text', 'special_feature_text');
            $table->renameColumn('special_feture_image', 'special_feature_image');
            $table->renameColumn('special_feture_start_date', 'special_feature_start_date');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('special_features', function (Blueprint $table) {
            //
        });
    }
};
