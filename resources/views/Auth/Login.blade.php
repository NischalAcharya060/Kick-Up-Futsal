<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Login</title>
</head>
<body>
    <h2>Login</h2>
    <form method="POST" action="{{ route('login') }}">
        @csrf

        <div>
            <label for="email">E-Mail Address</label>
            <input id="email" type="email" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
        @error('email')
        <span>{{ $message }}</span>
        @enderror
        </div>

            <div>
            <label for="password">Password</label>
            <input id="password" type="password" name="password">
        @error('password')
        <span>{{ $message }}</span>
        @enderror
                </div>

                 <div>
            <button type="submit">Login</button>
                    </div>
    </form>

    <div>
        Don't have an account? <a href="{{ route('register') }}">Register here</a>
    </div>

</body>
</html>
