<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BeSmart - Login</title>
    <link rel="shortcut icon" href="{{ asset("img/logo.png") }}">
    <link rel="stylesheet" href="{{ asset("css/app.css") }}">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" integrity="sha512-iBBXm8fW90+nuLcSKlbmrPcLa0OT92xO1BIsZ+ywDWZCvqsWgccV3gFoRBv0z+8dLJgyAHIhR35VZc2oM/gI1w==" crossorigin="anonymous" />
</head>
<body style="background-color: #eeeff3;">
    <div class="container">
        <div id="title-login">
            <div id="title">
                <p class="mb-0 title-web" style="font-size: 25px;">
                    <span>
                        <img src="{{ asset("img/logo.png") }}" width="45px">
                    </span>
                    <span id="title-name">BE-SMART Login
                </p>
            </div>
        </div>
        <div class="">
            <div id="login-box" class="mx-auto">
                <div class="card">
                    <div class="card-header">
                        <p class="text-center mb-0">
                            Silahkan login dahulu!
                        </p>
                    </div>
                    <div class="card-body">
                        @if (Session::has("error"))
                            <span class="text-danger">
                                <p class="text-center font-weight-bold">
                                    <i class="fa fa-exclamation-circle" aria-hidden="true"></i> {{ Session::get("error") }}
                                </p>
                            </span>
                        @endif
                        <form action="{{ route("login.attempt") }}" method="post">
                            @csrf
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="inputGroup-sizing-default">
                                        <i class="fa fa-user" aria-hidden="true"></i>
                                    </span>
                                </div>
                                <input type="text" class="form-control" name="username" placeholder="Type your username">
                            </div>
                            @error('username')
                                <div class="text-danger mb-2">
                                    {{ $message }}
                                </div>
                            @enderror
                            <div class="input-group mt-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="inputGroup-sizing-default">
                                        <i class="fa fa-lock" aria-hidden="true"></i>
                                    </span>
                                </div>
                                <input type="password" class="form-control" name="password" placeholder="Type your password">
                            </div>
                            @error('password')
                                <div class="text-danger mb-2">
                                    {{ $message }}
                                </div>
                            @enderror
                            <button type="submit" class=" btn btn-block mt-3">Sign In</button>
                        </form>
                    </div>
                    <div class="card-footer text-center text-sm">
                        Powered by Smart Lock
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>