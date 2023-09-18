<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link rel="stylesheet" href="{{ asset('frontend/css/register.css') }}">
        <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />
        <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">

    </head>
    <body class="antialiased">

                <div class="login-reg-panel">
                        <div class="login-info-box">
                            <h2>Have an account?</h2>
                            <p>Lorem ipsum dolor sit amet</p>
                            <label id="label-register" for="log-reg-show">Login</label>
                            <input type="radio" name="active-log-panel" id="log-reg-show"  checked="checked">
                        </div>
        
                                            
                        <div class="register-info-box">
                            <h2>Don't have an account?</h2>
                            <p>Lorem ipsum dolor sit amet</p>
                            <label id="label-login" for="log-login-show">Register</label>
                            <input type="radio" name="active-log-panel" id="log-login-show">
                        </div>
                                            
                        <div class="white-panel">
                            <form method="POST" action="{{ route('login') }}">
                                @csrf
                              <div class="login-show">
                                <h2>LOGIN</h2>
                                <input id="email" type="email" name="email" value="{{ old('email') }}" placeholder="Email">
                                <input id="password" type="password" name="password" placeholder="Password">
                                <input type="submit" value="Login">
                                <a href="{{ route('password.request') }}">Forgot password?</a>
                              </div>
                            </form>
                            <form method="POST" action="{{ route('register') }}">
                                @csrf  
                                <div class="register-show">
                                    <h2>REGISTER</h2>
                                    <input id="name" type="text" name="name" value="{{ old('name') }}" placeholder="Name">
                                    <input id="email" type="email" name="email" value="{{ old('email') }}" placeholder="Email">
                                    <input id="password" type="password" name="password" placeholder="Password">
                                    <input id="password_confirmation" name="password_confirmation" type="password" placeholder="Confirm Password">
                                    <input type="submit" value="Register">
                                    
                                    @if ($errors->any())
                                        <div class="alert alert-danger">
                                            <ul>
                                                @foreach ($errors->all() as $error)
                                                    <li>{{ $error }}</li>
                                                @endforeach
                                            </ul>
                                        </div>
                                    @endif
                                </div>
                             </form>
                        </div>
                    </div>

        <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
        <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
        <script src="{{ asset('frontend/js/register.js') }}"></script>
    </body>
</html>
