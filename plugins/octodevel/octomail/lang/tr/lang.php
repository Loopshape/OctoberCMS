<?php

return [
    // Plugin definitions
    'app' => [
        'name' => 'Mail',
        'description' => 'Oluşturduğunuz taslaklara göre site önyüzünde iletişim formları oluşturmanızı sağlar.',
    ],
    'navigation' => [
        'templates' => 'Taslaklar',
        'recipients' => 'Alıcılar',
        'contact_logs' => 'İletişim Kayıtları'
    ],
    'permissions' => [
        'access_templates' => 'Taslakları Yönet',
        'access_recipients' => 'Alıcıları Yönet',
        'access_logs' => 'Kayıtları Göster'
    ],
    'mailTemplates' => [
        'autoresponse' => 'Kullanıcı mail gönderdiğinde bir yanıt e-postası gönder.'
    ],

    // Models Definitions
    'models' => [
        // Default translations for models
        'default' => [
            'fields' => [
                'options' => [
                    'yes' => 'Evet',
                    'no' => 'Hayır'
                ]
            ]
        ],
        // Template model
        'templates' => [
            'columns' => [
                'title' => 'Başlık',
                'slug' => 'Takma ad',
                'lang' => 'Dil',
                'created_at' => 'Oluşturulma',
                'updated_at' => 'Güncellenme'
            ],
            'fields' => [
                'label' => [
                    'title' => 'Başlık',
                    'slug' => 'Takma ad',
                    'fields' => 'Onay Alanları',
                    'autoresponse' => 'Otomatik cevap',
                    'lang' => 'Dil',
                    'subject' => 'Konu',
                    'sender_name' => 'Gönderen Adı',
                    'sender_email' => 'Gönderen Email',
                    'multiple_recipients' => 'Çoklu Alıcı',
                    'recipents' => 'Alıcılar',
                    'recipient_name' => 'Alıcı Adı',
                    'recipient_email' => 'Alıcı Email',
                    'confirmation_text' => 'Onay Metni'
                ],
                'commentAbove' => [
                    'recipents' => 'Bu mesajı almasını istediğiniz alıcıları seçin'
                ],
                'placeholder' => [
                    'title' => 'Yeni Taslak',
                    'slug' => 'yeni-taslak-takma-adi',
                    'fields' => 'alanların doğrulama kurallarını girin',
                    'subject' => 'email konusunu girin',
                    'sender_name' => 'gönderici adını girin',
                    'sender_email' => 'gönderici email girin',
                    'recipents' => 'Alıcı yok, ilk alıcıyı oluşturmalısınız!',
                    'recipient_name' => 'alıcı adını girin',
                    'recipient_email' => 'alıcı email girin',
                    'confirmation_text' => 'Onay metnini girin'
                ],
                'tab' => [
                    'edit' => 'Düzenleyici',
                    'manage' => 'Yönetim'
                ]
            ]
        ],
        // Recipient model
        'recipient' => [
            'columns' => [
                'name' => 'İsim',
                'email' => 'Email'
            ],
            'fields' => [
                'label' => [
                    'name' => 'İsim',
                    'email' => 'Email'
                ]
            ]
        ],
        // Recipient model
        'log' => [
            'columns' => [
                'template_id' => 'Taslak',
                'sender_ip' => 'IP',
                'sent_at' => 'Gönderilme',
                'sender_agent' => 'Tarayıcı'
            ],
            'fields' => [
                'label' => [
                    'template_id' => 'Taslak',
                    'sender_agent' => 'Tarayıcı',
                    'sender_ip' => 'IP',
                    'sent_at' => 'Gönderilme',
                    'data' => 'Gönderilen Veri'
                ]
            ]
        ]
    ],

    // Controllers Definitions
    'controllers' => [
        // Default translations for controllers
        'default' => [
            'buttons' => [
                'new' => 'Yeni Taslak',
                'delete' => 'Sil',
                'duplicate' => 'Çoğalt'
            ],
            'confirm' => [
                'delete' => 'Silmek istediğinize emin misiniz?',
                'selected_delete' => 'Tüm seçilenleri silmek istediğinize emin misiniz?'
            ],
            'return_to_items' => 'Listeye geri dön',
            'data_window_close_confirm' => 'Kaydedilmedi.'
        ],
        // Templates controller
        'templates' => [
            'config_form' => ['name' => 'Email Taslakları'],
            'config_list' => ['title' => 'Email Taslaklarını Yönet'],
            'preview' => ['menu_label' => 'Email taslakları'],
            'functions' => [
                'index_onDelete' => [
                    'success' => 'Seçilenler başarılı şekilde silindi.'
                ],
                'index_onDuplicate' => [
                    'no_data_error' => 'Bazı nesneler bulunamadı.',
                    'success' => 'Seçilenler çoğaltıldı.'
                ]
            ]
        ],
        // recipients controller
        'recipients' => [
            'title' => 'Mail Alıcıları',
            '_list_toolbar' => ['new' => 'Yeni Alıcı'],
            'config_form' => ['name' => 'Email Alıcısı'],
            'config_list' => ['title' => 'Alıcıları Yönet']
        ],
        // logs controller
        'logs' => [
            'title' => 'İletişim Kayıtları',
            'config_form' => ['name' => 'İletişim Günlüğü'],
            'config_list' => ['title' => 'İletişim Kayıtlarını Göster']
        ]
    ],

    // Components Definitions
    'components' => [
        'mailTemplate' => [
            'name' => 'Mail Taslağı',
            'description' => 'İletişim formunun eklendiği heryerde mail taslağını gösterir.',
            'default' => [
                'options' => [
                    'none' => '- hiçbiri -'
                ]
            ],
            'properties' => [
                'redirectURL' => [
                    'title' => 'Yönlendir',
                    'description' => 'Mail gönderildikten sonra adrese yönlendir.'
                ],
                'templateName' => [
                    'title' => 'Mail taslağı',
                    'description' => 'Mail taslağını seçin.'
                ],
                'responseTemplate' => [
                    'title' => 'Yanıt taslağı',
                    'description' => 'Yanıt taslağını seçin.'
                ],
                'bodyField' => [
                    'title' => 'Mesaj gövdesi adı',
                    'description' => 'Kullanıcının mesajını temsil eden form alanı. Gönderilmeden önce satırlara nl2br uygulanacak.'
                ],
                'responseFieldName' => [
                    'title' => 'Yanıt alanı adı',
                    'description' => 'Otomatik yanıt yapılacak kişinin ismini temsil eden form alanı.'
                ],
                'responseFieldEmail' => [
                    'title' => 'Yanıt alanı email',
                    'description' => 'Otomatik yanıt yapılacak kişinin emailini temsil eden form alanı.'
                ]
            ],
            'functions' => [
                'onOctoMailSent' => [
                    'exceptions' => [
                        'invalid_template' => 'Beklenmedik bir hata oluştu. Tema takma adı geçersiz.',
                        'invalid_attributes' => 'Beklenmedik bir hata oluştu. Nesne olmayan bir özelliği almaya çalışırken hata oluştu.',
                        'invalid_message_field' => '"message" alan ismi olarak kullanılamaz. Lütfen alanın ismini düzenleyin.'
                    ]
                ]
            ]
        ]
    ]
];