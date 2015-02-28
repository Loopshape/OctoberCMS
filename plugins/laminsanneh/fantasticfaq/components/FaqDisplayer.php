<?php namespace LaminSanneh\FantasticFaq\Components;

use Cms\Classes\ComponentBase;
use LaminSanneh\FantasticFaq\Models\FaqGroup;

class FaqDisplayer extends ComponentBase
{

    public function componentDetails()
    {
        return [
            'name'        => 'FaqDisplayer Component',
            'description' => 'Gives access to a single faq group to display its questions'
        ];
    }

    public function defineProperties()
    {
        return [
            'faqGroup' => [
                'title'       => 'Faq group',
                'description' => 'An Faq Group containing questions',
                'type'        => 'dropdown',
                'default'     => ''
            ],
            'injectBootstrapAssets' => [
                'title'       => 'Inject Bootstrap Assets',
                'description' => 'Whether To Insert bootstrap css and javascript files',
                'type'        => 'checkbox',
                'default'     => true,
            ]
        ];
    }

    public function getfaqGroupOptions(){
        return FaqGroup::lists('name', 'id');
    }

    public function selectedFaqGroup(){
        $selectedFaqGroupId = $this->property('faqGroup');

        return FaqGroup::with('questions')->find($selectedFaqGroupId);

    }

    public function onRun()
    {
        if($this->property('injectBootstrapAssets') == true){
            $this->addCss('assets/css/bootstrap.css');
            $this->addJs('assets/js/bootstrap.js');
        }
    }
}