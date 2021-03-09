@extends('layouts.navbar-footer')

@section('title', 'JUST SPORT')

@section('content')
    <head>
        <link rel="stylesheet" href="/css/home.css">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous"/>
    </head>   




    <div class="sale"></div>
    <div class="container">
        <div class="homeImage"></div>
            <div class="container p-4 pb-0 text-center">
                <section class="mb-4">
                <a class="nike"></a>
                <a class="adidas"></a>
                <a class="reebok"></a>
                </section>
            </div>
    </div>

    <!-- <div class="row">
        <div class="col-4 border">
            <ul>
                @foreach($categories as $parent)
                <li><a href="#link{{$loop->iteration}}" data-toggle="collapse">{{$parent->title}}</a>
                    @if($parent->children->count())
                    <ul id="link{{$loop->iteration}}" class="collapse">
                        @foreach($parent->children as $child)
                        <li><a href="{{route('showCategory', $parent->alias)}}">{{$child->title}}</a></li>
                        @endforeach
                    </ul>
                    @endif
                </li>
                @endforeach
            </ul>
        </div>
    </div> -->


        

@endsection