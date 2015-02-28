<?php namespace Alxy\GooglePlus;

use System\Classes\PluginBase;

/**
 * GooglePlus Plugin Information File
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
            'name'        => 'Google+',
            'description' => 'Add buttons to your website to help your visitors share content and connect on Google+.',
            'author'      => 'Alexander Guth',
            'icon'        => 'icon-google-plus'
        ];
    }

    public function registerComponents()
    {
        return [
            'Alxy\GooglePlus\Components\PlusOne' => 'plusOne',
            'Alxy\GooglePlus\Components\Share' => 'share',
            'Alxy\GooglePlus\Components\Follow' => 'follow',
            'Alxy\GooglePlus\Components\Badge' => 'badge',
        ];
    }

}
