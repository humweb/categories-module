<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCategoriesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
        Schema::create('categories', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('slug')->unique();
            $table->string('caption')->nullable();
            $table->timestamps();
        });

        Schema::create('categorizables', function (Blueprint $table) {
            $table->unsignedInteger('category_id');
            $table->morphs('categorizable');
            $table->timestamp('created_at');

            $table->foreign('category_id')->references('id')->on('categories')->onDelete('cascade');
        });
    }

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::dropIfExists('categories');
		Schema::dropIfExists('categorizables');
	}

}
