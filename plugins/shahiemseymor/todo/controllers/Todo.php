<?php namespace ShahiemSeymor\Todo\Controllers;

use BackendMenu;
use Backend\Classes\Controller;

class Todo extends Controller
{
    public $implement = [
        'Backend.Behaviors.FormController',
        'Backend.Behaviors.ListController'
    ];

    public $formConfig = 'config_form.yaml';
    public $listConfig = 'config_list.yaml';
    public $bodyClass = 'compact-container';

    public function __construct()
    {
        parent::__construct();
        BackendMenu::setContext('ShahiemSeymor.Todo', 'todo', 'list');
    }

}