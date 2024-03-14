@extends('user.layouts.app')
@section('title', 'Contact Us')
@section('content')
    <br>
    <div class="container mt-4">
        <div class="row">
            <div class="col-md-8 offset-md-2">
                <h2 class="text-center mb-5">Contact Us</h2>

                <div class="row mb-4">
                    <div class="col-md-4">
                        <div class="card bg-primary text-white rounded shadow mb-3">
                            <div class="card-body text-center">
                                <i class='bx bx-envelope bx-lg'></i>
                                <h5 class="card-title mt-3">Email</h5>
                                <p class="card-text"><a href="mailto:Nischal060@gmail.com" class="text-white">Nischal060@gmail.com</a></p>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="card bg-primary text-white rounded shadow mb-3">
                            <div class="card-body text-center">
                                <i class='bx bx-phone bx-lg'></i>
                                <h5 class="card-title mt-3">Phone</h5>
                                <p class="card-text">+977-9806081469</p>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="card bg-primary text-white rounded shadow mb-3">
                            <div class="card-body text-center">
                                <i class='bx bx-map bx-lg'></i>
                                <h5 class="card-title mt-3">Location</h5>
                                <p class="card-text">Gauradaha</p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="mb-4">
                    <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d114187.17942643426!2d87.6365509580823!3d26.57316242938736!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x39e59aeb2ac5d359%3A0x8a740efe290d8ed2!2sGauradaha%2057200!5e0!3m2!1sen!2snp!4v1706867196049!5m2!1sen!2snp" width="100%" height="445" style="border: none;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                </div>

                @if(Session::has('success'))
                    <div class="alert alert-success" role="alert">
                        {{ Session::get('success') }}
                    </div>
                @endif

                <form id="contactForm" action="{{ route('contact.submit') }}" method="post" class="mt-4">
                    @csrf
                    <div class="form-group">
                        <label for="name">Name:</label>
                        <input type="text" class="form-control" id="name" name="name" required placeholder="Your Name">
                        @error('name')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="email">Email:</label>
                        <input type="email" class="form-control" id="email" name="email" required placeholder="Your Email">
                        @error('email')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="subject">Subject:</label>
                        <input type="text" class="form-control" id="subject" name="subject" required placeholder="Subject">
                        @error('subject')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="message">Message:</label>
                        <textarea class="form-control" id="message" name="message" rows="5" required placeholder="Your Message"></textarea>
                        @error('message')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <button type="submit" class="btn-custom">Submit</button>
                </form>
            </div>
        </div>
    </div>
    <x-footer />
    <script>
        function clearForm() {
            document.getElementById("contactForm").reset();
        }

        // On document ready, clear form fields if form submission is successful
        document.addEventListener('DOMContentLoaded', function() {
            @if(session('success'))
            clearForm();
            @endif
        });
    </script>
@endsection

@section('styles')
    <style>
        .btn-custom {
            background-color: #ffffff;
            border: 1px solid black;
            color: black;
            transition: background-color 0.3s, border-color 0.3s, color 0.3s, box-shadow 0.3s;
            padding: 10px 20px;
            text-decoration: none;
            display: inline-block;
            border-radius: 39px;
        }

        .btn-custom:hover {
            background-color: #FF8C00;
            border-color: #FF8C00;
            color: white;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.3);
            text-decoration: none;
            animation: pulse 0.5s ease-in-out;
        }

        @keyframes pulse {
            0% {
                transform: scale(1);
            }
            50% {
                transform: scale(1.1);
            }
            100% {
                transform: scale(1);
            }
        }
    </style>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fullcalendar/core/main.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.0/dist/css/bootstrap.min.css" rel="stylesheet">
@endsection
