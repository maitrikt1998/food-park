@extends('admin.layouts.master')

@section('content')
<div class="section">
    <div class="section-header">
        <h1>Blog Commentt</h1>
    </div>
    <div class="col-12 col-md-12 col-lg-12">
        <div class="card card-primary">
          <div class="card-header">
            <h4>Blog Commentt</h4>
            <div class="card-header-action">

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
