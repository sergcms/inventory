<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCardsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cards', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('inventory');
            $table->unsignedInteger('department_id');
            $table->foreign('department_id')->references('id')->on('departments');
            $table->unsignedInteger('device_id');
            $table->foreign('device_id')->references('id')->on('devices');
            $table->unsignedInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users');
            $table->string('model');
            $table->string('characteristic')->nullable();
            $table->text('movement')->nullable();
            $table->enum('condition', ['Рабочее', 'Не рабочее', 'В ремонте'])->default('Рабочее');
            $table->string('photo')->nullable();
            $table->text('comment')->nullable();            
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
        Schema::dropIfExists('cards');
    }
}
