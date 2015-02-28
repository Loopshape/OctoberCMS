<?php namespace Lyra\Hashtag\Components;

use System\Classes\ApplicationException;
use Cms\Classes\ComponentBase;
use Lyra\Hashtag\Models\Settings;
use Cache;

class Hashfeed extends ComponentBase
{

    public function componentDetails()
    {
        return [
            'name'        => 'Hashtag Feed',
            'description' => 'Outputs a pretty feed'
        ];
    }

    public function defineProperties()
    {
        return [
            'count' => [
                'description' => 'Number of items to display',
                'title' => 'Count',
                'default' => 12,
                'type' => 'string',
                'validationPattern' => '^[0-9]+$',
                'validationMessage' => 'The Count value is required and should be integer.'
            ],
            'tag' => [
                'description' => 'The hashtag used',
                'title' => 'Hashtag',
                'default' => 'beer',
                'type' => 'string',
                'validationPattern' => '^[a-zA-Z0-9]+$',
                'validationMessage' => 'The hashtag may only contain alphanumerical characters',
            ],
        ];
    }

    public function onRun()
    {
         $this->controller->addCss('/plugins/lyra/hashtag/assets/css/main.css');
        $this->page['items'] = $this->getItems();
    }

    /**
     * Get Items
     * @return array
     */
    public function getItems()
    {
        $settings = Settings::instance();

        if (!strlen($settings->client_id)) {
            throw new ApplicationException('Instagram Client ID is not configured. Please configure it on the System / Settings / Hashtag page.');
        }

        if (!strlen($settings->cache)) {
            throw new ApplicationException('Cache is not configured. Please configure it on the System / Settings / Hashtag page.');
        }

        if (Cache::has('lyra_hashtag')) {
            return Cache::get('lyra_hashtag');
        }

        $client_id = $settings->client_id;
        $tag = '#' . ltrim('#', $this->property('tag'));
        $count = $this->property('count');

        $url = 'https://api.instagram.com/v1/tags/'.$tag.'/media/recent?client_id='.$client_id . '&count=' . $count;

        $ch = curl_init();
        curl_setopt_array($ch, array(
            CURLOPT_URL => $url,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_SSL_VERIFYPEER => false,
            CURLOPT_SSL_VERIFYHOST => 2
        ));

        $result = curl_exec($ch);
        curl_close($ch);

        $result = json_decode($result, true);

        if ($settings->cache !== "0") {
            Cache::add('lyra_hashtag', $result, $settings->cache);
        }

        return $result;
    }
}