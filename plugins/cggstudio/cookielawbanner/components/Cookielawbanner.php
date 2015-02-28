<?php namespace CGGStudio\Cookielawbanner\Components;

use Lang;
use Cms\Classes\ComponentBase;
use \stdClass;
use Cms\Classes\Page;


/**
 * cookielawbanner Plugin Information File
 */
class Cookielawbanner extends ComponentBase
{

    public function componentDetails()
    {
        return [
            'name' => 'cggstudio.cookielawbanner::lang.plugin.name',
            'description' => "cggstudio.cookielawbanner::lang.plugin.description",
        ];
    }

    public function defineProperties()
    {
        return [
            'backgroundColorEUCookieLawBanner' => [
                'title' => 'cggstudio.cookielawbanner::lang.messages.Background',
                'description' => 'cggstudio.cookielawbanner::lang.messages.Background_description',
                'default' => '#FFF',
                'type' => 'string',
                'group' => 'Color',
                'validationPattern' => '#([a-fA-F0-9]){3}(([a-fA-F0-9]){3})?\b',
                'validationMessage' =>  Lang::get('cggstudio.cookielawbanner::lang.messages.Background_validation'),
                'showExternalParameter' => false
            ],
            'textColorEUCookieLawBanner' => [
                'title' => 'cggstudio.cookielawbanner::lang.messages.TextColor',
                'description' => 'cggstudio.cookielawbanner::lang.messages.TextColor_description',
                'default' => '#000',
                'type' => 'string',
                'group' => 'Color',
                'validationPattern' => '#([a-fA-F0-9]){3}(([a-fA-F0-9]){3})?\b',
                'validationMessage' =>  Lang::get('cggstudio.cookielawbanner::lang.messages.TextColor_validation'),
                'showExternalParameter' => false
            ],
            'durationEUCookieLawBanner' => [
                'title' => 'cggstudio.cookielawbanner::lang.messages.Duration',
                'description' => 'cggstudio.cookielawbanner::lang.messages.Duration_description',
                'type' => 'dropdown',
                'default' => '5',
                'options' => [
                    '5' => '5',
                    '10' => '10',
                    '15' => '15',
                    '30' => '30',
                ],
                'group' => 'Properties',
                'showExternalParameter' => false
            ],
            'timeEUCookieLawBanner' => [
                'title' => 'cggstudio.cookielawbanner::lang.messages.Time',
                'description' => 'cggstudio.cookielawbanner::lang.messages.Time_description',
                'type' => 'dropdown',
                'default' => '999999999',
                'options' => [
                    '3000' => '3 seg',
                    '5000' => '5 seg',
                    '8000' => '8 seg',
                    '10000' => '10 seg',
                    '999999999' => Lang::get('cggstudio.cookielawbanner::lang.messages.Static')
                ],
                'group' => 'Properties',
                'showExternalParameter' => false
            ],
            'titleEUCookieLawBanner' => [
                'title' => 'cggstudio.cookielawbanner::lang.messages.Title',
                'description' => 'cggstudio.cookielawbanner::lang.messages.Title_description',
                'type' => 'string',
                'group' => 'Text',
                'default' => Lang::get('cggstudio.cookielawbanner::lang.messages.Title_default'),
                'showExternalParameter' => false
            ],
            'textEUCookieLawBanner' => [
                'title' => 'cggstudio.cookielawbanner::lang.messages.Text',
                'description' => 'cggstudio.cookielawbanner::lang.messages.Text_description',
                'type' => 'string',
                'group' => 'Text',
                'default' => Lang::get('cggstudio.cookielawbanner::lang.messages.Text_default'),
                'showExternalParameter' => false
            ],
            'TextlinkEUCookieLawBanner'            => [
                'title'       => 'cggstudio.cookielawbanner::lang.messages.TextLink',
                'description' => 'cggstudio.cookielawbanner::lang.messages.TextLink_description',
                'default' =>  Lang::get('cggstudio.cookielawbanner::lang.messages.TextLink_default'),
                'group' => 'Link',
                'showExternalParameter' => false
            ],
            'linkEUCookieLawBanner'            => [
                'title'       => 'cggstudio.cookielawbanner::lang.messages.Link',
                'description' => 'cggstudio.cookielawbanner::lang.messages.Link_description',
                'type'        => 'dropdown',
                'options' =>Cookielawbanner::getUrlOptions(),
                'group' => 'Link',
                'showExternalParameter' => false
            ],
            'activeEUCookieLawBanner'            => [
                'title' => 'cggstudio.cookielawbanner::lang.messages.active',
                'description'       => 'cggstudio.cookielawbanner::lang.messages.active_description',
                'default'     => 1,
                'type'        => 'checkbox',
                'showExternalParameter' => false
            ],
            'developerEUCookieLawBanner'            => [
                'title' => 'cggstudio.cookielawbanner::lang.messages.Developer',
                'description'       => 'cggstudio.cookielawbanner::lang.messages.Developer_description',
                'default'     => 1,
                'type'        => 'checkbox',
                'showExternalParameter' => false
            ],


        ];
    }

    public function onRun()
    {
        // Add css
        $this->addCss('assets/css/eucookielaw.css');
        // Add js
        $this->addJs('assets/js/eucookielaw.js');

    }

    public function onRender()
    {

        $this->Cookielawbanner = new stdClass();
        $this->Cookielawbanner->backgroundColor = $this->propertyOrParam('backgroundColorEUCookieLawBanner');
        $this->Cookielawbanner->textColor = $this->propertyOrParam('textColorEUCookieLawBanner');
        $this->Cookielawbanner->duration = $this->propertyOrParam('durationEUCookieLawBanner');
        $this->Cookielawbanner->time = $this->propertyOrParam('timeEUCookieLawBanner');
        $this->Cookielawbanner->title = $this->propertyOrParam('titleEUCookieLawBanner');
        $this->Cookielawbanner->message = $this->propertyOrParam('textEUCookieLawBanner');
        $this->Cookielawbanner->link = $this->propertyOrParam('linkEUCookieLawBanner');
        $this->Cookielawbanner->Textlink = $this->propertyOrParam('TextlinkEUCookieLawBanner');
        $this->Cookielawbanner->developer = $this->propertyOrParam('developerEUCookieLawBanner');
        $this->Cookielawbanner->active = $this->propertyOrParam('activeEUCookieLawBanner');
        $this->page['cookielawbanner'] = $this->Cookielawbanner;

    }


    /**
     * Get a list of all pages. Prepend an empty option to the start
     *
     * @return array
     */
    public function getUrlOptions()
    {
        $allPages = Page::sortBy('baseFileName')->lists('title', 'baseFileName');
        $pages    = array(
            '' => 'No page link'
        );
        foreach ($allPages as $key => $value) {
            $pages[$key] = "$key";
        }
        return $pages;
    }

}
