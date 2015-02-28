<?php namespace RainLab\Twitter\Classes;

use Cache;
use tmhOAuth;
use RainLab\Twitter\Models\Settings;
use System\Classes\ApplicationException;

class TwitterClient
{
    use \October\Rain\Support\Traits\Singleton;

    /**
     * @var tmhOAuth Twitter API client
     */
    public $client;

    protected function init()
    {
        $settings = Settings::instance();
        if (!strlen($settings->api_key))
            throw new ApplicationException('Twitter API access is not configured. Please configure it on the System / Settings / Twitter page.');

        $this->client = new tmhOAuth([
            'consumer_key'        => $settings->api_key,
            'consumer_secret'     => $settings->api_secret,
            'token'               => $settings->access_token,
            'secret'              => $settings->access_token_secret,
            'curl_ssl_verifypeer' => false
        ]);
    }

    /**
     * Returns a representation of the requesting user if authentication was successful.
     * @see https://dev.twitter.com/docs/api/1.1/get/account/verify_credentials
     */
    public function getUserData()
    {
        $cacheKey = 'rainlab-twitter-user-data';
        $cached = Cache::get($cacheKey, false);
        if ($cached && ($unserialized = @unserialize($cached)) !== false)
            return $unserialized;

        $code = $this->client->user_request([
            'url' => $this->client->url('1.1/account/verify_credentials')
        ]);

        if ($code <> 200) {
            if ($code == 429)
                throw new ApplicationException('Exceeded Twitter API rate limit');

            throw new ApplicationException('Error requesting Twitter API: '.$this->client->response['error']);
        }

        $result = json_decode($this->client->response['response'], true);

        Cache::put($cacheKey, serialize($result), 2);
    }

    /**
     * Returns the 200 most recent Tweets favorited by the authenticating user.
     * @see https://dev.twitter.com/docs/api/1.1/get/favorites/list
     */
    public function listFavorites()
    {
        $cacheKey = 'rainlab-twitter-favorites';
        $cached = Cache::get($cacheKey, false);
        if ($cached && ($unserialized = @unserialize($cached)) !== false)
            return $unserialized;

        $obj = static::instance();

        $userData = $obj->getUserData();

        $code = $obj->client->user_request(array(
            'url'    => $obj->client->url('1.1/favorites/list'),
            'params' => array(
                'include_entities' => true,
                'count'            => 200,
                'screen_name'      => $userData['screen_name']
            )
        ));

        if ($code <> 200)
            throw new ApplicationException('Error requesting Twitter API: '.$obj->client->response['error']);

        $result = json_decode($obj->client->response['response'], true);
        foreach ($result as &$message) {
            $text = $message['text'];
            $text = preg_replace('/\@\w+/', '<span class="name">$0</span>', $text);
            $text = preg_replace('/\#\w+/', '<span class="tag">$0</span>', $text);
            $message['text_processed'] = $obj->urlsToLinks($text);
        }

        Cache::put($cacheKey, serialize($result), 2);
        return $result;
    }

    public function urlsToLinks($str)
    {
        return preg_replace('@(https?://([-\w\.]+[-\w])+(:\d+)?(/([\w/_\.#-]*(\?\S+)?[^\.\s])?)?)@', '<a href="$1" target="_blank">$1</a>', $str);
    }
}