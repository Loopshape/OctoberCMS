<?php 
/**
 * Created by ShahiemSeymor.
 * Date: 5/29/14
 */
namespace ShahiemSeymor\Poll\Models;

use Model;

class Settings extends Model
{
    public $implement = ['System.Behaviors.SettingsModel'];
    public $settingsCode = 'poll_settings';
    public $settingsFields = 'fields.yaml';

    public function getPollSettingsOptions()
    {
        return array('red' => 'Red', 'orange' => 'Orange', 'blue' => 'Blue', 'green' => 'Green');
    }

}