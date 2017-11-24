<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFilmsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('films', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id');
            $table->string('name', 255);
            $table->text('description');
            $table->dateTime('realease_date');
            $table->tinyInteger('rating');
            $table->integer('ticket_price');
            $table->string('country', 100);
            $table->string('genre', 255);
            $table->string('photo', 255);
            $table->timestamps();
            $table->tinyInteger('status')->default(1)->nullable()->comment('1 - Active , 2 - Inactive, 3 - Deleted');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('films');
    }
}
