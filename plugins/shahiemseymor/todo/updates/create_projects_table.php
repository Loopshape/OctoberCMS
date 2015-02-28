<?php namespace ShahiemSeymor\Todo\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class CreateProjectsTable extends Migration
{

    public function up()
    {
        Schema::create('shahiemseymor_todo_projects', function($table)
        {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->string('title');
            $table->text('description');
            $table->integer('user_id');
            $table->timestamps();
        });

        Schema::create('shahiemseymor_todo_projects_assigned', function($table)
        {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->integer('user_id');
            $table->integer('project_id');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::drop('shahiemseymor_todo_projects');
        Schema::drop('shahiemseymor_todo_projects_assigned');
    }

}
