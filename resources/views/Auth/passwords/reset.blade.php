<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <title>Kick Up Futsal | Reset Password</title>
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
                    <h1 class="login-title">Reset Password</h1>
                    <form method="POST" action="{{ route('password.update') }}">
                        @csrf
                        <input type="hidden" name="token" value="{{ $token }}">
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
                                <div class="input-group-append">
                                    <span class="input-group-text" onclick="passwordconfirm()" id="show-hide-password-confirm" style="cursor: pointer;"><i class="mdi mdi-eye"></i></span>
                                </div>
                            </div>
                            @error('password-confirm')
                            <span class="error-message">{{ $message }}</span>
                            @enderror
                        </div>
                        <button
                            name="login"
                            id="login"
                            class="btn btn-block login-btn"
                            type="submit"
                        >
                            <i class="mdi mdi-lock-reset"></i> Reset Password
                        </button>
                    </form>
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
</body>
</html>
