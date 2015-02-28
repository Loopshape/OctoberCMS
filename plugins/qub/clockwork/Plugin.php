<?php

namespace Qub\Clockwork;

use System\Classes\PluginBase;
use Illuminate\Support\Facades\App;
use Illuminate\Foundation\AliasLoader;
use Clockwork\Support\Laravel\Facade as Clockwork;

class Plugin extends PluginBase
{
    public function pluginDetails()
    {
        return [
            'name'        => 'Qub.Clockwork',
            'description' => "Clockwork Developer Tools integration plugin for OctoberCMS",
            'author'      => 'Andriy Kuzyk',
            'icon'        => 'icon-leaf'
        ];
    }

    public function boot()
    {
        App::register( 'Clockwork\Support\Laravel\ClockworkServiceProvider' );

        $alias = AliasLoader::getInstance();
        $alias->alias( 'Clockwork', 'Clockwork\Support\Laravel\Facade' );
    }

    public function registerMarkupTags()
    {
        return [
            'functions' => [
                'info'       => function ( $item ) {
                    return Clockwork::info( $item );
                },
                'startEvent' => function ( $name, $description = null ) {
                    return Clockwork::startEvent( $name, $description );
                },
                'endEvent'   => function ( $name ) {
                    return Clockwork::endEvent( $name );
                }
            ]
        ];
    }
}
