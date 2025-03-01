@extends('admin.layouts.master')

@section('content')
<div class="section">
    <div class="section-header">
        <h1>Menu Builder</h1>
    </div>
    <div class="col-12 col-md-12 col-lg-12">
        <div class="card card-primary">
          <div class="card-header">
            <h4>All Menus</h4>
          </div>
          <div class="card-body">
            {!! Menu::render() !!}
          </div>
        </div>
      </div>
</div>
@endsection


@push('scripts')
    {!! Menu::scripts() !!}
@endpush




