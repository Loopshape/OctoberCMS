<?php namespace JorgeAndrade\Subscribe;

use System\Classes\PluginBase;

/**
 * Subscribe Plugin Information File
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
            'name'        => 'Subscribe',
            'description' => 'A simple Subscribe form for October CMS',
            'author'      => 'Jorge Andrade',
            'icon'        => 'icon-rss'
        ];
    }

    public function registerComponents()
    {
        return [
            'JorgeAndrade\Subscribe\Components\Subscriber'       => 'formSubscribe',
            'JorgeAndrade\Subscribe\Components\Unsubscribe'       => 'formUnsubscribe',
        ];
    }

    public function registerPermissions()
    {
        return [
            'jorgeandrade.subscribe.subscribers'       => ['tab' => 'Subscribe', 'label' => 'Access Subscribers'],
        ];
    }

    public function registerNavigation()
    {
        return [
            'subscribe' => [
                'label'       => 'Subscribers',
                'url'         => \Backend::url('jorgeandrade/subscribe/subscribers'),
                'icon'        => 'icon-rss',
                'permissions' => ['jorgeandrade.subscribe.*'],
                'order'       => 500,

                'sideMenu' => [
                    'subscribers' => [
                        'label'       => 'Subscribers',
                        'icon'        => 'icon-rss',
                        'url'         => \Backend::url('jorgeandrade/subscribe/subscribers'),
                        'permissions' => ['jorgeandrade.subscribe.access_subscribers'],
                    ]
                ]

            ]
        ];
    }

    public function registerMailTemplates()
    {
        return [
            'jorgeandrade.subscribe::mail.subscribe' => 'Welcome message for subscriber',
            'jorgeandrade.subscribe::mail.unsubscribe' => 'Good bye message for subscriber'
        ];
    }

}
