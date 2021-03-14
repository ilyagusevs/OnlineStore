@extends('layouts.navbar-footer')

@section('title', $categ->title)

@section('content')
    <head>
        <link rel="stylesheet" href="/css/categories.css">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous"/>
    </head>   

    <div class="home-title"><h1>{{$categ->title}}</h1></div>

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
                                            <li class="product_sorting_btn" data-order="default"><span>Default</span></li>
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
                                <div class="product_image"><img src="/css/productImages/{{$image}}" alt="{{$product->title}}">
                                    <div class="product_content">
                                        <div class="product_title"><a href="{{route('showProduct',[$product->category['alias'], $product->id])}}">{{$product->title}}</a></div>
                                        @if($product->new_price != null)
                                            <div style="text-decoration: line-through">&euro; {{$product->old_price}}</div>
                                            <div class="product_price">&euro; {{$product->new_price}}</div>
                                        @else
                                            <div class="product_price">&euro; {{$product->price}}</div>
                                        @endif      
                                    </div>    
                                </div>
                           </div>
                        @endforeach
                    </div>

                </div>
            </div>
        </div>
    </div>


@endsection

@section('custom_js')
    <script>
        $(document).ready(function () {
            $('.product_sorting_btn').click(function () {
                let orderBy = $(this).data('order')
               
                $.ajax({
                    url: "{{route('showCategory',$categ->alias)}}",
                    type: "GET",
                    data: {
                        orderBy: orderBy
                       
                    },
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: (data) => {
                       console.log(data)
                         
                    }
                });
            })
        })
    </script>
@endsection