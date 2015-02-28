<?php namespace ShahiemSeymor\Poll\Components;

use DB;
use App;
use Cms\Classes\Page;
use Cms\Classes\ComponentBase;
use Validator;
use Symfony\Component\HttpFoundation\Request;
use October\Rain\Support\ValidationException;
use ShahiemSeymor\Poll\Models\Polls as Poll;
use ShahiemSeymor\Poll\Models\Vote as Votes;
use Cms\Classes\CmsPropertyHelper;
use ShahiemSeymor\Poll\Models\Settings as Settings;

class Vote extends ComponentBase
{
    public $lastestPoll;
    public $lastestPollAnswers;
    public $checkIfVote;
    public $request;
    public $vote;
    public $property;
    public $poll_id;

    public function componentDetails()
    {
        return [
            'name'        => 'Poll',
            'description' => 'Poll form.'
        ];
    }

    public function defineProperties()
    {
        return [
            'poll' => [
                'title'       => 'Poll',
                'description' => 'Poll question to display',
                'type'        => 'dropdown',
                'default'     => ''
            ],
        ];
    }

    public function getPollOptions()
    {
        return array_add(Poll::all()->lists('question', 'id'), '', '-none-');
    }

    public function onRun()
    {
        $this->addCss('/plugins/shahiemseymor/poll/assets/css/poll.css');

        $this->request = Request::createFromGlobals();
        $this->vote = $this->page['vote'] = new Votes;
        $this->vote = $this->page['barColor'] = Settings::get('poll_settings');
    }

    public function onRender()
    {
        $this->lastestPoll = $this->page['lastestPoll'] = Poll::getLatestPoll(($this->property('poll') == 0 ? Poll::getLatestPollId() : $this->property('poll')));
        $this->lastestPollAnswers = $this->page['lastestPollAnswers'] = Poll::getLatestPollAnswers(($this->property('poll') == 0 ? Poll::getLatestPollId() : $this->property('poll')));
        $this->checkIfVote = $this->page['checkIfVote'] = Votes::checkIfVote($this->request->getClientIp(), ($this->property('poll') == 0 ? Poll::getLatestPollId() : $this->property('poll')));
    }

    public function onPoll()
    {
        $this->request = Request::createFromGlobals();
        $rules = ['vote_answer' => 'required'];
        $validation = Validator::make(post(), $rules);

        if ($validation->fails())
        {
            throw new ValidationException($validation);
        }
        else
        {
            $addVote = new Votes;
            $addVote->ip =  $this->request->getClientIp();
            $addVote->poll_id = (post('id') == 0 ? Poll::getLatestPollId() : post('id'));
            $addVote->answer_id = \Input::get('vote_answer');
            $addVote->save();

            $this->page['vote'] = new Votes;
            $this->lastestPoll = $this->page['lastestPoll'] = Poll::getLatestPoll((post('id') == 0 ? Poll::getLatestPollId() : post('id')));
            $this->lastestPollAnswers = $this->page['lastestPollAnswers'] = Poll::getLatestPollAnswers((post('id') == 0 ? Poll::getLatestPollId() : post('id')));
            $this->vote = $this->page['barColor'] = Settings::get('poll_settings');
        }
    }

}