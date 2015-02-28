<?php namespace Lyra\Hashtag\Models;

use \October\Rain\Database\Model;

/**
 * Hashtag Settings model
 *
 * @package  System
 * @author  John Svensson
 * 
 */
class Settings extends Model
{
    public $implement = ['System.Behaviors.SettingsModel'];

    public $settingsCode = 'lyra_hashtag_settings';

    public $settingsFields = 'fields.yaml';

    /**
     * Validation rules
     */
    public $rules = [
        'client_id' => 'required',
        'client_secret' => 'required',
    ];
}