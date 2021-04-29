@extends('admin.admin')

@section('content')

    @if(Session::has('success'))
        <div style="margin-top: 20px;" class="alert alert-success" role="alert">
 	        {{Session::get('success')}}
        </div>
    @endif
    <h1 style="margin-top: 30px; margin-bottom: 20px;">All products</h1>
    <a href="{{ route('admin.product.create') }}" class="btn btn-success mb-4">
        Add product
    </a>
    <table class="table table-bordered">
        <tr>
            <th width="10%">Image</th>
            <th width="25%">Title</th>
            <th width="65%">Description</th>
            <th>Actions</th>
        </tr>
        @foreach ($products as $product)
            @php
                $image = '';
                if(count($product->images) > 0){
                    $image = $product->images[0]['img'];
                } else {
                    $image = 'no_image.png';
                }
            @endphp
        <tr>
            <td><a href="{{ route('admin.product.show', ['product' => $product->id]) }}"><img style="width: 110px;"  src="/css/productImages/{{$image}}" alt="{{$product->title}}"></a></td>
            <td>
                <a href="{{ route('admin.product.show', ['product' => $product->id]) }}">
                    {{ $product->title }}
                </a>
            </td>
            <td>{{ $product->description }}</td>
            <td>
                <a href="{{ route('admin.product.edit', ['product' => $product->id]) }}">
                    <i class="far fa-edit"></i>
                </a>
                <form action="{{ route('admin.product.destroy', ['product' => $product->id]) }}"
                      method="post" onsubmit="return confirm('Delete this product?')">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="m-0 p-0 border-0 bg-transparent">
                        <i class="far fa-trash-alt text-danger"></i>
                    </button>
                </form>
            </td>
        </tr>
        @endforeach
    </table>
    {{$products->appends(request()->query())->links('pagination.pagination')}}
@endsection
