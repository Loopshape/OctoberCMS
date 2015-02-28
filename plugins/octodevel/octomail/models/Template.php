<?php namespace OctoDevel\OctoMail\Models;

use \DB;
use Model;
use OctoDevel\OctoMail\Models\Files;
use OctoDevel\OctoMail\Models\Recipient;

class Template extends Model
{
    use \October\Rain\Database\Traits\Validation;

    public $table = 'octodevel_octomail_templates';

    public $belongsToMany = [
        'recipents' => ['OctoDevel\OctoMail\Models\Recipient','table' => 'octodevel_octomail_tem_rec']
    ];

    /*
     * Validation
     */
    public $rules = [
        'title' => ['required', 'regex:/^[\' a-z0-9\/\:_\-\*\[\]\+\?\|]*$/i'],
        'slug' => ['required', 'regex:/^[a-z0-9\/\:_\-\*\[\]\+\?\|]*$/i'],
        'lang' => 'required',
        'content_html' => 'required',
        'fields' => '',
        'subject' => 'required',
        'sender_name' => 'required',
        'sender_email' => ['required', 'email'],
        'multiple_recipients' => '',
        'recipient_name' => '',
        'recipient_email' => 'email',
        'confirmation_text' => '',
        'autoresponse' => '',
    ];

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */

    protected $dates = ['created_at'];

    public function beforeDuplicate()
    {
        // Update title
        $title = explode(' ', $this->title);

        $lastTitle = end($title);

        if(is_numeric($lastTitle))
        {
            array_pop($title);
        }

        $title = implode(' ', $title) ? implode(' ', $title) : $this->title;

        $getTitle = DB::table($this->table)->where('title', 'regexp', '^'. preg_quote($title) . '( [0-9]*$|$)')->orderBy(DB::raw('length(`title`)'), 'desc')->orderBy('title', 'desc')->first();

        if($getTitle)
        {
            $DbTitle = explode(' ', $getTitle->title);

            $lastDbTitle = array_pop($DbTitle);

            if(!is_numeric($lastDbTitle))
            {
                $lastDbTitle = 0;
            }
        }
        else
        {
            $lastDbTitle = 0;
        }

        $this->title = $title . ' ' . ++$lastDbTitle;

        // Update slug
        $slug = explode('-', $this->slug);

        $lastSlug = end($slug);

        if(is_numeric($lastSlug))
        {
            array_pop($slug);
        }

        $slug = implode('-', $slug) ? implode('-', $slug) : $this->slug;

        $getSlug = DB::table($this->table)->where('slug', 'regexp', '^'. preg_quote($slug) . '(\\-[0-9]*$|$)')->orderBy(DB::raw('length(`slug`)'), 'desc')->orderBy('slug', 'desc')->first();

        if($getSlug)
        {
            $DbSlug = explode('-', $getSlug->slug);

            $lastDbSlug = array_pop($DbSlug);

            if(!is_numeric($lastDbSlug))
            {
                $lastDbSlug = 0;
            }
        }
        else
        {
            $lastDbSlug = 0;
        }

        $this->slug = $slug . '-' . ++$lastDbSlug;

        // Update some fields
        $this->created_at = date('Y-m-d H:i:s');
        $this->updated_at = date('Y-m-d H:i:s');

        return parent::save();
    }

    public function beforeSave()
    {
        $this->filename = $this->slug . '.htm';
        $this->fields = preg_replace('/\s/', '', $this->fields);
        $this->content = strip_tags(preg_replace("/{{\s*message\s*}}/i", "{{ body }}", $this->content_html));
        $this->content_html = preg_replace("/{{\s*message\s*}}/i", "{{ body }}", $this->content_html);
    }

    public function afterSave()
    {
        Files::write_view($this);
    }

    public function beforeUpdate()
    {
        Files::delete_view($this->original);
    }

    public function afterDelete()
    {
        Files::delete_view($this);
    }

    public function scopeGetTemplate($query)
    {
        return $query;
    }
}