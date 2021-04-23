<!DOCTYPE html>
<html> 
<head>
    <title>ADMIN PANEL</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">
    <link rel="stylesheet" href="/css/admin-panel.css">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Lilita+One&display=swap" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat&display=swap" rel="stylesheet">
    <script src="https://kit.fontawesome.com/d5003edbf4.js" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
</head>
<script type="text/javascript">
  $(document).ready(function(){
    var maxField = 10; //Input fields increment limitation
    var addButton = $('.add_button'); //Add button selector
    var wrapper = $('.field_wrapper'); //Input field wrapper
    var fieldHTML = '<div><input style="margin-top: 10px;" placeholder="Size" type="text" name="size[]" value=""/><input style="margin-left: 5px;" type="text" name="slug[]" placeholder="Slug" value=""/><input style="margin-left: 5px;" type="number" name="stock[]" placeholder="Stock" value=""/><a href="javascript:void(0);" style="margin-left: 3px;" class="remove_button">Remove</a></div>'; //New input field html 
    var x = 1; //Initial field counter is 1
    
    //Once add button is clicked
    $(addButton).click(function(){
        //Check maximum number of input fields
        if(x < maxField){ 
            x++; //Increment field counter
            $(wrapper).append(fieldHTML); //Add field html
        }
    });
    
    //Once remove button is clicked
    $(wrapper).on('click', '.remove_button', function(e){
        e.preventDefault();
        $(this).parent('div').remove(); //Remove field html
        x--; //Decrement field counter
    });
});
</script>
<body>
<nav class="navbar navbar-expand-lg navbar-light bg-light">
<div class="container">
  <a class="navbar-brand" href="{{route('welcome')}}">JUST SPORT</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarNav">
    <ul class="navbar-nav">
      <li class="nav-item active">
        <a class="nav-link" href="{{route('admin.product.index')}}">Products</a>
      </li>
      <li class="nav-item active">
        <a class="nav-link" href="{{route('admin.brand.index')}}">Brands</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="{{route('admin.category.index')}}">Categories</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="{{route('admin.order.index')}}">Orders</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="{{route('admin.user.index')}}">Users</a>
      </li>
    </ul>
  </div>
</div>
</nav>

<div class="container">
@yield('content')
</div>

</body>
</html>