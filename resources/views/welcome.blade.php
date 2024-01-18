<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kick Up Futsal</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <style>
        body {
            font-family: 'Karla', sans-serif;
            margin: 0;
            padding: 0;
            background-color: #D5EAF2;
            color: #121257;
        }

        header {
            background-color: #121257;
            color: white;
            text-align: center;
            padding: 4em 0;
        }

        header img {
            width: 280px;
        }

        section {
            text-align: center;
            padding: 4em 0;
        }

        h1 {
            color: #121257;
        }

        p {
            color: #6c757d;
            font-size: 1.2em;
            max-width: 800px;
            margin: 0 auto;
            line-height: 1.6;
        }

        .btn {
            display: inline-block;
            background-color: #121257;
            color: white;
            padding: 12px 24px;
            text-decoration: none;
            font-size: 1.2em;
            border-radius: 5px;
            margin-top: 1em;
            transition: background-color 0.3s, color 0.3s;
        }

        .btn:hover {
            background-color: black;
            color: white;
        }


        .features {
            display: flex;
            justify-content: space-around;
            margin-top: 4em;
        }

        .feature {
            text-align: left;
            max-width: 300px;
            padding: 20px;
            border-radius: 8px;
            background-color: #fff;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s;
        }

        .feature i {
            font-size: 2em;
            color: #121257;
        }

        .feature h3 {
            color: #121257;
            margin-top: 1em;
        }

        .feature p {
            color: #6c757d;
            font-size: 1em;
            line-height: 1.4;
        }

        .feature:hover {
            transform: translateY(-10px);
        }

        footer {
            background-color: #121257;
            color: white;
            text-align: center;
            padding: 1em 0;
        }
    </style>
</head>

<body>

<header>
    <img src="{{ asset('img/logo.png') }}" alt="logo" />
    <h1>Futsal Booking System</h1>
    <p>Book your favorite futsal ground with ease and enjoy the game with friends and family!</p>
    <a href="{{ route('register') }}" class="btn">Sign Up Now</a>
    <a href="{{ route('login') }}" class="btn">Login</a>
</header>

<section id="features">
    <h2>Key Features</h2>
    <section class="features">
        <div class="feature">
            <i class="fas fa-calendar-alt"></i>
            <h3>Easy Booking</h3>
            <p>Effortlessly schedule your futsal games online with our user-friendly booking system.</p>
        </div>
        <div class="feature">
            <i class="fas fa-trophy"></i>
            <h3>Tournaments</h3>
            <p>Play in tournaments, earn certificates, and engage in exciting matches to showcase your futsal skills.</p>
        </div>
        <div class="feature">
            <i class="fas fa-star"></i>
            <h3>Events</h3>
            <p>Explore weekly futsal challenges with top-notch facilities to enhance your gaming experience.</p>
        </div>
    </section>

</section>

<footer>
    &copy; 2024 Kick Up Futsal. All rights reserved.
</footer>

</body>

</html>
