<?php namespace Mariuzzo\Gistie;

/**
 * The plugin.php file (called the plugin initialization script) defines the plugin information class.
 */

use System\Classes\PluginBase;

class Plugin extends PluginBase
{

    public function pluginDetails()
    {
        return [
            'name'        => 'Gistie',
            'description' => 'Provides a simple way to share snippets and pastes with others using Github\'s gist.',
            'author'      => 'Rubens Mariuzzo',
            'icon'        => 'icon-github'
        ];
    }

    public function registerComponents()
    {
        return [
            '\Mariuzzo\Gistie\Components\Gistie' => 'gist'
        ];
    }

}