@extends('admin.layouts.master')

@section('content')
<div class="section">
    <div class="section-header">
        <h1>Banner Slider</h1>
    </div>
    <div class="col-12 col-md-12 col-lg-12">
        <div class="card card-primary">
          <div class="card-header">
            <h4>All Banner Slider</h4>
            <div class="card-header-action">
              <a href="{{ route('admin.banner-slider.create') }}" class="btn btn-primary">
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
