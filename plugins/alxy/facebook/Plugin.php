<?php namespace Alxy\Facebook;

use System\Classes\PluginBase;

/**
 * Facebook Plugin Information File
 */
class Plugin extends PluginBase
{

    /**
     * Returns information about this plugin.
     *
     * @return array
     */
    public function pluginDetails()
    {
        return [
            'name'        => 'Facebook',
            'description' => 'Add buttons to your website to help your visitors share content and connect on Facebook.',
            'author'      => 'Alexander Guth',
            'icon'        => 'icon-facebook'
        ];
    }

    public function registerComponents()
    {
        return [
            'Alxy\Facebook\Components\Like' => 'like',
            'Alxy\Facebook\Components\Share' => 'share',
            'Alxy\Facebook\Components\Send' => 'send',
            'Alxy\Facebook\Components\Follow' => 'follow',
            'Alxy\Facebook\Components\Comments' => 'comments',
        ];
    }

    public function registerSettings()
    {
        return [
            'settings' => [
                'label'       => 'Facebook',
                'description' => 'Manage Facebook settings.',
                'category'    => 'Social Media',
                'icon'        => 'icon-facebook',
                'class'       => 'Alxy\Facebook\Models\Settings',
                'order'       => 100
            ]
        ];
    }

}
