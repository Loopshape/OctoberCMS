<?php namespace Ndcisiv\DisposableEmailBlocker;

use System\Classes\PluginBase;

/**
 * DisposableEmailBlocker Plugin Information File
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
            'name'        => 'ndcisiv.disposableemailblocker::lang.plugin.name',
            'description' => 'ndcisiv.disposableemailblocker::lang.plugin.description',
            'author'      => 'Ndcisiv',
            'icon'        => 'icon-envelope-square'
        ];
    }

    /**
     * Register our settings for the back end
     * @return array
     */
    public function registerSettings()
    {
        return [
            'settings' => [
                'label'       => 'ndcisiv.disposableemailblocker::lang.settings.menu_label',
                'icon'        => 'icon-envelope-square',
                'description' => 'ndcisiv.disposableemailblocker::lang.settings.menu_description',
                'class'       => 'Ndcisiv\DisposableEmailBlocker\Models\DisposableSettings',
                'order'       => 100
            ]
        ];
    }

    /**
     * Register emailProtect component
     * @return array
     */
    public function registerComponents()
    {
        return [
            '\Ndcisiv\DisposableEmailBlocker\Components\VerifyEmail' => 'verifyEmail'
        ];
    }

    /**
     * Register email templates
     * @return array
     */
    public function registerMailTemplates()
    {
        return [
            'ndcisiv.disposableemailblocker::mail.inform' => 'ndcisiv.disposableemailblocker::lang.mailtemplates.mail_inform_description',
        ];
    }


}
