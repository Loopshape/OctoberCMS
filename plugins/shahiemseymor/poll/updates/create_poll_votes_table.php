<?php namespace ShahiemSeymor\Poll\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class CreatePollVotesTable extends Migration
{

    public function up()
    {
        Schema::create('shahiemseymor_poll_votes', function($table)
        {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->string('ip');
            $table->integer('answer_id');
            $table->integer('poll_id');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::drop('shahiemseymor_poll_votes');
    }

}
