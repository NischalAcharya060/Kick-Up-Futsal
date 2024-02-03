<footer class="footer">
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <div class="footer-nav">
                    <ul class="list-unstyled">
                        <li><a href="{{ route('user.dashboard') }}"><i class='bx bxs-home'></i> Home</a></li>
                        <li><a href="#"><i class='bx bxs-info-circle'></i> About</a></li>
                        <li><a href="{{ route('contact.show') }}"><i class='bx bx-envelope'></i> Contact Us</a></li>
                        <li><a href="{{ route('user.calendar') }}"><i class='bx bxs-calendar'></i> Calendar</a></li>
                        <li><a href="{{ route('user.booking.index') }}"><i class='bx bxs-calendar'></i> Booking</a></li>
                        <li><a href="{{ route('user.profile') }}"><i class='bx bx-user'></i> My Profile</a></li>
                        <li><a href="{{ route('user.facility_submissions.create') }}"><i class='bx bx-plus'></i> List Your Facility</a></li>
                        <li><a href="{{ route('logout') }}"><i class='bx bx-log-out'></i> Logout</a></li>
                    </ul>
                </div>
            </div>
            <div class="col-md-6">
                <div class="footer-bottom text-md-right">
                    <p>&copy; {{ date('Y') }} Kick Up Futsal. All rights reserved.</p>
                </div>
            </div>
        </div>
    </div>
</footer>

<style>
    .footer {
        background-color: #000;
        color: #fff;
        padding: 20px 0;
        margin-top: 70px;
    }

    .footer-nav ul {
        list-style: none;
        padding: 0;
        margin: 0;
    }

    .footer-nav li {
        display: inline-block;
        margin-right: 15px;
    }

    .footer-nav a {
        color: #fff;
        text-decoration: none;
        display: flex;
        align-items: center;
        transition: color 0.3s ease;
    }

    .footer-nav a:hover {
        color: #888;
    }

    .footer-nav i {
        margin-right: 5px;
    }

    .footer-bottom p {
        margin-bottom: 0;
        color: #888;
    }
</style>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/boxicons/2.0.7/css/boxicons.min.css">
