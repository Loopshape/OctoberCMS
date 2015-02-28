<?php namespace Ndcisiv\DisposableEmailBlocker\Models;

use Model;

/**
 * DisposableSettings Model
 */
class DisposableSettings extends Model
{
    use \October\Rain\Database\Traits\Validation;

    public $implement = ['System.Behaviors.SettingsModel'];

    // A unique code
    public $settingsCode = 'ndcisiv_disposable_email_blocker_settings';

    // Reference to field configuration
    public $settingsFields = 'fields.yaml';

    /**
     * Validation rules
     */
    public $rules = [
        'api_key' => 'required',
        'notification_email' => 'required|email'
    ];

}