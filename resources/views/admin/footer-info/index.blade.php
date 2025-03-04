@extends('admin.layouts.master')

@section('content')
<div class="section">
    <div class="section-header">
        <h1>Footer Info</h1>
    </div>
    <div class="col-12 col-md-12 col-lg-12">
        <div class="card card-primary">
          <div class="card-header">
            <h4>Card Header</h4>
          </div>
          <div class="card-header-action">
            <h4>Create Footer Info</h4>
          </div>
          <div class="card-body">
            <form action="{{ route('admin.footer-info.update') }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="form-group">
                    <label>Short Info</label>
                    <textarea type="text" name="short_info" class="form-control"> {{ @$footerInfo->short_info }}</textarea>
                </div>
                <div class="form-group">
                    <label>Address</label>
                    <input type="text" name="address" class="form-control" value="{{ @$footerInfo->address }}">
                </div>
                <div class="form-group">
                    <label>Phone</label>
                    <input type="text" name="phone" class="form-control"  value="{{ @$footerInfo->phone }}">
                </div>
                <div class="form-group">
                    <label>Email</label>
                    <input type="text" name="email" class="form-control" value="{{ @$footerInfo->email }}">
                </div>
                <div class="form-group">
                    <label>Copy Right</label>
                    <input type="text" name="copyright" class="form-control" value="{{ @$footerInfo->copyright }}">
                </div>

                <button type="submit" class="btn btn-primary">Update</button>
            </form>
          </div>
        </div>
      </div>
</div>
@endsection


