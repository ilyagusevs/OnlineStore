<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="/css/login-register.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Lilita+One&display=swap" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat&display=swap" rel="stylesheet">
</head>
<title>Join</title>
<body style="background-color:#F9F9F8;">
    <div class="container">
        <a style="font-size: 32px;" class="navbar-brand" href="/">JUST SPORT</a>
            <div class="card">
                <div class="login-register">
                    <a class="log-reg" href="{{route('login')}}" >
                        ALREADY REGISTRED?
                    </a>
                </div>
                <span style="display: flex; justify-content: center; margin-bottom: 20px;">SIGN UP USING YOUR EMAIL</span>
            <form class="col-lg-6 offset-lg-3" method="POST" action="{{route('register')}}" aria-label="Register">
            @csrf
                <span>EMAIL ADDRESS:</span>
                <input style="margin-top: 10px;" id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" autofocus> 
                <div class="invalid-feedback">
                    Email already used!
                </div>
                <br>
                <span>FIRST NAME:</span>
                <input style="margin-top: 10px;"  id="firstname" type="text" class="form-control" name="firstname">
                <br>
                <span>LAST NAME:</span>
                <input style="margin-top: 10px;"  id="lastname" type="text" class="form-control" name="lastname">
                <br>
                <span>PASSWORD:</span>
                <input style="margin-top: 10px;"  id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password">
                <div class="invalid-feedback">
                    Password mismatch!
                </div>
                <br>
                <span>CONFIRM PASSWORD:</span>
                <input style="margin-top: 10px;" id="password-confirm" type="password" class="form-control" name="password_confirmation">
                <button style="margin-bottom: 10px;" class="btn btn-lg btn-primary btn-block btn-signin" type="submit">JOIN</button>
            </form><!-- /form -->
        </div><!-- /card-container -->
    </div><!-- /container -->
</body>
</html>



