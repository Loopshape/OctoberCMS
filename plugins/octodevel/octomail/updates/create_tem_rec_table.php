<?php namespace OctoDevel\OctoMail\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class CreateTemRecTable extends Migration
{

    public function up()
    {

        // Install templates table
        if ( !Schema::hasTable('octodevel_octomail_tem_rec') )
        {
            Schema::create('octodevel_octomail_tem_rec', function($table)
            {
                $table->engine = 'InnoDB';
                $table->integer('template_id')->unsigned();
                $table->integer('recipient_id')->unsigned();
                $table->primary(['template_id', 'recipient_id']);
            });
        }
    }

    public function down()
    {
        // Drop octodevel_octomail_tem_rec table
        if ( Schema::hasTable('octodevel_octomail_tem_rec') )
        {
            Schema::drop('octodevel_octomail_tem_rec');
        }
        // Drop octodevel_octomail_templates_recipients table
        if ( Schema::hasTable('octodevel_octomail_templates_recipients') )
        {
            Schema::drop('octodevel_octomail_templates_recipients');
        }
    }

}
