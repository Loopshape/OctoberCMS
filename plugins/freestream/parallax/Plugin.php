<?php namespace Freestream\Parallax;

use Lang;
use Backend;
use System\Classes\PluginBase;

/**
 * Parallax Plugin Information File.
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
            'name'        => 'Parallax',
            'description' => 'freestream.parallax::lang.system.details.description',
            'author'      => 'Freestream',
            'icon'        => 'icon-th-large'
        ];
    }

    /**
     * Registers available components.
     *
     * @return array
     */
    public function registerComponents()
    {
        return [
            'Freestream\Parallax\Components\Parallax'    => 'parallax'
        ];
    }

    /**
     * Registers system user permissions.
     *
     * @return array
     */
    public function registerPermissions()
    {
        return [
            'freestream.parallax.manage_parallaxes' => [
                'label' => 'freestream.parallax::lang.system.permissions.manage_parallaxes',
                'tab'   => 'Parallax'
            ]
        ];
    }

    /**
     * Registers a new navigation item.
     *
     * @return array
     */
    public function registerNavigation()
    {
        return [
            'parallax' => [
                'label'         => 'Parallax',
                'url'           => Backend::url('freestream/parallax/parallaxes'),
                'icon'          => 'icon-th-large',
                'permissions'   => ['freestream.parallax.*'],
                'sideMenu'      => [
                    'parallax'      => [
                        'label'         => 'Parallax',
                        'icon'          => 'icon-th-large',
                        'url'           => Backend::url('freestream/parallax/parallaxes'),
                    ],
                ]
            ]
        ];
    }
}
