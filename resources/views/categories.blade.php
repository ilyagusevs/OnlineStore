@extends('layouts.navbar-footer')

@section('title', $categ->title)

@section('content')
    <head>
        <link rel="stylesheet" href="/css/categories.css">
    </head>   

    <h1>{{$categ->title}}</h1>

    <div class="products">
        <div class="container">
                <div class="row">
                    <div class="col">
                        <!-- Product Sorting -->
                        <div class="sorting_bar d-flex flex-md-row flex-column align-items-md-center justify-content-md-start">
                        <div class="results">Showing <span>{{$products->count()}}</span> results</div>
                            <div class="sorting_container ml-md-auto">
                                <div class="sorting">
                                    <ul class="item_sorting">
                                        <li>
                                            <span class="sorting_text">Sort by</span>
                                            <i class="fa fa-chevron-down" aria-hidden="true"></i>
                                            <ul>
                                                <li class="product_sorting_btn" data-order="price-low-high"><span>Price: Low-High</span></li>
                                                <li class="product_sorting_btn" data-order="price-high-low"><span>Price: High-Low</span></li>
                                            </ul>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        <div class="container">
            <div class="row">
                <div class="col">
                    <div class="product_grid">
                        @foreach($products as $product)
                            @php
                                $image = '';
                                if(count($product->images) > 0){
                                    $image = $product->images[0]['img'];
                                }else{
                                    $image = 'no_image.png';
                                }
                            @endphp
                           <div class="product">
                                <div class="product_image">
                                    <a href="{{route('showProduct',[$product->category['alias'], $product->id])}}"><img src="/css/productImages/{{$image}}" alt="{{$product->title}}"></a>
                                    <div class="product_content">
                                        <div class="product_title">{{$product->brand}} {{$product->title}}</div>
                                            <div class="prices">
                                            @if($product->new_price != $product->old_price)
                                                <div class="product_price" >&euro; {{$product->old_price}}</div>
                                                <div class="product_new_price">&euro; {{$product->new_price}}</div>
                                            @else
                                                <div class="product_price1">&euro; {{$product->old_price}}</div>
                                            @endif    
                                        </div>  
                                    </div>    
                                </div>
                           </div>
                        @endforeach                      
                    </div>
                </div>
                {{$products->appends(request()->query())->links('pagination.pagination')}}
            </div>
        </div>
    </div>
    
    

@endsection

@section('custom_js')
    <script>
       $(document).ready(function () {
            $('.product_sorting_btn').click(function () {
                let orderBy = $(this).data('order')
                $('.sorting_text').text($(this).find('span').text())
                $.ajax({
                    url: "{{route('showCategory',$categ->alias)}}",
                    type: "GET",
                    data: {
                        orderBy: orderBy,
                        page: {{isset($_GET['page']) ? $_GET['page'] : 1}},
                    },
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: (data) => {
                        let positionParameters = location.pathname.indexOf('?');
                        let url = location.pathname.substring(positionParameters,location.pathname.length);
                        let newURL = url + '?'; // http://127.0.0.1:8001/category/mens_clothing?
                        newURL += 'orderBy=' + orderBy + "&page={{isset($_GET['page']) ? $_GET['page'] : 1}}"; // http://127.0.0.1:8001/category/mens_clothing?orderBy=price-low-high
                        history.pushState({}, '', newURL);
                        $('.product_pagination a').each(function(index, value){
                            let link= $(this).attr('href')
                            $(this).attr('href',link+'&orderBy='+orderBy)
                        })
                        $('.product_grid').html(data)
                        $('.product_grid').isotope('destroy')
                        $('.product_grid').imagesLoaded( function() {
                            let grid = $('.product_grid').isotope({
                                itemSelector: '.product',
                                layoutMode: 'fitRows',
                                fitRows:
                                    {
                                        gutter: 30
                                    }
                            });
                        });
                    }
                });
            })
        })
    </script>
@endsection