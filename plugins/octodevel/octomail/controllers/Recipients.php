<?php namespace OctoDevel\OctoMail\Controllers;

use BackendMenu;
use Backend\Classes\Controller;

class Recipients extends Controller
{
    public $implement = [
        'Backend.Behaviors.FormController',
        'Backend.Behaviors.ListController'
    ];

    public $formConfig = 'config_form.yaml';
    public $listConfig = 'config_list.yaml';

    public function __construct()
    {
        parent::__construct();

        BackendMenu::setContext('OctoDevel.OctoMail', 'octomail', 'recipients');
    }
}