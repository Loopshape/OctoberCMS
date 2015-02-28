<?php namespace OctoDevel\OctoMail\Models;

use Model;

class Files extends Model
{
    public static function write_view($data)
    {
        $dbData = is_array($data) ? $data : $data->attributes;
        $path = base_path('plugins/octodevel/octomail/views/mail/') . $dbData['filename'];

        $content = "subject = \"". $dbData['subject'] ."\"\n==\r\n";
        $content .= $dbData['content'] . "\r\n==\r\n";
        $content .= $dbData['content_html'];

        if(!file_put_contents($path, $content))
	    return FALSE;

        return TRUE;
    }

    public static function delete_view($data)
    {
        $dbData = is_array($data) ? $data : $data->attributes;
        $path = base_path('plugins/octodevel/octomail/views/mail/') . $dbData['filename'];
        $tmp_path = base_path('plugins/octodevel/octomail/views/mail/') . 'tmp-' . $dbData['slug'] . '.htm';

	// Remove file
        if(file_exists($path))
            @unlink ($path);

	// Remove temp files
	if(file_exists($tmp_path))
            @unlink ($tmp_path);

        return TRUE;
    }
}