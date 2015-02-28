<?php 
/**
 * Created by ShahiemSeymor.
 * Date: 6/19/14
 */
namespace ShahiemSeymor\Todo\Models;
use BackendAuth;
use Model;

class Assign extends Model
{
    public $table = 'shahiemseymor_todo_projects_assigned';   
	 
	public static function checkAssigned($userId, $projectId)
	{
		$checkAssign = Assign::where('user_id', '=', $userId)->where('project_id', '=', $projectId);
        if($checkAssign->count() >= 1)
        {
        	return TRUE;
        }
	}
}