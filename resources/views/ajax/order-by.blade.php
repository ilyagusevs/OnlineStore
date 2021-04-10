<head>
    <link rel="stylesheet" href="/css/categories.css">
</head> 

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
            <a href="{{route('showProduct',[$product->category['slug'], $product->id])}}"><img src="/css/productImages/{{$image}}" alt="{{$product->title}}"></a>
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