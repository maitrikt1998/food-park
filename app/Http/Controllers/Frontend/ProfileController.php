<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Requests\UpdateProfileRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    //
    public function updateProfile(UpdateProfileRequest $request)
    {
        $user = Auth::user();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->save();

        toastr()->success('Password updated successfully');
        return redirect()->back();
    }
}
