<?php namespace JorgeAndrade\Subscribe\Components;

use Cms\Classes\ComponentBase;
use JorgeAndrade\Subscribe\Models\Subscriber as Subs;

class Unsubscribe extends ComponentBase
{

    public function componentDetails()
    {
        return [
            'name'        => 'Unsubscribe Component',
            'description' => 'Form for remove already subscriber'
        ];
    }

    public function defineProperties()
    {
        return [
            'thanksMessage' => [
                'title'       => 'Thanks Message',
                'description' => 'Thanks message for new subscribers',
                'type' => 'string',
                'default'     => 'Thanks for be part of us!'
            ],
            'errorMessage' => [
                'title'       => 'Error Message',
                'description' => 'Message for error thown',
                'type' => 'string',
                'default'     => 'You are already unsubscribe!'
            ]
        ];
    }

    public function onRun()
    {
        $code = $this->param('code');
        
        try{

            $subscriber = Subs::whereCode($code)->whereStatus(1)->firstOrFail();

            $this->page['code'] = $code;

        }
        catch (\Exception $e){

            return \Redirect::to('/');

        }
        
    }

    public function onRemoveSubscriber()
    {
        $email = post('email');
        $code = post('code');
        
        try{

             $subscriber = Subs::whereCode($code)->whereEmail($email)->whereStatus(1)->firstOrFail();
             $subscriber->status = 0;
             $subscriber->code = null;
             $subscriber->save();
            \Mail::send('jorgeandrade.subscribe::mail.unsubscribe', $data, function($message) use ($email) {
                $message->to($email, 'Bye old Subscriber');
            });

            $this->page['result'] = $this->property('thanksMessage');

        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e){

            $this->page['result'] = "Email not found!";

        } catch (\Exception $e){
            $this->page['result'] = $this->property('errorMessage');
        }
        
    }

}