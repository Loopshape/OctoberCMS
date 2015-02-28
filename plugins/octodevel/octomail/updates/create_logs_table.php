<?php namespace OctoDevel\OctoMail\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class CreateLogsTable extends Migration
{

    public function up()
    {
        if ( !Schema::hasTable('octodevel_octomail_logs') )
        {
            Schema::create('octodevel_octomail_logs', function($table)
            {
                $table->engine = 'InnoDB';
                $table->increments('id');
                $table->integer('template_id')->unsigned();
                $table->string('sender_agent')->nullable();
                $table->string('sender_ip')->nullable();
                $table->timestamp('sent_at');
                $table->text('data')->nullable();
                $table->timestamps();
                $table->foreign('template_id')->references('id')->on('octodevel_octomail_templates')->onDelete('no action');;
            });
        }
    }

    public function down()
    {
        if ( Schema::hasTable('octodevel_octomail_logs') )
        {
            Schema::drop('octodevel_octomail_logs');
        }
    }
}
