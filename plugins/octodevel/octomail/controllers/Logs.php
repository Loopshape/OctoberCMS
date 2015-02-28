<?php namespace OctoDevel\OctoMail\Controllers;

use BackendMenu;
use Backend\Classes\Controller;

class Logs extends Controller
{
    public $implement = [
        'Backend.Behaviors.FormController',
        'Backend.Behaviors.ListController'
    ];

    public $formConfig = 'config_form.yaml';
    public $listConfig = 'config_list.yaml';

    public $requiredPermissions = ['octodevel.octomail.access_logs'];

    public function __construct()
    {
        parent::__construct();

        BackendMenu::setContext('OctoDevel.OctoMail', 'octomail', 'logs');
        $this->addCss('/plugins/octodevel/octomail/assets/css/octodevel.octomail-form.css');
    }
}