<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <meta name="google-signin-client_id" content="507326692367-toq9mfki6g9lqvdq17jm661t13k3tbg3.apps.googleusercontent.com">
    <title>Kick Up Futsal | Login</title>
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
                    <h1 class="login-title">Log in Your Account</h1>
                    <form method="POST" action="{{ route('login') }}">
                        @csrf
                        @if(session('success'))
                            <div class="alert alert-success">
                                {{ session('success') }}
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
                        <div class="form-group mb-4">
                            <label for="password">Password</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="mdi mdi-lock"></i></span>
                                </div>
                                <input
                                    type="password"
                                    name="password"
                                    id="password"
                                    class="form-control"
                                    placeholder="Enter your password"
                                    required
                                    autocomplete="new-password"
                                />
                                <div class="input-group-append">
                                    <span class="input-group-text" onclick="password()" id="show-hide-password" style="cursor: pointer;"><i class="mdi mdi-eye"></i></span>
                                </div>
                            </div>
                            @error('password')
                            <span class="error-message">{{ $message }}</span>
                            @enderror
                        </div>
                        <button
                            name="login"
                            id="login"
                            class="btn btn-block login-btn"
                            type="submit"
                        >
                            <i class="mdi mdi-login"></i> Login
                        </button>
                    </form>
                    <p class="login-wrapper-footer-text">
                        Don't have an account?
                        <a href="{{ route('register') }}" style="color: #121257; text-decoration: none;"><i class="mdi mdi-account-plus"></i> Register here</a>
                    </p>
                    <div class="separator"></div>
                    <button onclick="window.location='{{ route('login.google') }}'" class="btn google btn-danger btn-lg btn-block mt-3">
                        <i class="mdi mdi-google mr-2"></i> Log In with Google
                    </button>
                </div>
            </div>
            <div class="col-sm-6 px-0 d-none d-sm-block" style="background-color: #ffffff">
                <img src="{{ asset('img/logo.png') }}" alt="login image" class="login-img" />
            </div>
        </div>
    </div>
</main>
<script src="{{ asset('js/admin_dashboard.js') }}"></script>
<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
<script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
<script src="https://apis.google.com/js/platform.js" async defer></script>
</body>
</html>
