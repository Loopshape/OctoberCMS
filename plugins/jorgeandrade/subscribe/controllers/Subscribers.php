<?php namespace JorgeAndrade\Subscribe\Controllers;

use BackendMenu;
use Backend\Classes\Controller;

/**
 * Subscribers Back-end Controller
 */
class Subscribers extends Controller
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

        BackendMenu::setContext('JorgeAndrade.Subscribe', 'subscribe', 'subscribers');
        $this->addJs('/plugins/jorgeandrade/subscribe/assets/javascript/tableExport.js');
        $this->addJs('/plugins/jorgeandrade/subscribe/assets/javascript/jquery.base64.js');
        $this->addJs('/plugins/jorgeandrade/subscribe/assets/javascript/subscribe-backend-scripts.js');
    }
}