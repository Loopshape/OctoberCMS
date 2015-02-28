<?php 
/**
 * Created by ShahiemSeymor.
 * Date: 5/29/14
 */

namespace ShahiemSeymor\Poll\Models;

use Model;

class Polls extends Model
{
    use \October\Rain\Database\Traits\Validation;
    
    public $table = 'shahiemseymor_poll';   

    public $rules = [
        'question' => 'required',
        'answer_1' => 'required',
        'answer_2' => 'required',
    ];

    protected $dates = ['created_at'];

    public static function getLatestPoll($pollId = NULL)
    {
        $latestPoll = self::take(1)->orderBy('created_at', 'desc');
        if($pollId != NULL)
        {
            $latestPoll->where('id', '=', $pollId);
        }

        return $latestPoll->get();
    }

    public static function getLatestPollId()
    {
        return (!count(self::getLatestPoll()) > 0 ? '' : self::getLatestPoll()[0]->id);
    }

    public static function getLatestPollAnswers($pollId = NULL)
    {
        $returnAnswer = array();
        foreach(self::getLatestPoll(($pollId == 0 ? self::getLatestPollId() : $pollId)) as $answers)
        {
            for($i = 1; $i <= 10; $i++)
            {
                if($answers->{"answer_$i"} != '')
                {
                    $returnAnswer[$i] = $answers->{"answer_$i"};
                }
            }
        }

        return $returnAnswer;
    }

}