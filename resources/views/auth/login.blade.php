<head>
    <link rel="stylesheet" href="/css/login-register.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Lilita+One&display=swap" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat&display=swap" rel="stylesheet">
</head>

<body style="background-color:#F9F9F8;">
<title>Sign in</title>
<div class="container">
    <a style="font-size: 32px;" class="navbar-brand" href="/">JUST SPORT</a>
        <div class="card ">
            <a style="display: flex; justify-content: center; margin-bottom: 20px;">SIGN IN WITH EMAIL</a>
            <p id="profile-name" class="profile-name-card"></p>
            <form class="col-lg-6 offset-lg-3">
                <span id="reauth-email" class="reauth-email"></span>
                <a>EMAIL ADDRESS:</a>
                <input style="margin-bottom: 40px; margin-top: 10px;"  type="email" id="inputEmail" class="form-control" required autofocus>
                <a>PASSWORD:</a>
                <input style="margin-top: 10px;" type="password" id="inputPassword" class="form-control" required>
                <button class="btn btn-lg btn-primary btn-block btn-signin" type="submit">SIGN IN</button>
            </form><!-- /form -->
            <a style="display: flex; justify-content: center; font-size: 14px;"  href="#" class="forgot-password">
                Forgot the password?
            </a>
        </div><!-- /card-container -->
    </div><!-- /container -->
</body>



