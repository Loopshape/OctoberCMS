<?php namespace RainLab\Twitter;

/**
 * The plugin.php file (called the plugin initialization script) defines the plugin information class.
 */

use System\Classes\PluginBase;

class Plugin extends PluginBase
{

    public function pluginDetails()
    {
        return [
            'name'        => 'Twitter',
            'description' => 'Provides integration with Twitter.',
            'author'      => 'Alexey Bobkov, Samuel Georges',
            'icon'        => 'icon-twitter'
        ];
    }

    public function registerComponents()
    {
        return [
            'RainLab\Twitter\Components\Favorites'        => 'twitterFavorites',
            'RainLab\Twitter\Components\FollowButton'     => 'followButton',
            'RainLab\Twitter\Components\TweetButton'      => 'tweetButton',
            'RainLab\Twitter\Components\EmbedTweet'       => 'embedTweet',
            'RainLab\Twitter\Components\EmbedTimeline'    => 'embedTimeline',
        ];
    }

    public function registerSettings()
    {
        return [
            'settings' => [
                'label'       => 'Twitter',
                'icon'        => 'icon-twitter',
                'description' => 'Configure Twitter authentication parameters.',
                'class'       => 'RainLab\Twitter\Models\Settings',
                'order'       => 210
            ]
        ];
    }
}