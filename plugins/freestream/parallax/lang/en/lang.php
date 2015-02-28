<?php
/**
 * The MIT License (MIT)
 *
 * Copyright (c) 2014 Anton Samuelsson
 *
 * Permission is hereby granted, free of charge, to any person obtaining a copy
 * of this software and associated documentation files (the "Software"), to deal
 * in the Software without restriction, including without limitation the rights
 * to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
 * copies of the Software, and to permit persons to whom the Software is
 * furnished to do so, subject to the following conditions:
 *
 * The above copyright notice and this permission notice shall be included in
 * all copies or substantial portions of the Software.
 *
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
 * IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
 * FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
 * AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
 * LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
 * OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN
 * THE SOFTWARE.
 */
?>
<?php
return [
    'system'    => [
        'permissions' => [
            'manage_parallaxes' => 'Parallax - Manage Parallaxes',
        ],
        'details' => [
            'description' => 'Manage and create multiple parallax sliders that you can view on any page.',
        ]
    ],
    'controllers' => [
        'parallax' => [
            'parallaxes'            => 'Parallaxes',
            'title'                 => 'Title',
            'pages'                 => 'Pages',
            'create'                => 'Create Parallax',
            'edit'                  => 'Edit Parallax',
            'general'               => 'General',
            'deleted_success'       => 'Parallax(es) has been deleted successfully.',
            'new_parallax'          => 'New Parallax',
            'created'               => 'Created',
            'updated'               => 'Updated',
            'how_to'                => 'Add vertical pages from the currently active them to create an continuous vertical scrolling page.<br />All pages in the second level will automatically be handled as a sidescroll.<br /><strong>Place note that it is limited to only 2 levels and it requires at lest one vertical page to create a horizontal scroll.</strong>',
            'available_pages'       => 'Available Pages',
            'selected_pages'        => 'Selected Pages',
            'return_to_parallaxes'  => 'Return to parallaxes list',
            'manage_parallaxes'     => 'Manage Parallaxes',
            'available_title'       => 'Available Pages',
            'available_description' => 'Click on the page you want to include.',
            'horizontal_label'      => 'Add horizontal page',
            'vertical_label'        => 'Add vertical page'
        ]
    ],
    'components' => [
        'parallax_page'             => 'Parallax Page',
        'description'               => 'Generates a parallax of selected pages.',
        'properties'                => [
            'groups'                    => [
                'general'                   => 'General',
                'looping'                   => 'Looping',
                'navigation'                => 'Navigation',
                'slides_navigation'         => 'Slides Navigation',
                'advanced'                  => 'Advanced',
            ],
            'options'                   => [
                'right'                     => 'Right',
                'left'                      => 'Left',
                'bottom'                    => 'Bottom',
                'top'                       => 'Top',
            ],
            'parallax'                          => [
                'title'                             => 'Parallax',
                'description'                       => 'Parallax page collection',
            ],
            'verticalCentered'                  => [
                'title'                             => 'Vertical Centered',
                'description'                       => 'Vertically centering of the content within sections',
            ],
            'resize'                            => [
                'title'                             => 'Resize',
                'description'                       => 'Whether you want to resize the text when the window is resized.',
            ],
            'scrollingSpeed'                    => [
                'title'                             => 'Scrolling Speed',
                'description'                       => 'Speed in milliseconds for the scrolling transitions.',
                'validationMessage'                 => 'Invalid "Scrolling Speed" format.'
            ],
            'menu'                              => [
                'title'                             => 'Menu',
                'description'                       => 'A selector can be used to specify the menu to link with the sections. This way the scrolling of the sections will activate the corresponding element in the menu using the class active. This won\'t generate a menu but will just add the active class to the element in the given menu with the corresponding anchor links. In order to link the elements of the menu with the sections, an HTML 5 data-tag (data-menuanchor) will be needed to use with the same anchor links as used within the sections.',
            ],
            'autoScrolling'                     => [
                'title'                             => 'Auto Scrolling',
                'description'                       => 'Defines whether to use the "automatic" scrolling or the "normal" one. It also has affects the way the sections fit in the browser/device window in tablets and mobile phones.',
            ],
            'scrollOverflow'                    => [
                'title'                             => 'Scroll Overflow',
                'description'                       => 'Defines whether or not to create a scroll for the section in case its content is bigger than the height of it.',
            ],
            'css3'                              => [
                'title'                             => 'CSS3',
                'description'                       => 'Defines wheter to use JavaScript or CSS3 transforms to scroll within sections and slides. Useful to speed up the movement in tablet and mobile devices with browsers supporting CSS3. If this option is set to true and the browser doesn\'t support CSS3, a jQuery fallback will be used instead.',
            ],
            'loopBottom'                        => [
                'title'                             => 'Loop Bottom',
                'description'                       => 'Defines whether scrolling down in the last section should scroll to the first one or not.',
            ],
            'loopTop'                           => [
                'title'                             => 'Loop Top',
                'description'                       => 'Defines whether scrolling up in the first section should scroll to the last one or not.',
            ],
            'loopHorizontal'                    => [
                'title'                             => 'Loop Horizontal',
                'description'                       => 'Defines whether horizontal sliders will loop after reaching the last or previous slide or not.',
            ],
            'navigation'                        => [
                'title'                             => 'Menu',
                'description'                       => 'Will show a navigation bar made up of small circles.',
            ],
            'navigationPosition'                => [
                'title'                             => 'Navigation Position',
                'description'                       => 'It can be set to left or right and defines which position the navigation bar will be shown (if using one)',
            ],
            'slidesNavigation'                  => [
                'title'                             => 'Slides Navigation',
                'description'                       => 'If set to true it will show a navigation bar made up of small circles for each landscape slider on the site.',
            ],
            'slidesNavPosition'                 => [
                'title'                             => 'Sides Navigation Position',
                'description'                       => 'Defines the position for the landscape navigation bar for sliders. Admits top and bottom as values. You may want to modify the CSS styles to determine the distance from the top or bottom as well as any other style such as color.',
            ],
            'paddingTop'                        => [
                'title'                             => 'Padding Top',
                'description'                       => 'Defines the top padding for each section with a numerical value and its measure. Useful in case of using a fixed header.',
                'validationMessage'                 => 'Must be number with a tailing size option (em, px or %)',
            ],
            'paddingBottom'                     => [
                'title'                             => 'Padding Bottom',
                'description'                       => 'Defines the bottom padding for each section with a numerical value and its measure. Useful in case of using a fixed footer.',
                'validationMessage'                 => 'Must be number with a tailing size option (em, px or %)',
            ],
            'fixedElements'                     => [
                'title'                             => 'Fixed Elements',
                'description'                       => 'Defines which elements will be taken off the scrolling structure of the plugin which is necesary when using the css3 option to keep them fixed. It requires a string with the jQuery selectors for those elements.',
            ],
            'normalScrollElements'              => [
                'title'                             => 'Normal Scroll Elements',
                'description'                       => 'If you want to avoid the auto scroll when scrolling over some elements, this is the option you need to use. (useful for maps, scrolling divs etc.) It requires a string with the jQuery selectors for those elements.',
            ],
            'normalScrollElementTouchThreshold' => [
                'title'                             => 'Normal Scroll Element Touch Threshold',
                'description'                       => 'Defines the threshold for the number of hops up the html node tree Fullpage will test to see if "Normal Scroll Elements" is a match to allow scrolling functionality on divs on a touch device.',
                'validationMessage'                 => 'Invalid "Normal Scroll Element Touch Threshold" format.',
            ],
            'keyboardScrolling'                 => [
                'title'                             => 'Keyboard Scrolling',
                'description'                       => 'Defines if the content can be navigated using the keyboard.',
            ],
            'touchSensitivity'                  => [
                'title'                             => 'Touch Sensitivity',
                'description'                       => 'Defines a percentage of the browsers window width/height, and how far a swipe must measure for navigating to the next section / slide.',
                'validationMessage'                 => 'Invalid "Touch Sensitivity" format.',
            ],
            'continuousVertical'                => [
                'title'                             => 'Continuous Vertical',
                'description'                       => 'Defines whether scrolling down in the last section should scroll down to the first one or not, and if scrolling up in the first section should scroll up to the last one or not. Not compatible with "Loop Top" or "Loop Bottom"',
            ],
            'animateAnchor'                     => [
                'title'                             => 'Animate Anchor',
                'description'                       => 'Defines whether the load of the site when given an anchor (#) will scroll with animation to its destination or will directly load on the given section.',
            ],
        ]
    ]
];
