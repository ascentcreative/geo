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
            
        Schema::table('geo_addresses', function (Blueprint $table) {
            $table->decimal('lat', 10, 4)->after('country_id')->index()->nullable();
            $table->decimal('lng', 10, 4)->after('country_id')->index()->nullable();

            $table->index(['lat', 'lng']);
        });
   
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('geo_addresses', function (Blueprint $table) {
            $table->dropColumn('lat');
            $table->dropColumn('lng');
        });

    }
};
