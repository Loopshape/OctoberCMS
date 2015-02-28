<?php namespace ShahiemSeymor\Todo\Controllers;

use BackendMenu;
use Backend\Classes\Controller;
use BackendAuth;
use ShahiemSeymor\Todo\Models\Assign;
use ShahiemSeymor\Todo\Models\Project;
use Flash;
use Redirect;
use DB;

class Projects extends Controller
{
    public $implement = [
        'Backend.Behaviors.FormController',
        'Backend.Behaviors.ListController',
        'Backend.Behaviors.RelationController',
    ];

    public $formConfig     = 'config_form.yaml';
    public $listConfig     = 'config_list.yaml';
    public $relationConfig = 'config_relation.yaml';

    public function __construct()
    {
        parent::__construct();
        BackendMenu::setContext('ShahiemSeymor.Todo', 'todo', 'list');
    }

    public function index()
    {
        $this->getClassExtension('Backend.Behaviors.ListController')->index();
    }
 
    public function listExtendQuery($query, $definition = null)
    {
        $query->whereExists(function($query)
        {
            $query->select('*')
                  ->from('shahiemseymor_todo_projects_assigned')
                  ->whereRaw('shahiemseymor_todo_projects_assigned.project_id = shahiemseymor_todo_projects.id')
                  ->where('shahiemseymor_todo_projects_assigned.user_id', '=',  BackendAuth::getUser()->id);
        })->orWhere('shahiemseymor_todo_projects.user_id', '=', BackendAuth::getUser()->id);
    }

    public function create_onSave()
    {
        $lastId = DB::select("SELECT AUTO_INCREMENT FROM information_schema.tables WHERE table_name = 'shahiemseymor_todo_projects' LIMIT 0 , 30");
        $result = $this->getClassExtension('Backend.Behaviors.FormController')->create_onSave();
        $assign = explode(",", post('Project[assign]'));
        
        if(post('Project[assign]') != '')
        {
            $assign = explode(",", post('Project[assign]'));
            foreach($assign as $assigned)
            {
                $as             = new Assign;
                $as->user_id    = $assigned;
                $as->project_id = $lastId[0]->AUTO_INCREMENT;
                $as->save();

            }
        }

        return $result;
    }

    public function update_onSave($recordId)
    {
        $result = $this->getClassExtension('Backend.Behaviors.FormController')->update_onSave($recordId);
        
        $as = new Assign;
        if($as->where('project_id', '=', $recordId)->count() >= 1)
        {
            $as->where('project_id', '=', $recordId)->delete();
        }

        if(post('Project[assign]') != '')
        {
            $assign = explode(",", post('Project[assign]'));
            foreach($assign as $assigned)
            {
                $as             = new Assign;
                $as->user_id    = $assigned;
                $as->project_id = $recordId;
                $as->save();
            }
        }

        return $result;
    }

    public function update($id)
    {
        $query = Project::where('id', '=', $id)->get();
        foreach($query as $fetch)
        {
            $this->vars['user_id']    = $fetch->user_id;
            $this->vars['myId']       = BackendAuth::getUser()->id;    
            $this->vars['isAssigned'] = Assign::checkAssigned(BackendAuth::getUser()->id, $fetch->id);  
        }

        $this->getClassExtension('Backend.Behaviors.FormController')->update($id);
    }

}