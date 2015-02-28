<?php namespace Radiantweb\Disqus;

use Backend;
use System\Classes\PluginBase;

class Plugin extends PluginBase
{
    public function pluginDetails()
    {
        return [
            'name'        => 'Disqus',
            'description' => 'Add Disqus Commenting to your Site.',
            'author'      => '://radiantweb',
            'icon'        => 'icon-comments'
        ];
    }

    public function registerComponents()
    {
        return [
            'Radiantweb\Disqus\Components\Disqus' => 'disqus',
        ];
    }

    public function registerSettings()
    {
        return [
            'settings' => [
                'label'       => 'Disqus',
                'description' => 'Manage Disqus Settings.',
                'icon'        => 'icon-comments',
                'class'       => 'Radiantweb\Disqus\Models\Settings',
                'order'       => 100
            ]
        ];
    }
}