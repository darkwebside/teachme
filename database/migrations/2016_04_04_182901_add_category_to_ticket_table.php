<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddCategoryToTicketTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS = 0');
        Schema::drop('tickets');
        Schema::create('tickets', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title', 200);
            $table->integer('category_id')->unsigned();
            $table->foreign('category_id')->references('id')->on('ticket_categories');
            $table->enum('status', ['open', 'closed']);
            $table->integer('user_id')->unsigned();
            $table->foreign('user_id')->references('id')->on('users');
            $table->timestamps();
        });
        DB::statement('SET FOREIGN_KEY_CHECKS = 1');
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::drop('tickets');
    }
}
