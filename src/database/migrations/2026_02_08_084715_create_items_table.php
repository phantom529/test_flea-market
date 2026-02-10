<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('items', function (Blueprint $table) {
            $table->id();

            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            
            $table->string('items_image');
            $table->string('items_name');
            $table->text('description');
            $table->integer('price')->unsigned();;//0円以上
            $table->string('condition');
            $table->string('brand_name');
            $table->string('item_comment');

             $table->boolean('is_sold')->default(false);//二重購入防止

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
        Schema::dropIfExists('items');
    }
}
