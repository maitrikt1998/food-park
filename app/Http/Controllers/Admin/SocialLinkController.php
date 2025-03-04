<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\SocialLinkDataTable;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\SocialLinkStoreRequest;
use App\Models\SocialLink;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\View\View;

class SocialLinkController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(SocialLinkDataTable $dataTable) : View|JsonResponse
    {
        return $dataTable->render('admin.social-link.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create() : View
    {
        return View('admin.social-link.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(SocialLinkStoreRequest $request) : RedirectResponse
    {
        $link = new SocialLink();
        $link->icon = $request->icon;
        $link->name = $request->name;
        $link->link = $request->link;
        $link->status = $request->status;
        $link->save();

        toastr()->success('created Successfully!');

        return to_route('admin.social-link.index');
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $link = SocialLink::findOrFail($id);
        return View('admin.social-link.edit',compact('link'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(SocialLinkStoreRequest $request, string $id)
    {
        $link = SocialLink::findOrFail($id);
        $link->icon = $request->icon;
        $link->name = $request->name;
        $link->link = $request->link;
        $link->status = $request->status;
        $link->save();

        toastr()->success('updated Successfully!');

        return to_route('admin.social-link.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id) : Response
    {
        try{
            $sociallink = SocialLink::findOrFail($id);
            $sociallink->delete();

            return response(['status'=>'success', 'message' => 'Deleted Successfully!']);
        }catch(\Exception $e){
            return response(['status'=>'error', 'message' => 'Something Went Wrong!']);
        }
    }
}
