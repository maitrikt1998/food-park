@extends('admin.layouts.master')

@section('content')
<div class="section">
    <div class="section-header">
        <h1>Terms And Condition</h1>
    </div>
    <div class="col-12 col-md-12 col-lg-12">
        <div class="card card-primary">
          <div class="card-header">
            <h4>Terms And Condition</h4>
          </div>
          <div class="card-header-action">
            <h4>Create Terms And Condition</h4>
          </div>
          <div class="card-body">
            <form action="{{ route('admin.terms-and-condition.update') }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="form-group">
                    <label>Content</label>
                    <textarea name="content" class="summernote form-control">{!! $terms_condition->content !!}</textarea>
                </div>
                <button type="submit" class="btn btn-primary">Update</button>
            </form>
          </div>
        </div>
      </div>
</div>
@endsection


