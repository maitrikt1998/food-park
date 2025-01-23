<div class="tab-pane fade show active" id="paypal-setting" role="tabpanel" aria-labelledby="home-tab4">
    <div class="card">
        <div class="card-body border">
            <form action="{{ route('admin.paypal-setting.update') }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="form-group">
                    <label for="paypal_status">Paypal Status</label>
                    <select name="paypal_status" id="" class="select2 form-control">
                        <option @selected($paypalGateway['paypal_status'] === 1) value="1">Active</option>
                        <option @selected($paypalGateway['paypal_status'] === 0) value="0">InActive</option>
                    </select>
                </div>

                <div class="form-group">
                    <label for="paypal_account_mode">Paypal Account Mode</label>
                    <select name="paypal_account_mode" id="" class="select2 form-control">
                        <option @selected($paypalGateway['paypal_account_mode'] === 'sandbox')  value="sandbox">Sandbox</option>
                        <option @selected($paypalGateway['paypal_account_mode'] === 'live')  value="live">Live</option>
                    </select>
                </div>

                <div class="form-group">
                    <label for="paypal_country">Paypal Country Name</label>
                    <select name="paypal_country" id="" class="select2 form-control">
                        <option value="">Select</option>
                        @foreach (Config('country_list') as $key => $country)
                            <option @selected($paypalGateway['paypal_country'] ===  $key ) value="{{ $key }}">{{ $country }}</option>
                        @endforeach
                        
                    </select>
                </div>

                <div class="form-group">
                    <label for="paypal_currency">Paypal Currency Name</label>
                    <select name="paypal_currency" id="" class="select2 form-control">
                        <option value="">Select</option>
                        @foreach (config('currencys.currency_list') as $currency)
                            <option @selected($paypalGateway['paypal_currency'] === $currency) value="{{ $currency }}">
                                {{ $currency }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label for="paypal_rate">Currency Rate(  Per {{ config('settings.site_default_currency' ) }})</label>
                    <input name="paypal_rate" type="text" class="form-control" value="{{ $paypalGateway['paypal_rate'] }}">
                </div>

                <div class="form-group">
                    <label for="paypal_api_key">Paypal Client Id</label>
                    <input name="paypal_api_key" type="text" class="form-control" value="{{ $paypalGateway['paypal_api_key'] }}">
                </div>

                <div class="form-group">
                    <label for="paypal_secret_key">Paypal Secret Key</label>
                    <input name="paypal_secret_key" type="text" class="form-control" value="{{ $paypalGateway['paypal_secret_key'] }}">
                </div>
                 
                <div class="form-group">
                    <label>Paypal Logo</label>
                    <div id="image-preview" class="image-preview">
                        <label for="image-upload" id="image-label">Choose File</label>
                        <input type="file" name="paypal_logo" id="image-upload" />
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
            let paypalLogo = '{{ isset($paypalGateway["paypal_logo"]) ? asset($paypalGateway["paypal_logo"]) : "" }}';
            $('.image-preview').css({
                'background-image': paypalLogo ? `url(${paypalLogo})` : '',
                'background-size': 'cover',
                'background-position': 'center center'
            })
        })
    </script>
@endpush