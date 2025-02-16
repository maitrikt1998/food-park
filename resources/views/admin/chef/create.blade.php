@extends('admin.layouts.master')

@section('content')
<div class="section">
    <div class="section-header">
        <h1>Chef</h1>
    </div>
    <div class="col-12 col-md-12 col-lg-12">
        <div class="card card-primary">
          <div class="card-header">
            <h4>Chef</h4>
          </div>
          <div class="card-header-action">
            <h4>Create Chef</h4>
          </div>
          <div class="card-body">
            <form action="{{ route('admin.chefs.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="form-group">
                    <label>Image</label>
                    <div id="image-preview" class="image-preview">
                        <label for="image-upload" id="image-label">Choose File</label>
                        <input type="file" name="image" id="image-upload" />
                    </div>
                </div>

                <div class="form-group">
                    <label>Name</label>
                    <input type="text" name="name" class="form-control">
                </div>


                <div class="form-group">
                    <label>Title</label>
                    <input type="text" name="title" class="form-control">
                </div>

                <br/>
                <h5>Social Links</h5>
                <div class="form-group">
                    <label>Facebook <code>(Leave empty if not available)</code></label>
                    <input type="text" name="fb" class="form-control">
                </div>

                <div class="form-group">
                    <label>Linkedin <code>(Leave empty if not available)</code></label>
                    <input type="text" name="in" class="form-control">
                </div>

                <div class="form-group">
                    <label>X <code>(Leave empty if not available)</code></label>
                    <input type="text" name="x" class="form-control">
                </div>

                <div class="form-group">
                    <label>Web <code>(Leave empty if not available)</code></label>
                    <input type="text" name="web" class="form-control">
                </div>

                <div class="form-group">
                    <label>Show at Home</label>
                    <select name="show_at_home" class="form-control" id="">
                        <option value="0">No</option>
                        <option value="1">Yes</option>
                    </select>
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
