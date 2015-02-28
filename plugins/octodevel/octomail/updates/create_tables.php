<?php namespace OctoDevel\OctoMail\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class CreateTables extends Migration
{

    public function up()
    {
        // Install templates table
        if ( !Schema::hasTable('octodevel_octomail_templates') )
        {
            Schema::create('octodevel_octomail_templates', function($table)
            {
                $table->engine = 'InnoDB';
                $table->increments('id');
                $table->string('title')->unique();
                $table->string('slug')->index()->unique();
                $table->string('subject')->nullable();
                $table->string('filename')->index()->unique();
                $table->string('lang');
                $table->integer('autoresponse')->default(1);
                $table->text('content')->nullable();
                $table->text('content_html')->nullable();
                $table->text('fields')->nullable();
                $table->string('sender_name')->nullable();
                $table->string('sender_email')->nullable();
                $table->string('recipient_name')->nullable();
                $table->string('recipient_email')->nullable();
                $table->text('confirmation_text')->nullable();
                $table->timestamps();
            });
        }
    }

    public function down()
    {
        // Drop templates table
        if ( Schema::hasTable('octodevel_octomail_templates') )
        {
            Schema::drop('octodevel_octomail_templates');
        }
    }

}
