<?php

namespace App\Http\Controllers;

use App\Repository\SettingRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class SettingController extends Controller
{
    private $settingRepository;

    public function __construct(SettingRepository $settingRepository)
    {
        $this->settingRepository = $settingRepository;
    }


    /**
     * Save user setting
     *
     * @param Request $request
     */
    public function saveUserSetting(Request $request)
    {
        $status = $this->settingRepository->saveSettings($request->except('_token'));
        Session::flash('status', $status);
        return redirect()->back();
    }
}
