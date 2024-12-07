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
            <form action="{{ route('admin.why-choose-us.update', $whyChooseUs->id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="form-group">
                    <label>Icon</label><br />
                    <button data-icon="{{ $whyChooseUs->icon }}" class="btn btn-primary" role="iconpicker" name="icon"></button>
                </div>
                <div class="form-group">
                    <label>Title</label>
                    <input type="text"  class="form-control" name="title" value="{{ $whyChooseUs->title }}">
                </div>
                <div class="form-group">
                    <label>Short description</label>
                    <input type="text" class="form-control" name="short_description" value="{{ $whyChooseUs->short_description }}">
                </div>

                <div class="form-group">
                    <label>Status</label>
                    <select name="status" class="form-control" id="">
                        <option @selected($whyChooseUs->status === 1) value="1">Yes</option>
                        <option @selected($whyChooseUs->status === 0) value="0">No</option>
                    </select>
                </div>
                <button type="submit" class="btn btn-primary">Update</button>
            </form>
          </div>
        </div>
      </div>
</div>
@endsection


