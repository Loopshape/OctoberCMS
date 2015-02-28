<?php namespace OctoDevel\OctoMail\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class CreateRecipientsTable extends Migration
{

    public function up()
    {
        // Install octodevel_octomail_recipients table
        if ( !Schema::hasTable('octodevel_octomail_recipients') )
        {
            Schema::create('octodevel_octomail_recipients', function($table)
            {
                $table->engine = 'InnoDB';
                $table->increments('id');
                $table->string('name');
                $table->string('email');
                $table->timestamps();
            });
        }
    }

    public function down()
    {
        // Drop octodevel_octomail_recipients table
        if ( Schema::hasTable('octodevel_octomail_recipients') )
        {
            Schema::drop('octodevel_octomail_recipients');
        }
    }

}
