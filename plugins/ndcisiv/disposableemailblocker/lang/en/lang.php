<?php

return [
    'plugin' => [
        'name' => 'Disposable Email Blocker',
        'description' => 'Blocks users from registering accounts using disposable email addresses.',
    ],
    'settings' => [
        'menu_label' => 'Disposable Email Blocker',
        'menu_description' => 'Setup configuration for checking emails against a disposable domain list.',
    ],
    'mailtemplates' => [
        'mail_inform_description' => 'Informational notifications to email.',
    ],
    'verifyemail' => [
        'name' => 'VerifyEmail Component',
        'description' => 'Processes an email address to see if it is from a disposable domain.',
        'api_key_exception' => 'API key is not configured.',
        'input_domain_exception' => 'The email domain is in the wrong format or does not exist.  Please try again.',
        'malformed_domain_exception' => 'There is a problem with the Email Address you provided.  Please try again.',
        'improper_formatted_email_exception' => 'The Email Address you provided is not properly formatted.  Please try again.',
        'blocked_email_exception' => 'This site does not allow temporary or disposable emails for registration.  Please use a valid email account.',
        'fail_key_message' => 'Something is wrong with your api key.  Please double-check or request a new one.',
        'fail_server_message' => 'The server could not connect to the database or had some other problems.',
        'fail_key_low_credits_message' => 'You used up your credits.  The current and any additional request will be answered with ok without really checking the domain.  Consider buying additional credits.',
    ],
    'disposablesettings' => [
        'api_key' => 'API Key',
        'api_key_comment' => 'Enter your block-disposable-email.com API Key to use with this plugin',
        'notification_email' => 'Notification Email Address',
        'notification_email_comment' => 'Enter an email address you want to receive notifications at when credits run low',
        'receive_notification_emails' => 'Receive Notification Emails?',
        'receive_notification_emails_comment' => 'Do you want to receive emails about errors and when credits are out?',
        'plugin_enabled' => 'Enable Plugin?',
        'plugin_enabled_comment' => 'Do you want to turn on email verification?',
    ],
];
