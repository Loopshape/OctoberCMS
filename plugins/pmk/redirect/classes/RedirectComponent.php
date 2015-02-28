<?php namespace PMK\Redirect\Classes;

use Cms\Classes\ComponentBase;
use Cms\Classes\Controller;
use Cms\Classes\Page;

abstract class RedirectComponent extends ComponentBase
{

    public function onRun()
    {
        $url = "";
        $status = '302';

        if ($this->property('redirectInternal') !== null) {
            $url = Page::url($this->property('redirectInternal'));
        }

        if ($this->property('redirectExternal') !== null) {
            $url = $this->property('redirectExternal');
        }

        if ($this->property('statusCode') !== null) {
            $status = $this->property('statusCode');
        }

        if (!!strlen($url)) {
            header("Location: " . $url, true, $status);
            exit;
        }
    }

    public function getStatusCodeOptions()
    {
        return [
            '301' => 'Moved Permanently',
            '302' => 'Found (temporary redirect)',
            '307' => 'Temporary Redirect (since HTTP/1.1)',
            '308' => 'Permanent Redirect (Experimental RFC; RFC 7238)'
        ];
    }

}
