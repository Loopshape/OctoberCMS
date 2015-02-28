<?php namespace RainLab\Twitter\Components;

use Cms\Classes\ComponentBase;
use HTML;

class EmbedTimeline extends ComponentBase
{
    public $timelineAttributes;

    public function componentDetails()
    {
        return [
            'name'        => 'Embed Timeline',
            'description' => 'Display an embedded timeline area.'
        ];
    }

    public function defineProperties()
    {
        return [
            'widget-id' => [
                 'title'             => 'Widget ID',
                 'description'       => 'To create a timeline you must be signed in to twitter.com and visit the widgets section [https://twitter.com/settings/widgets] of your settings page.',
                 'type'              => 'string',
                 'validationPattern' => '^\d+$',
                 'validationMessage' => 'The widget ID can only contain digits and is required.'
            ],
            'tweet-limit' => [
                 'title'             => 'Tweet limit',
                 'description'       => 'To fix the size of a timeline to a preset number of Tweets, use any value between 1 and 20 Tweets',
                 'type'              => 'string',
                 'default'           => 10,
                 'validationPattern' => '^\d+$',
                 'validationMessage' => 'The tweet limit attribute must be an integer.'
            ],
            'aria-polite' => [
                 'title'             => 'ARIA politeness',
                 'description'       => 'ARIA is an accessibility system that aids people using assistive technology interacting with dynamic web content.',
                 'default'           => 'polite',
                 'type'              => 'dropdown',
                 'options'           => [
                    'polite' => 'polite',
                    'assertive' => 'assertive'
                 ],
                 'group'             => 'Display',
            ],
            'chrome' => [
                 'title'             => 'Chrome',
                 'description'       => 'Control the widget layout and chrome. Use a space-separated set of the following options: [noheader, nofooter, noborders, noscrollbar, transparent]',
                 'default'           => 'nofooter transparent',
                 'type'              => 'string',
                 'group'             => 'Display',
            ],
            'width' => [
                 'title'             => 'Width',
                 'description'       => 'You can specify the width of the embedded timeline.',
                 'type'              => 'string',
                 'default'           => 520,
                 'validationPattern' => '^\d+$',
                 'validationMessage' => 'The width attribute can only contain numbers.',
                 'group'             => 'Display',
            ],
            'height' => [
                 'title'             => 'Height',
                 'description'       => 'You can specify the height of the embedded timeline.',
                 'type'              => 'string',
                 'default'           => 600,
                 'validationPattern' => '^\d+$',
                 'validationMessage' => 'The height attribute can only contain numbers.',
                 'group'             => 'Display',
            ],
            'theme' => [
                 'title'             => 'Theme',
                 'description'       => 'Theme.',
                 'default'           => 'light',
                 'type'              => 'dropdown',
                 'options'           => [
                    'light' => 'light',
                    'dark' => 'dark'
                 ],
                 'group'             => 'Display',
            ],
            'border-color' => [
                 'title'             => 'Border color',
                 'description'       => 'Change the border color used by the widget. Takes an #abc123 hex format color.',
                 'default'           => '',
                 'type'              => 'string',
                 'group'             => 'Display',
            ],
            'related' => [
                 'title'             => 'Recommended accounts',
                 'description'       => 'Related accounts.',
                 'type'              => 'string',
                 'group'             => 'Extra options',
            ],
            'dnt' => [
                 'title'             => 'Tailoring opt-out',
                 'description'       => 'Twitter buttons on your site can help us tailor content and suggestions for Twitter users. If you want to opt-out of this feature, check this option.',
                 'default'           => 0,
                 'type'              => 'checkbox',
                 'group'             => 'Extra options',
            ],
            'lang' => [
                'title'             => 'Language',
                'type'              => 'dropdown',
                'default'           => 'en',
                'placeholder'       => 'Select language',
                'group'             => 'Extra options',
            ]
        ];
    }

    protected function getLangOptions()
    {
        return json_decode(file_get_contents(__DIR__.'/../data/languages.json'), true);
    }

    public function onRun()
    {
        $this->timelineAttributes = $this->page['timelineAttributes'] = $this->loadTimelineAttributes();
    }

    protected function loadTimelineAttributes()
    {
        $attributes = $this->getProperties();

        /*
         * Convert booleans
         */
        array_walk($attributes, function(&$value, $key) {
            switch ($value) {
                case '1':
                    $value = 'true';
                    break;

                case '0':
                    $value = 'false';
                    break;

                default:
                    $value = $value;
                    break;
            }
        });

        /*
         * Prefix attributes with data-
         */
        $prefixAttributes = [];
        foreach ($attributes as $key => $value) {
            $prefixAttributes['data-'.$key] = $value;
        }

        return HTML::attributes($prefixAttributes);
    }
}