<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use App\Services\SettingService;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class SettingController extends Controller
{
    function index(): View{
        return view('admin.setting.index');
    }

    function updateGeneralSetting(Request $request)
    {
        $validatedData = $request->validate([
            'site_name' => ['required', 'max:255'],
            'site_default_currency' => ['required', 'max:10'],
            'site_currency_icon' => ['required', 'max:4'],
            'site_currency_icon_position' => ['required', 'max:255'],
        ]);

        foreach($validatedData as $key => $value)
        {
            Setting::updateOrCreate(
                ['key' => $key],
                ['value' => $value],
            );
        }

        $settingService = app(SettingService::class);
        $settingService->clearCachedSettings();
        toastr()->success('Updated Successfully!');

        return redirect()->back();
    }

    function UpdatePusherSetting(Request $request): RedirectResponse
    {
        $validatedData = $request->validate([
            'pusher_app_id' => ['required'],
            'pusher_key' => ['required'],
            'pusher_secret' => ['required'],
            'pusher_cluster' => ['required'],
        ]);

        foreach ($validatedData as $key => $value) {
            Setting::updateOrCreate(
                ['key' => $key],
                ['value' => $value]
            );
        }

        $settingsService = app(SettingService::class);
        $settingsService->clearCachedSettings();

        toastr()->success('Updated Successfully!');

        return redirect()->back();
    }

    function updateMailSetting(Request $request): RedirectResponse
    {
        $validatedData = $request->validate([
            'mail_driver' => ['required'],
            'mail_host' => ['required'],
            'mail_port' => ['required'],
            'mail_username' => ['required'],
            'mail_password' => ['required'],
            'mail_encryption' => ['required'],
            'mail_from_address' => ['required'],
            'mail_receive_address' => ['required'],
        ]);

        foreach ($validatedData as $key => $value) {
            Setting::updateOrCreate(
                ['key' => $key],
                ['value' => $value]
            );
        }

        $settingsService = app(SettingService::class);
        $settingsService->clearCachedSettings();
        Cache::forget('mail_settings');
        toastr()->success('Updated Successfully!');

        return redirect()->back();
    }


}
