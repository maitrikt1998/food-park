@extends('admin.layouts.master')

@section('content')
<div class="section">
    <div class="section-header">
        <h1>Privacy Policy</h1>
    </div>
    <div class="col-12 col-md-12 col-lg-12">
        <div class="card card-primary">
          <div class="card-header">
            <h4>Privacy Policy</h4>
          </div>
          <div class="card-header-action">
            <h4>Create Privacy Policy</h4>
          </div>
          <div class="card-body">
            <form action="{{ route('admin.privacy-policy.update') }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="form-group">
                    <label>Content</label>
                    <textarea name="content" class="summernote form-control">{!! $privacy_policy->content !!}</textarea>
                </div>


                <button type="submit" class="btn btn-primary">Update</button>
            </form>
          </div>
        </div>
      </div>
</div>
@endsection


