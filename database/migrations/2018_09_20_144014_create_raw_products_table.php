<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRawProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('raw_products', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('company_id');
            $table->string('product_name');
            $table->string('product_display_name');
            $table->string('product_code');
            $table->integer('product_uom');
            $table->integer('product_conv_uom');
            $table->double('conv_factor',8,2);
            $table->boolean('batch_type');
            $table->boolean('stock_ledger');
            $table->string('product_rate_pick');
            $table->double('product_purchase_rate',8,2);
            $table->double('mrp_rate',8,2);
            $table->double('sales_rate',8,2);
            $table->int('product_category');
            $table->string('product_hsn');
            $table->integer('max_level');
            $table->integer('min_level');
            $table->text('description');      
            $table->timestamps();
            $table->integer('created_by_id');
            $table->integer('updated_by_id');

            $table->int('gst_rate')->references('id')->on('taxes');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('raw_products');
    }
}
