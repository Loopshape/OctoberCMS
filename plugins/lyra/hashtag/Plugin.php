<?php namespace Lyra\Hashtag;

use System\Classes\PluginBase;

class Plugin extends PluginBase
{
    public function pluginDetails()
    {
        return [
            'name' => 'Hashtag',
            'description' => 'Provides feed from a Instagram #hashtag',
            'author' => 'John Svensson',
            'icon' => 'icon-instagram'
        ];
    }

    public function registerComponents()
    {
        return [
            '\Lyra\Hashtag\Components\Hashfeed' => 'hashFeed'
        ];
    }

    public function registerSettings()
    {
        return [
            'settings' => [
                'label'       => 'Hashtag',
                'icon'        => 'icon-instagram',
                'description' => '',
                'class'       => '\Lyra\Hashtag\Models\Settings',
                'order'       => 250
            ]
        ];
    }
}