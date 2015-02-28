<?php namespace JorgeAndrade\Subscribe\Updates;

use Schema;
use Str;
use October\Rain\Database\Updates\Migration;

class CreateSubscribersCode extends Migration
{

    public function up()
    {
        Schema::table('andradedev_subscribe_subscribers', function($table)
        {
            $table->string('code')->nullable()->after('longitude');
        });

        \DB::update("update andradedev_subscribe_subscribers set code = '{Str::random(20)}' ");
    }

    public function down()
    {
        Schema::table('andradedev_subscribe_subscribers', function($table)
        {
            $table->dropColumn('code');
        });
    }

}