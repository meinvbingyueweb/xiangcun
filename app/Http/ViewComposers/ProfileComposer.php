<?php namespace App\Http\ViewComposers;

class ProfileComposer
{
    public function __construct()
    {
    }

    public function compose(View $view)
    {
        //$view->with($k,$v);
        return $view;
    }

}