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
            <h4>Edit Chef</h4>
          </div>
          <div class="card-body">
            <form action="{{ route('admin.chefs.update', $chef->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="form-group">
                    <label>Image</label>
                    <div id="image-preview" class="image-preview">
                        <label for="image-upload" id="image-label">Choose File</label>
                        <input type="file" name="image" id="image-upload" />
                        <input type="hidden" name="old_image" value="{{ $chef->image }}" />
                    </div>
                </div>

                <div class="form-group">
                    <label>Name</label>
                    <input type="text" name="name" class="form-control" value="{{ $chef->name }}">
                </div>


                <div class="form-group">
                    <label>Title</label>
                    <input type="text" name="title" class="form-control" value="{{ $chef->title }}">
                </div>

                <br/>
                <h5>Social Links</h5>
                <div class="form-group">
                    <label>Facebook <code>(Leave empty if not available)</code></label>
                    <input type="text" name="fb" class="form-control" value="{{ $chef->fb }}">
                </div>

                <div class="form-group">
                    <label>Linkedin <code>(Leave empty if not available)</code></label>
                    <input type="text" name="in" class="form-control" value="{{ $chef->in }}">
                </div>

                <div class="form-group">
                    <label>X <code>(Leave empty if not available)</code></label>
                    <input type="text" name="x" class="form-control" value="{{ $chef->x }}">
                </div>

                <div class="form-group">
                    <label>Web <code>(Leave empty if not available)</code></label>
                    <input type="text" name="web" class="form-control" value="{{ $chef->web }}">
                </div>

                <div class="form-group">
                    <label>Show at Home</label>
                    <select name="show_at_home" class="form-control" id="">
                        <option @selected($chef->show_at_home == 0) value="0">No</option>
                        <option @selected($chef->show_at_home == 1) value="1">Yes</option>
                    </select>
                </div>

                <div class="form-group">
                    <label>Status</label>
                    <select name="status" class="form-control" id="">
                        <option @selected($chef->status == 1) value="1">Active</option>
                        <option @selected($chef->status == 0) value="0">InActive</option>
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
                'background-image': 'url({{ $chef->image }})',
                'background-size': 'cover',
                'background-position': 'center center'
            })
        })
    </script>
@endpush
