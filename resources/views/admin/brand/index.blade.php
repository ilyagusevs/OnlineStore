@extends('admin.admin')

@section('content')
    @if(Session::has('errors'))
        <div style="margin-top: 30px; margin-bottom: 20px;" class="alert alert-danger" role="alert">
 	        {{Session::get('errors')->first()}}
        </div>
    @endif
    @if(Session::has('success'))
        <div style="margin-top: 20px;" class="alert alert-success" role="alert">
 	        {{Session::get('success')}}
        </div>
    @endif
    <h1 style="margin-top: 30px; margin-bottom: 20px;">All brands</h1>
    <a href="{{ route('admin.brand.create') }}" class="btn btn-success mb-4">
        Add brand
    </a>
    <table class="table table-bordered w-auto">
        <tr>
            <th width="20%">Title</th>
            <th width="20%">Slug</th>
            <th width="10%">Actions</th>
        </tr>
        @foreach ($brands as $brand)
        <tr>
            <td>{{ $brand->brand }}</td>
            <td>{{ $brand->brand_slug }}</td>
            <td>
                <a href="{{ route('admin.brand.edit', ['brand' => $brand->b_id]) }}">
                    <i class="far fa-edit"></i>
                </a>
                <form action="{{ route('admin.brand.destroy', ['brand' => $brand->b_id]) }}"
                      method="post" onsubmit="return confirm('Delete this brand?')">
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
@endsection
