<?php

namespace App\Http\Controllers;

use App\Repository\SettingRepository;
use Illuminate\Http\Request;

class SettingController extends Controller
{
    private $settingRepository;

    public function __construct(SettingRepository $settingRepository)
    {
        $this->settingRepository = $settingRepository;
    }

    /**
     * testing settings save process
     */
    public function testSettingSave()
    {
        $settings = [
            'theme_name' => 'light',
            'no_of_task' => '3',
        ];

        $res = $this->settingRepository->saveSettings($settings);

        dd($res);

    }
}
