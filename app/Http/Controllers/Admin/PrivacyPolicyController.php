<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PrivacyPolicy;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class PrivacyPolicyController extends Controller
{
    public function index(): View
    {
        $privacy_policy =  PrivacyPolicy::first();
        return view('admin.privacy-policy.index', compact('privacy_policy'));
    }

    public function update(Request $request) : RedirectResponse
    {
        $request->validate([
            'content' => ['required']
        ]);

        PrivacyPolicy::updateOrCreate(
            ['id' => 1],
            [
                'content' => $request->content
            ]
        );

        toastr()->success('Created Successfully');

        return redirect()->back();
    }
}
