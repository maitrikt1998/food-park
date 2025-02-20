<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\TermsAndCondition;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class TermsAndConditionController extends Controller
{
    //
    public function index(): View
    {
        $terms_condition = TermsAndCondition::first();
        return view('admin.terms-and-condition.index', compact('terms_condition'));
    }

    public function update(Request $request) : RedirectResponse
    {
        $request->validate([
            'content' => ['required']
        ]);

        TermsAndCondition::updateOrCreate(
            ['id' => 1],
            [
                'content' => $request->content
            ]
        );

        toastr()->success('Created Successfully');
        return redirect()->back();
    }
}
