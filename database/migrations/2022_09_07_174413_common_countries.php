<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CommonCountries extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

            Schema::table('geo_countries', function (Blueprint $table) {
                $table->tinyInteger('is_common')->default(0)->index();
            });

            $uk = \AscentCreative\Geo\Models\Country::find('1188');
            $uk->is_common = true;
            $uk->save();        

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('geo_countries', function (Blueprint $table) {
            $table->dropColumn('is_common');
        });
    }
}
