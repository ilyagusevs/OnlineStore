@extends('admin.admin')

@section('content')
    @if(Session::has('errors'))
        <div style="margin-top: 20px;" class="alert alert-danger" role="alert">
 	        {{Session::get('errors')->first()}}
        </div>
    @endif
    @if(Session::has('success'))
        <div style="margin-top: 20px;" class="alert alert-success" role="alert">
 	        {{Session::get('success')}}
        </div>
    @endif
<h1 style="margin-top: 30px; margin-bottom: 30px;">Category view</h1>
    <div class="row">
        <div class="col-md-6">
            <p><strong>Title:</strong> {{ $category->title }}</p>
            <p><strong>Slug:</strong> {{ $category->slug }}</p>
        </div>
    </div>
    @if ($category->children->count())
        <h2 style="margin-top: 30px; margin-bottom: 20px;">Subcategories</h2>
        <table class="table table-bordered">
            <tr>
                <th width="45%">Title</th>
                <th width="45%">Slug</th>
                <th>Actions</th>
            </tr>
            @foreach ($category->children as $child)
                <tr>
                    <td>
                        <a href="{{ route('admin.category.show', ['category' => $child->id]) }}" style="text-decoration: none;">
                            {{ $child->title }}
                        </a>
                    </td>
                    <td>{{ $child->slug }}</td>
                    <td style="display: flex;">
                        <a href="{{ route('admin.category.edit', ['category' => $child->id]) }}">
                            <i class="far fa-edit"></i>
                        </a>
                        <form action="{{ route('admin.category.destroy', ['category' => $child->id]) }}"
                              method="post" onsubmit="return confirm('Delete this category?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="m-0 p-0 border-0 bg-transparent">
                                <i style="margin-left: 10px;" class="far fa-trash-alt text-danger"></i>
                            </button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </table>
    @else
        <p>Subcategory doesn't exist! </p>
    @endif
    <form method="post" class="d-inline"
          action="{{ route('admin.category.destroy', ['category' => $category->id]) }}">
        @csrf
        @method('DELETE')
        <button type="submit" class="btn btn-danger" >
            Remove category
        </button>
    </form>
    <a href="{{url('admin/category')}}">
        <button class="btn btn-primary">
            Back to categories
        </button>
    </a>
@endsection
