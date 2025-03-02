@extends('frontend.layouts.master')

@section('content')
    <!--=============================
            BREADCRUMB START
        ==============================-->
    <section class="fp__breadcrumb" style="background: url({{ asset(config('settings.breadcumb')) }});">
        <div class="fp__breadcrumb_overlay">
            <div class="container">
                <div class="fp__breadcrumb_text">
                    <h1>search result</h1>
                    <ul>
                        <li><a href="{{ url('/') }}">home</a></li>
                        <li><a href="javascript:;">search result</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </section>
    <!--=============================
            BREADCRUMB END
        ==============================-->


    <!--=============================
            SEARCH MENU START
        ==============================-->
    <section class="fp__search_menu mt_120 xs_mt_90 mb_100 xs_mb_70">
        <div class="container">
            <form class="fp__search_menu_form" method="GET" action="{{ route('products.index') }}">
                <div class="row">
                    <div class="col-xl-6 col-md-5">
                        <input type="text" placeholder="Search..." name="search" value="{{ @request()->search }}">
                    </div>
                    <div class="col-xl-4 col-md-4">
                        <select class="nice-select" name="category">
                            <option value="">All</option>
                            @foreach ($categories as $category)
                                <option @selected(@request()->category == $category->slug) value="{{ $category->slug }}">{{ $category->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-xl-2 col-md-3">
                        <button type="submit" class="common_btn">search</button>
                    </div>
                </div>
            </form>

            <div class="row">
                @foreach ($products as $product)
                <div class="col-xl-3 col-sm-6 col-lg-4 wow fadeInUp" data-wow-duration="1s">
                    <div class="fp__menu_item">
                        <div class="fp__menu_item_img">
                            <img src="{{ asset($product->thumb_image) }}" alt="{{ $product->name }}" class="img-fluid w-100">
                            <a class="category" href="#">{{ @$product->category->name }}</a>
                        </div>
                        <div class="fp__menu_item_text">
                            <p class="rating">
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star-half-alt"></i>
                                <i class="far fa-star"></i>
                                <span>145</span>
                            </p>
                            <a class="title" href="{{ route('product.show',$product->slug) }}">{{ $product->name }}</a>
                            <h5 class="price">
                                @if ($product->offer_price > 0)
                                     {{ currencyPosition($product->offer_price) }}
                                    <del>{{ currencyPosition($product->price) }}</del>
                                @else
                                    {{ currencyPosition($product->price) }}
                                @endif
                            </h5>
                            <ul class="d-flex flex-wrap justify-content-center">
                                <li><a href="javascript:;" onclick="loadProductModal('{{ $product->id }}')"><i
                                            class="fas fa-shopping-basket"></i></a></li>
                                <li><a href="#"><i class="fal fa-heart"></i></a></li>
                                <li><a href="{{ route('product.show',$product->slug) }}"><i class="far fa-eye"></i></a></li>
                            </ul>
                        </div>
                    </div>
                </div>
                @endforeach


                @if(count(@$products) == 0 )
                    <h4 class="text-center">No Product Found!!</h4>
                @endif

            </div>
            @if (@$products->hasPages())
            <div class="fp__pagination mt_60">
                <div class="row">
                    <div class="col-12">
                        {{ @$products->links() }}

                    </div>
                </div>
            </div>
            @endif
        </div>
    </section>

    <!-- CART POPUT START -->
    <div class="fp__cart_popup">
        <div class="modal fade" id="cartModal" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-body">
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"><i
                                class="fal fa-times"></i></button>
                        <div class="fp__cart_popup_img">
                            <img src="images/menu1.png" alt="menu" class="img-fluid w-100">
                        </div>
                        <div class="fp__cart_popup_text">
                            <a href="#" class="title">Maxican Pizza Test Better</a>
                            <p class="rating">
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star-half-alt"></i>
                                <i class="far fa-star"></i>
                                <span>(201)</span>
                            </p>
                            <h4 class="price">$320.00 <del>$350.00</del> </h4>

                            <div class="details_size">
                                <h5>select size</h5>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="flexRadioDefault"
                                        id="large" checked>
                                    <label class="form-check-label" for="large">
                                        large <span>+ $350</span>
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="flexRadioDefault"
                                        id="medium">
                                    <label class="form-check-label" for="medium">
                                        medium <span>+ $250</span>
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="flexRadioDefault"
                                        id="small">
                                    <label class="form-check-label" for="small">
                                        small <span>+ $150</span>
                                    </label>
                                </div>
                            </div>

                            <div class="details_extra_item">
                                <h5>select option <span>(optional)</span></h5>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="" id="coca-cola">
                                    <label class="form-check-label" for="coca-cola">
                                        coca-cola <span>+ $10</span>
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="" id="7up">
                                    <label class="form-check-label" for="7up">
                                        7up <span>+ $15</span>
                                    </label>
                                </div>
                            </div>

                            <div class="details_quentity">
                                <h5>select quentity</h5>
                                <div class="quentity_btn_area d-flex flex-wrapa align-items-center">
                                    <div class="quentity_btn">
                                        <button class="btn btn-danger"><i class="fal fa-minus"></i></button>
                                        <input type="text" placeholder="1">
                                        <button class="btn btn-success"><i class="fal fa-plus"></i></button>
                                    </div>
                                    <h3>$320.00</h3>
                                </div>
                            </div>
                            <ul class="details_button_area d-flex flex-wrap">
                                <li><a class="common_btn" href="#">add to cart</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- CART POPUT END -->
@endsection
