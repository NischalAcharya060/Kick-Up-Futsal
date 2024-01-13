<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <title>Kick Up Futsal | Forgot Password</title>
    <link
        href="https://fonts.googleapis.com/css?family=Karla:400,700&display=swap"
        rel="stylesheet"
    />
    <link
        rel="stylesheet"
        href="https://cdn.materialdesignicons.com/4.8.95/css/materialdesignicons.min.css"
    />
    <link
        rel="stylesheet"
        href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css"
    />
    <link rel="stylesheet" href="{{ asset('css/auth.css') }}" />

</head>
<body>
<main>
    <div class="container-fluid">
        <div class="row">
            <div class="col-12 col-sm-6 login-section-wrapper mx-auto">
                <div class="brand-wrapper">
                    <img src="{{ asset('img/logo.png') }}" alt="logo" class="logo" />
                </div>
                <div class="login-wrapper my-auto">
                    <h1 class="login-title">Forgot Password</h1>
                    <form method="POST" action="{{ route('password.email') }}">
                        @csrf
                        @if(session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif
                        <div class="form-group">
                            <label for="email">E-Mail Address</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="mdi mdi-email"></i></span>
                                </div>
                                <input
                                    type="email"
                                    name="email"
                                    id="email"
                                    class="form-control"
                                    placeholder="Enter your email"
                                    value="{{ old('email') }}"
                                    autofocus
                                    autocomplete="email"
                                />
                            </div>
                            @error('email')
                            <span class="error-message">{{ $message }}</span>
                            @enderror
                        </div>
                        <button
                            name="login"
                            id="login"
                            class="btn btn-block login-btn"
                            type="submit"
                        >
                            <i class="mdi mdi-lock-reset"></i> Forgot Password
                        </button>
                    </form>
                    <div style="text-align: right;">
                    <p class="login-wrapper-footer-text">
                        <a href="{{ route('login') }}" style="color: #121257; text-decoration: none;"><i class="mdi mdi-account-plus"></i> Back to Login</a>
                    </p>
                    </div>
                </div>
            </div>
            <div class="col-sm-6 px-0 d-none d-sm-block" style="background-color: #ffffff">
                <img src="{{ asset('img/logo.png') }}" alt="login image" class="login-img" />
            </div>
        </div>
    </div>
</main>
</body>
</html>
