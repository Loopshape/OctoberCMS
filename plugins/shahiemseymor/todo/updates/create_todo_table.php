<?php namespace ShahiemSeymor\Todo\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class CreateTodoTable extends Migration
{

    public function up()
    {
        Schema::create('shahiemseymor_todo', function($table)
        {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->string('title');
            $table->string('priority');
            $table->text('description');
            $table->timestamp('deadline');
            $table->integer('progress_val');
            $table->integer('project_id');
            $table->integer('user_id');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::drop('shahiemseymor_todo');
    }

}
