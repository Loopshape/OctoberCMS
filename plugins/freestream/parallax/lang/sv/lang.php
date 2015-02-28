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
            'manage_parallaxes' => 'Parallax - Hantera parallaxer',
        ],
        'details' => [
            'description' => 'Hantera och skapa multipla parallax sidor som kan använas på valfri sida.',
        ]
    ],
    'controllers' => [
        'parallax' => [
            'parallaxes'            => 'Parallaxer',
            'title'                 => 'Titel',
            'pages'                 => 'Sidor',
            'create'                => 'Skapa parallax',
            'edit'                  => 'Ändra parallax',
            'general'               => 'Generell',
            'deleted_success'       => 'Parallax(er) har blivit borttagna.',
            'new_parallax'          => 'Ny parallax',
            'created'               => 'Skapad',
            'updated'               => 'Uppdaterad',
            'how_to'                => 'Lägg till vertikala sidor genom att välj bland de existerande sidorna i det aktiva temat för att skapa en kontinuerlig vertikalt rullande sida.<br />Alla horisontella sidor kommer att automatiskt bli behandlade som en horisontellt rullande sida.<br /><strong>Notera att det endast går att skapa två nivåer av sidor samt att det krävs minst en vertikal sida för att skapa en horisontellt rullande sida.</strong>',
            'available_pages'       => 'Tillgängliga sidor',
            'selected_pages'        => 'Valda sidor',
            'return_to_parallaxes'  => 'Återvänd till parallax listan',
            'manage_parallaxes'     => 'Hantera parallaxer',
            'available_title'       => 'Valbara sidor',
            'available_description' => 'Klicka på den sidan du vill inkludera.',
            'horizontal_label'      => 'Lägg till horisontell sida',
            'vertical_label'        => 'Lägg till vertikal sida'
        ]
    ],
    'components' => [
        'parallax_page'             => 'Parallax sida',
        'description'               => 'Skapa en parallax av valda sidor.',
        'properties'                => [
            'groups'                    => [
                'general'                   => 'Generell',
                'looping'                   => 'Koppling',
                'navigation'                => 'Navigation',
                'slides_navigation'         => 'Sidnavigation',
                'advanced'                  => 'Avancerat',
            ],
            'parallax'                  => [
                'title'                     => 'Parallax',
                'description'               => 'Parallax sidor',
            ]
        ]
    ]
];