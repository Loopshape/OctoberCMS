<?php namespace Radiantweb\Disqus\Models;

use Model;

class Settings extends Model
{
    public $implement = ['System.Behaviors.SettingsModel'];

    // A unique code
    public $settingsCode = 'disqus_settings';

    // Reference to field configuration
    public $settingsFields = 'fields.yaml';
}