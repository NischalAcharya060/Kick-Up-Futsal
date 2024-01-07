<!DOCTYPE html>
<html lang="en">
<head>
    <title>User Dashboard</title>
</head>
<body>
<h1>Welcome to the User Dashboard!</h1>
<form action="{{ route('logout') }}" method="get">
    @csrf
    <button type="submit">Logout</button>
</form>
</body>
</html>
