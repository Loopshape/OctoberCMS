<?php namespace Radiantweb\Disqus\Components;

use Cms\Classes\ComponentBase;
use Request;
use Radiantweb\Disqus\Models\Settings as DisqusSettingsModel;

class Disqus extends ComponentBase
{

    public function componentDetails()
    {
        return [
            'name'        => 'Disqus',
            'description' => 'Displays Disqus Comments on the page.'
        ];
    }

    public function defineProperties()
    {
        return [];
    }

    public function onRun(){
        $this->page['disqus'] = DisqusSettingsModel::get('disquskey'); 
    }
}