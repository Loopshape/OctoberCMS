<?php namespace PMK\Redirect\Components;

use Cms\Classes\Page;
use PMK\Redirect\Classes\RedirectComponent;

class RedirectInternal extends RedirectComponent
{

    public function componentDetails()
    {
        return [
            'name'        => 'Internal redirect',
            'description' => 'Redirect to an internal page.'
        ];
    }

    public function defineProperties()
    {
        return [
            'redirectInternal' => [
                'title'             => 'Redirect to',
                'type'              => 'dropdown'
            ],
            'statusCode' => [
                'title'             => 'Status code',
                'type'              => 'dropdown',
                'default'           => '302'
            ]
        ];
    }

    public function getRedirectInternalOptions()
    {
        return Page::sortBy('baseFileName')->lists('baseFileName', 'baseFileName');
    }

}
