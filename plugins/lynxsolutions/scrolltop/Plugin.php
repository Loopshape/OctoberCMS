<?php namespace LynxSolutions\Scrolltop;

class Plugin extends \System\Classes\PluginBase
{
    public function pluginDetails()
    {
        return [
            'name' => 'Scroll to Top Plugin',
            'description' => "'Scroll to top' arrow on your pages",
            'author' => 'LynxSolutions',
            'icon' => 'icon-arrow-up'
        ];
    }

    public function registerComponents()
    {
        return [
            '\LynxSolutions\Scrolltop\Components\ScrollTop' => 'ScrollTop'
        ];
    }
}