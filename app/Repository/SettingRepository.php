<?php

namespace App\Repository;

use App\Models\Setting;
use Illuminate\Support\Facades\Auth;

class SettingRepository
{
    /**
     *  if available then Update, otherwise Create User Setting
     *
     * @param array $settings
     *
     * eg: for saving theme_name:<br>
     * $settings = ["theme_name" => "theme_id_from_enum"]<br>
     * db = "user_id" | "setting_name" | "setting_value"<br>
     * -> [ user_id = current_user, setting_name = theme_name ],<br>
     *      [setting_value = theme_id_from_enum]
     *
     * @return string Setting Save Status
     */
    public function saveSettings(array $settings): string
    {
        $status = 0;
        foreach ($settings as $setting_name => $value) {

            $setting = Setting::updateOrCreate(
                ['user_id' => Auth::id(), 'setting_name' => $setting_name],
                ['setting_value' => $value]
            );

            if ($setting->wasRecentlyCreated || $setting->getChanges()) $status++;
        }
        return $status > 0 ? "$status Settings Updated" : "Nothing Updated";
    }

}
