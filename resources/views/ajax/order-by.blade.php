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