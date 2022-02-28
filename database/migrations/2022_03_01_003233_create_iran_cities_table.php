<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateIranCitiesTable extends Migration
{
    /**
     * Migration for shahr
     *
     * Run the migrations.
     *
     * This table is equal to shahr in farsi
     *
     * @return void
     */
    public function up()
    {
        Schema::create('iran_cities', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->foreignId('province_id')->constrained('iran_provinces')->onDelete('cascade');
            $table->foreignId('county_id')->constrained('iran_counties')->onDelete('cascade');
            $table->foreignId('sector_id')->constrained('iran_sectors')->onDelete('cascade');
            $table->string('code', 50)->unique();
            $table->string('short_code', 20);
            $table->boolean('status')->default(1);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('iran_cities');
    }
}
