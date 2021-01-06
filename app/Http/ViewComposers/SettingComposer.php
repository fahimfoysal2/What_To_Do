<?php

namespace App\Http\ViewComposers;

use Illuminate\View\View;

class SettingComposer
{
    /**
     *  bind Settings with view
     *
     * @param View $view
     */
    public function compose(View $view)
    {
        /**
         * Initial Settings:
         * theme_name: dark / light
         */
        $view->with('theme_name', 'light');
    }
}