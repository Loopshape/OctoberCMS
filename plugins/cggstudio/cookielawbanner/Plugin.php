<?php namespace CGGStudio\Cookielawbanner;

class Plugin extends \System\Classes\PluginBase
{
    public function pluginDetails()
    {
        return [
            'name' => 'cggstudio.cookielawbanner::lang.plugin.name',
            'description' => "cggstudio.cookielawbanner::lang.plugin.description",
            'author' => 'Carlos González Gurrea',
            'icon' => 'icon-gavel'
        ];
    }

    public function registerComponents()
    {
        return [
            '\CGGStudio\Cookielawbanner\Components\Cookielawbanner' => 'Cookielawbanner'
        ];
    }
}
?>