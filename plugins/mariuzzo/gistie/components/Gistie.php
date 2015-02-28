<?php namespace Mariuzzo\Gistie\Components;

use Cms\Classes\ComponentBase;

class Gistie extends ComponentBase
{
    public $url;

    public function componentDetails()
    {
        return [
            'name'        => 'Gist',
            'description' => 'Embed a Github\'s gist'
        ];
    }

    public function defineProperties()
    {
        return [
            'url' => [
                'description' => 'The gist url.',
                'title'       => 'Gist URL',
                'default'     => 'https://gist.github.com/',
                'type'        => 'string'
            ]
        ];
    }

    public function onRun()
    {
        $this->url = $this->property('url');
    }

}