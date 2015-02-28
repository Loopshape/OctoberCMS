<?php namespace OctoDevel\OctoMail\Models;

use Str;
use Model;
use OctoDevel\OctoMail\Models\Template;

class Recipient extends Model
{
    use \October\Rain\Database\Traits\Validation;

    public $table = 'octodevel_octomail_recipients';

    /*
     * Validation
     */
    public $rules = [
        'name' => 'required',
        'email' => ['required', 'email'],
    ];
}