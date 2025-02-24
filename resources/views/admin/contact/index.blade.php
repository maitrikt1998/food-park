@extends('admin.layouts.master')

@section('content')
<div class="section">
    <div class="section-header">
        <h1>Contact</h1>
    </div>
    <div class="col-12 col-md-12 col-lg-12">
        <div class="card card-primary">
          <div class="card-header">
            <h4>Contact</h4>
          </div>
          <div class="card-header-action">
            <h4>Create Contact</h4>
          </div>
          <div class="card-body">
            <form action="{{ route('admin.contact.update') }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="form-group">
                    <label>Phone One</label>
                    <input type="text" name="phone_one" class="form-control" value="{{ $conatct->phone_one }}">
                </div>

                <div class="form-group">
                    <label>Phone Two</label>
                    <input type="text" name="phone_two" class="form-control" value="{{ $conatct->phone_two }}">
                </div>

                <div class="form-group">
                    <label>Email One</label>
                    <input type="text" name="mail_one" class="form-control" value="{{ $conatct->mail_one }}">
                </div>

                <div class="form-group">
                    <label>Email Two</label>
                    <input type="text" name="mail_two" class="form-control"  value="{{ $conatct->mail_two }}">
                </div>

                <div class="form-group">
                    <label>Address</label>
                    <textarea name="address" class="form-control">{!! $conatct->address !!}</textarea>
                </div>

                <div class="form-group">
                    <label>Google Map Link</label>
                    <input type="text" name="map_link" class="form-control" value="{{ $conatct->map_link }}">
                </div>

                <button type="submit" class="btn btn-primary">Update</button>
            </form>
          </div>
        </div>
      </div>
</div>
@endsection
