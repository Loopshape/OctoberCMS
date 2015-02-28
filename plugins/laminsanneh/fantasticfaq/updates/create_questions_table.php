<?php namespace LaminSanneh\FantasticFaq\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class CreateQuestionsTable extends Migration
{

    public function up()
    {
        Schema::create('laminsanneh_fantasticfaq_questions', function($table)
        {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->integer('group_id')->unsigned();
            $table->foreign('group_id')->references('id')->on('laminsanneh_fantasticfaq_faq_groups');
            $table->string('title');
            $table->text('body');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::drop('laminsanneh_fantasticfaq_questions');
    }

}
