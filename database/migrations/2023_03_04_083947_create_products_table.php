<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->decimal('price', 8, 2);
            $table->enum('status', ['available', 'unavailable'])->default('available');
            $table->enum('type', ['item', 'service']);
            $table->unsignedBigInteger('added_by');
            $table->timestamps();
            $table->softDeletes();
            
            $table->foreign('added_by')->references('id')->on('users')->onDelete('cascade');
        });
        
        Schema::create('product_histories', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('product_id');
            $table->unsignedBigInteger('user_id');
            $table->string('field');
            $table->text('old_value');
            $table->text('new_value');
            $table->timestamps();
            
            $table->foreign('product_id')->references('id')->on('products')->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('product_histories');
        Schema::dropIfExists('products');
    }
}
