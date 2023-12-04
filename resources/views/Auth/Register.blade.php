<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Register</title>
</head>
<body>
    <h2>Register</h2>
    <form method="POST" action="{{ route('register') }}">
        @csrf

        <div>
            <label for="name">Name</label>
            <input id="name" type="text" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>
        @error('name')
        <span>{{ $message }}</span>
        @enderror
        </div>

        <div>
            <label for="email">E-Mail Address</label>
            <input id="email" type="email" name="email" value="{{ old('email') }}" required autocomplete="email">
        @error('email')
        <span>{{ $message }}</span>
        @enderror
        </div>

        <div>
            <label for="password">Password</label>
            <input id="password" type="password" name="password" required autocomplete="new-password">
        @error('password')
        <span>{{ $message }}</span>
        @enderror
        </div>

        <div>
            <label for="password-confirm">Confirm Password</label>
            <input id="password-confirm" type="password" name="password_confirmation" required autocomplete="new-password">
        @error('password-confirm')
        <span>{{ $message }}</span>
        @enderror
        </div>

        <div>
            <button type="submit">Register</button>
        </div>

        <div>
            Already have an account? <a href="{{ route('login') }}">Login here</a>
        </div>

    </form>

</body>
</html>
