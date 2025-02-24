<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\SubscriberDataTable;
use App\Http\Controllers\Controller;
use App\Mail\NewsLetter;
use App\Models\Subscriber;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\View\View;

class NewsLetterController extends Controller
{
    //
    public function index(SubscriberDataTable $dataTable) : View|JsonResponse
    {
        return $dataTable->render('admin.news-letter.index');
    }

    public function sendNewsLetter(Request $request)
    {
        $request->validate([
            'subject' => ['required', 'max:255'],
            'message' => ['required'],
        ]);

        $subscribers = Subscriber::pluck('email')->toArray();

        Mail::to($subscribers)->send(new NewsLetter($request->subject, $request->message));

        toastr()->success('News Letter Sent successfully!');

        return to_route('admin.news-letter.index');
    }
}
