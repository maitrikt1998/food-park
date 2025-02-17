<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\CounterUpdateRequest;
use App\Models\Counter;
use App\Traits\FileUploadTrait;
use Illuminate\Http\Request;

class CounterController extends Controller
{
    use FileUploadTrait;

    public function index()
    {
        $counter = Counter::first();
        return view('admin.counter.index',compact('counter'));
    }

    public function update(CounterUpdateRequest $request)
    {
        $imagePath = $this->uploadImage($request, 'background', $request->background_old);
        Counter::updateOrCreate(
            ['id' => 1],
            [
                'background' => !empty($imagePath) ? $imagePath : $request->background_old,
                'counter_icon_one' => $request->counter_icon_one,
                'counter_count_one' => $request->counter_count_one,
                'counter_name_one' => $request->counter_name_one,
                'counter_icon_two' => $request->counter_icon_two,
                'counter_count_two' => $request->counter_count_two,
                'counter_name_two' => $request->counter_name_two,
                'counter_icon_three' => $request->counter_icon_three,
                'counter_count_three' => $request->counter_count_three,
                'counter_name_three' => $request->counter_name_three,
                'counter_icon_four' => $request->counter_icon_four,
                'counter_count_four' => $request->counter_count_four,
                'counter_name_four' => $request->counter_name_four,
            ]
        );

        toastr()->Success('updated Successfully!');

        return redirect()->back();
    }
}
