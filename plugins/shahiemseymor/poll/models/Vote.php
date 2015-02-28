<?php 
/**
 * Created by ShahiemSeymor.
 * Date: 5/29/14
 */
namespace ShahiemSeymor\Poll\Models;

use Model;

class Vote extends Model
{
    public $table = 'shahiemseymor_poll_votes';   
    protected $dates = ['created_at'];

    public static function checkIfVote($ip, $pollId)
    {
        $checkIfVote = self::where('ip', '=', $ip)->where('poll_id', '=', $pollId)->get();
        if($checkIfVote->count() == 1)
        {
        	return TRUE;
        }

        return FALSE;
    }

    public static function countVotesById($pollId, $answerId)
    {
        $countQuery = self::where('poll_id', '=', $pollId)->where('answer_id', '=', $answerId)->count();
        return $countQuery;
    }

    public static function countTotalVotesById($pollId)
    {
        $countQuery = self::where('poll_id', '=', $pollId)->count();
        return $countQuery;
    }

    public static function getPercentById($pollId, $answerId)
	{
		$pollQuery = self::where('poll_id', '=', $pollId)->count();
		$pollAnswerQuery = self::where('poll_id', '=', $pollId)->where('answer_id', '=', $answerId)->count();

        if($pollAnswerQuery != 0)
        {
    		$percent = round($pollAnswerQuery / $pollQuery * 100);
    		return $percent;
        }
        else
            return '0';
	}
}