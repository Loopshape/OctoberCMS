<?php namespace ShahiemSeymor\Todo\FormWidgets;

use Backend\Classes\FormWidgetBase;
use Backend\Models\User;
use BackendAuth;
use ShahiemSeymor\Todo\Controllers\Projects;
use ShahiemSeymor\Todo\Models\Assign;

class Tokeninput extends FormWidgetBase
{

    public function widgetDetails()
    {
        return [
            'name'        => 'TextExt',
            'description' => 'TextExt is a plugin for jQuery which is designed to provide functionality such as tag input and autocomplete.'
        ];
    }

    public function render()
    {
        $this->prepareVars();
        return $this->makePartial('textext');
    }

    public function prepareVars()
    {
        $this->vars['name']  = $this->formField->getName();
        $this->vars['value'] = $this->model->{$this->columnName};
        $this->vars['myID']  = BackendAuth::getUser()->id;
        $this->vars['users'] = User::all();
    
        $project = new Projects; 

        if(isset($project->params[0]))
        {
            $this->vars['projectAssign'] = Assign::where('project_id', '=', $project->params[0]);
        }
        
        $this->vars['getInfo'] = new User;
    }

    public function loadAssets()
    {
        $this->addCss('css/token-input.css');
        $this->addJs('js/jquery.tokeninput.js'); 
    }

}