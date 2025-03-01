@extends('admin.layouts.master')

@section('content')
<div class="section">
    <div class="section-header">
        <h1>Product Reviews</h1>
    </div>
    <div class="col-12 col-md-12 col-lg-12">
        <div class="card card-primary">
          <div class="card-header">
            <h4>All Reviews</h4>
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

  <script>
    $('body').ready(function(){
        $('body').on('change','.review_status',function(){
            let status = $(this).val();
            let id = $(this).data('id');
            $.ajax({
                method:'POST',
                url: "{{ route('admin.product-reviews.update') }}",
                data: {
                    _token: "{{ csrf_token() }}",
                    status: status,
                    id: id,
                },
                success: function(response){
                    toastr.success(response.message);
                },
                error: function(xhr, status, error){
                    console.log(xhr.responseJSON.error);
                },
            })
        })
    })

  </script>
@endpush
