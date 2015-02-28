<?php namespace Backend\FormWidgets;

use Backend\Classes\FormWidgetBase;

/**
 * Rich Editor
 * Renders a rich content editor field.
 *
 * @package october\backend
 * @author Alexey Bobkov, Samuel Georges
 */
class RichEditor extends FormWidgetBase
{
    /**
     * {@inheritDoc}
     */
    public $defaultAlias = 'richeditor';

    /**
     * @var boolean Determines whether content has HEAD and HTML tags.
     */
    public $fullPage = false;

    /**
     * {@inheritDoc}
     */
    public function render()
    {
        $this->fullPage = $this->getConfig('fullPage', $this->fullPage);

        $this->prepareVars();
        return $this->makePartial('richeditor');
    }

    /**
     * Prepares the list data
     */
    public function prepareVars()
    {
        $this->vars['fullPage'] = $this->fullPage;
        $this->vars['stretch'] = $this->formField->stretch;
        $this->vars['size'] = $this->formField->size;
        $this->vars['name'] = $this->formField->getName();
        $this->vars['value'] = $this->getLoadValue();
    }

    /**
     * {@inheritDoc}
     */
    public function loadAssets()
    {
        $this->addJs('js/plugin.cleanup.js', 'core');
        $this->addJs('js/plugin.fullscreen.js', 'core');
        $this->addJs('js/plugin.figure.js', 'core');
        $this->addJs('js/plugin.quote.js', 'core');
        $this->addJs('js/plugin.table.js', 'core');
        $this->addJs('js/plugin.image.js', 'core');

        $this->addJs('vendor/redactor/redactor.js', 'core');
        $this->addCss('css/richeditor.css', 'core');
        $this->addJs('js/richeditor.js', 'core');

    }
}
