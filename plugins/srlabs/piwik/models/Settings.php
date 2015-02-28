<?php namespace srlabs\Piwik\Models;

use Model;

class Settings extends Model
{
    public $implement = ['System.Behaviors.SettingsModel'];

    // A unique code
    public $settingsCode = 'srlabs_piwik_settings';

    // Reference to field configuration
    public $settingsFields = 'fields.yaml';
}