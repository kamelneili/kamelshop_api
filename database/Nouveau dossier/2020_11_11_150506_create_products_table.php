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
            $table->string("title");
            $table->string("slug", 191)->unique();
            $table->string("description");
            $table->decimal("price", 8, 2)->default(0);
            $table->decimal("old_price", 8, 2)->default(0);
            $table->integer("inStock")->default(0);
            $table->string("image");
            $table->bigInteger("category_id")->unsigned();

            $table->timestamps();
           // $table->foreign("category_id")->references("id")->on("categories")->onDelete("cascade");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('products');
    }
}
