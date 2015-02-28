<?php namespace RainLab\Twitter\Components;

use HTML;
use Cms\Classes\ComponentBase;

class FollowButton extends ComponentBase
{
    public $followUser;
    public $followAttributes;

    public function componentDetails()
    {
        return [
            'name'        => 'Follow Button',
            'description' => 'Display a Twitter Follow button.'
        ];
    }

    public function defineProperties()
    {
        return [
            'user' => [
                 'title'             => 'User to follow',
                 'description'       => 'The username of the user to follow.',
                 'type'              => 'string',
            ],
            'size' => [
                 'title'             => 'Button Size',
                 'description'       => 'The size of the button can render in either "medium", which is the default size, or in "large" - which is the larger button.',
                 'default'           => 'medium',
                 'type'              => 'dropdown',
                 'options'           => [
                    'medium' => 'medium',
                    'large' => 'large'
                 ],
                 'group'             => 'Display',
            ],
            'width' => [
                 'title'             => 'Width',
                 'description'       => 'You can specify the width of the Follow Button (in pixels or percentage).',
                 'type'              => 'string',
                 'validationPattern' => '^(\d+(px|%))?$',
                 'validationMessage' => 'The width must be specified in either pixels or percentage.',
                 'group'             => 'Display',
            ],
            'align' => [
                 'title'             => 'Alignment',
                 'description'       => 'You can specify the alignment of the Follow Button.',
                 'default'           => 'left',
                 'type'              => 'dropdown',
                 'options'           => [
                    'left' => 'left',
                    'right' => 'right'
                 ],
                 'group'             => 'Display',
            ],
            'show-count' => [
                 'title'             => 'Followers count display',
                 'description'       => "By default, the User's followers count is not displayed with the Follow Button.",
                 'default'           => 0,
                 'type'              => 'checkbox',
                 'group'             => 'Display',
            ],
            'show-screen-name' => [
                 'title'             => 'Show Screen Name',
                 'description'       => "The user's screen name shows up by default, but you can opt not to show the screen name in the button.",
                 'default'           => 1,
                 'type'              => 'checkbox',
                 'group'             => 'Display',
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
        $this->followAttributes = $this->page['followAttributes'] = $this->loadAttributes();
        $this->followUser = $this->page['followUser'] = $this->property('user');
    }

    public function loadAttributes()
    {
        $attributes = array_except($this->getProperties(), ['user']);

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