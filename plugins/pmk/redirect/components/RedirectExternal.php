<?php namespace PMK\Redirect\Components;

use PMK\Redirect\Classes\RedirectComponent;

class RedirectExternal extends RedirectComponent
{

    public function componentDetails()
    {
        return [
            'name'        => 'External redirect',
            'description' => 'Redirect to an external url.'
        ];
    }

    public function defineProperties()
    {
        return [
            'redirectExternal' => [
                'title'             => 'Redirect to',
                'type'              => 'string',
                'default'           => 'http://'
            ],
            'statusCode' => [
                'title'             => 'Status code',
                'type'              => 'dropdown',
                'default'           => '302'
            ]
        ];
    }

}
