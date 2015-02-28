<?php
return [
    'plugin' => [
        'name' => 'Banner Ley de Cookies',
        'description' => 'Añade una banner con la información para cumplir la ley de cookies',
    ],
    'messages' => [
        'Background' => 'Color de fondo',
        'Background_description' => 'Color de fondo de la precargar',
        'Background_validation' => 'El color tiene que ser hexadecimal',
        'TextColor' => 'Color de las letras',
        'TextColor_description' => 'Color de las letras del banner',
        'TextColor_validation' => 'El color tiene que ser hexadecimal',
        'Duration' => 'Duración en días de la cookie',
        'Duration_description' => 'Tiempo en desaparecer la cookie en días',
        'Time' => 'Tiempo',
        'Time_description' => 'Tiempo en desaparecer en minisegundos',
        'Title' => 'Titulo que aparece en el mensaje que aparece en el banner de ley de cookie ',
        'Title_default' =>'Ley de Cookies',
        'Title_description' => 'Titulo que aparece en el mensaje que aparece en el banner de ley de cookie',
        'Text' => 'Mensaje que aparece en el banner de ley de cookie ',
        'Text_description' => 'Mensaje que aparece en el banner de ley de cookie',
        'Text_default' =>'Utilizamos cookies propias y de terceros para mejorar nuestros servicios y mostrarle publicidad relacionada con sus preferencias mediante el análisis de sus hábitos de navegación. Si continúa navegando, consideramos que acepta su uso',
        'TextLink' => 'Mensaje que aparece en el enlace ',
        'TextLink_default' => 'Más información',
        'TextLink_description' => 'Mensaje que aparece en el enlace',
        'Link' => 'Página a la que enlace el banner',
        'Link_description' => 'Página a la que ir para ver más información',
        'Static' =>'Fijo',
        'Developer' =>'Desarrollo y prueba del banner',
        'Developer_description' =>'Al marcar esta casilla pondrá el plugin en el modo de desarrollo. Será visible siempre para todo el mundo',
        'active'=>'Activar',
        'active_description'=>'Si esta activo o sino borramos la cookie'
    ],
];
?>