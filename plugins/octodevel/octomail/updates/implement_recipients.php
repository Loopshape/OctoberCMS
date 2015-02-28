<?php namespace OctoDevel\OctoMail\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class ImplementRecipients extends Migration
{

    public function up()
    {
        if ( Schema::hasTable('octodevel_octomail_templates') and !Schema::hasColumn('octodevel_octomail_templates', 'multiple_recipients') )
        {
            Schema::table('octodevel_octomail_templates', function($table)
            {
                $table->integer('multiple_recipients')->default(0)->nullable();
            });
        }
    }

    public function down()
    {
        return true;
    }
}
