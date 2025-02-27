@extends('admin.layouts.master')

@section('content')
<section class="section mt-4">
    <div id="accordion">
        <div class="accordion">
            <div class="accordion-header collapsed bg-primary text-light p-3" role="button" data-toggle="collapse" data-target="#panel-body-1" aria-expanded="true">
                <h4>Reservation Time</h4>
            </div>
        </div>

    </div>
</section>
<div class="section">
    <div class="section-header">
        <h1>Reservation Time</h1>
    </div>
    <div class="col-12 col-md-12 col-lg-12">
        <div class="card card-primary">
          <div class="card-header">
            <h4>All Reservation Time</h4>
            <div class="card-header-action">
              <a href="{{ route('admin.reservation-time.create') }}" class="btn btn-primary">
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

  <script>
    $('body').ready(function(){
        $('body').on('change','.reservation_status',function(){
            let status = $(this).val();
            let id = $(this).data('id');
            $.ajax({
                method:'POST',
                url: "{{ route('admin.reservation.update') }}",
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
