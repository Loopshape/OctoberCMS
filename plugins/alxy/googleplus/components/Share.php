<?php namespace Alxy\GooglePlus\Components;

use Cms\Classes\ComponentBase;
use HTML;

class Share extends ComponentBase
{

    public $lang;
    public $attributes;

    public function componentDetails()
    {
        return [
            'name'        => 'Share',
            'description' => 'Display a GooglePlus Share button.'
        ];
    }

    public function defineProperties()
    {
        return [
            'data-href' => [
                 'title'             => 'URL to share',
                 'description'       => 'Sets the URL to share.',
                 'type'              => 'string',
            ],
            'data-annotation' => [
                 'title'             => 'Annotation',
                 'description'       => 'Sets the annotation to display next to the button.',
                 'default'           => 'bubble',
                 'type'              => 'dropdown',
                 'options'           => [
                    'vertical-bubble' => 'vertical-bubble',
                    'bubble' => 'bubble',
                    'inline' => 'inline',
                    'none' => 'none'
                 ]
            ],
            'data-width' => [
                 'title'             => 'Width',
                 'description'       => 'The maximum width to allocate to the entire share plugin.',
                 'type'              => 'string',
                 'validationPattern' => '^(\d+)?$',
                 'validationMessage' => 'The width must be an integer.'
            ],
            'data-height' => [
                 'title'             => 'Height',
                 'description'       => 'The height to assign the button.',
                 'default'           => '20',
                 'type'              => 'dropdown',
                 'options'           => [
                    '15' => '15',
                    '20' => '20',
                    '24' => '24',
                    '60' => '60'
                 ]
            ],
            'data-align' => [
                 'title'             => 'Alignment',
                 'description'       => 'Sets the alignment of the button assets within its frame.',
                 'default'           => 'left',
                 'type'              => 'dropdown',
                 'options'           => [
                    'left' => 'left',
                    'right' => 'right'
                 ]
            ],
            'data-expandTo' => [
                 'title'             => 'Expand to',
                 'description'       => 'Sets the preferred positions to display hover and confirmation bubbles, which are relative to the button.',
                 'default'           => 'left',
                 'type'              => 'dropdown',
                 'options'           => [
                    'top' => 'top',
                    'right' => 'right',
                    'bottom' => 'bottom',
                    'left' => 'left'
                 ]
            ],
            'data-recommendations' => [
                 'title'             => 'Recommendations',
                 'description'       => 'Show recommendations within the +1 hover bubble.',
                 'default'           => 1,
                 'type'              => 'checkbox'
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