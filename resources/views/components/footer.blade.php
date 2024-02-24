<footer class="footer">
    <div class="container">
        <div class="row">
            <div class="col-md-6 col-sm-12">
                <div class="footer-nav">
                    <ul class="list-unstyled">
                        <li><a href="{{ route('user.dashboard') }}"><i class='bx bxs-home'></i> Home</a></li>
                        <li><a href="{{ route('about.show') }}"><i class='bx bxs-info-circle'></i> About</a></li>
                        <li><a href="{{ route('contact.show') }}"><i class='bx bx-envelope'></i> Contact Us</a></li>
                        <li><a href="{{ route('user.calendar') }}"><i class='bx bxs-calendar'></i> Calendar</a></li>
                        <li><a href="{{ route('user.booking.index') }}"><i class='bx bxs-calendar'></i> Booking</a></li>
                        <li><a href="{{ route('user.profile') }}"><i class='bx bx-user'></i> My Profile</a></li>
                        <li><a href="{{ route('user.facility_submissions.create') }}"><i class='bx bx-plus'></i> List Your Facility</a></li>
                        <li><a href="{{ route('logout') }}"><i class='bx bx-log-out'></i> Logout</a></li>
                    </ul>
                </div>
            </div>
            <div class="col-md-6 col-sm-12">
                <div class="footer-bottom text-md-right text-sm-center">
                    <p>&copy; {{ date('Y') }} Kick Up Futsal. All rights reserved.</p>
                </div>
            </div>
        </div>
    </div>
</footer>

<style>
    .footer {
        background: linear-gradient(to right, #222, #333);
        color: #fff;
        padding: 40px 0;
        margin-top: 70px;
    }

    .footer-nav ul {
        list-style: none;
        padding: 0;
        margin: 0;
        display: flex;
        flex-wrap: wrap;
        justify-content: space-between;
    }

    .footer-nav li {
        margin: 10px;
    }

    .footer-nav a {
        color: #fff;
        text-decoration: none;
        display: flex;
        align-items: center;
        transition: color 0.3s ease, background 0.3s ease;
        font-size: 16px;
        flex-direction: row;
    }

    .footer-nav a:hover {
        color: #FF5733;
        background: rgba(255, 253, 128, 0.1);
    }

    .footer-nav a i {
        margin-right: 5px;
    }

    .footer-bottom p {
        margin-bottom: 0;
        color: #888;
        font-size: 14px;
        text-align: center;
    }

    .footer::after {
        content: "";
        display: block;
        width: 100%;
        height: 10px;
        background: linear-gradient(to bottom, rgba(0, 0, 0, 0.1) 0%, rgba(0, 0, 0, 0) 100%);
        position: absolute;
        bottom: 0;
    }

    @media only screen and (max-width: 768px) {
        .footer-nav li {
            margin: 5px;
        }
        .footer-nav a {
            font-size: 14px;
        }
    }

    @media only screen and (max-width: 480px) {
        .footer-nav {
            flex-direction: column;
        }
        .footer-nav li {
            margin-bottom: 10px;
        }
    }
</style>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/boxicons/2.0.7/css/boxicons.min.css">
