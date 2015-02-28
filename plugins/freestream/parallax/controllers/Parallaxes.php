<?php
/**
 * The MIT License (MIT)
 *
 * Copyright (c) 2014 Anton Samuelsson
 *
 * Permission is hereby granted, free of charge, to any person obtaining a copy
 * of this software and associated documentation files (the "Software"), to deal
 * in the Software without restriction, including without limitation the rights
 * to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
 * copies of the Software, and to permit persons to whom the Software is
 * furnished to do so, subject to the following conditions:
 *
 * The above copyright notice and this permission notice shall be included in
 * all copies or substantial portions of the Software.
 *
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
 * IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
 * FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
 * AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
 * LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
 * OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN
 * THE SOFTWARE.
 */
?>
<?php namespace Freestream\Parallax\Controllers;

use BackendMenu;
use Backend\Classes\Controller;
use Freestream\Parallax\Models\Parallaxes as Parallax;
use System\Classes\SystemException;
use Cms\Classes\Page;
use Flash;
use Land;

/**
 * Parallaxes Back-end Controller
 */
class Parallaxes extends Controller
{
    /**
     * Initial implementation.
     *
     * @var array
     */
    public $implement = [
        'Backend.Behaviors.FormController',
        'Backend.Behaviors.ListController'
    ];

    /**
     * Form configuration file.
     *
     * @var string
     */
    public $formConfig = 'config_form.yaml';

    /**
     * List configuration file.
     *
     * @var string
     */
    public $listConfig = 'config_list.yaml';

    /**
     * User permission requirement ID.
     *
     * @var array
     */
    public $requiredPermissions = ['freestream.parallax.manage_parallaxes'];

    /**
     * Initial constructor.
     */
    public function __construct()
    {
        parent::__construct();

        BackendMenu::setContext('Freestream.Parallax', 'parallax', 'parallaxes');

        /**
         * Customization overrides.
         */
        $this->addCss('/plugins/freestream/parallax/assets/css/backend/pages.css');
        $this->addCss('/plugins/freestream/parallax/assets/css/backend/pages.css.map');
        $this->addJs('/plugins/freestream/parallax/assets/js/backend/pages.js');
    }

    /**
     * Deletes single of multiple items from the list.
     */
    public function index_onDelete()
    {
        if (($ids = post('checked')) && is_array($ids) && count($ids)) {

            foreach ($ids as $id) {
                $parallax = Parallax::find($id);

                if ($parallax) {
                    $parallax->delete();
                }
            }

            Flash::success(
                Lang::get('freestream.parallax::lang.controllers.parallax.deleted_success')
            );
        }

         return $this->listRefresh();
    }

    /**
     * Creates popup partial on AJAX event.
     *
     * @return string
     */
    public function onOpenAvailablePages()
    {
        if (!post('button_id')) {
            throw new SystemException('Expected to get a button tracking ID.');
        }

        $this->vars['button_id'] = post('button_id');
        $this->vars['pages'] = Page::getNameList();

        return $this->makePartial('available_page');
    }

    /**
     * Returns an array with all selected pages in the correct hierarchy.
     *
     * @return array
     */
    public function getSelectedPagesInHierarchy()
    {
        $data = $this->vars['formModel']->attributes;

        if (!array_key_exists('pages', $data)) {
            return [];
        }

        $pages = json_decode($data['pages'], true);

        if (!$pages) {
            return [];
        }

        return $pages;
    }

    /**
     * Returns a flat array of all selected pages.
     *
     * @return array
     */
    public function getFlatSelectedPages()
    {
        $pages = [];
        $selectedPages = $this->getSelectedPagesInHierarchy();

        foreach ($selectedPages as $parent) {
            if (!in_array($parent['pagename'], $this->getAvailablePageNames())) {
                continue;
            }

            $pages[] = [
                'pagename'  => $parent['pagename'],
                'title'     => $parent['title']
            ];

            foreach ($parent['children'] as $child) {
                if (!in_array($child['pagename'], $this->getAvailablePageNames())) {
                    continue;
                }

                $pages[] = [
                    'pagename'  => $child['pagename'],
                    'title'     => $child['title']
                ];
            }
        }

        return $pages;
    }

    /**
     * Returns page names of all selected pages.
     *
     * @return array
     */
    public function getSelectedPageNames()
    {
        $pageNames = [];

        foreach ($this->getFlatSelectedPages() as $page) {
            $pageNames[] = $page['pagename'];
        }

        return $pageNames;
    }

    /**
     * Returns page names of all available pages.
     *
     * @return array
     */
    public function getAvailablePageNames()
    {
        $pageNames = [];

        foreach (Page::getNameList() as $pageName => $pageTitle) {
            $pageNames[] = $pageName;
        }

        return $pageNames;
    }

    /**
     * Returns array with all available pages.
     *
     * @return array
     */
    public function getAllAvailablePages()
    {
        $pages = [];

        foreach (Page::getNameList() as $pageName => $pageTitle) {
            if (!in_array($pageName, $this->getSelectedPageNames())) {
                $pages[$pageName] = $pageTitle;
            }
        }

        return $pages;
    }
}
