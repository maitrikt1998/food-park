@extends('admin.layouts.master')

@section('content')
<div class="section">
    <div class="section-header">
        <h1>Blog Category</h1>
    </div>
    <div class="col-12 col-md-12 col-lg-12">
        <div class="card card-primary">
          <div class="card-header">
            <h4>Blog Category</h4>
          </div>
          <div class="card-header-action">
            <h4>Edit Blog Category</h4>
          </div>
          <div class="card-body">
            <form action="{{ route('admin.blog-category.update', $category->id) }}" method="POST" enctype="multipart/form-data">
                @csrf

                @method('PUT')
                <div class="form-group">
                    <label>Name</label>
                    <input type="text" name="name" class="form-control" value="{{ $category->name }}">
                </div>


                <div class="form-group">
                    <label>Status</label>
                    <select name="status" class="form-control" id="">
                        <option @selected($category->status == 1) value="1">Active</option>
                        <option @selected($category->status == 0) value="0">InActive</option>
                    </select>
                </div>
                <button type="submit" class="btn btn-primary">Update</button>
            </form>
          </div>
        </div>
      </div>
</div>
@endsection
