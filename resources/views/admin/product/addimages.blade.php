@extends('admin.admin')

@section('content')
@if(Session::has('success'))
        <div style="margin-top: 20px;" class="alert alert-success" role="alert">
 	        {{Session::get('success')}}
        </div>
    @endif

<h1 style="margin-top: 30px; margin-bottom: 20px;">Product Images</h1>

<form name="addImageForm" id="addImageForm" method="post" action="{{ url('admin/add-images/'.$productData['id']) }}" enctype="multipart/form-data">
    @csrf
        <div class="col-md-6">
            <p><strong>Title:</strong> {{ $productData['title'] }}</p>
            <p><strong>Slug:</strong> {{ $productData['slug'] }}</p>
            <div class="form-group">
                <div class="field_wrapper">
                    <div>
                        <input multiple="" id="images" name="images[]" type="file" name="images[]" value="" required=""/>
                    </div>
                </div>
            </div>
        </div>
        <button style="margin-top: 20px; margin-bottom: 30px;" type="submit" class="btn btn-success">
            Add Image(s)
        </button>
</form>
        <table class="table table-bordered table-stripped w-auto">
            <thead>
                <tr>
                    <th width ="5%">ID</th>
                    <th width ="50%">Image</th>
                    <th>Delete Image?</th>
                </tr>
            </thead>
            <tbody>
                @foreach($productData['images'] as $image)
                    <tr>
                        <td>{{$image['id']}}</td>
                        <td> <img style="width: 150px;" src="/css/productImages/{{$image['img']}}" alt="{{$productData['title']}}"></td>
                        <form name="DeleteImageForm" id="DeleteImageForm" method="get" action="{{ url('admin/delete-image/'.$image['id']) }}" onsubmit="return confirm('Delete this image?')" enctype="multipart/form-data">
                            <td>
                                <button  type="submit"class="m-0 p-0 border-0 bg-transparent">
                                    <i class="far fa-trash-alt text-danger"></i>
                                </button>
                            </td>
                        </form>
                    </tr>
                @endforeach
            </tbody>
        </table>
@endsection

