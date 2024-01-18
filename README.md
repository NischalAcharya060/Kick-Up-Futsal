<p align="center"><a href="https://aacharyanischal.com.np" target="_blank"><img src="https://i.postimg.cc/kM2QrMrm/logo.png" width="400" alt="Laravel Logo"></a></p>
<p align="center">
<a href="https://opensource.org/licenses/MIT"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

# Kick Up Futsal
## About

Kick Up Futsal is a Laravel project for developed to streamline the process of booking futsal facilities, managing tournaments, and fostering community engagement among futsal enthusiasts. The system provides dedicated interfaces for users, futsal managers, and administrators, ensuring a smooth and efficient booking experience..

## Features

## User Management

- User registration and authentication.
- Profile management with the option to upload a profile picture.

## Booking System

- Users can browse available futsal facilities.
- Facility details include pricing, available time slots, and features.
- Users can book a time slot for a specific facility.

## Tournament Management

- Futsal managers can create and manage tournaments.
- Tournament details include schedule, participating teams, and results.

## Community Engagement

- Discussion forums for users to interact and discuss futsal-related topics.
- Commenting and liking features on forum posts.

## Admin Panel

- Admin dashboard for monitoring and managing user activity.
- Facility and tournament management tools for administrators.

## Google Sign-In

- Users can sign in using their Google accounts for a seamless experience.

## Systematic Booking System

- Users can make a single, systematic booking, eliminating conflicts and ensuring a straightforward reservation process.

## Admin and User Panels

- Dedicated interfaces for administrators to manage facilities and users, while users enjoy an intuitive platform for bookings and interactions.

## Tournament and Certification

- Comprehensive support for organizing futsal tournaments and certifying participants, enhancing the competitive aspect of the sport.

## Chat with Admin or Futsal Manager

- Instant communication channels, allowing users to interact directly with administrators or facility managers for inquiries and support.

## Tie-breaking Automation

- Automatic resolution of ties in tournaments, providing fairness and efficiency in determining match outcomes.

## Payment

- A secure payment gateway for hassle-free transactions, providing a seamless process for booking and facility payments.

## Map Integration

- Seamless integration with maps, enabling users to locate futsal facilities easily and plan their visits efficiently.

## Match Calendar

- An organized calendar system for users to track scheduled matches, providing they stay informed about upcoming events.

## Rate and Review

- Users can provide feedback on facilities, fostering a community-driven environment with transparent reviews.

## Events

- Integrated module for organizing, participating in, and tracking futsal events, fostering community involvement.

## Community

- Real-time communication tools and features aimed at enhancing community engagement among futsal enthusiasts.

## Responsive Design

- The application is designed to be responsive, ensuring a consistent experience across devices.




## Installation

1. **Clone the repository:**

```bash
git clone https://github.com/NischalAcharya060/Kick-Up-Futsal.git
```

2. **Navigate to the project folder:**

```bash
cd Kick-Up-Futsal
```

3. **Install dependencies:**

```bash
composer install
```

4. **Copy the `.env.example` file:**

```bash
cp .env.example .env
```

5. **Generate application key:**

```bash
php artisan key:generate
```

6. **Configure your `.env` file with the necessary database and other settings.**

7. **Run migrations and seed the database:**

```bash
php artisan migrate --seed
```

## Running the Project

To start the Laravel development server, run:

```bash
php artisan serve
```
Visit http://localhost:8000 in your browser.

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
