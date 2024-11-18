@extends('admin.layouts.master')

@section('content')
<div class="section">
    <div class="section-header">
        <h1>Slider</h1>
    </div>
    <div class="col-12 col-md-12 col-lg-12">
        <div class="card card-primary">
          <div class="card-header">
            <h4>Card Header</h4>
            <div class="card-header-action">
              <a href="#" class="btn btn-primary">
                Create New
              </a>
            </div>
          </div>
          <div class="card-body">
            {{  $dataTable->table() }}
          </div>
        </div>
      </div>
</div>
@endsection

@push('scripts')
    {{ $dataTable->scripts(['type' => 'module']) }}
@endpush
