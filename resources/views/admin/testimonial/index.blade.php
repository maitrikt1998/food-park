@extends('admin.layouts.master')

@section('content')

<div class="section">
    <div class="section-header">
        <h1>Testimonial</h1>
    </div>


    <div class="card">

        <div class="card-body">
        <div id="accordion">
            <div class="accordion">
                <div class="accordion-header collapsed bg-primary text-light p-3" role="button" data-toggle="collapse" data-target="#panel-body-1" aria-expanded="true">
                    <h4>Testimonial Section Titles..</h4>
                </div>
                <div class="accordion-body collapse show" id="panel-body-1" data-parent="#accordion">
                    <form action="{{ route('admin.testimonial-title.update') }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="form-group">
                            <label for="">Top Title</label>
                            <input type="text" class="form-control" name="testimonial_top_title" value="{{ @$titles['testimonial_top_title'] }}">
                        </div>
                        <div class="form-group">
                            <label for="">Main Title</label>
                            <input type="text" class="form-control" name="testimonial_main_title" value="{{ @$titles['testimonial_main_title'] }}">
                        </div>
                        <div class="form-group">
                            <label for="">Sub Title</label>
                            <input type="text" class="form-control" name="testimonial_sub_title" value="{{ @$titles['testimonial_sub_title'] }}">
                        </div>
                        <button type="submit" class="btn btn-primary">Save</button>
                    </form>

                </div>
            </div>

        </div>
        </div>
    </div>


</div>
<div class="section">
    <div class="col-12 col-md-12 col-lg-12">
        <div class="card card-primary">
          <div class="card-header">
            <h4>All Testimonial</h4>
            <div class="card-header-action">
              <a href="{{ route('admin.testimonial.create') }}" class="btn btn-primary">
                Create New
              </a>
            </div>
          </div>
          <div class="card-body">
            {{ $dataTable->table() }}
          </div>
        </div>
      </div>
</div>
@endsection

@push('scripts')
  {{ $dataTable->scripts() }}
@endpush
