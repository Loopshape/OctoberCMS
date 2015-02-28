<?php namespace OctoDevel\OctoMail\FormWidgets;

use Backend\Classes\FormWidgetBase;
use OctoDevel\OctoMail\Models\Template;

/**
 * Renders the template name field.
 *
 * @package OctoDevel\OctoMail
 * @author OctoDevel
 */
class TemplateData extends FormWidgetBase
{
    public $requestTemplate;
    /**
     * Widget Details
     */
    public function widgetDetails()
    {
        return [
            'name'        => 'TemplateData',
            'description' => 'Renders the template name field.'
        ];
    }

    /**
     * Renders Partial
     */
    public function render()
    {
        $this->prepareVars();
        return $this->makePartial('templatedata');
    }

    /**
     * Prepares the list data
     */
    public function prepareVars()
    {
         $this->vars['name'] = $this->formField->getName();
         $this->vars['value'] = $this->model->{$this->columnName};

        // Set the requested template in a variable;
        $this->requestTemplate = $this->loadTemplate($this->vars['value']);
        if(!$this->requestTemplate)
                throw new \Exception(sprintf('A unexpected error has occurred. The template slug is invalid.'));

        // Set a second variable with request data from database
        $template = $this->requestTemplate->attributes;
        if(!$template)
                throw new \Exception(sprintf('A unexpected error has occurred. Erro while trying to get a non-object property.'));

        $this->vars['template'] = $template;
    }

    /*
     * Request a template data
     */
    protected function loadTemplate($id = '')
    {
        return Template::getTemplate()->where('id', '=', $id)->first();
    }
}