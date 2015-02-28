<?php namespace Alxy\GooglePlus\Components;

use Cms\Classes\ComponentBase;
use HTML;

class Badge extends ComponentBase
{

    public $lang;
    public $attributes;

    public function componentDetails()
    {
        return [
            'name'        => 'Badge Component',
            'description' => 'Display a GooglePlus Badge.'
        ];
    }

    public function defineProperties()
    {
        return [
            'class' => [
                 'title'             => 'Type',
                 'description'       => 'Because Google+ pages, profiles, and communities are different, there are slightly different versions of the badges.',
                 'type'              => 'dropdown',
                 'options'           => [
                    'g-person' => 'Person',
                    'g-page' => 'Page',
                    'g-community' => 'Community'
                 ]
            ],
            'data-href' => [
                 'title'             => 'URL',
                 'description'       => 'The URL of the Google+ profile/page/community.',
                 'type'              => 'string',
            ],
            'data-layout' => [
                 'title'             => 'Layout',
                 'description'       => 'Sets the orientation of the badge.',
                 'default'           => 'portrait',
                 'type'              => 'dropdown',
                 'options'           => [
                    'portrait' => 'portrait',
                    'landscape' => 'landscape'
                 ]
            ],
            'data-showcoverphoto' => [
                 'title'             => 'Show cover photo',
                 'description'       => 'Displays the cover photo in the badge if set to true and the photo exists.',
                 'default'           => 1,
                 'type'              => 'checkbox'
            ],
            'data-showtagline' => [
                 'title'             => 'Show tag line',
                 'description'       => 'Displays the user\'s tag line if set to true.',
                 'default'           => 1,
                 'type'              => 'checkbox'
            ],
            'data-theme' => [
                 'title'             => 'Theme',
                 'description'       => 'The color theme of the badge. Use dark when placing the badge on a page with a dark background.',
                 'default'           => 'light',
                 'type'              => 'dropdown',
                 'options'           => [
                    'light' => 'light',
                    'dark' => 'dark'
                 ]
            ],
            'data-width' => [
                 'title'             => 'Width',
                 'description'       => 'The pixel width of the badge to render.',
                 'default'           => '300',
                 'type'              => 'string',
                 'validationPattern' => '^(\d+)?$',
                 'validationMessage' => 'The width must be an integer.'
            ],
            'lang' => [
                'title'             => 'Language',
                'type'              => 'dropdown',
                'default'           => 'en',
                'placeholder'       => 'Select language',
                'options'           => [
                    "aa" => "Afar",
                    "ab" => "Abkhazian",
                    "ae" => "Avestan",
                    "af" => "Afrikaans",
                    "ak" => "Akan",
                    "am" => "Amharic",
                    "an" => "Aragonese",
                    "ar" => "Arabic",
                    "as" => "Assamese",
                    "av" => "Avaric",
                    "ay" => "Aymara",
                    "az" => "Azerbaijani",
                    "ba" => "Bashkir",
                    "be" => "Belarusian",
                    "bg" => "Bulgarian",
                    "bh" => "Bihari",
                    "bi" => "Bislama",
                    "bm" => "Bambara",
                    "bn" => "Bengali",
                    "bo" => "Tibetan",
                    "br" => "Breton",
                    "bs" => "Bosnian",
                    "ca" => "Catalan",
                    "ce" => "Chechen",
                    "ch" => "Chamorro",
                    "co" => "Corsican",
                    "cr" => "Cree",
                    "cs" => "Czech",
                    "cu" => "Church Slavic",
                    "cv" => "Chuvash",
                    "cy" => "Welsh",
                    "da" => "Danish",
                    "de" => "German",
                    "dv" => "Divehi",
                    "dz" => "Dzongkha",
                    "ee" => "Ewe",
                    "el" => "Greek",
                    "en" => "English",
                    "eo" => "Esperanto",
                    "es" => "Spanish",
                    "et" => "Estonian",
                    "eu" => "Basque",
                    "fa" => "Persian",
                    "ff" => "Fulah",
                    "fi" => "Finnish",
                    "fj" => "Fijian",
                    "fo" => "Faroese",
                    "fr" => "French",
                    "fy" => "Western Frisian",
                    "ga" => "Irish",
                    "gd" => "Scottish Gaelic",
                    "gl" => "Galician",
                    "gn" => "Guarani",
                    "gu" => "Gujarati",
                    "gv" => "Manx",
                    "ha" => "Hausa",
                    "he" => "Hebrew",
                    "hi" => "Hindi",
                    "ho" => "Hiri Motu",
                    "hr" => "Croatian",
                    "ht" => "Haitian",
                    "hu" => "Hungarian",
                    "hy" => "Armenian",
                    "hz" => "Herero",
                    "ia" => "Interlingua (International Auxiliary Language Association)",
                    "id" => "Indonesian",
                    "ie" => "Interlingue",
                    "ig" => "Igbo",
                    "ii" => "Sichuan Yi",
                    "ik" => "Inupiaq",
                    "io" => "Ido",
                    "is" => "Icelandic",
                    "it" => "Italian",
                    "iu" => "Inuktitut",
                    "ja" => "Japanese",
                    "jv" => "Javanese",
                    "ka" => "Georgian",
                    "kg" => "Kongo",
                    "ki" => "Kikuyu",
                    "kj" => "Kwanyama",
                    "kk" => "Kazakh",
                    "kl" => "Kalaallisut",
                    "km" => "Khmer",
                    "kn" => "Kannada",
                    "ko" => "Korean",
                    "kr" => "Kanuri",
                    "ks" => "Kashmiri",
                    "ku" => "Kurdish",
                    "kv" => "Komi",
                    "kw" => "Cornish",
                    "ky" => "Kirghiz",
                    "la" => "Latin",
                    "lb" => "Luxembourgish",
                    "lg" => "Ganda",
                    "li" => "Limburgish",
                    "ln" => "Lingala",
                    "lo" => "Lao",
                    "lt" => "Lithuanian",
                    "lu" => "Luba-Katanga",
                    "lv" => "Latvian",
                    "mg" => "Malagasy",
                    "mh" => "Marshallese",
                    "mi" => "Maori",
                    "mk" => "Macedonian",
                    "ml" => "Malayalam",
                    "mn" => "Mongolian",
                    "mr" => "Marathi",
                    "ms" => "Malay",
                    "mt" => "Maltese",
                    "my" => "Burmese",
                    "na" => "Nauru",
                    "nb" => "Norwegian Bokmal",
                    "nd" => "North Ndebele",
                    "ne" => "Nepali",
                    "ng" => "Ndonga",
                    "nl" => "Dutch",
                    "nn" => "Norwegian Nynorsk",
                    "no" => "Norwegian",
                    "nr" => "South Ndebele",
                    "nv" => "Navajo",
                    "ny" => "Chichewa",
                    "oc" => "Occitan",
                    "oj" => "Ojibwa",
                    "om" => "Oromo",
                    "or" => "Oriya",
                    "os" => "Ossetian",
                    "pa" => "Panjabi",
                    "pi" => "Pali",
                    "pl" => "Polish",
                    "ps" => "Pashto",
                    "pt" => "Portuguese",
                    "qu" => "Quechua",
                    "rm" => "Raeto-Romance",
                    "rn" => "Kirundi",
                    "ro" => "Romanian",
                    "ru" => "Russian",
                    "rw" => "Kinyarwanda",
                    "sa" => "Sanskrit",
                    "sc" => "Sardinian",
                    "sd" => "Sindhi",
                    "se" => "Northern Sami",
                    "sg" => "Sango",
                    "si" => "Sinhala",
                    "sk" => "Slovak",
                    "sl" => "Slovenian",
                    "sm" => "Samoan",
                    "sn" => "Shona",
                    "so" => "Somali",
                    "sq" => "Albanian",
                    "sr" => "Serbian",
                    "ss" => "Swati",
                    "st" => "Southern Sotho",
                    "su" => "Sundanese",
                    "sv" => "Swedish",
                    "sw" => "Swahili",
                    "ta" => "Tamil",
                    "te" => "Telugu",
                    "tg" => "Tajik",
                    "th" => "Thai",
                    "ti" => "Tigrinya",
                    "tk" => "Turkmen",
                    "tl" => "Tagalog",
                    "tn" => "Tswana",
                    "to" => "Tonga",
                    "tr" => "Turkish",
                    "ts" => "Tsonga",
                    "tt" => "Tatar",
                    "tw" => "Twi",
                    "ty" => "Tahitian",
                    "ug" => "Uighur",
                    "uk" => "Ukrainian",
                    "ur" => "Urdu",
                    "uz" => "Uzbek",
                    "ve" => "Venda",
                    "vi" => "Vietnamese",
                    "vo" => "Volapuk",
                    "wa" => "Walloon",
                    "wo" => "Wolof",
                    "xh" => "Xhosa",
                    "yi" => "Yiddish",
                    "yo" => "Yoruba",
                    "za" => "Zhuang",
                    "zh" => "Chinese",
                    "zu" => "Zulu"
                ]
            ]
        ];
    }

    public function onRun() {
        $attributes = array_except($this->getProperties(), ['lang']);
        array_walk($attributes, function(&$value, $key) {
            switch ($value) {
                case '1':
                    $value = 'true';
                    break;

                case '0':
                    $value = 'false';
                    break;
                
                default:
                    $value = $value;
                    break;
            }
        });
        $this->attributes = HTML::attributes($attributes);
        $this->lang = $this->property('lang');
    }

}