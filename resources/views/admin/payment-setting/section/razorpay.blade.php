<div class="tab-pane fade show" id="razorpay-setting" role="tabpanel" aria-labelledby="home-tab4">
    <div class="card">
        <div class="card-body border">
            <form action="{{ route('admin.razorpay-setting.update') }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="form-group">
                    <label for="razorpay_status">Razorpay Status</label>
                    <select name="razorpay_status" id="" class="select2 form-control">
                        <option @selected(@$paymentGateway['razorpay_status'] == 1) value="1">Active</option>
                        <option @selected(@$paymentGateway['razorpay_status'] == 0) value="0">Inactive</option>
                    </select>
                </div>

                <div class="form-group">
                    <label for="razorpay_country">Razorpay Country Name</label>
                    <select name="razorpay_country" id="" class="select2 form-control">
                        <option value="">Select</option>
                        @foreach (config('country_list') as $key => $country)
                            <option @selected(@$paymentGateway['razorpay_country'] ===  $key ) value="{{ $key }}">{{ $country }}</option>
                        @endforeach

                    </select>
                </div>

                <div class="form-group">
                    <label for="razorpay_currency">Razorpay Currency Name</label>
                    <select name="razorpay_currency" id="" class="select2 form-control">
                        <option value="">Select</option>
                        @foreach (config('currencys.currency_list') as $currency)
                            <option @selected(@$paymentGateway['razorpay_currency'] === $currency) value="{{ $currency }}">
                                {{ $currency }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label for="razorpay_rate">Currency Rate(  Per {{ config('settings.site_default_currency' ) }})</label>
                    <input name="razorpay_rate" type="text" class="form-control" value="{{ @$paymentGateway['razorpay_rate'] }}">
                </div>

                <div class="form-group">
                    <label for="razorpay_api_key">Razorpay Key</label>
                    <input name="razorpay_api_key" type="text" class="form-control" value="{{ @$paymentGateway['razorpay_api_key'] }}">
                </div>

                <div class="form-group">
                    <label for="razorpay_secret_key">Razorpay Secret Key</label>
                    <input name="razorpay_secret_key" type="text" class="form-control" value="{{ @$paymentGateway['razorpay_secret_key'] }}">
                </div>


                <div class="form-group">
                    <label>Razorpay Logo</label>
                    <div id="image-preview-3" class="image-preview razorpay-preview">
                        <label for="image-upload-3" id="image-label-3">Choose File</label>
                        <input type="file" name="stripce_logo" id="image-upload-3" />
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
            let razorpayLogo = '{{ isset($paymentGateway["razorpay_logo"]) ? asset($paymentGateway["razorpay_logo"]) : "" }}';
            $('.razorpay-preview').css({
                'background-image': razorpayLogo ? `url(${razorpayLogo})` : '',
                'background-size': 'cover',
                'background-position': 'center center'
            })

            $.uploadPreview({
                input_field: "#image-upload-3",   // Default: .image-upload
                preview_box: "#image-preview-3",  // Default: .image-preview
                label_field: "#image-label-3",    // Default: .image-label
                label_default: "Choose File",   // Default: Choose File
                label_selected: "Change File",  // Default: Change File
                no_label: false,                // Default: false
                success_callback: null          // Default: null
            });
        })
    </script>
@endpush
