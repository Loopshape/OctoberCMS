<?php

namespace Mey\Breadcrumbs\Components;

use Cms\Classes\ComponentBase;
use Cms\Classes\Page;
use Cms\Classes\Theme;
use System\Classes\ApplicationException;
use Symfony\Component\Yaml\Yaml;

class Breadcrumbs extends ComponentBase
{
    public $breadcrumbs = [];
    public $pagesList = [];
    public $childTrail = [];

    public function componentDetails()
    {
        return [
            'name'        => 'Breadcrumbs',
            'description' => 'Displays the Breadcrumbs.'
        ];
    }

    public function defineProperties()
    {
        return [
            'main-ol-class' => [
                 'title'       => 'Breadcrumb Class',
                 'description' => 'The class attribute for the breadcrumb list (ol).',
                 'type'        => 'string',
                 'default'     => 'breadcrumb'
            ],
            'main-li-class' => [
                 'title'       => 'Item class',
                 'description' => 'The class attribute for the breadcrumb items (li).',
                 'type'        => 'string',
                 'default'     => ''
            ],
            'active-class' => [
                 'title'       => 'Active class',
                 'description' => 'The class attribute for the active breadcrumb.',
                 'type'        => 'string',
                 'default'     => 'active'
            ],
            'disabled-class' => [
                 'title'       => 'Disabled class',
                 'description' => 'The class attribute for a disabled breadcrumb.',
                 'type'        => 'string',
                 'default'     => 'disabled'
            ]
        ];
    }

    public function getOptions() {
        return $this->getProperties();
    }

    public function onRun() {
        if (!($theme = Theme::getEditTheme())) {
            throw new ApplicationException(Lang::get('cms::lang.theme.edit.not_found'));
        }

        $currentPage = $this->page->baseFileName;
        $pages = Page::listInTheme($theme, true);
        $this->pagesList = $this->buildPagesList($pages);
        $breadcrumbList = $this->buildCrumbTrail($currentPage);
        $currentCrumb = array_slice($breadcrumbList, -1, 1, true);
        $currentCrumb = array_shift($currentCrumb);
        $this->page['breadcrumbs'] = $breadcrumbList;
        $this->page['currentCrumb'] = $currentCrumb;
        return;
    }

    /**
     * Creates an array of all pages and their crumb specific data
     *
     * @param array $pages The array of page objects
     *
     * @return array The list of page arrays
     */
    private function buildPagesList($pages)
    {
        $pagesList = [];
        foreach ($pages as $page) {
            //strip off forward slash

            $pagesList[$page->baseFileName] = [
                'baseFileName'   => $page->baseFileName,
                'url'            => $page->url,
                'title'          => empty($page->crumb_title) ? $page->title : $page->crumb_title,
                'elementTitle'   => $page->crumbElementTitle,
                'crumb_disabled' => $page->crumb_disabled == 1 ? true : false,
                'in_crumb_trail' => $page->remove_crumb_trail == 1 ? false : true,
                'show_crumb'     => $page->hide_crumb == 1 ? false : true,
                'child_of'       => $page->child_of,
            ];
        }
        return $pagesList;
    }

    /**
     * For the current page, follows all the parents back to the root crumb.
     *
     * @param array $page The breadcrumb specific page.
     */
    private function followParents($page)
    {
        $this->childTrail[] = $page['baseFileName'];
        if ($this->getParent($page) != 'mey_no_parent') {
            if (isset($this->pagesList[$this->getParent($page)])) {
                $parentPage = $this->pagesList[$this->getParent($page)];
                $this->followParents($parentPage);
            }
        }
        return;
    }

    /**
     * From the current page, build out the breadcrumb data array
     *
     * @param array $page The breadcrumb specific page
     */
    private function buildCrumbTrail($page)
    {
        //Page Doesnt exist in our crumb list
        if (!($page = $this->pagesList[$page])) {
            return;
        }

        //We need an array of children before we can build this guy out
        if (empty($this->childTrail)) {
            $this->followParents($page);
            //Give the proper order to the keys;
            $this->childTrail = array_reverse($this->childTrail);
        }

        foreach ($this->childTrail as $page) {
            $workingPage = $this->pagesList[$page];
            $this->addCrumb($workingPage);
        }
        return $this->breadcrumbs;
    }

    /**
     * Add a page array to the breadcrumb list
     *
     * @param array $page
     */
    private function addCrumb($page)
    {
        $this->breadcrumbs[] = $page;
        return;
    }

    /**
     * Return the parent crumb url
     *
     * @param array $page The breadcrumb specific page
     *
     * @return string The url of the crumbs parent
     */
    private function getParent($page)
    {
        $parent = null;
        if (!empty($page['child_of'])) {
            $parent = $page['child_of'];
        }
        return $parent;
    }
}
