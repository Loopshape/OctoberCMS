<?php

return [
    // Plugin definitions
    'app' => [
        'name' => 'Mail',
        'description' => 'Create front-end contact forms that allow to send email messages based on custom templates.',
    ],
    'navigation' => [
        'templates' => 'Templates',
        'recipients' => 'Recipients',
        'contact_logs' => 'Contact Logs',
    ],
    'permissions' => [
        'access_templates' => 'OctoMail - Manage Templates',
        'access_recipients' => 'OctoMail - Manage Recipients',
        'access_logs' => 'OctoMail - View Logs',
    ],
    'mailTemplates' => [
        'autoresponse' => 'Send a response email to user when send a message from Octo Mail.',
    ],

    // Models Definitions
    'models' => [
        // Default translations for models
        'default' => [
            'fields' => [
                'options' => [
                    'yes' => 'Yes',
                    'no' => 'No',
                ],
            ],
        ],
        // Template model
        'templates' => [
            'columns' => [
                'title' => 'Title',
                'slug' => 'Slug',
                'lang' => 'Lang',
                'created_at' => 'Created',
                'updated_at' => 'Updated',
            ],
            'fields' => [
                'label' => [
                    'title' => 'Title',
                    'slug' => 'Slug',
                    'fields' => 'Validation Fields',
                    'autoresponse' => 'Auto-response',
                    'lang' => 'Language',
                    'subject' => 'Subject',
                    'sender_name' => 'Sender Name',
                    'sender_email' => 'Sender Email',
                    'multiple_recipients' => 'Multiple Recipients',
                    'recipents' => 'Recipients',
                    'recipient_name' => 'Recipient Name',
                    'recipient_email' => 'Recipient Email',
                    'confirmation_text' => 'Confirmation Text',
                ],
                'commentAbove' => [
                    'recipents' => 'Select recipients that will receive this message'
                ],
                'placeholder' => [
                    'title' => 'New Template',
                    'slug' => 'new-template-slug',
                    'fields' => 'Enter the fields validation rules',
                    'subject' => 'Enter the email subject',
                    'sender_name' => 'Enter the sender name',
                    'sender_email' => 'Enter the sender email',
                    'recipents' => 'There are no recipients, you should create one first!',
                    'recipient_name' => 'Enter the recipient name',
                    'recipient_email' => 'Enter the recipient email',
                    'confirmation_text' => 'Enter your confirmation text',
                ],
                'tab' => [
                    'edit' => 'Editor',
                    'manage' => 'Management'
                ],
            ],
        ],
        // Recipient model
        'recipient' => [
            'columns' => [
                'name' => 'Name',
                'email' => 'Email',
            ],
            'fields' => [
                'label' => [
                    'name' => 'Name',
                    'email' => 'Email',
                ],
            ],
        ],
        // Recipient model
        'log' => [
            'columns' => [
                'template_id' => 'Template',
                'sender_ip' => 'IP',
                'sent_at' => 'Sent At',
                'sender_agent' => 'User Agent',
            ],
            'fields' => [
                'label' => [
                    'template_id' => 'Template',
                    'sender_agent' => 'User Agent',
                    'sender_ip' => 'IP',
                    'sent_at' => 'Sent At',
                    'data' => 'Sent Data',
                ],
            ],
        ],
    ],

    // Controllers Definitions
    'controllers' => [
        // Default translations for controllers
        'default' => [
            'buttons' => [
                'new' => 'New Item',
                'delete' => 'Remove',
                'duplicate' => 'Duplicate'
            ],
            'confirm' => [
                'delete' => 'Are you sure to remove this item?',
                'selected_delete' => 'Are you sure to remove all selected items?',
            ],
            'return_to_items' => 'Return to item list',
            'data_window_close_confirm' => 'The item is not saved.',
        ],
        // Templates controller
        'templates' => [
            'config_form' => ['name' => 'Email Template'],
            'config_list' => ['title' => 'Manage Email Templates'],
            'preview' => ['menu_label' => 'Email templates'],
            'functions' => [
                'index_onDelete' => [
                    'success' => 'Successfully deleted those selected.',
                ],
                'index_onDuplicate' => [
                    'no_data_error' => 'One or more items cannot be found.',
                    'success' => 'Successfully duplicate those selected.',
                ],
            ],
        ],
        // recipients controller
        'recipients' => [
            'title' => 'Recipients',
            '_list_toolbar' => ['new' => 'New Recipient'],
            'config_form' => ['name' => 'Email Recipient'],
            'config_list' => ['title' => 'Manage Email Recipients'],
        ],
        // logs controller
        'logs' => [
            'title' => 'Contact Logs',
            'config_form' => ['name' => 'Contact Log'],
            'config_list' => ['title' => 'View Contact Logs'],
        ],
    ],

    // Components Definitions
    'components' => [
        'mailTemplate' => [
            'name' => 'Mail Template',
            'description' => 'Displays a mail template to contact form where ever it\'s been embedded.',
            'default' => [
                'options' => [
                    'none' => '- none -',
                ],
            ],
            'properties' => [
                'redirectURL' => [
                    'title' => 'Redirect to',
                    'description' => 'Redirect to page after send email.',
                ],
                'templateName' => [
                    'title' => 'Mail template',
                    'description' => 'Select the mail template.',
                ],
                'responseTemplate' => [
                    'title' => 'Response template',
                    'description' => 'Select the response mail template.',
                ],
                'bodyField' => [
                    'title' => 'Body field name',
                    'description' => 'Set here your form field that represents the user message. The nl2br will be applied before send.',
                ],
                'responseFieldName' => [
                    'title' => 'Response field name',
                    'description' => 'Set here your form field name that auto-response message will use as recipient.',
                ],
                'responseFieldEmail' => [
                    'title' => 'Response field email',
                    'description' => 'Set here your form field email that auto-response message will use as recipient.',
                ],
            ],
            'functions' => [
                'onOctoMailSent' => [
                    'exceptions' => [
                        'invalid_template' => 'A unexpected error has occurred. The template slug is invalid.',
                        'invalid_attributes' => 'A unexpected error has occurred. Erro while trying to get a non-object property.',
                        'invalid_message_field' => 'The field name "message" can\'t be used. Please modify the name of the field.',
                    ],
                ],
            ],
        ],
    ],
];