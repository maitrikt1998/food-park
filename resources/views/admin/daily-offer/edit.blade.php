@extends('admin.layouts.master')

@section('content')
<div class="section">
    <div class="section-header">
        <h1>Daily Offer</h1>
    </div>
    <div class="col-12 col-md-12 col-lg-12">
        <div class="card card-primary">
          <div class="card-header">
            <h4>Daily Offer</h4>
          </div>
          <div class="card-header-action">
            <h4>Create Daily Offer</h4>
          </div>
          <div class="card-body">
            <form action="{{ route('admin.daily-offer.update', $dailyOffer->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="form-group">
                    <label>Product</label>
                    <select name="product" class="form-control" id="product_search">
                        <option value="{{ $dailyOffer->product->id }}" selected>{{ $dailyOffer->product->name }}</option>
                    </select>
                </div>

                <div class="form-group">
                    <label>Status</label>
                    <select name="status" class="form-control" id="">
                        <option @selected($dailyOffer->status === 1) value="1">Active</option>
                        <option @selected($dailyOffer->status === 0) value="0">InActive</option>
                    </select>
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
            $('#product_search').select2({
                ajax:{
                    url: "{{ route('admin.daily-offer.search-product') }}",
                    data: function(params){
                        var query = {
                            search: params.term,
                            type: 'public'
                        }

                        return query;
                    },
                processResults: function(data){
                    return {
                        results: $.map(data, function(product){
                            return {
                                text: product.name,
                                id: product.id,
                                image_url: product.thumb_image
                            }
                        })
                    }
                }
                },
                minimumInputLength: 3,
                templateResult: fomatProduct,
                escapeMarkup: function(m){
                    return m;
                }
            });

            function fomatProduct(product){
                var product = $('<span><img src="'+product.image_url+'" width="30px" class="thumbnail"> '+product.text+'</span>');
                return product;
            }
        })
    </script>
@endpush
