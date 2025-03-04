@extends('admin.layouts.master')

@section('content')
    <div class="section">
        <div class="section-header">
            <h1>Clear Database</h1>
        </div>
        <div class="col-12 col-md-12 col-lg-12">
            <div class="card card-primary">
                <div class="card-header">
                    <h4>Clear Database</h4>
                </div>
                <div class="card-body">
                    <div class="alert alert-warning alert-has-icon">
                        <div class="alert-icon"><i class="far fa-lightbulb"></i></div>
                        <div class="alert-body">
                            <div class="alert-title">Danger</div>
                            If you fire this action it will wipe your entire database.
                        </div>
                        <form action="" class="mt-2 clear_db">
                            <button class="btn btn-danger submit_button" type="submit">Clear Database</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        $(document).ready(function() {
            $('.clear_db').on('submit',function(e) {
                e.preventDefault();

                Swal.fire({
                    title: "Are you sure?",
                    text: "You won't be able to revert this!",
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#3085d6",
                    cancelButtonColor: "#d33",
                    confirmButtonText: "Yes, delete it!"
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            method: 'POST',
                            url: "{{ route('admin.clear-database.destroy') }}",
                            data: {
                                _token: "{{ csrf_token() }}"
                            },
                            beforeSend: function(){
                                $('.submit_button').prop('disabled', true);
                                $('.submit_button').html('<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>Loading...');
                            },
                            success: function(response) {
                                $('.submit_button').prop('disabled', false);
                                $('.submit_button').html('Clear Database');
                                if (response.status === 'success') {
                                    toastr.success(response.message)
                                    window.location.reload();
                                } else if (response.status === 'error') {
                                    toastr.error(response.message)
                                }
                            },
                            error: function(error) {
                                $('.submit_button').prop('disabled', false);
                                $('.submit_button').html('Clear Database');
                                console.log(error);
                            }
                        });
                    }
                });
            })
        })
    </script>
@endpush
