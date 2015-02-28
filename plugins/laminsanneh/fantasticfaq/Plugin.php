<?php namespace LaminSanneh\FantasticFaq;

use Backend\Facades\Backend;
use System\Classes\PluginBase;

/**
 * FantasticFaq Plugin Information File
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
            'name'        => 'FantasticFaq',
            'description' => 'An FAQ plugin with singular manageable instances',
            'author'      => 'LaminSanneh',
            'icon'        => 'icon-leaf'
        ];
    }

    public function registerComponents(){
        return [
            '\LaminSanneh\FantasticFaq\Components\FaqDisplayer' => 'faqDisplayer'
        ];
    }

    public function registerNavigation()
    {
        return [
            'fantasticfaq' => [
                'label'       => 'Faq Groups',
                'url'         => Backend::url('laminsanneh/fantasticfaq/faqgroups'),
                'icon'        => 'icon-bullhorn',
                'permissions' => ['laminsanneh.fantasticfaq.*'],
                'order'       => 500,

                'sideMenu' => [
                    'faqgroups' => [
                        'label'       => 'All Form Groups',
                        'url'         => Backend::url('laminsanneh/fantasticfaq/faqgroups'),
                        'icon'        => 'icon-pencil',
                        'permissions' => ['laminsanneh.fantasticfaq.access_faqgroups'],
                    ]
                ]

            ]
        ];
    }

}
