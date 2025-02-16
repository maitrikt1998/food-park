@extends('admin.layouts.master')

@section('content')
<div class="section">
    <div class="section-header">
        <h1>Banner Slider</h1>
    </div>
    <div class="col-12 col-md-12 col-lg-12">
        <div class="card card-primary">
          <div class="card-header">
            <h4>Banner Slider</h4>
          </div>
          <div class="card-header-action">
            <h4>Create Banner Slider</h4>
          </div>
          <div class="card-body">
            <form action="{{ route('admin.banner-slider.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="form-group">
                    <label>Image</label>
                    <div id="image-preview" class="image-preview">
                        <label for="image-upload" id="image-label">Choose File</label>
                        <input type="file" name="banner" id="image-upload" />
                    </div>
                </div>

                <div class="form-group">
                    <label>Title</label>
                    <input type="text" name="title" class="form-control">
                </div>

                <div class="form-group">
                    <label>Sub Title</label>
                    <input type="text" name="sub_title" class="form-control">
                </div>

                <div class="form-group">
                    <label>Url</label>
                    <input type="text" name="url" class="form-control">
                </div>

                <div class="form-group">
                    <label>Status</label>
                    <select name="status" class="form-control" id="">
                        <option value="1">Active</option>
                        <option value="0">InActive</option>
                    </select>
                </div>
                <button type="submit" class="btn btn-primary">Create</button>
            </form>
          </div>
        </div>
      </div>
</div>
@endsection

@push('scripts')
    <script>
        $(document).ready(function(){
            $('.image-preview').css({
                'background-image': 'url({{ asset(auth()->user()->avatar) }})',
                'background-size': 'cover',
                'background-position': 'center center'
            })
        })
    </script>
@endpush
