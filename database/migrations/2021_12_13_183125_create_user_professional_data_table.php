<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserProfessionalDataTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_professional_data', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id');
            $table->string('license_no', 20)->nullable();
            $table->string('year_of_experience', 20)->nullable();
            $table->string('speciality', 100)->nullable();
            $table->string('other_speciality', 100)->nullable();
            $table->text('personal_commitment', 100); //might be json as well
            $table->foreign('user_id')->references('id')->on('users')
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
        Schema::dropIfExists('user_professional_data');
    }
}
