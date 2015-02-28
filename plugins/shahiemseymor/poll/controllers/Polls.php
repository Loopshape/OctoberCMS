<?php namespace ShahiemSeymor\Poll\Controllers;

use BackendMenu;
use Backend\Classes\Controller;
use ShahiemSeymor\Poll\Models\Polls as PollModel;
use ShahiemSeymor\Poll\Models\Vote;
use Flash;

class Polls extends Controller
{
    public $implement = [
        'Backend.Behaviors.FormController',
        'Backend.Behaviors.ListController'
    ];

    public $formConfig = 'config_form.yaml';
    public $listConfig = 'config_list.yaml';

    public function __construct()
    {
        parent::__construct();
        BackendMenu::setContext('ShahiemSeymor.Poll', 'poll', 'polls');
    }    

    public function index_onDelete()
    {
        if (($checkedIds = post('checked')) && is_array($checkedIds) && count($checkedIds)) 
        {
            foreach ($checkedIds as $pollId) {
                if (!$poll = PollModel::find($pollId))
                    continue;

                $poll->delete();

                if (!$votes = Vote::where('poll_id', '=', $pollId))
                    continue;

                $votes->delete();
            }

            Flash::success('The Poll has been deleted successfully.');
        }

         return $this->listRefresh();
    }

    public function update($recordId, $context = null)
    {
        $this->bodyClass = 'compact-container';
        return $this->getClassExtension('Backend.Behaviors.FormController')->update($recordId, $context);
    }

}