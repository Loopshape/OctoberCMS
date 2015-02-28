<?php namespace RainLab\Twitter\Components;

use Cms\Classes\ComponentBase;
use HTML;
use Http;

class EmbedTweet extends ComponentBase
{
    public $tweetContent;

    public function componentDetails()
    {
        return [
            'name'        => 'Embed Tweet',
            'description' => 'Display an embedded tweet area.'
        ];
    }

    public function defineProperties()
    {
        return [
            'id' => [
                 'title'             => 'Tweet ID',
                 'description'       => 'The Tweet/status ID to return embed code for.',
                 'type'              => 'string',
            ],
            'hide_media' => [
                 'title'             => 'Hide media',
                 'description'       => 'Specifies whether the embedded Tweet should automatically expand images.',
                 'default'           => 0,
                 'type'              => 'checkbox'
            ],
            'hide_thread' => [
                 'title'             => 'Hide thread',
                 'description'       => 'Specifies whether the embedded Tweet should automatically show the original message in the case that the embedded Tweet is a reply.',
                 'default'           => 0,
                 'type'              => 'checkbox'
            ],
            'maxwidth' => [
                 'title'             => 'Maximum width',
                 'description'       => 'The maximum width in pixels that the embed should be rendered at. This value is constrained to be between 250 and 550 pixels.',
                 'type'              => 'string',
                 'validationPattern' => '^\d*$',
                 'validationMessage' => 'The maximum width can only contain numbers.',
                'group'              => 'Display',
            ],
            'align' => [
                 'title'             => 'Align',
                 'description'       => 'Specifies whether the embedded Tweet should be left aligned, right aligned, or centered in the page.',
                 'default'           => 'none',
                 'type'              => 'dropdown',
                 'options'           => [
                    'left'   => 'left',
                    'rigth'  => 'rigth',
                    'center' => 'center',
                    'none'   => 'none',
                 ],
                 'group'             => 'Display',
            ],
            'related' => [
                 'title'             => 'Recommended accounts',
                 'description'       => 'Related accounts.',
                 'type'              => 'string',
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
        $this->tweetContent = $this->page['tweetContent'] = $this->loadTweetContent();
    }

    protected function loadTweetContent()
    {
        $json = json_decode(Http::get('https://api.twitter.com/1/statuses/oembed.json', function($http){
            $http->data($this->getProperties());
        })->body);

        return $json->html;
    }

}