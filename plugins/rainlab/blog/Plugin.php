<?php namespace RainLab\Blog;

use Backend;
use Controller;
use System\Classes\PluginBase;
use RainLab\Blog\Classes\TagProcessor;
use RainLab\Blog\Models\Category;
use Event;

class Plugin extends PluginBase
{

    public function pluginDetails()
    {
        return [
            'name'        => 'rainlab.blog::lang.plugin.name',
            'description' => 'rainlab.blog::lang.plugin.description',
            'author'      => 'Alexey Bobkov, Samuel Georges',
            'icon'        => 'icon-pencil'
        ];
    }

    public function registerComponents()
    {
        return [
            'RainLab\Blog\Components\Post'       => 'blogPost',
            'RainLab\Blog\Components\Posts'      => 'blogPosts',
            'RainLab\Blog\Components\Categories' => 'blogCategories',
        ];
    }

    public function registerPermissions()
    {
        return [
            'rainlab.blog.access_posts'       => ['tab' => 'Blog', 'label' => 'rainlab.blog::lang.blog.access_posts'],
            'rainlab.blog.access_categories'  => ['tab' => 'Blog', 'label' => 'rainlab.blog::lang.blog.access_categories'],
            'rainlab.blog.access_other_posts' => ['tab' => 'Blog', 'label' => 'rainlab.blog::lang.blog.access_other_posts']
        ];
    }

    public function registerNavigation()
    {
        return [
            'blog' => [
                'label'       => 'rainlab.blog::lang.blog.menu_label',
                'url'         => Backend::url('rainlab/blog/posts'),
                'icon'        => 'icon-pencil',
                'permissions' => ['rainlab.blog.*'],
                'order'       => 500,

                'sideMenu' => [
                    'posts' => [
                        'label'       => 'rainlab.blog::lang.blog.posts',
                        'icon'        => 'icon-copy',
                        'url'         => Backend::url('rainlab/blog/posts'),
                        'permissions' => ['rainlab.blog.access_posts'],
                    ],
                    'categories' => [
                        'label'       => 'rainlab.blog::lang.blog.categories',
                        'icon'        => 'icon-list-ul',
                        'url'         => Backend::url('rainlab/blog/categories'),
                        'permissions' => ['rainlab.blog.access_categories'],
                    ],
                ]

            ]
        ];
    }

    public function registerFormWidgets()
    {
        return [
            'RainLab\Blog\FormWidgets\Preview' => [
                'label' => 'Preview',
                'code'  => 'preview'
            ]
        ];
    }

    /**
     * Register method, called when the plugin is first registered.
     */
    public function register()
    {
        /*
         * Register the image tag processing callback
         */
        TagProcessor::instance()->registerCallback(function($input, $preview){
            if (!$preview)
                return $input;

            return preg_replace('|\<img alt="([0-9]+)" src="image"([^>]*)\/>|m',
                '<span class="image-placeholder" data-index="$1">
                    <span class="upload-dropzone">
                        <span class="label">Click or drop an image...</span>
                        <span class="indicator"></span>
                    </span>
                </span>',
            $input);
        });
    }

    public function boot()
    {
        Event::listen('pages.menuitem.listTypes', function() {
            return [
                'blog-category' => 'Blog category',
                'all-blog-categories' => 'All blog categories',
            ];
        });

        Event::listen('pages.menuitem.getTypeInfo', function($type) {
            if ($type == 'blog-category' || $type == 'all-blog-categories')
                return Category::getMenuTypeInfo($type);
        });

        Event::listen('pages.menuitem.resolveItem', function($type, $item, $url, $theme) {
            if ($type == 'blog-category' || $type == 'all-blog-categories')
                return Category::resolveMenuItem($item, $url, $theme);
        });
    }
}
