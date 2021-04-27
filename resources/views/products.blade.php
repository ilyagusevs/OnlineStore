@extends('layouts.navbar-footer')

@section('title', $categ_slug->title)

@section('content')
    <head>
        <link rel="stylesheet" href="/css/products.css">
    </head>   
    <div class="products">
        <div class="container">
                <div class="row">
                    <div class="col">
                        <!-- Product Sorting -->
                        <div class="sorting_bar d-flex flex-md-row flex-column align-items-md-center justify-content-md-start">
                            <div class="sorting_container ml-md-auto">
                                <div class="sorting">
                                    <ul class="item_sorting">
                                        <li>
                                            <span class="sorting_text">Sort</span>
                                            <i class="fa fa-chevron-down" aria-hidden="true"></i>
                                            <ul>
                                                <li><a class="sort-font" href="{{ URL::current()."?sort=new" }}"><span>What's new</span></a></li>
                                                <li><a class="sort-font" href="{{ URL::current()."?sort=low-high" }}"><span>Low-High</span></a></li>
                                                <li><a class="sort-font" href="{{ URL::current()."?sort=high-low"}}"><span>High-Low</span></a></li>
                                            </ul>
                                        </li>
                                        <li>
                                            <span class="filtering_text">Brand</span>
                                            <i class="fa fa-chevron-down" aria-hidden="true"></i>
                                            <ul>
                                                <li><a class="sort-font" href="{{ URL::current() }}"><span>All brands</span></a></li>
                                                <li><a class="sort-font" href="{{ URL::current()."?filter=nike" }}"><span>Nike</span></a></li>
                                                <li><a class="sort-font" href="{{ URL::current()."?filter=adidas" }}"><span>Adidas</span></a></li>
                                                <li><a class="sort-font" href="{{ URL::current()."?filter=reebok"}}"><span>Reebok</span></a></li>
                                            </ul>
                                        </li>
                                        @if($categ_slug->title == 'Trainers' or $categ_slug->title == 'Football' or $categ_slug->title == 'Basketball'
                                        or $categ_slug->title == 'Fitness'or $categ_slug->title == 'Running')
                                            <li>
                                                <span class="filtering_text">Size</span>
                                                <i class="fa fa-chevron-down" aria-hidden="true"></i>
                                                <ul>
                                                    <li><a class="sort-font" href="{{ URL::current()."?filter-size=38" }}"><span>38</span></a></li>
                                                    <li><a class="sort-font" href="{{ URL::current()."?filter-size=39" }}"><span>39</span></a></li>
                                                    <li><a class="sort-font" href="{{ URL::current()."?filter-size=40" }}"><span>40</span></a></li>
                                                    <li><a class="sort-font" href="{{ URL::current()."?filter-size=41" }}"><span>41</span></a></li>
                                                    <li><a class="sort-font" href="{{ URL::current()."?filter-size=42" }}"><span>42</span></a></li>
                                                    <li><a class="sort-font" href="{{ URL::current()."?filter-size=43" }}"><span>43</span></a></li>
                                                    <li><a class="sort-font" href="{{ URL::current()."?filter-size=44" }}"><span>44</span></a></li>
                                                </ul>
                                            </li>
                                        @elseif($categ_slug->title == 'Hoodies' or $categ_slug->title == 'Shorts' or $categ_slug->title == 'Shirts')
                                            <li>
                                                <span class="filtering_text">Size</span>
                                                <i class="fa fa-chevron-down" aria-hidden="true"></i>
                                                <ul>
                                                    <li><a class="sort-font" href="{{ URL::current()."?filter-size=xs" }}"><span>XS</span></a></li>
                                                    <li><a class="sort-font" href="{{ URL::current()."?filter-size=s" }}"><span>S</span></a></li>
                                                    <li><a class="sort-font" href="{{ URL::current()."?filter-size=m" }}"><span>M</span></a></li>
                                                    <li><a class="sort-font" href="{{ URL::current()."?filter-size=l" }}"><span>L</span></a></li>
                                                    <li><a class="sort-font" href="{{ URL::current()."?filter-size=xl" }}"><span>XL</span></a></li>
                                                </ul>
                                            </li>
                                        @elseif($categ_slug->title == 'Sunglasses')
                                            <li>
                                                <span class="filtering_text">Size</span>
                                                <i class="fa fa-chevron-down" aria-hidden="true"></i>
                                                <ul>
                                                    <li><a class="sort-font" href="{{ URL::current()."?filter-size=one-size" }}"><span>One size</span></a></li>
                                                </ul>
                                            </li>
                                        @endif
                                    </ul>
                                </div>
                            </div>
                        </div>                       
                    </div>
                </div>
            </div>
        <div class="container">
        <div style="margin-top: -30px; margin-bottom: 30px;"class="results">Showing <span>{{$products->count()}}</span> results</div>
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
                                    <a href="{{route('show-product',[$product->category['slug'], $product->slug])}}"><img src="/css/productImages/{{$image}}" alt="{{$product->title}}"></a>
                                    <div class="product_content">
                                        <div class="product_title">{{ $product->brand->title }} {{$product->title}}</div>
                                            <div class="prices">
                                            @if($product->new_price != $product->old_price)
                                                <div class="product_price" >&euro; {{ number_format($product->old_price, 2, '.', '') }}</div>
                                                <div class="product_new_price">&euro; {{ number_format($product->new_price, 2, '.', '') }}</div>
                                            @else
                                                <div class="product_price1">&euro; {{ number_format($product->old_price, 2, '.', '') }}</div>
                                            @endif    
                                        </div>  
                                    </div>    
                                </div>
                           </div>
                        @endforeach                      
                    </div>
                </div>
                {{ $products->appends(request()->query())->links('pagination.pagination') }}
            </div>
        </div>
    </div>
@endsection
