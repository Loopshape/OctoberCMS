<?php namespace RainLab\Translate\FormWidgets;

use Backend\Classes\FormWidgetBase;
use RainLab\Translate\Models\Locale;

/**
 * ML Textarea
 * Renders a multi-lingual textarea field.
 *
 * @package rainlab\translate
 * @author Alexey Bobkov, Samuel Georges
 */
class MLTextarea extends FormWidgetBase
{

    use \RainLab\Translate\Traits\MLControl;

    /**
     * {@inheritDoc}
     */
    public $defaultAlias = 'mltextarea';

    /**
     * @var string If translation is unavailable, fall back to this standard field.
     */
    const FALLBACK_TYPE = 'textarea';

    /**
     * {@inheritDoc}
     */
    public function init()
    {
        $this->initLocale();
    }

    /**
     * {@inheritDoc}
     */
    public function render()
    {
        $this->isAvailable = Locale::isAvailable();

        $this->prepareLocaleVars();

        if ($this->isAvailable)
            return $this->makePartial('mltextarea');
        else
            return $this->renderFallbackField();
    }

    /**
     * {@inheritDoc}
     */
    public function loadAssets()
    {
        $this->loadLocaleAssets();
    }

}