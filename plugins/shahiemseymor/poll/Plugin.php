<?php
/**
 * Created by ShahiemSeymor.
 * Date: 5/29/14
 */

namespace ShahiemSeymor\Poll;

use App;
use Backend;
use System\Classes\PluginBase;
use Illuminate\Foundation\AliasLoader;

class Plugin extends PluginBase
{
    public function pluginDetails()
    {
        return [
            'name' => 'Poll Plugin',
            'description' => 'Nice poll system.',
            'author' => 'ShahiemSeymor',
            'icon' => 'icon-bar-chart-o'
        ];
    }

    public function registerComponents()
    {
        return [
            'ShahiemSeymor\Poll\Components\Vote'  => 'vote',
        ];
    }

    public function registerNavigation()
    {
        return [
            'poll' => [
                'label'       => 'Poll',
                'url'         => \Backend::url('shahiemseymor/poll/polls'),
                'icon'        => 'icon-bar-chart-o',
                'sideMenu' => [
                    'polls' => [
                        'label'       => 'Polls',
                        'icon'        => 'icon-bar-chart-o',
                        'url'         => Backend::url('shahiemseymor/poll/polls'),
                    ],
                ]

            ]
        ];
    }

    public function registerSettings()
    {
        return [
            'settings' => [
                'label'       => 'Poll Settings',
                'description' => 'Manage poll settings.',
                'category'    => 'Misc',
                'icon'        => 'icon-cog',
                'class'       => 'ShahiemSeymor\Poll\Models\Settings',
                'sort'        => 100,
                'icon' => ' icon-bar-chart-o'
            ]
        ];
    }


}
