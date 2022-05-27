<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddCategoryAttributeIdToCategoryValues extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('category_values', function (Blueprint $table) {
            $table->foreignId('category_attribute_id')->after('product_id')->constrained('category_attributes')->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('category_values', function (Blueprint $table) {
            $table->dropConstrainedForeignId('category_attribute_id');
        });
    }
}
