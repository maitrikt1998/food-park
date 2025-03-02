@extends('admin.layouts.master')

@section('content')
<div class="section">
    <div class="section-header">
        <h1>Counter</h1>
    </div>
    <div class="col-12 col-md-12 col-lg-12">
        <div class="card card-primary">
          <div class="card-header">
            <h4>Counter</h4>
          </div>
          <div class="card-header-action">
            <h4>Create Counter</h4>
          </div>
          <div class="card-body">
            <form action="{{ route('admin.counter.update') }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="form-group">
                    <label>Background</label>
                    <div id="image-preview" class="image-preview">
                        <label for="image-upload" id="image-label">Choose File</label>
                        <input type="file" name="background" id="image-upload" />
                        <input type="hidden" name="background_old" id="image-upload" value="{{ @$counter->background }}" />
                    </div>
                </div>

                <h6>Counter One</h6>
                <hr />
                <div class="form-group">
                    <label>Counter Icon One</label>
                    <button  class="btn btn-secondary" role="iconpicker" name="counter_icon_one" data-icon="{{ @$counter->counter_icon_one }}"></button>
                </div>

                <div class="form-group">
                    <label>Counter Count One</label>
                    <input type="text" name="counter_count_one" class="form-control" value="{{ @$counter->counter_count_one }}">
                </div>

                <div class="form-group">
                    <label>Counter Count Name</label>
                    <input type="text" name="counter_name_one" class="form-control" value="{{ @$counter->counter_name_one }}">
                </div>

                <h6>Counter two</h6>
                <hr />
                <div class="form-group">
                    <label>Counter Icon two</label>
                    <button  class="btn btn-secondary" role="iconpicker" name="counter_icon_two" data-icon="{{ @$counter->counter_icon_two }}"></button>
                </div>

                <div class="form-group">
                    <label>Counter Count two</label>
                    <input type="text" name="counter_count_two" class="form-control" value="{{ @$counter->counter_count_two }}">
                </div>

                <div class="form-group">
                    <label>Counter Count Two Name</label>
                    <input type="text" name="counter_name_two" class="form-control" value="{{ @$counter->counter_name_two  }}">
                </div>

                <h6>Counter three</h6>
                <hr />
                <div class="form-group">
                    <label>Counter Icon three</label>
                    <button  class="btn btn-secondary" role="iconpicker" name="counter_icon_three" data-icon="{{ @$counter->counter_icon_three }}"></button>
                </div>

                <div class="form-group">
                    <label>Counter Count three</label>
                    <input type="text" name="counter_count_three" class="form-control" value="{{ @$counter->counter_count_three }}">
                </div>

                <div class="form-group">
                    <label>Counter Count Three Name</label>
                    <input type="text" name="counter_name_three" class="form-control" value="{{ @$counter->counter_name_three }}">
                </div>

                <h6>Counter four</h6>
                <hr />
                <div class="form-group">
                    <label>Counter Icon four</label>
                    <button  class="btn btn-secondary" role="iconpicker" name="counter_icon_four" data-icon="{{ @$counter->counter_icon_four }}"></button>
                </div>

                <div class="form-group">
                    <label>Counter Count four</label>
                    <input type="text" name="counter_count_four" class="form-control" value="{{ @$counter->counter_count_four }}">
                </div>

                <div class="form-group">
                    <label>Counter Count Four Name</label>
                    <input type="text" name="counter_name_four" class="form-control" value="{{ @$counter->counter_name_four }}">
                </div>


                <button type="submit" class="btn btn-primary">Create</button>
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
                'background-image': 'url({{ @$counter->background }})',
                'background-size': 'cover',
                'background-position': 'center center'
            })
        })
    </script>
@endpush
