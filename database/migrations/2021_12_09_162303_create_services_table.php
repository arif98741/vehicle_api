<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateServicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('services', function (Blueprint $table) {
            $table->increments('id');
            $table->string('service_name', 150);
            $table->integer('service_category_id');
            $table->float('price', 8, 2)->default(0);
            $table->text('description');
            $table->text('service_image')->nullable();
            $table->text('service_image_thumbnail')->nullable();
            $table->text('image_path')->nullable();
            $table->string('status', 20)->default('active');
            $table->foreign('service_category_id')->references('id')->on('service_categories')
                ->onUpdate('cascade')
                ->onDelete('cascade');
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
        Schema::dropIfExists('services');
    }
}
