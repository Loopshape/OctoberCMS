<?php namespace OctoDevel\OctoMail\Updates;

use \DB;
use Schema;
use October\Rain\Database\Updates\Migration;
use OctoDevel\OctoMail\Models\Template;

class FixFilenames extends Migration
{

    public function up()
    {
        $templates = DB::table('octodevel_octomail_templates')->where('filename', 'like', '%view-%')->get();

        if($templates)
        {
            foreach ($templates as $template)
            {
                $filename = str_replace('view-', '', $template->filename);

                $temp_mail = Template::find($template->id);
                $temp_mail->filename = $filename;
                $temp_mail->save();
            }
        }
    }

    public function down()
    {
        return true;
    }
}
