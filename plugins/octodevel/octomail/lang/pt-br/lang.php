<?php

return [
    // Plugin definitions
    'app' => [
        'name' => 'Mail',
        'description' => 'Crie formulários de contato front-end que permitem enviar mensagens de e-mail baseado em modelos personalizados.',
    ],
    'navigation' => [
        'templates' => 'Modelos',
        'recipients' => 'Destinatários',
        'contact_logs' => 'Logs de Contatos',
    ],
    'permissions' => [
        'access_templates' => 'OctoMail - Gerenciar Modelos',
        'access_recipients' => 'OctoMail - Gerenciar Destinatários',
        'access_logs' => 'OctoMail - Visualizar Logs',
    ],
    'mailTemplates' => [
        'autoresponse' => 'Enviar um e-mail de resposta para o usuário quando ele enviar uma mensagem do Mail.',
    ],

    // Models Definitions
    'models' => [
        // Default translations for models
        'default' => [
            'fields' => [
                'options' => [
                    'yes' => 'Sim',
                    'no' => 'Não',
                ],
            ],
        ],
        // Template model
        'templates' => [
            'columns' => [
                'title' => 'Título',
                'slug' => 'Slug',
                'lang' => 'Idioma',
                'created_at' => 'Criado em',
                'updated_at' => 'Atualizado em',
            ],
            'fields' => [
                'label' => [
                    'title' => 'Título',
                    'slug' => 'Slug',
                    'fields' => 'Regras de Validação',
                    'autoresponse' => 'Auto-resposta',
                    'lang' => 'Idioma',
                    'subject' => 'Assunto',
                    'sender_name' => 'Nome do Remetente',
                    'sender_email' => 'E-mail do Remetente',
                    'multiple_recipients' => 'Destinatários Múltiplos',
                    'recipents' => 'Destinatários',
                    'recipient_name' => 'Nome do Destinatário',
                    'recipient_email' => 'E-mail do Destinatário',
                    'confirmation_text' => 'Texto de Confirmação',
                ],
                'commentAbove' => [
                    'recipents' => 'Selecione os destinatários que receberão esta mensagem'
                ],
                'placeholder' => [
                    'title' => 'Novo Modelo',
                    'slug' => 'novo-slug-modelo',
                    'fields' => 'Digite as regras de validação campos',
                    'subject' => 'Digite o assunto do email',
                    'sender_name' => 'Digite o nome do remetente',
                    'sender_email' => 'Digite o e-mail do remetente',
                    'recipents' => 'Não há destinatários, você deve criar um primeiro!',
                    'recipient_name' => 'Digite o nome do destinatário',
                    'recipient_email' => 'Digite o e-mail do destinatário',
                    'confirmation_text' => 'Digite o texto de confirmação',
                ],
                'tab' => [
                    'edit' => 'Editor',
                    'manage' => 'Gerenciamento'
                ],
            ],
        ],
        // Recipient model
        'recipient' => [
            'columns' => [
                'name' => 'Nome',
                'email' => 'E-mail',
            ],
            'fields' => [
                'label' => [
                    'name' => 'Nome',
                    'email' => 'E-mail',
                ],
            ],
        ],
        // Recipient model
        'log' => [
            'columns' => [
                'template_id' => 'Modelo',
                'sender_ip' => 'IP',
                'sent_at' => 'Enviado em',
                'sender_agent' => 'User Agent',
            ],
            'fields' => [
                'label' => [
                    'template_id' => 'Modelo',
                    'sender_agent' => 'User Agent',
                    'sender_ip' => 'IP',
                    'sent_at' => 'Enviado em',
                    'data' => 'Dados Enviados',
                ],
            ],
        ],
    ],

    // Controllers Definitions
    'controllers' => [
        // Default translations for controllers
        'default' => [
            'buttons' => [
                'new' => 'Novo Item',
                'delete' => 'Remover',
                'duplicate' => 'Duplicar'
            ],
            'confirm' => [
                'delete' => 'Tem certeza que deseja remover este item?',
                'selected_delete' => 'Tem certeza que deseja remover todos os itens selecionados?',
            ],
            'return_to_items' => 'Voltar à lista de itens',
            'data_window_close_confirm' => 'O item não está salvo.',
        ],
        // Templates controller
        'templates' => [
            'config_form' => ['name' => 'Modelo de E-mail'],
            'config_list' => ['title' => 'Gerenciar Modelos de E-mail'],
            'preview' => ['menu_label' => 'Modelos de E-mail'],
            'functions' => [
                'index_onDelete' => [
                    'success' => 'Os itens selecionados foram removidos com sucesso.',
                ],
                'index_onDuplicate' => [
                    'no_data_error' => 'Um ou mais itens não foram encontrados.',
                    'success' => 'Os itens selecionados foram duplicados com sucesso.',
                ],
            ],
        ],
        // recipients controller
        'recipients' => [
            'title' => 'Destinatários',
            '_list_toolbar' => ['new' => 'Novo Destinatário'],
            'config_form' => ['name' => 'E-mail Destinatário'],
            'config_list' => ['title' => 'Gerenciar E-mails Destinatários'],
        ],
        // logs controller
        'logs' => [
            'title' => 'Logs de Contato',
            'config_form' => ['name' => 'Log de Contato'],
            'config_list' => ['title' => 'View Logs de Contato'],
        ],
    ],

    // Components Definitions
    'components' => [
        'mailTemplate' => [
            'name' => 'Modelo de E-mail',
            'description' => 'Exibe um modelo de e-mail o formulário de contato onde ele for incorporado.',
            'default' => [
                'options' => [
                    'none' => '- nenhum -',
                ],
            ],
            'properties' => [
                'redirectURL' => [
                    'title' => 'Redirecionar para',
                    'description' => 'Redirecionar para a página depois de envio de e-mail.',
                ],
                'templateName' => [
                    'title' => 'Modelo de e-mail',
                    'description' => 'Selecione o modelo de e-mail.',
                ],
                'responseTemplate' => [
                    'title' => 'Modelo de resposta',
                    'description' => 'Selecione o modelo de e-mail de resposta.',
                ],
                'bodyField' => [
                    'title' => 'Nome do campo do corpo',
                    'description' => 'Defina aqui o campo de formulário que representa a mensagem do usuário. O nl2br será aplicado antes do envio.',
                ],
                'responseFieldName' => [
                    'title' => 'Nome do campo de nome de resposta',
                    'description' => 'Defina aqui o campo de formulário que representa o nome do destinatário que a mensagem de resposta automática será enviado.',
                ],
                'responseFieldEmail' => [
                    'title' => 'Nome do campo de e-mail de resposta',
                    'description' => 'Defina aqui o campo de formulário que representa o email do destinatário que a mensagem de resposta automática será enviado.',
                ],
            ],
            'functions' => [
                'onOctoMailSent' => [
                    'exceptions' => [
                        'invalid_template' => 'Ocorreu um erro inesperado. A slug do modelo de e-mail é inválido.',
                        'invalid_attributes' => 'Ocorreu um erro inesperado. Erro ao tentar obter uma propriedade não-objeto.',
                        'invalid_message_field' => 'O nome de campo "message" não pode ser usado. Por favor, modifique o nome deste campo.',
                    ],
                ],
            ],
        ],
    ],
];