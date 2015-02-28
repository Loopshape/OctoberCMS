<?php namespace OctoDevel\OctoMail;

use Backend;
use \Lang;
use System\Classes\PluginBase;

class Plugin extends PluginBase
{
    public function pluginDetails()
    {
        return [
            'name' => Lang::get('octodevel.octomail::lang.app.name'),
            'description' => Lang::get('octodevel.octomail::lang.app.description'),
            'author' => 'Octo Devel',
            'homepage' => 'http://octodevel.com',
            'icon' => 'icon-envelope'
        ];
    }

    public function registerComponents()
    {
        return [
            'OctoDevel\OctoMail\Components\Template' => 'mailTemplate',
        ];
    }

    public function registerNavigation()
    {
        return [
            'octomail' => [
                'label'       => Lang::get('octodevel.octomail::lang.app.name'),
                'url'         => Backend::url('octodevel/octomail/templates'),
                'icon'        => 'icon-envelope',
                'permissions' => ['octodevel.octomail.*'],
                'order'       => 500,

                'sideMenu' => [
                    'templates' => [
                        'label'       => Lang::get('octodevel.octomail::lang.navigation.templates'),
                        'icon'        => 'icon-list-alt',
                        'url'         => Backend::url('octodevel/octomail/templates'),
                        'permissions' => ['octodevel.octomail.access_templates'],
                    ],
                    'recipients' => [
                        'label'       => Lang::get('octodevel.octomail::lang.navigation.recipients'),
                        'icon'        => 'icon-envelope-o',
                        'url'         => Backend::url('octodevel/octomail/recipients'),
                        'permissions' => ['octodevel.octomail.access_recipients'],
                    ],
                    'logs' => [
                        'label'       => Lang::get('octodevel.octomail::lang.navigation.contact_logs'),
                        'icon'        => 'icon-file-text-o',
                        'url'         => Backend::url('octodevel/octomail/logs'),
                        'permissions' => ['octodevel.octomail.access_logs'],
                    ]
                ]
            ]
        ];
    }

    public function registerFormWidgets()
    {
        return [
            'OctoDevel\OctoMail\FormWidgets\JsonRender' => [
                'label' => 'JsonRender',
                'alias' => 'jsonrender'
            ],
            'OctoDevel\OctoMail\FormWidgets\TemplateData' => [
                'label' => 'TemplateData',
                'alias' => 'templatedata'
            ],
            'OctoDevel\OctoMail\FormWidgets\UserAgent' => [
                'label' => 'UserAgent',
                'alias' => 'useragent'
            ]
        ];
    }

    public function registerPermissions()
    {
        return [
            'octodevel.octomail.access_templates' => ['label' => Lang::get('octodevel.octomail::lang.permissions.access_templates'), 'tab' => 'OctoDevel'],
            'octodevel.octomail.access_recipients' => ['label' => Lang::get('octodevel.octomail::lang.permissions.access_recipients'), 'tab' => 'OctoDevel'],
            'octodevel.octomail.access_logs' => ['label' => Lang::get('octodevel.octomail::lang.permissions.access_logs'), 'tab' => 'OctoDevel']
        ];
    }

    public function registerMailTemplates()
    {
        return [
            'octodevel.octomail::mail.autoresponse' => Lang::get('octodevel.octomail::lang.mailTemplates.autoresponse'),
        ];
    }
}