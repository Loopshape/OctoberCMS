<?php namespace OctoDevel\OctoMail\Components;

use \DB;
use Mail;
use \Lang;
use Redirect;
use Validator;
use Cms\Classes\Page;
use Cms\Classes\ComponentBase;
use Symfony\Component\HttpFoundation\Request;
use October\Rain\Support\ValidationException;
use System\Models\MailSettings;
use System\Models\MailTemplate;
use OctoDevel\OctoMail\Models\Template as TemplateBase;
use OctoDevel\OctoMail\Models\Recipient as RecipientEmail;
use OctoDevel\OctoMail\Models\Log as RegisterLog;

class Template extends ComponentBase
{
    use \October\Rain\Database\Traits\Validation;

    public $table = 'octodevel_octomail_templates';
    public $recipients = 'octodevel_octomail_tem_rec';
    public $recipients_table = 'octodevel_octomail_recipients';

    public $aRName;
    public $aREmail;
    public $requestTemplate;
    public $langs = [
        ''   => '',
        'nl' => 'Dutch',
        'en' => 'English',
        'de' => 'German',
        'ja' => 'Japanese',
        'br' => 'Portuguese (Brazilian)',
        'pt' => 'Portuguese',
        'ru' => 'Russian',
        'sv' => 'Swedish',
        'tr' => 'Turkish'
    ];

    /*
    * Validation
    */
    public $rules = [];

    public function componentDetails()
    {
        return [
            'name' => 'octodevel.octomail::lang.components.mailTemplate.name',
            'description' => 'octodevel.octomail::lang.components.mailTemplate.description'
        ];
    }

    public function defineProperties()
    {
        return [
            'redirectURL' => [
                'title' => 'octodevel.octomail::lang.components.mailTemplate.properties.redirectURL.title',
                'description' => 'octodevel.octomail::lang.components.mailTemplate.properties.redirectURL.description',
                'type' => 'dropdown',
                'default' => '',
                'showExternalParam' => false,
            ],
            'templateName' => [
                'title' => 'octodevel.octomail::lang.components.mailTemplate.properties.templateName.title',
                'description' => 'octodevel.octomail::lang.components.mailTemplate.properties.templateName.description',
                'type' => 'dropdown',
                'default' => 1,
                'showExternalParam' => false,
            ],
            'responseTemplate' => [
                'title' => 'octodevel.octomail::lang.components.mailTemplate.properties.responseTemplate.title',
                'description' => 'octodevel.octomail::lang.components.mailTemplate.properties.responseTemplate.description',
                'type' => 'dropdown',
                'default' => 'octodevel.octomail::mail.autoresponse',
                'showExternalParam' => false,
            ],
            'bodyField' => [
                'title' => 'octodevel.octomail::lang.components.mailTemplate.properties.bodyField.title',
                'description' => 'octodevel.octomail::lang.components.mailTemplate.properties.bodyField.description',
                'type' => 'string',
                'default' => 'body',
                'showExternalParam' => false,
            ],
            'responseFieldName' => [
                'title' => 'octodevel.octomail::lang.components.mailTemplate.properties.responseFieldName.title',
                'description' => 'octodevel.octomail::lang.components.mailTemplate.properties.responseFieldName.description',
                'type' => 'string',
                'default' => 'name',
                'showExternalParam' => false,
            ],
            'responseFieldEmail' => [
                'title' => 'octodevel.octomail::lang.components.mailTemplate.properties.responseFieldEmail.title',
                'description' => 'octodevel.octomail::lang.components.mailTemplate.properties.responseFieldEmail.description',
                'type' => 'string',
                'default' => 'email',
                'showExternalParam' => false,
            ]
        ];
    }

    public function getRedirectURLOptions()
    {
        return array_merge(['' => Lang::get('octodevel.octomail::lang.components.mailTemplate.default.options.none')], Page::sortBy('baseFileName')->lists('baseFileName', 'baseFileName'));
    }

    public function getResponseTemplateOptions()
    {
        $EmailTemplates = new MailTemplate();
        $system = $EmailTemplates->listRegisteredTemplates();

        $templates = ['' => Lang::get('octodevel.octomail::lang.components.mailTemplate.default.options.none')];

        if($system)
        {
            foreach ($system as $key => $value) {
                $templates[$key] = $value;
            }
        }

        return $templates;
    }

    public function getTemplateNameOptions()
    {
        $templates = TemplateBase::all();

        $array_dropdown = ['' => ''];

        foreach ($templates as $template)
        {
            $array_dropdown[$template->id] = $template->title . ' [' . $this->langs[$template->lang] . ']';
        }

        return $array_dropdown;
    }

    public function onOctoMailSent()
    {
        // Set the requested template in a variable;
        $this->requestTemplate = $this->loadTemplate();
        if(!$this->requestTemplate)
            throw new \Exception(sprintf(Lang::get('octodevel.octomail::lang.components.mailTemplate.functions.onOctoMailSent.exceptions.invalid_template')));

        // Set a second variable with request data from database
        $template = $this->requestTemplate->attributes;
        if(!$template)
            throw new \Exception(sprintf(Lang::get('octodevel.octomail::lang.components.mailTemplate.functions.onOctoMailSent.exceptions.invalid_attributes')));

        // Set a global $_POST variable
        $post = post();

        // Unset problematic variables
        if(isset($post['message']))
        {
            throw new \Exception(sprintf(Lang::get('octodevel.octomail::lang.components.mailTemplate.functions.onOctoMailSent.exceptions.invalid_message_field')));
        }

        // get the message body
        $this->bodyField = $this->property('bodyField');

        if(isset($this->bodyField) && !empty($this->bodyField))
        {
            if(isset($post[$this->bodyField]))
            {
                $body = strip_tags($post[$this->bodyField]);
                $post[$this->bodyField] = nl2br($body);
            }
        }

        // get name for auto-response message
        $this->aRName = $this->property('responseFieldName');

        // get email for auto-response message
        $this->aREmail = $this->property('responseFieldEmail');

        // Set redirect URL
        $redirectUrl = $this->controller->pageUrl($this->property('redirectURL'));

        // Get response email
        $responseMailTemplate = $this->property('responseTemplate');

        // Get request info
        $request = Request::createFromGlobals();

        // Set some request variables
        $post['ip_address'] = $request->getClientIp();
        $post['user_agent'] = $request->headers->get('User-Agent');
        $post['sender_name'] = $template['sender_name'];
        $post['sender_email'] = $template['sender_email'];
        $post['recipient_name'] = $template['recipient_name'] ? $template['recipient_name'] : MailSettings::get('sender_name');
        $post['recipient_email'] = $template['recipient_email'] ? $template['recipient_email'] : MailSettings::get('sender_email');
        $post['default_subject'] = $template['subject'];

        // Set some usable data
        $data = [
            'replyto_email' => (isset($post[$this->aREmail]) ? $post[$this->aREmail] : false),
            'replyto_name' => (isset($post[$this->aRName]) ? $post[$this->aRName] : false),
            'sender_name' => $template['sender_name'],
            'sender_email' => $template['sender_email'],
            'recipient_name' => $template['recipient_name'] ? $template['recipient_name'] : MailSettings::get('sender_name'),
            'recipient_email' => $template['recipient_email'] ? $template['recipient_email'] : MailSettings::get('sender_email'),
            'default_subject' => $template['subject']
        ];

        // Making custon validation
        $fields = explode(',', preg_replace('/\s/', '', $template['fields']));

        if($fields)
        {
            $validation_rules = [];
            foreach ($fields as $field)
            {
                $rules = explode("|", $field);
                if($rules)
                {
                    $field_name = $rules[0];
                    $validation_rules[$field_name] = [];
                    unset($rules[0]);

                    foreach ($rules as $key => $rule)
                    {
                        $validation_rules[$field_name][$key] = $rule;
                    }
                }
            }
            $this->rules = $validation_rules;
            $validation = Validator::make($post, $this->rules);

            if ($validation->fails())
                throw new ValidationException($validation);
        }

        // Get recipients
        $recipients = DB::table($this->recipients)
                    ->where('template_id', '=', $template['id'])
                    ->leftJoin($this->recipients_table, $this->recipients_table . '.id', '=', $this->recipients . '.recipient_id')
                    ->get();

        if(!$template['multiple_recipients'])
        {
            Mail::send('octodevel.octomail::mail.' . $template['slug'], $post, function($message) use($data)
            {
                $message->from($data['sender_email'], $data['sender_name']);
                $message->to($data['recipient_email'], $data['recipient_name'])->subject($data['default_subject']);

                if($data['replyto_email'] and $data['replyto_name'])
                    $message->replyTo($data['replyto_email'], $data['replyto_name']);
            });

            $log = new RegisterLog;
            $log->template_id = $template['id'];
            $log->sender_agent = $post['user_agent'];
            $log->sender_ip = $post['ip_address'];
            $log->sent_at = date('Y-m-d H:i:s');
            $log->data = $post;
            $log->save();
        }
        else
        {
            // Multiple emails
            foreach($recipients as $recipient)
            {
                $data['recipient_name'] = $recipient->name;
                $data['recipient_email'] = $recipient->email;

                Mail::send('octodevel.octomail::mail.' . $template['slug'], $post, function($message) use($data)
                {
                    $message->from($data['sender_email'], $data['sender_name']);
                    $message->to($data['recipient_email'], $data['recipient_name'])->subject($data['default_subject']);

                    if($data['replyto_email'] and $data['replyto_name'])
                        $message->replyTo($data['replyto_email'], $data['replyto_name']);
                });

                $log = new RegisterLog;
                $log->template_id = $template['id'];
                $log->sender_agent = $post['user_agent'];
                $log->sender_ip = $post['ip_address'];
                $log->sent_at = date('Y-m-d H:i:s');
                $log->data = $post;
                $log->save();
            }
        }

        if( (isset($post[$this->aREmail]) and $post[$this->aREmail]) and (isset($post[$this->aRName]) and $post[$this->aRName]) and (isset($template['autoresponse']) and $template['autoresponse']) )
        {
            $response = [
                'name' => $post[$this->aRName],
                'email' => $post[$this->aREmail],
            ];

            if($responseMailTemplate)
            {
                Mail::send($responseMailTemplate, $post, function($autoresponse) use ($response)
                {
                    $autoresponse->to($response['email'], $response['name']);
                });
            }
        }

        $this->page["result"] = true;
        $this->page["confirmation_text"] = $template['confirmation_text'];

       if($redirectUrl)
               return Redirect::intended($redirectUrl);
    }

    protected function loadTemplate()
    {
        $id = $this->property('templateName');

        if(is_numeric($id))
        {
            return TemplateBase::getTemplate()->where('id', '=', $id)->first();
        }

        return TemplateBase::getTemplate()->where('slug', '=', $id)->first();
    }
}