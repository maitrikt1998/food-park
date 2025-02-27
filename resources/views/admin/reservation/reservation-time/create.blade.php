@extends('admin.layouts.master')

@section('content')
<div class="section">
    <div class="section-header">
        <h1>Reservation Time</h1>
    </div>
    <div class="col-12 col-md-12 col-lg-12">
        <div class="card card-primary">
          <div class="card-header">
            <h4>Card Header</h4>
          </div>
          <div class="card-header-action">
            <h4>Create Reservation Time</h4>
          </div>
          <div class="card-body">
            <form action="{{ route('admin.reservation-time.store') }}" method="POST">
                @csrf

                <div class="form-group">
                    <label>Start Time</label>
                    <input type="text" name="start_time" class="form-control timepicker">
                </div>
                <div class="form-group">
                    <label>End Time</label>
                    <input type="text" name="end_time" class="form-control timepicker">
                </div>

                <div class="form-group">
                    <label>Status</label>
                    <select name="status" class="form-control" id="">
                        <option value="1">Yes</option>
                        <option value="0">No</option>
                    </select>
                </div>
                <button type="submit" class="btn btn-primary">Create</button>
            </form>
          </div>
        </div>
      </div>
</div>
@endsection


