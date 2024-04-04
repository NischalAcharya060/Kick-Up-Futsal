<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <title>Kick Up Futsal | Verification Page</title>
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
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>
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
                    <h1 class="login-title">Verify Your Account</h1>
                    @if(session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif
                    @if (session('message'))
                        <div class="alert alert-danger">{{ session('message') }}</div>
                    @endif
                    @if (session('error'))
                        <div class="alert alert-danger">{{ session('error') }}</div>
                    @endif
                    <form method="POST" action="{{ route('verify') }}" id="verifyForm">
                        @csrf
                        <div class="form-group">
                            <label for="verification_code">Verification Code</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="mdi mdi-lock"></i></span>
                                </div>
                                <input
                                    id="verification_code"
                                    type="text"
                                    name="verification_code"
                                    class="form-control"
                                    placeholder="Enter your verification code"
                                    required
                                    autofocus
                                />
                            </div>
                            @error('verification_code')
                            <span class="error-message">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="g-recaptcha" data-sitekey="6LdW2KgpAAAAAL1qoAiF_OIpeYYTMT2fIi-VlAx4"></div>
                        @error('g-recaptcha-response')
                        <span class="error-message">{{ $message }}</span>
                        @enderror
                        <br>
                        <button
                            name="verify"
                            id="verify"
                            class="btn btn-block login-btn"
                            type="submit"
                        >
                            <i class="mdi mdi-check-circle"></i> Verify
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
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
</body>
</html>
