<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\BlogCommentDataTable;
use App\DataTables\BlogDataTable;
use App\Http\Controllers\Controller;
use App\Models\Blog;
use App\Models\BlogCategory;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;
use App\Http\Requests\Admin\BlogCreateRequest;
use App\Http\Requests\Admin\BlogUpdateRequest;
use App\Models\BlogComment;
use App\Traits\FileUploadTrait;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Response;
use Str;

class BlogController extends Controller
{
    use FileUploadTrait;
    /**
     * Display a listing of the resource.
     */
    public function index(BlogDataTable $dataTable): View|JsonResponse
    {
        return $dataTable->render('admin.blog.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create() : View
    {
        $categories = BlogCategory::all();
        return view('admin.blog.create',compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(BlogCreateRequest $request) : RedirectResponse
    {
        $imagePath = $this->uploadImage($request, 'image');

        $blog = new Blog();
        $blog->image = $imagePath;
        $blog->user_id = auth()->user()->id;
        $blog->title = $request->title;
        $blog->slug = Str::slug($request->title);
        $blog->category_id = $request->category;
        $blog->description = $request->description;
        $blog->seo_title = $request->seo_title;
        $blog->seo_description = $request->seo_description;
        $blog->status = $request->status;
        $blog->save();

        toastr()->success('Created Successfully');

        return to_route('admin.blogs.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $blog = Blog::findOrFail($id);
        $categories =  BlogCategory::all();
        return view('admin.blog.edit',compact('blog','categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(BlogUpdateRequest $request, string $id)
    {
        $imagePath = $this->uploadImage($request, 'image', $request->old_image);

        $blog = Blog::findOrFail($id);
        $blog->image = !empty($imagePath) ? $imagePath : $request->old_image;
        $blog->title = $request->title;
        $blog->slug = Str::slug($request->title);
        $blog->category_id = $request->category;
        $blog->description = $request->description;
        $blog->seo_title = $request->seo_title;
        $blog->seo_description = $request->seo_description;
        $blog->status = $request->status;
        $blog->save();

        toastr()->success('Updated Successfully');

        return to_route('admin.blogs.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try{
            $blog = Blog::findOrFail($id);
            $this->removeImage($blog->image);
            $blog->delete();
            return response(['status'=>'success', 'message' => 'Deleted Successfully!']);
        }catch(\Exception $e){
            return response(['status'=>'error', 'message' => 'Something Went Wrong!']);
        }
    }

    function blogComment(BlogCommentDataTable $dataTable) : View|JsonResponse
    {
        return $dataTable->render('admin.blog.blog-comment.index');
    }

    function commentStatusUpdate(string $id) : RedirectResponse
    {
        $comment = BlogComment::find($id);
        $comment->status = !$comment->status;
        $comment->save();
        toastr()->success('Updated Successfully');
        return redirect()->back();
    }

    function commentsDestroy(string $id)
    {
        try{
            $comment = BlogComment::findOrFail($id);
            $comment->delete();
            toastr()->success('Deleted Successfully');
            return response(['status'=>'success', 'message' => 'Deleted Successfully!']);
        }catch(\Exception $e){
            return response(['status'=>'error', 'message' => 'Something Went Wrong!']);
        }
    }
}
