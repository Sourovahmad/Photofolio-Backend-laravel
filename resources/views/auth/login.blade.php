<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

     <!-- bootstrap cdn link -->
     <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">
     <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js" integrity="sha384-JEW9xMcG8R+pH31jmWH6WWP0WintQrMb4s7ZOdauHnUtxwoG2vI5DkLtS3qm9Ekf" crossorigin="anonymous"></script>
     <script src="https://unpkg.com/react-bootstrap@next/dist/react-bootstrap.min.js" crossorigin></script>
     <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous" />

     <!-- font awesome cdn link -->
     <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/>
     <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/duotone.css" integrity="sha384-R3QzTxyukP03CMqKFe0ssp5wUvBPEyy9ZspCB+Y01fEjhMwcXixTyeot+S40+AjZ" crossorigin="anonymous"/>
     <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/fontawesome.css" integrity="sha384-eHoocPgXsiuZh+Yy6+7DsKAerLXyJmu2Hadh4QYyt+8v86geixVYwFqUvMU8X90l" crossorigin="anonymous"/>

    <!-- custom css link -->
    <link rel="stylesheet" href="{{ asset('css/login.css') }}">
</head>
<body>
    <section class="login_area">
        <div class="overflow-hidden">
            <div class="row">
                <div class="col-md-7">
                    <div class="share_area">
                        <h2>scopes</h2>
                        <h6>Get Hired, Create,</h6>
                        <h6>Shoot, Share.</h6>
                    </div>
                </div>

                <div class="col-md-5">

                @if($message = Session::get('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <strong>{{ $message }}</strong>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            @foreach($errors->all() as $error)

                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <strong>{{ $error }}</strong>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endforeach
                        <div class="login_inner pb-5 mb-5">
                        <div class="pt-2">
                            <h4>Log In</h4>
                            <p class="sub_title">You are new here? <a href="{{ route('registerGet') }}">Register</a></p>
                        </div>

                        <form action="{{ route('login_post') }}" method="POST">
                            @csrf


                            <div class="pb-2">
                                <label class="label" for="email">E-Mail Address</label><br />
                                <input class="input form-control" type="email" name="email" id="email">
                            </div>



                            <div class="pb-2">
                                <label class="label" for="password">Password</label><br />
                                <input class="input form-control" type="password" name="password" id="password">
                            </div>




                            <div class="text-end">
                                <button class="loginBtn mt-5">Log In</button>
                            </div>
                        </form>

                        <div class="social_login mt-5 pt-3">
                            <div class="pb-3">
                                <button class="btn one">Log In With Google</button>
                            </div>

                            <div class="pb-3">
                                <button class="btn two">Log In With Google</button>
                            </div>

                            <div>
                                <button class="btn three">Log In With Apple</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <footer class="footer_area pt-3">
        <div class="container">
            <div class="row">
                <div class="offset-md-3 col-md-5">
                    <p>Copyright &copy; 2020 - Tum haklan Saklidir.</p>
                </div>

                <div class="col-md-4">
                    <div class="social_area">
                        <a href="#" ><i class="fab fa-facebook-f"></i></a>
                        <a href="#"><i class="fab fa-twitter"></i></a>
                        <a href="#"><i class="fab fa-instagram"></i></a>
                        <a href="#"><i class="fab fa-linkedin-in"></i></a>
                    </div>
                </div>
            </div>
        </div>
    </footer>
</body>
</html>
