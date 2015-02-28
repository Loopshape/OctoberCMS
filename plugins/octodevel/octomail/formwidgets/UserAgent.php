<?php namespace OctoDevel\OctoMail\FormWidgets;

require_once 'useragent/classes/UserAgentInfoPeer.class.php';
use Backend\Classes\FormWidgetBase;

/**
 * Renders a JSON data field.
 *
 * @package OctoDevel\OctoMail
 * @author OctoDevel
 */
class UserAgent extends FormWidgetBase
{
    // Include user agent info classes

    /**
     * Widget Details
     */
    public function widgetDetails()
    {
        return [
            'name'        => 'UserAgent',
            'description' => 'Renders a user_agent data field to humans.'
        ];
    }

    /**
     * Renders Partial
     */
    public function render()
    {
        $this->prepareVars();
        return $this->makePartial('useragent');
    }

    /**
     * Prepares the list data
     */
    public function prepareVars()
    {
        $pathName = \UserAgentInfoPeer::getOther($this->model->{$this->columnName});

        $this->vars['name'] = $this->formField->getName();
        $this->vars['value'] = 'Browser: ' . $pathName->getBrowserName() . ' ' . $pathName->getBrowserVersionMajor() . ($pathName->getBrowserVersionMinor() ? '.' . $pathName->getBrowserVersionMinor() : '') . ' / OS: ' . $pathName->getOsName();
    }
}