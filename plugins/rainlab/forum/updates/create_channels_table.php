<?php namespace RainLab\Forum\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class CreateChannelsTable extends Migration
{

    public function up()
    {
        Schema::create('rainlab_forum_channels', function($table)
        {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->integer('parent_id')->unsigned()->index()->nullable();
            $table->string('title');
            $table->string('slug')->index()->unique();
            $table->string('description')->nullable();
            $table->integer('nest_left');
            $table->integer('nest_right');
            $table->integer('nest_depth')->nullable();
            $table->integer('count_topics')->default(0);
            $table->integer('count_posts')->default(0);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::drop('rainlab_forum_channels');
    }

}
