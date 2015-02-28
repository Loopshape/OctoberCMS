<?php namespace LynxSolutions\Scrolltop\Components;

use Cms\Classes\ComponentBase;
use \stdClass;

class ScrollTop extends ComponentBase
{
    public function componentDetails()
    {
        return [
            'name' => 'Scroll to Top',
            'description' => "Adds a 'scroll to top' link to the page"
        ];
    }

    public function defineProperties()
    {
        return [
            'speedScrollTopLynx' => [
                'title'             => 'Speed',
                'description'       => 'Time in milliseconds it takes for the scroll to end',
                'default'           => '300',
                'type'              => 'string',
                'validationPattern' => '^[0-9]*$',
                'validationMessage' => 'The "Speed" property can contain only numeric symbols',
                'showExternalParam' => false
            ],
            'sizeScrollLynx'            => [
                'title'             => 'Size',
                'description'       => 'Size of the button in pixels',
                'default'           => '50',
                'type'              => 'string',
                'validationPattern' => '^[0-9]*$',
                'validationMessage' => 'The "Size" property can contain only numeric symbols',
                'showExternalParam' => false
            ],
            'positionScrollLynx' => [
                'title'             => 'Position',
                'description'       => 'Select where you want to button to appear',
                'type'              => 'dropdown',
                'default'           => 'bottomright',
                'options'               => [
                    'bottomright' => 'Bottom Right',
                    'bottomleft'  => 'Bottom Left',
                    'topright'=> 'Top Right',
                    'topleft' => 'Top Left',
                ],
                'group'             => 'position',
                'showExternalParam' => false
            ],
            'UnitScrollLynx' => [
                'title'             => 'Unit',
                'description'       => 'Select the measurement unit you want to use to position the button',
                'type'              => 'dropdown',
                'default'           => '%',
                'options'               => [
                    'px'=> 'Pixel(px)',
                    '%' => 'Percent(%)'
                ],
                'group'             => 'position',
                'showExternalParam' => false
            ],
            'horizontalUnitsScrollLynx' => [
                'title'             => 'Units from Left/Right',
                'description'       => 'Units from the Side (right or left, depending on your selection of positioning)',
                'type'              => 'string',
                'default'           => '2',
                'group'             => 'position',
                'validationPattern' => '^[0-9]*$',
                'validationMessage' => 'The "Units from Left/Right" property can contain only numeric symbols',
                'showExternalParam' => false
            ],
            'verticalUnitsScrollLynx' => [
                'title'             => 'Units from Top/Bottom',
                'description'       => 'Units from Top/Bottom (depending on your selection of positioning)',
                'type'              => 'string',
                'default'           => '7',
                'group'             => 'position',
                'validationPattern' => '^[0-9]*$',
                'validationMessage' => 'The "Units from Top/Bottom" property can contain only numeric symbols',
                'showExternalParam' => false
            ],
            'arrowColorScrollLynx' => [
                'title'             => 'Arrow Color',
                'description'       => 'CSS color attribute of the arrow',
                'default'           => '#000',
                'type'              => 'string',
                'validationPattern' => '#([a-fA-F0-9]){3}(([a-fA-F0-9]){3})?\b',
                'validationMessage' => 'The "Arrow Color" needs to be a hex color code',
                'group'             => 'color',
                'showExternalParam' => false
            ],
            'arrowHoverColorScrollLynx' => [
                'title'             => 'Arrow Hover Color',
                'description'       => 'CSS color attribute of the arrow when the user hoveres over it',
                'default'           => '#2E2E2E',
                'type'              => 'string',
                'validationPattern' => '#([a-fA-F0-9]){3}(([a-fA-F0-9]){3})?\b',
                'validationMessage' => 'The "Arrow Color" needs to be a hex color code',
                'group'             => 'color',
                'showExternalParam' => false
            ],
            'backgroundColorScrollLynx' => [
                'title'             => 'Background Color',
                'description'       => 'CSS color attribute of the background',
                'default'           => '#FFF',
                'type'              => 'string',
                'validationPattern' => '#([a-fA-F0-9]){3}(([a-fA-F0-9]){3})?\b',
                'validationMessage' => 'The "Background Color" needs to be a hex color code',
                'group'             => 'color',
                'showExternalParam' => false
            ],
            'backgroundHoverColorScrollLynx' => [
                'title'         => 'Background Hover Color',
                'description'   => 'CSS color attribute of the background when the user hoveres over it',
                'default'       => '#E6E6E6',
                'type'          => 'string',
                'validationPattern' => '#([a-fA-F0-9]){3}(([a-fA-F0-9]){3})?\b',
                'validationMessage' => 'The "Background Color" needs to be a hex color code',
                'group'         => 'color',
                'showExternalParam' => false
            ],
        ];
    }

    public function onRun()
    {
        $this->ScrollTop = new stdClass();

        $this->ScrollTop->speed             = $this->propertyOrParam('speedScrollTopLynx');
        $this->ScrollTop->position          = $this->propertyOrParam('positionScrollLynx');
        $this->ScrollTop->unit              = $this->propertyOrParam('UnitScrollLynx');
        $this->ScrollTop->horizontalUnits   = $this->propertyOrParam('horizontalUnitsScrollLynx');
        $this->ScrollTop->verticalUnits     = $this->propertyOrParam('verticalUnitsScrollLynx');
        $this->ScrollTop->arrowColor        = $this->propertyOrParam('arrowColorScrollLynx');
        $this->ScrollTop->arrowHoverColor   = $this->propertyOrParam('arrowHoverColorScrollLynx');
        $this->ScrollTop->backgroundColor   = $this->propertyOrParam('backgroundColorScrollLynx');
        $this->ScrollTop->backgroundHoverColor = $this->propertyOrParam('backgroundHoverColorScrollLynx');
        $this->ScrollTop->size              = $this->propertyOrParam('sizeScrollLynx');

        $this->page['scrollToTop'] = $this->ScrollTop;

        // Add css
        $this->addCss('assets/css/default.css');
        $this->addCss('assets/css/scroll_top_lnx.css');
    }
}