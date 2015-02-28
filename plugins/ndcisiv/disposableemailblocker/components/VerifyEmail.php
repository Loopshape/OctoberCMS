<?php namespace Ndcisiv\DisposableEmailBlocker\Components;

use Cms\Classes\CmsException;
use Cms\Classes\ComponentBase;
use Ndcisiv\DisposableEmailBlocker\Models\DisposableSettings;
use Event;
use Flash;
use Redirect;
use Mail;
use Lang;

class VerifyEmail extends ComponentBase
{

    /**
     * Component Detail information
     * @return array
     */
    public function componentDetails()
    {
        return [
            'name' => 'ndcisiv.disposableemailblocker::lang.verifyemail.name',
            'description' => 'ndcisiv.disposableemailblocker::lang.verifyemail.description'
        ];
    }

    /**
     * Method checks email address to see if it is from a disposable/temporary domain using
     * block-disposable-email.com's API access
     * http://www.block-disposable-email.com/cms/
     *
     * @param $email
     * @return bool
     * @throws CmsException
     */
    public function checkAddress($email)
    {
        try {
            // Verify an API key is setup
            $settings = DisposableSettings::instance();
            if (!$settings->api_key) {
                $lng = Lang::get('ndcisiv.disposableemailblocker::lang.verifyemail.api_key_exception');
                throw new CmsException($lng);
            }

            // Check that the email is properly formatted
            if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
                // Process the email address and strip out the domain
                $email_array = explode('@', $email);
                $domain = array_pop($email_array);

                // Prepare the request and get results
                $request = 'http://check.block-disposable-email.com/easyapi/json/' . $settings->api_key . '/' . $domain;
                $response = file_get_contents($request);
                $dea = json_decode($response);

                // Test the results
                if ($dea->request_status == 'success') {
                    if ($dea->domain_status == 'block') {
                        //Access Denied
                        return false;
                    } else {
                        // Access Granted
                        return true;
                    }
                } elseif ($dea->request_status == 'fail_key') {
                    // The API key is entered, but is not valid.  Allow the registration but notify the site email
                    $lng = Lang::get('ndcisiv.disposableemailblocker::lang.verifyemail.fail_key_message');
                    $msg = array(
                        'type' => 'fail_key',
                        'content' => $lng
                    );
                    $this->sendNotificationEmail($msg);
                    return true;
                } elseif ($dea->request_status == 'fail_server') {
                    // There is a problem contacting the verification server.  Allow the registration but notify the site email
                    $lng = Lang::get('ndcisiv.disposableemailblocker::lang.verifyemail.fail_server_message');
                    $msg = array(
                        'type' => 'fail_server',
                        'content' => $lng
                    );
                    $this->sendNotificationEmail($msg);
                    return true;
                } elseif ($dea->request_status == 'fail_input_domain') {
                    // The domain is formatted incorrectly, or does not exist
                    $lng = Lang::get('ndcisiv.disposableemailblocker::lang.verifyemail.fail_input_domain_exception');
                    throw new CmsException($lng);
                } elseif ($dea->request_status == 'fail_key_low_credits') {
                    // You are out of credits.  Allow the registration but notify the site email
                    $lng = Lang::get('ndcisiv.disposableemailblocker::lang.verifyemail.fail_key_low_credits_message');
                    $msg = array(
                        'type' => 'fail_key_low_credits',
                        'content' => $lng
                    );
                    $this->sendNotificationEmail($msg);
                    return true;
                } else {
                    // something else went wrong with the address (maybe a malformed domain)
                    $lng = Lang::get('ndcisiv.disposableemailblocker::lang.verifyemail.malformed_domain_exception');
                    throw new CmsException($lng);
                }
            } else {
                $lng = Lang::get('ndcisiv.disposableemailblocker::lang.verifyemail.improper_formatted_email_exception');
                throw new CmsException($lng);
            }
        } catch (CmsException $e) {
            Flash::error($e->getMessage());
            Redirect::back();
        }

    }

    /**
     * Component init method
     * Listens for event to check email at registration for bad email addresses
     */
    public function init()
    {
        // Only attach if the plugin has been enabled
        $settings = DisposableSettings::instance();

        if ($settings->plugin_enabled) {
            // Listen for ajax event and process email prior to it running
            Event::listen('cms.component.beforeRunAjaxHandler', function ($this, $handler) {

                try {
                    // Only continue for onRegister handler
                    if ($handler != 'onRegister') {
                        return;
                    }

                    // Grab email from registration form and check it
                    $emailtoverify = post('email');
                    $verifier = new VerifyEmail();
                    $goodemail = $verifier->checkAddress($emailtoverify);

                    // If the email is legit, continue operation
                    if ($goodemail) {
                        return;
                    }

                    // The email came back bad, throw exception
                    $lng = Lang::get('ndcisiv.disposableemailblocker::lang.verifyemail.blocked_email_exception');
                    throw new CmsException($lng);
                } catch (CmsException $e) {
                    Flash::error($e->getMessage());
                    return Redirect::back();
                }

            });
        }

    }

    /**
     * Send out notification emails if requested to do so
     * @param $msg
     */
    protected function sendNotificationEmail($msg)
    {
        $settings = DisposableSettings::instance();

        if ($settings->receive_notification_emails) {
            Mail::send('ndcisiv.disposableemailblocker::mail.inform', $msg, function ($message) use ($settings) {
                $message->to($settings->notification_email, $settings->notification_email);
            });
        }

    }

}