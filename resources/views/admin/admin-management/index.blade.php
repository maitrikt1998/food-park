@extends('admin.layouts.master')

@section('content')

<div class="section">
    <div class="section-header">
        <h1>Admin Management</h1>
    </div>
    <div class="col-12 col-md-12 col-lg-12">
        <div class="card card-primary">
          <div class="card-header">
            <h4>All Admin Management</h4>
            <div class="card-header-action">
              <a href="{{ route('admin.admin-management.create') }}" class="btn btn-primary">
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
