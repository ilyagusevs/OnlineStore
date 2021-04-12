@extends('admin.admin')

@section('content')
@if(Session::has('success'))
        <div style="margin-top: 20px;" class="alert alert-success" role="alert">
 	        {{Session::get('success')}}
        </div>
    @endif
    @if(Session::has('error'))
        <div style="margin-top: 20px;" class="alert alert-danger" role="alert">
 	        {{Session::get('error')}}
        </div>
    @endif

<h1 style="margin-top: 30px; margin-bottom: 20px;">Product sizes</h1>

<form name="addSizeForm" id="addSizeForm" method="post" action="{{ url('admin/add-sizes/'.$product['id']) }}" enctype="multipart/form-data">
    @csrf
        <div class="col-md-6">
            <p><strong>Title:</strong> {{ $product['title'] }}</p>
            <p><strong>Slug:</strong> {{ $product['slug'] }}</p>
        </div>
        <input type="hidden" name="product_id" value="{{$product['id']}}">
        <div class="field_wrapper">
            <div>
                <input id="size" name="size[]" type="text" name="size[]" value="" placeholder="Size"/>
                <input id="slug" name="slug[]" type="text" name="slug[]" value="" placeholder="Slug"/>
                <a href="javascript:void(0);" class="add_button" title="Add field">Add</a>
            </div>
        </div>
        <button style="margin-top: 20px; margin-bottom: 30px;" type="submit" class="btn btn-success">
            Add Size(s)
        </button>
</form>
<form name="editSizeForm" id="EditForm" method="post" action="{{ url('admin/edit-sizes/'.$product['id']) }}" enctype="multipart/form-data">
    <table class="table table-bordered table-stripped w-auto">
        <h3 style="margin-bottom: 20px;" class="card-title">Added product sizes</h3>
        <thead>
            <tr>
                <th>ID</th>
                <th>Size</th>
                <th>Slug</th>
                <th>Delete size?</th>
            </tr>
        </thead>
        <tbody>
            @foreach($product['sizes'] as $size)
                @csrf
                <input type="hidden" name="size_id[]" value="{{$size['id']}}">
                <tr>
                    <td>{{$size['id']}}</td>
                    <td>
                        <input type="text" name="size[]" value="{{$size['size']}}" requared="">
                    </td>
                    <td>
                        <input type="text" name="slug[]" value="{{$size['slug']}}" requared="">
                    </td>
                    <td>
                        <form name="DeleteSizeForm" id="DeleteSizeForm" method="get" action="{{ url('admin/delete-sizes/'.$size['id']) }}" onsubmit="return confirm('Delete this size?')" enctype="multipart/form-data">
                            <button  type="submit"class="m-0 p-0 border-0 bg-transparent">
                                <i class="far fa-trash-alt text-danger"></i>
                            </button>
                        </form>
                    </td>
                 </tr>
            @endforeach
        </tbody>
    </table>
    <button style="margin-top: 10px;" type="submit" class="btn btn-success">
        Edit size(s)
    </button>
</form>
@endsection

