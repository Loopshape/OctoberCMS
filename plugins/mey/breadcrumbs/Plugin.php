<?php namespace

Mey\Breadcrumbs;

use System\Classes\PluginBase;
use Cms\Classes\Page;
use Cms\Classes\Theme;

/**
 * Breadcrumbs Plugin Information File
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
            'name'        => 'Breadcrumbs',
            'description' => 'Create Breadcrumbs Trail',
            'author'      => 'Jared Meyering',
            'icon'        => 'icon-ellipsis-v',
        ];
    }

    public function register()
    {
        \Event::listen('backend.form.extendFields', function($widget) {
            if (!$widget->model instanceof \Cms\Classes\Page) return;

            if (!($theme = Theme::getEditTheme())) {
                throw new ApplicationException(Lang::get('cms::lang.theme.edit.not_found'));
            }

            $pages = Page::all()->sort(function($a, $b){
                return strcasecmp($a->title, $b->title);
            });

            $pageOptions = $this->buildPageOptions($pages);
            $widget->addFields(
                [
                    'settings[child_of]' => [
                        'label'   => 'Child Of',
                        'type'    => 'dropdown',
                        'tab'     => 'Breadcrumbs',
                        'span'    => 'left',
                        'options' => $pageOptions,
                        'comment' => 'The parent of this page. Set to "None" if root page',
                    ],
                    'settings[hide_crumb]' => [
                        'label'   => 'Hide Breadcrumbs',
                        'type'    => 'checkbox',
                        'tab'     => 'Breadcrumbs',
                        'span'    => 'right',
                        'comment' => 'Hide the breadcrumb trail on this page',
                    ],
                    'settings[crumb_title]' => [
                        'label'   => 'Crumb Title (Optional)',
                        'type'    => 'text',
                        'tab'     => 'Breadcrumbs',
                        'span'    => 'left',
                        'comment' => 'Title text for this pages crumb, by default will use page title',
                    ],
                    'settings[remove_crumb_trail]' => [
                        'label'   => 'Remove From Breadcrumbs',
                        'type'    => 'checkbox',
                        'tab'     => 'Breadcrumbs',
                        'span'    => 'right',
                        'comment' => 'Do not show this page in the breadcrumb trail',
                    ],
                    'settings[crumbElementTitle]' => [
                        'label'   => 'Crumb Title From Id (Optional)',
                        'type'    => 'text',
                        'tab'     => 'Breadcrumbs',
                        'span'    => 'left',
                        'comment' => 'Use a DOM element as the crumb title for this page. Must be a a unique #id on the page.',
                    ],
                    'settings[crumb_disabled]' => [
                        'label'   => 'Disabled',
                        'type'    => 'checkbox',
                        'tab'     => 'Breadcrumbs',
                        'span'    => 'right',
                        'comment' => 'Disable the link and add the disabled class to this crumb item in the breadcrumb list',
                    ],
                ],
                'primary'
            );
        });
    }

    public function registerComponents()
    {
        return [
            'Mey\Breadcrumbs\Components\Breadcrumbs' => 'breadcrumbs'
        ];
    }

    private function buildPageOptions($pages)
    {
        $pageOptions = [
            'mey_no_parent' => 'None'
        ];

        foreach($pages as $page) {
            $pageOptions[$page->baseFileName] = "{$page->title} ({$page->url})";
        }

        return $pageOptions;
    }
}
