@extends('admin.layouts.master')

@section('content')
    <div class="section">
        <div class="section-header">
            <h1>Blog</h1>
        </div>
        <div class="col-12 col-md-12 col-lg-12">
            <div class="card card-primary">
                <div class="card-header">
                    <h4>Card Header</h4>
                </div>
                <div class="card-header-action">
                    <h4>Edit Blog</h4>
                </div>
                <div class="card-body">
                    <form action="{{ route('admin.blogs.update', $blog->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="form-group">
                            <label>Image</label>
                            <div id="image-preview" class="image-preview">
                                <label for="image-upload" id="image-label">Choose File</label>
                                <input type="file" name="image" id="image-upload" />
                                <input type="hidden" name="old_image" value="{{ $blog->old_image }}" />
                            </div>
                        </div>

                        <div class="form-group">
                            <label>Title</label>
                            <input type="text" name="title" class="form-control" value="{{ $blog->title }}">
                        </div>

                        <div class="form-group">
                            <label>Category</label>
                            <select name="category" class="form-control select2" id="">
                                <option value="">Select</option>
                                @foreach ($categories as $category)
                                    <option value="{{ $category->id }}"  @selected($category->id  == $blog->category_id)>{{  $category->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <label> Description</label>
                            <textarea name="description" class="form-control summernote" id="" >{!! $blog->description !!}</textarea>
                        </div>

                        <div class="form-group">
                            <label>Seo title</label>
                            <input type="text" name="seo_title" class="form-control" value="{{ $blog->seo_title }}">
                        </div>

                        <div class="form-group">
                            <label>Seo description</label>
                            <textarea name="seo_description" class="form-control"> {{ $blog->seo_description }}</textarea>
                        </div>

                        <div class="form-group">
                            <label>Status</label>
                            <select name="status" class="form-control" id="">
                                <option value="1" @selected($blog->status == 1)>Active</option>
                                <option value="0" @selected($blog->status == 0)>Inactive</option>
                            </select>
                        </div>
                        <button type="submit" class="btn btn-primary">Update</button>
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
                'background-image': 'url({{ asset($blog->image) }})',
                'background-size': 'cover',
                'background-position': 'center center'
            })
        })
    </script>
@endpush
