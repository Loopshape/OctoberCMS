<?php namespace OctoDevel\OctoMail\Updates;

use OctoDevel\OctoMail\Models\Template;
use October\Rain\Database\Updates\Seeder;

class SeedAllTables extends Seeder
{

    public function run()
    {
        //
        // @todo
        //
        // Add a Welcome template or something
        //

        Template::create([
	    'title' => 'Demo Template',
	    'slug' => 'demo-template',
	    'lang' => 'en',
        'autoresponse' => 1,
	    'content' => "Hello {{ sender_name }},\r\n"
	    . "An user sent you a message from website.\r\n"
	    . "Name: {{ name }}\r\n"
	    . "Email: {{ email }}\r\n"
	    . "Phone: {{ phone }}\r\n"
	    . "Message: \r\n\n{{ body|raw }}\r\n",
	    'content_html' => "<p>Hello {{ sender_name }},</p>\r\n"
	    . "<p>An user sent you a message from website.</p>\r\n"
	    . "Name: {{ name }}<br />\r\n"
	    . "Email: {{ email }}<br />\r\n"
	    . "Phone: {{ phone }}\r\n"
	    . "<p>Message:</p> {{ body|raw }}\r\n",
	    'fields' => 'name|required,email|required|email,phone,body|required',
	    'sender_name' => 'Your Name',
	    'sender_email' => 'youremail@yourwebsite.com',
	    'subject' => 'Demo Template :: {{ subject }}',
	    'confirmation_text' => 'Thank you! Your message has been successfully received, we\'ll return the contact soon.'
        ]);
    }

}
