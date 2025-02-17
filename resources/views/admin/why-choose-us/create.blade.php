@extends('admin.layouts.master')

@section('content')
<div class="section">
    <div class="section-header">
        <h1>Why Choose Us</h1>
    </div>
    <div class="col-12 col-md-12 col-lg-12">
        <div class="card card-primary">
          <div class="card-header">
            <h4>Card Header</h4>
          </div>
          <div class="card-body">
            <form action="{{ route('admin.why-choose-us.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="form-group">
                    <label>Icon</label><br />
                    <button class="btn btn-primary" role="iconpicker" name="icon"></button>
                </div>
                <div class="form-group">
                    <label>Title</label>
                    <input type="text"  class="form-control" name="title">
                </div>
                <div class="form-group">
                    <label>Short description</label>
                    <input type="text" class="form-control" name="short_description">
                </div>

                <div class="form-group">
                    <label>Status</label>
                    <select name="status" class="form-control" id="">
                        <option value="1">Active</option>
                        <option value="0">Inactive</option>
                    </select>
                </div>
                <button type="submit" class="btn btn-primary">Create</button>
            </form>
          </div>
        </div>
      </div>
</div>
@endsection


