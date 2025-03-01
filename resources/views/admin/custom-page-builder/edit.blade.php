@extends('admin.layouts.master')

@section('content')
<div class="section">
    <div class="section-header">
        <h1>Custom Page Builder</h1>
    </div>
    <div class="col-12 col-md-12 col-lg-12">
        <div class="card card-primary">
          <div class="card-header">
            <h4>Card Header</h4>
          </div>
          <div class="card-body">
            <form action="{{ route('admin.custom-page-builder.update', $page->id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="form-group">
                    <label>Page Name</label>
                    <input type="text" name="name" class="form-control" value="{{ $page->name }}">
                </div>
                <div class="form-group">
                    <label>Page Content</label>
                    <textarea name="content" class="form-control summernote">{!! $page->content !!}</textarea>
                </div>

                <div class="form-group">
                    <label>Status</label>
                    <select name="status" class="form-control" id="">
                        <option @selected($page->status === 1) value="1">Active</option>
                        <option @selected($page->status === 0) value="0">InActive</option>
                    </select>
                </div>
                <button type="submit" class="btn btn-primary">Update</button>
            </form>
          </div>
        </div>
      </div>
</div>
@endsection


