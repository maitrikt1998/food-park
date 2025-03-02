<div class="tab-pane fade show" id="apperance-setting" role="tabpanel" aria-labelledby="home-tab4">
    <div class="card">
        <div class="card-body">
            <form action="{{ route('admin.appearance-setting.update') }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="row">
                    <div class="col-md-3">
                        <div class="form-group">
                            <label>Site Color</label>
                            <input type="text" class="form-control colorpickerinput" name="site_color" value="{{ config('settings.site_color') }}">
                        </div>
                    </div>

                </div>

                <button type="submit" class="btn btn-primary">Save</button>
            </form>
        </div>
    </div>
</div>

@push('scripts')
<script>
     $(document).ready(function(){
        $(".colorpickerinput").colorpicker({
            format: 'hex',
            component: '.input-group-append',
        });


    })

</script>

@endpush
