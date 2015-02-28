<?php namespace ShahiemSeymor\Poll\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class CreatePollTable extends Migration
{

    public function up()
    {
        Schema::create('shahiemseymor_poll', function($table)
        {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->string('question');
            $table->string('answer_1');
            $table->string('answer_2');
            $table->string('answer_3');
            $table->string('answer_4');
            $table->string('answer_5');
            $table->string('answer_6');
            $table->string('answer_7');
            $table->string('answer_8');
            $table->string('answer_9');
            $table->string('answer_10');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::drop('shahiemseymor_poll');
    }

}
