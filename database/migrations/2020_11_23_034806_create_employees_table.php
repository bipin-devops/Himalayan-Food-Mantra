<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEmployeesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('employees', function (Blueprint $table) {
            $table->id();
            $table->text('name');
            $table->text('last');
            $table->bigInteger('phone');
            $table->text('temp_address')->nullable();
            $table->text('per_address')->nullable();
            $table->text('date_of_join')->nullable();
            $table->text('gender')->nullable();
            $table->double('salary')->nullable();
            $table->text('dob')->nullable();
            $table->text('file_name')->nullable();
            $table->boolean('status')->default(1);
            $table->softDeletes();
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
        Schema::dropIfExists('employees');
    }
}
