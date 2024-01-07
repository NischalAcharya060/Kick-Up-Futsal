<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <title>Kick Up Futsal | Register</title>
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
    <link rel="stylesheet" href="https://cdn.materialdesignicons.com/4.8.95/css/materialdesignicons.min.css" />
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
                    <h1 class="login-title">Register Your Account</h1>
                    <form method="POST" action="{{ route('register') }}">
                        @csrf
                        <div class="form-group">
                            <label for="name">Name</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="mdi mdi-account"></i></span>
                                </div>
                            <input
                                id="name"
                                type="text"
                                name="name"
                                class="form-control"
                                placeholder="Enter your name"
                                value="{{ old('name') }}"
                                required
                                autocomplete="name"
                                autofocus
                            />
                            </div>
                            @error('name')
                            <span class="error-message">{{ $message }}</span>
                            @enderror
                        </div>
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
                            </div>
                            @error('password')
                            <span class="error-message">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group mb-4">
                            <label for="password-confirm">Confirm Password</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="mdi mdi-lock"></i></span>
                                </div>
                            <input
                                type="password"
                                name="password_confirmation"
                                id="password-confirm"
                                class="form-control"
                                placeholder="Re-enter your password"
                                required
                                autocomplete="new-password"
                            />
                            </div>
                            @error('password-confirm')
                            <span class="error-message">{{ $message }}</span>
                            @enderror
                        </div>
                        <button
                            name="register"
                            id="register"
                            class="btn btn-block login-btn"
                            type="submit"
                        >
                            <i class="mdi mdi-account-plus"></i> Register
                        </button>
                    </form>
                    <p class="login-wrapper-footer-text">
                        Already have an account?
                        <a href="{{ route('login') }}" style="color: #121257; text-decoration: none;"><i class="mdi mdi-login"></i> Login here</a>
                    </p>
                </div>
            </div>
            <div class="col-sm-6 px-0 d-none d-sm-block" style="background-color: #ffffff">
                <img src="{{ asset('img/logo.png') }}" alt="login image" class="login-img" />
            </div>
        </div>
    </div>
</main>
<script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
</body>
</html>
