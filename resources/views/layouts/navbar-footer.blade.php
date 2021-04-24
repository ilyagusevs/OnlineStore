<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8" />
    <title>@yield('title')</title>
    <link rel="stylesheet" href="/css/navbar-footer.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous"/>
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Lilita+One&display=swap" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat&display=swap" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
    <script src="https://kit.fontawesome.com/d5003edbf4.js" crossorigin="anonymous"></script>
    <link rel="icon" type="image/png" sizes="16x16" href="/favicon-16x16.png">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/css/bootstrap-select.min.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/js/bootstrap-select.min.js"></script>
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    
    <script src="https://ajax.aspnetcdn.com/ajax/jQuery/jquery-3.3.1.min.js"></script>
    <script src="https://unpkg.com/imagesloaded@4/imagesloaded.pkgd.min.js"></script>
  </head>   
  <body>
    <div class="page">
    <nav class="navbar navbar-expand-lg navbar-light bg-light" >
      <a style="font-size: 32px;" class="navbar-brand" href="{{ route('welcome') }}">JUST SPORT</a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav mr-auto">
          @foreach ($categories as $category)
        <li class="nav-item dropdown has-megamenu">
          <a class="nav-link dropdown-toggle"  href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            {{$category->title}}
          </a>
            <div style="margin-top: -1px; width: 69%; margin-left: 300px; background-color: whitesmoke; margin-top: -6px;" class="dropdown-menu megamenu" role="menu">
              <div class="row">
                <div class="col-md-3">
                  <div class="col-megamenu"> 
                      @foreach ($category->children as $child)
                        <div class="categ">
                          <h5 style="font-weight: bold;" class="category-title">{{$child->title}}</h5>
                          @foreach ($child->children as $child2)
                            <a style="margin:0;padding:0;"class="dropdown-item" href="{{route('show-category-product', $child2->slug)}}">{{$child2->title}}</a>
                          @endforeach  
                        </div>
                      @endforeach
                    
                  </div>  <!-- col-megamenu.// -->
                </div><!-- end col-3 -->   
              </div><!-- end row --> 
            </div> <!-- dropdown-mega-menu.// -->
          @endforeach
        </li>
      </ul>
    
    <div class="container h-100">
      <div class="d-flex justify-content-center h-100">
        <div class="searchbar">
          <input class="search_input" type="text" name="" placeholder="Search for items and brands">
          <a href="#" class="search_icon"><i class="fa fa-search"></i></a>
        </div>
      </div>
    </div>            
        
      <div class="profile">
        @admin
          <div class="admin-panel">
            <a href="{{route('admin.product.index')}}">Admin Panel</a>
          </div>
        @endadmin
         <ul class="navbar-nav">
		      <li style="width: 20px; margin-right: 25px;" class="nav-item dropdown">
            <a style="margin-top: 7px;" class="nav-link dropdown" href="#" data-toggle="dropdown"><i class="fa fa-user fa-lg" ></i></a>
              <ul class="dropdown-menu dropdown-menu-right" >
                @guest
                  <li class="auth"><a class="login" href="{{route('login')}}">Sign in </a><i>|</i><a class="register" href="{{route('register')}}">Join</a></li>
                @endguest
                @auth
                  <li class="auth" style="font-weight: bold; font-family: 'Montserrat', sans-serif; margin-left: 15px;" >Hi, {{ auth()->user()->firstname }}<a class="signout" href="{{route('get-logout')}}">Sign Out</a></li>
                @endauth
                <hr style="margin-top: -10px;">
                <a class="dropdown-item" href="/account"><i style="margin-right: 10px;" class="fas fa-user fa-lg"></i> My Account</a>
                <a class="dropdown-item" href="{{route('user.my-orders')}}"><i style="margin-right: 10px;" class="fas fa-box fa-lg"></i> My Orders</a>
              </ul>
		      </li>
	      </ul>
            <a style="margin-top: 22px; margin-right: -10px;" href="{{route('cart')}}">
              <i class="fa fa-shopping-cart fa-lg"></i>
            </a>

            <span style="height: 20px; margin-top: 15px; margin-left: -20px;" class="badge rounded-pill  bg-danger">@if ($positions) {{ $positions }} @endif</span>

      </div>
      </div>
    </nav>
        
  @yield('content')
          
  <footer class="bg-light text-center text-white">
    <div class="container p-4 pb-0">
      <section class="mb-4">
        <a href="https://www.facebook.com" class="facebook"></a>
        <a href="https://www.instagram.com/latvian.cars/" class="instagram"></a>
        <a href="https://www.twitter.com" class="twitter"></a>
      </section>
    </div>
    <div class="text-center p-3" style="background-color: rgba(0, 0 , 0, 0.2);">
      © 2021 Copyright:
      <a class="text-white" href="/">justsport.lv</a>
    </div>
    </footer>
  </div>
@yield('custom_js')
    </body>     
</html>
