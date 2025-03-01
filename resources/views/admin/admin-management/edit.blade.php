@extends('admin.layouts.master')

@section('content')
<div class="section">
    <div class="section-header">
        <h1>Admin Management</h1>
    </div>
    <div class="col-12 col-md-12 col-lg-12">
        <div class="card card-primary">
          <div class="card-header">
            <h4>Admin Management</h4>
          </div>
          <div class="card-header-action">
            <h4>Create Admin</h4>
          </div>
          <div class="card-body">
            <form action="{{ route('admin.admin-management.update', $admin->id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="form-group">
                    <label>Name</label>
                    <input type="text" name="name" class="form-control" value={{ $admin->name }}>
                </div>

                <div class="form-group">
                    <label>Email</label>
                    <input type="text" name="email" class="form-control" value={{ $admin->email }}>
                </div>

                <div class="form-group">
                    <label>Role</label>
                    <select name="role" class="form-control" id="">
                        <option value="admin">Admin</option>
                    </select>
                </div>

                <div class="form-group">
                    <label>Password</label>
                    <input type="password" name="password" class="form-control">
                </div>

                <div class="form-group">
                    <label>Confirm Password</label>
                    <input type="password" name="password_confirmation" class="form-control">
                </div>

                <button type="submit" class="btn btn-primary">Update</button>
            </form>
          </div>
        </div>
      </div>
</div>
@endsection

@push('scripts')
    <script>
        $(document).ready(function(){
            $('.image-preview').css({
                'background-image': 'url({{ asset(auth()->user()->avatar) }})',
                'background-size': 'cover',
                'background-position': 'center center'
            })
        })
    </script>
@endpush
