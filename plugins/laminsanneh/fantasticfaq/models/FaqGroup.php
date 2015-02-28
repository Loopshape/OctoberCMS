<?php namespace LaminSanneh\FantasticFaq\Models;

use Model;

/**
 * FaqGroup Model
 */
class FaqGroup extends Model
{

    /**
     * @var string The database table used by the model.
     */
    public $table = 'laminsanneh_fantasticfaq_faq_groups';

    /**
     * @var array Guarded fields
     */
    protected $guarded = ['*'];

    /**
     * @var array Fillable fields
     */
    protected $fillable = ['name'];

    /**
     * @var array Validation rules
     */
    public $rules = [];

    /**
     * @var array Relations
     */
    public $hasOne = [];
    public $hasMany = [
        'questions' => ['\LaminSanneh\FantasticFaq\Models\Question', 'primaryKey' => 'group_id']
    ];
    public $belongsTo = [];
    public $belongsToMany = [];
    public $morphTo = [];
    public $morphOne = [];
    public $morphMany = [];
    public $attachOne = [];
    public $attachMany = [];

//    public function questions(){
//        return $this->hasMany('\LaminSanneh\FantasticFaq\Models\Question', 'group_id');
//    }
}