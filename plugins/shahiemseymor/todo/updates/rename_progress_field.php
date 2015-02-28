<?php namespace ShahiemSeymor\Todo\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class RenameProgressField extends Migration
{

    public function up()
    {
        if(Schema::hasColumn('shahiemseymor_todo', 'progress'))
        {
            Schema::table('shahiemseymor_todo', function($table)
            {
                $table->renameColumn('progress', 'progress_val');
            });
        }
    }

    public function down()
    {
        if(Schema::hasColumn('shahiemseymor_todo', 'progress'))
        {
            Schema::table('shahiemseymor_todo', function($table)
            {
                $table->dropColumn('progress');
            });
        }
    }

}
