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
<?php namespace Freestream\Parallax\Components;

use Cms\Classes\ComponentBase;
use Freestream\Parallax\Models\Parallaxes;
use Lang;

class Parallax extends ComponentBase
{
    /**
     * Page Collection array;
     *
     * @var array
     */
    protected $_pageCollection = [];

    /**
     * Component Description.
     *
     * @return array
     */
    public function componentDetails()
    {
        return [
            'name'        => 'freestream.parallax::lang.components.parallax_page',
            'description' => 'freestream.parallax::lang.components.description',
        ];
    }

    /**
     * Component Configuration Properties.
     *
     * @return array
     */
    public function defineProperties()
    {
        return [
            'parallax' => [
                'title'             => 'freestream.parallax::lang.components.properties.parallax.title',
                'description'       => 'freestream.parallax::lang.components.properties.parallax.description',
                'type'              => 'dropdown',
                'default'           => ''
            ],
            'verticalCentered' => [
                'title'             => 'freestream.parallax::lang.components.properties.verticalCentered.title',
                'description'       => 'freestream.parallax::lang.components.properties.verticalCentered.description',
                'type'              => 'checkbox',
                'default'           => 'yes',
                'group'             => Lang::get('freestream.parallax::lang.components.properties.groups.general'),
            ],
            'resize' => [
                'title'             => 'freestream.parallax::lang.components.properties.resize.title',
                'description'       => 'freestream.parallax::lang.components.properties.resize.description',
                'type'              => 'checkbox',
                'default'           => 'yes',
                'group'             => Lang::get('freestream.parallax::lang.components.properties.groups.general'),
            ],
            'scrollingSpeed' => [
                'title'             => 'freestream.parallax::lang.components.properties.scrollingSpeed.title',
                'description'       => 'freestream.parallax::lang.components.properties.scrollingSpeed.description',
                'type'              => 'string',
                'validationPattern' => '^[\d]+$',
                'validationMessage' => 'freestream.parallax::lang.components.properties.scrollingSpeed.validationMessage',
                'default'           => '700',
                'group'             => Lang::get('freestream.parallax::lang.components.properties.groups.general'),
            ],
            'menu' => [
                'title'             => 'freestream.parallax::lang.components.properties.menu.title',
                'description'       => 'freestream.parallax::lang.components.properties.menu.description',
                'type'              => 'checkbox',
                'default'           => 'no',
                'group'             => Lang::get('freestream.parallax::lang.components.properties.groups.general'),
            ],
            'autoScrolling' => [
                'title'             => 'freestream.parallax::lang.components.properties.autoScrolling.title',
                'description'       => 'freestream.parallax::lang.components.properties.autoScrolling.description',
                'type'              => 'checkbox',
                'default'           => 'yes',
                'group'             => Lang::get('freestream.parallax::lang.components.properties.groups.general'),
            ],
            'scrollOverflow' => [
                'title'             => 'freestream.parallax::lang.components.properties.scrollOverflow.title',
                'description'       => 'freestream.parallax::lang.components.properties.scrollOverflow.description',
                'type'              => 'checkbox',
                'default'           => 'no',
                'group'             => Lang::get('freestream.parallax::lang.components.properties.groups.general'),
            ],
            'css3' => [
                'title'             => 'freestream.parallax::lang.components.properties.css3.title',
                'description'       => 'freestream.parallax::lang.components.properties.css3.description',
                'type'              => 'checkbox',
                'default'           => 'no',
                'group'             => Lang::get('freestream.parallax::lang.components.properties.groups.general'),
            ],
            'loopBottom' => [
                'title'             => 'freestream.parallax::lang.components.properties.loopBottom.title',
                'description'       => 'freestream.parallax::lang.components.properties.loopBottom.description',
                'type'              => 'checkbox',
                'default'           => 'no',
                'group'             => Lang::get('freestream.parallax::lang.components.properties.groups.looping'),
            ],
            'loopTop' => [
                'title'             => 'freestream.parallax::lang.components.properties.loopTop.title',
                'description'       => 'freestream.parallax::lang.components.properties.loopTop.description',
                'type'              => 'checkbox',
                'default'           => 'no',
                'group'             => Lang::get('freestream.parallax::lang.components.properties.groups.looping'),
            ],
            'loopHorizontal' => [
                'title'             => 'freestream.parallax::lang.components.properties.loopHorizontal.title',
                'description'       => 'freestream.parallax::lang.components.properties.loopHorizontal.description',
                'type'              => 'checkbox',
                'default'           => 'yes',
                'group'             => Lang::get('freestream.parallax::lang.components.properties.groups.looping'),
            ],
            'navigation' => [
                'title'             => 'freestream.parallax::lang.components.properties.navigation.title',
                'description'       => 'freestream.parallax::lang.components.properties.navigation.description',
                'type'              => 'checkbox',
                'default'           => 'no',
                'group'             => Lang::get('freestream.parallax::lang.components.properties.groups.navigation'),
            ],
            'navigationPosition' => [
                'title'             => 'freestream.parallax::lang.components.properties.navigationPosition.title',
                'description'       => 'freestream.parallax::lang.components.properties.navigationPosition.description',
                'type'              => 'dropdown',
                'default'           => 'right',
                'group'             => Lang::get('freestream.parallax::lang.components.properties.groups.navigation'),
                'options'               => [
                    'right'             => 'freestream.parallax::lang.components.properties.options.right',
                    'left'              => 'freestream.parallax::lang.components.properties.options.left'
                ]
            ],
            'slidesNavigation' => [
                'title'             => 'freestream.parallax::lang.components.properties.slidesNavigation.title',
                'description'       => 'freestream.parallax::lang.components.properties.slidesNavigation.description',
                'type'              => 'checkbox',
                'default'           => 'yes',
                'group'             => Lang::get('freestream.parallax::lang.components.properties.groups.slides_navigation'),
            ],
            'slidesNavPosition' => [
                'title'             => 'freestream.parallax::lang.components.properties.slidesNavPosition.title',
                'description'       => 'freestream.parallax::lang.components.properties.slidesNavPosition.description',
                'type'              => 'dropdown',
                'default'           => 'bottom',
                'group'             => Lang::get('freestream.parallax::lang.components.properties.groups.slides_navigation'),
                'options'               => [
                    'bottom'            => 'freestream.parallax::lang.components.properties.options.bottom',
                    'top'               => 'freestream.parallax::lang.components.properties.options.top',
                ]
            ],
            'paddingTop' => [
                'title'             => 'freestream.parallax::lang.components.properties.paddingTop.title',
                'description'       => 'freestream.parallax::lang.components.properties.paddingTop.description',
                'type'              => 'string',
                'validationPattern' => '^([0]|[\d]+(\s)?(em|px|\%))$',
                'validationMessage' => 'freestream.parallax::lang.components.properties.paddingTop.validationMessage',
                'default'           => '0',
                'group'             => Lang::get('freestream.parallax::lang.components.properties.groups.advanced'),
            ],
            'paddingBottom' => [
                'title'             => 'freestream.parallax::lang.components.properties.paddingBottom.title',
                'description'       => 'freestream.parallax::lang.components.properties.paddingBottom.description',
                'type'              => 'string',
                'validationPattern' => '^([0]|[\d]+(\s)?(em|px|\%))$',
                'validationMessage' => 'freestream.parallax::lang.components.properties.paddingBottom.validationMessage',
                'default'           => '0',
                'group'             => Lang::get('freestream.parallax::lang.components.properties.groups.advanced'),
            ],
            'fixedElements' => [
                'title'             => 'freestream.parallax::lang.components.properties.fixedElements.title',
                'description'       => 'freestream.parallax::lang.components.properties.fixedElements.description',
                'type'              => 'string',
                'default'           => '',
                'group'             => Lang::get('freestream.parallax::lang.components.properties.groups.advanced'),
            ],
            'normalScrollElements' => [
                'title'             => 'freestream.parallax::lang.components.properties.normalScrollElements.title',
                'description'       => 'freestream.parallax::lang.components.properties.normalScrollElements.description',
                'type'              => 'string',
                'default'           => '',
                'group'             => Lang::get('freestream.parallax::lang.components.properties.groups.advanced'),
            ],
            'normalScrollElementTouchThreshold' => [
                'title'             => 'freestream.parallax::lang.components.properties.normalScrollElementTouchThreshold.title',
                'description'       => 'freestream.parallax::lang.components.properties.normalScrollElementTouchThreshold.description',
                'type'              => 'string',
                'validationPattern' => '^[\d]+$',
                'validationMessage' => 'freestream.parallax::lang.components.properties.normalScrollElementTouchThreshold.validationMessage',
                'default'           => '5',
                'group'             => Lang::get('freestream.parallax::lang.components.properties.groups.advanced'),
            ],
            'keyboardScrolling' => [
                'title'             => 'freestream.parallax::lang.components.properties.keyboardScrolling.title',
                'description'       => 'freestream.parallax::lang.components.properties.keyboardScrolling.description',
                'type'              => 'checkbox',
                'default'           => 'yes',
                'group'             => Lang::get('freestream.parallax::lang.components.properties.groups.advanced'),
            ],
            'touchSensitivity' => [
                'title'             => 'freestream.parallax::lang.components.properties.touchSensitivity.title',
                'description'       => 'freestream.parallax::lang.components.properties.touchSensitivity.description',
                'type'              => 'string',
                'validationPattern' => '^[\d]+$',
                'validationMessage' => 'freestream.parallax::lang.components.properties.touchSensitivity.validationMessage',
                'default'           => '5',
                'group'             => Lang::get('freestream.parallax::lang.components.properties.groups.advanced'),
            ],
            'continuousVertical' => [
                'title'             => 'freestream.parallax::lang.components.properties.continuousVertical.title',
                'description'       => 'freestream.parallax::lang.components.properties.continuousVertical.description',
                'type'              => 'checkbox',
                'default'           => 'no',
                'group'             => Lang::get('freestream.parallax::lang.components.properties.groups.advanced'),
            ],
            'animateAnchor' => [
                'title'             => 'freestream.parallax::lang.components.properties.animateAnchor.title',
                'description'       => 'freestream.parallax::lang.components.properties.animateAnchor.description',
                'type'              => 'checkbox',
                'default'           => 'yes',
                'group'             => Lang::get('freestream.parallax::lang.components.properties.groups.advanced'),
            ],
        ];
    }

    /**
     * Option array with all parallaxes.
     */
    public function getParallaxOptions()
    {
        return Parallaxes::all()->lists('title', 'id');
    }

    /**
     * Initial run event.
     */
    public function onRun()
    {
        /**
         * Required library.
         */
        $this->addJs('/plugins/freestream/parallax/assets/js/jquery.easings.min.js');
        $this->addJs('/plugins/freestream/parallax/assets/js/jquery.slimscroll.min.js');
        $this->addJs('/plugins/freestream/parallax/assets/js/jquery.fullPage.min.js');

        /**
         * Custom styling.
         */
        $this->addJs('/plugins/freestream/parallax/assets/js/parallax.js');
        $this->addCss('/plugins/freestream/parallax/assets/css/parallax.css');
    }

   /**
     * Build all my parameters for the view.
     */
    public function onRender()
    {
        $model = new Parallaxes;
        $this->page['pages'] = $this->_getPageCollection();

        foreach ($this->getProperties() as $key => $value) {
            $this->page[$key] = $value;
        }

        $this->page['navigationTooltips']   = json_encode($this->getNavigationTooltips());
        $this->page['anchors']              = json_encode($this->getAnchors());
    }

    /**
     * Retrieves all pages from the current parallax.
     *
     * @return array
     */
    protected function _getPageCollection()
    {
        if (!$this->_pageCollection) {
            $model = new Parallaxes;
            $this->_pageCollection = $model->getPageCollection($this->property('parallax', $this->page->id));
        }

        return $this->_pageCollection;
    }

    /**
     * Returns all page names from the current parallax.
     *
     * @return array
     */
    protected function getAnchors()
    {
        $model = new Parallaxes;
        $pages = [];

        foreach ($this->_getPageCollection() as $page) {
            $pages[] = str_replace('/', '-', $page['pagename']);
        }

        return $pages;
    }

    /**
     * Returns all page titles from the current parallax.
     *
     * @return array
     */
    protected function getNavigationTooltips()
    {
        $model = new Parallaxes;
        $pages = [];

        foreach ($this->_getPageCollection() as $page) {
            $pages[] = $page['title'];
        }

        return $pages;
    }
}
