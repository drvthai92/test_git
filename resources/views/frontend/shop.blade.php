@extends('frontend.layout')
@section('shop')
<!-- Breadcrumb Section Begin -->
<section class="breadcrumb-section set-bg" data-setbg="img/breadcrumb.jpg">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 text-center">
                <div class="breadcrumb__text">
                    <h2>Organi Shop</h2>
                    <div class="breadcrumb__option">
                        <a href="./index.html">Home</a>
                        <span>Shop</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Breadcrumb Section End -->

<!-- Product Section Begin -->
<form action="{{ route('shop') }}" type="GET" id="form-product-list"
>
    <section class="product spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-3 col-md-5">
                    <div class="sidebar">
                        <div class="sidebar__item">
                            <div class="hero__categories">
                                <div class="hero__categories__all">
                                    <i class="fa fa-bars"></i>
                                    <span>All departments</span>
                                </div>
                                
                                <div class="row">
                                    <select name="category" id="select-category">
                                        <option value="all">All deparments</option>
                                        @foreach ($productCategories as $productCategory)
                                            <option {{ request()->query('category')==$productCategory->id?'selected':'' }} value="{{ $productCategory->id }}"> {{ $productCategory->name }} </option>
                                        @endforeach  
                                      
                                    </select>
                                </div>
                               
                            </div>
                          
                        </div>

                        <div class="sidebar__item">
                            <h4>Price</h4>
                            <div class="price-range-wrap">
                                <div class="price-range ui-slider ui-corner-all ui-slider-horizontal ui-widget ui-widget-content"
                                    data-min="{{ $min }}" data-max="{{ $max }}">
                                    <div class="ui-slider-range ui-corner-all ui-widget-header"></div>
                                    <span tabindex="0" class="ui-slider-handle ui-corner-all ui-state-default"></span>
                                    <span tabindex="0" class="ui-slider-handle ui-corner-all ui-state-default"></span>
                                </div>
                                <div class="range-slider">
                                    <div class="price-input">
                                        <input type="text" id="minamount" name="min">
                                        <input type="text" id="maxamount" name="max">
                                    </div>
                                </div>
                            </div>
                        </div>   
                    </div>
                </div>
                <div class="col-lg-9 col-md-7">
                    
                    <div class="filter__item">
                        <div class="row">
                            <div class="col-lg-4 col-md-5">
                                <div class="filter__sort">
                                    <span>Sort By</span>
                                    <select name="sort" id="sort">
                                        <option {{ request()->query('sort')==0?'selected':'' }}  value="0">Newest</option>
                                        <option {{ request()->query('sort')==1?'selected':'' }} value="1">Prize Low to High</option>
                                        <option {{ request()->query('sort')==2?'selected':'' }} value="2">Prize High to Low</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-4">
                                <div class="filter__found">
                                    <h6><span>{{ $count }}</span> Products found</h6>
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-3">
                                <div class="filter__option">
                                    <span class="icon_grid-2x2"></span>
                                    <span class="icon_ul"></span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        @foreach($products as $product)
                        <div class="col-lg-4 col-md-6 col-sm-6">
                            <div class="product__item">
                                @php
                                $image=empty($product->image)?'image_default.png':$product->image;
                                @endphp
                                <div class="product__item__pic set-bg" data-setbg="{{ asset('image'.'/'.$image) }}">
                                    <ul class="product__item__pic__hover">
                                        <li><a href="#"><i class="fa fa-heart"></i></a></li>
                                        <li><a href="#"><i class="fa fa-retweet"></i></a></li>
                                        <li><a class="add-to-cart1" data-url="{{ route('add.product.to.cart',[$product->id,1]) }}"><i class="fa fa-shopping-cart"></i></a></li>
                                    </ul>
                                </div>
                                <div class="product__item__text">
    
                                    @php
                                        $slug=is_null($product->slug)?'':$product->slug
                                    @endphp
                                    <h6><a href="{{ route('product.detail.slug',[$slug]) }}">{{ $product->name }}</a></h6>
                                    <h5>${{number_format($product->price,2)  }}</h5>
                                </div>
                            </div>
                        </div>
                        @endforeach
                       
                    </div>
                    {{-- pagination --}}
                    {{ $products->appends(request()->query())->links('pagination::bootstrap-5') }}
                </div>
            </div>
        </div>
    </section>
</form>

<!-- Product Section End -->
@endsection
@section('my-script')
    <script type="text/javascript">
        $(document).ready(function(){
        $('#sort,#select-category').on('change',function(){
            $('#form-product-list').submit();
        });
        // $('#select-category').on('change',function(){
        //     $('#form-product-list').submit();
        // });



        $('.price-range').on("slidestop",function(){
            $('#form-product-list').submit();
        });

        $(".price-range").slider("values",
        [
            "{{ is_null(request()->query('min'))?$min:request()->query('min') }}",
            "{{ is_null(request()->query('max'))?$max:request()->query('max') }}"
        ]);

        $("#minamount").val("{{ is_null(request()->query('min'))?$min:request()->query('min') }}");
        $("#maxamount").val("{{ is_null(request()->query('max'))?$max:request()->query('max') }}");
       
    });
    
    </script>
@endsection