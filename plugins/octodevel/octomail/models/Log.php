<?php namespace OctoDevel\OctoMail\Models;

use Model;

class Log extends Model
{
    use \October\Rain\Database\Traits\Validation;
    
    public $rules = [];//must be present to use Validation

    public $table = 'octodevel_octomail_logs';
    /*
     * Relations
     */
    public $belongsTo = [
        'template' => ['OctoDevel\OctoMail\Models\Template', 'foreignKey' => 'template_id']
    ];

    protected $jsonable = ['data'];
    /**
     * The attributes that should be mutated to dates.
     * @var array
     */
    protected $dates = ['sent_at'];

    public function scopeGetLogs($query)
    {
        return $query;
    }
}
