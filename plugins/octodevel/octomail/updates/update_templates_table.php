<?php namespace OctoDevel\OctoMail\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class UpdateTemplatesTable extends Migration
{

    public function up()
    {
        if ( Schema::hasTable('octodevel_octomail_templates') and !Schema::hasColumn('octodevel_octomail_templates', 'autoresponse') )
        {
            Schema::table('octodevel_octomail_templates', function($table)
            {
                $table->integer('autoresponse')->default(1);
            });
        }
    }

    public function down()
    {
        return true;
    }
}
