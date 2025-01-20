<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use App\Services\SettingService;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

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
}
