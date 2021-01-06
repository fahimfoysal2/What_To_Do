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

        // get users theme_type here from singletone
        $theme = 1; // from singletone = 1/2/null

        $view->with('theme_name', config('enums.settings.theme_name.'.$theme));
    }
}
