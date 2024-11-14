<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Requests\Frontend\ProfilePasswordUpdateRequest;
use App\Http\Requests\UpdateProfileRequest;
use App\Traits\FileUploadTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;

class ProfileController extends Controller
{
    use FileUploadTrait;
    //
    public function updateProfile(UpdateProfileRequest $request) : RedirectResponse
    {
        $user = Auth::user();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->save();

        toastr()->success('Password updated successfully');
        return redirect()->back();
    }

    public function updatePassword(ProfilePasswordUpdateRequest $request) : RedirectResponse {
        $user = Auth::user();
        $user->password = bcrypt($request->password);
        $user->save();

        toastr()->success('Password updated successfully');
        return redirect()->back();
    }

    public function updateAvatar(Request $request)
    {
       /* handle image file */
       $imagePath = $this->uploadImage($request, 'avatar');

       $user = Auth::user();
       $user->avatar = isset($imagePath) ? $imagePath : $user->avatar;
       $user->save();

    //    toastr()->success('Avatar updated successfully');
       return response(['status' => 'success','message'=>'Avatar updated successfully']);
    }

}
