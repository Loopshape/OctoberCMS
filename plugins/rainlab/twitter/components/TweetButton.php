<?php namespace RainLab\Twitter\Components;

use HTML;
use Cms\Classes\ComponentBase;

class TweetButton extends ComponentBase
{
    public $tweetAttributes;

    public function componentDetails()
    {
        return [
            'name'        => 'Tweet Button',
            'description' => 'Display a Twitter Tweet button for this page.'
        ];
    }

    public function defineProperties()
    {
        return [
            'via' => [
                 'title'             => 'Twitter user',
                 'description'       => 'Screen name of the user to attribute the Tweet to.',
                 'type'              => 'string',
            ],
            'text' => [
                 'title'             => 'Tweet text',
                 'description'       => 'Default Tweet text.',
                 'type'              => 'string',
            ],
            'hashtags' => [
                 'title'             => 'Hashtags',
                 'description'       => 'Comma separated hashtags appended to tweet text.',
                 'type'              => 'string',
            ],
            'counturl' => [
                 'title'             => 'Custom URL',
                 'description'       => 'To share a different page, enter its full URL here. Otherwise leave this blank to share the current page.',
                 'type'              => 'string',
            ],
            'size' => [
                 'title'             => 'Button Size',
                 'description'       => 'The size of the button can render in either "medium", which is the default size, or in "large" - which is the larger button.',
                 'default'           => 'medium',
                 'type'              => 'dropdown',
                 'options'           => [
                    'medium' => 'medium',
                    'large'  => 'large'
                 ],
                 'group' => 'Display'
            ],
            'count' => [
                 'title'             => 'Count box position',
                 'description'       => 'Count box position.',
                 'default'           => 'horizontal',
                 'type'              => 'dropdown',
                 'options'           => [
                    'none'       => 'none',
                    'horizontal' => 'horizontal',
                    'vertical'   => 'vertical'
                 ],
                 'group'             => 'Display',
            ],
            'url' => [
                 'title'             => 'Display URL',
                 'description'       => 'You can enter a shorter URL for display purposes only.',
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
        $this->tweetAttributes = $this->page['tweetAttributes'] = $this->loadAttributes();
    }

    public function loadAttributes()
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
            if ($key == 'counturl' && empty($value))
                $value = $this->currentPageUrl();

            $prefixAttributes['data-'.$key] = $value;
        }

        return HTML::attributes($prefixAttributes);
    }

}