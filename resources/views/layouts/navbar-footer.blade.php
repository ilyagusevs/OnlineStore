<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <title>@yield('title')</title>
        <link rel="stylesheet" href="/css/navbar-footer.css">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous"/>
        <link rel="preconnect" href="https://fonts.gstatic.com">
        <link href="https://fonts.googleapis.com/css2?family=Lilita+One&display=swap" rel="stylesheet">

    </head>   
    <body>
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <a class="navbar-brand" style="font-size: 30px;" href="/">JUST SPORT</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item active">
                        <a class="nav-link" href="#">Home <span class="sr-only">(current)</span></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Features</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Pricing</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link disabled" href="#">Disabled</a>
                    </li>
                </ul>
            </div>
            <div class="search">
                <div class="search-form">
                    <input class="form-control mr-sm-2" type="search" placeholder="Search for items and brands" aria-label="Search">
                </div>              
                <a class="search-logo" href="/"></a>
            </div>
           
            <div class="profile">
                <a class="cart" href="/cart"></a>
                <a class="user-profile" href="/account"></a>
                <a class="logout" href="/"></a>
            </div>
            
        </nav>
        
        @yield('content')
        
        <footer class="bg-light text-center text-white">
          <div class="container p-4 pb-0">
            <section class="mb-4">
              <a href="https://www.facebook.com" class="facebook"></a>
              <a href="https://www.instagram.com" class="instagram"></a>
              <a href="https://www.twitter.com" class="twitter"></a>
            </section>
          </div>
          <div class="text-center p-3" style="background-color: rgba(0, 0 , 0, 0.2);">
            © 2021 Copyright:
            <a class="text-white" href="/">justsport.lv</a>
          </div>
        </footer>

@yield('custom_js')
    </body>     
</html>