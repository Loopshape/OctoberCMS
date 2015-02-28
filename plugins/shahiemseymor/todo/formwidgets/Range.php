<?php namespace ShahiemSeymor\Todo\FormWidgets;

use Backend\Classes\FormWidgetBase;

class Range extends FormWidgetBase
{

    public function widgetDetails()
    {
        return [
            'name'        => 'Range slider',
            'description' => 'Renders a range slide field.'
        ];
    }

    public function render()
    {
        $this->prepareVars();
        return $this->makePartial('range');
    }

    public function prepareVars()
    {
         $this->vars['name']  = $this->formField->getName();
         $this->vars['value'] = $this->model->{$this->columnName};
    }

    public function loadAssets()
    {
        $this->addCss('css/normalize.min.css');
        $this->addCss('css/jquery.nouislider.css');
        $this->addJs('js/jquery.nouislider.min.js');  
    }

}