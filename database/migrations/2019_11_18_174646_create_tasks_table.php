<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTasksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return voido    Service ID
o   Title
o   Detail
o   Type (Online/Physical)
o   Location
o   Due Date
o   Budget

     */
    public function up()
    {
        Schema::create('tasks', function (Blueprint $table) {
            $table->bigIncrements('service_id');
            $table->string('title');
            $table->string('detail')->nullable();
            $table->string('type');
            $table->string('address');
            $table->bigInteger('latitude');
            $table->bigInteger('longitude');
            $table->dateTime('due_date');
            $table->string('budget')->nullable();


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
        Schema::dropIfExists('tasks');
    }
}
