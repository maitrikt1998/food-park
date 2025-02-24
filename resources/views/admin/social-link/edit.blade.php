@extends('admin.layouts.master')

@section('content')
<div class="section">
    <div class="section-header">
        <h1>Social Link</h1>
    </div>
    <div class="col-12 col-md-12 col-lg-12">
        <div class="card card-primary">
          <div class="card-header">
            <h4>Card Header</h4>
          </div>
          <div class="card-header-action">
            <h4>Create Social Link</h4>
          </div>
          <div class="card-body">
            <form action="{{ route('admin.social-link.update', $link->id) }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="form-group">
                    <label>Icon</label>
                    <button  class="btn btn-secondary" role="iconpicker" name="icon" data-icon="{{ $link->icon }}"></button>
                </div>
                <div class="form-group">
                    <label>Name</label>
                    <input type="text" name="name" class="form-control" value="{{ $link->name }}">
                </div>
                <div class="form-group">
                    <label>Link</label>
                    <input type="text" name="link" class="form-control" value="{{ $link->link }}">
                </div>

                <div class="form-group">
                    <label>Status</label>
                    <select name="status" class="form-control" id="">
                        <option @selected($link->status == 1) value="1">Active</option>
                        <option @selected($link->status == 0) value="0">InACtive</option>
                    </select>
                </div>
                <button type="submit" class="btn btn-primary">Create</button>
            </form>
          </div>
        </div>
      </div>
</div>
@endsection


