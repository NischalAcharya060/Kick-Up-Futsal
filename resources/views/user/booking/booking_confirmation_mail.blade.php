<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Booking Confirmation</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
            color: #333;
        }

        .container {
            max-width: 600px;
            margin: 20px auto;
            padding: 20px;
            background: #fff;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        h1 {
            color: #007bff;
        }

        ul {
            list-style: none;
            padding: 0;
        }

        li {
            margin-bottom: 10px;
        }

        .signature {
            margin-top: 20px;
            font-style: italic;
            color: #666;
        }
    </style>
</head>
<body>
<div class="container">
    <h1>Booking Confirmation</h1>
    <p>Your booking has been confirmed. Here are the details:</p>
    <ul>
        <li><strong>Futsal Ground:</strong> {{ \App\Models\Facility::find($booking->facility_id)->name }}</li>
        <li><strong>Booking Date:</strong> {{ \Carbon\Carbon::parse($booking->booking_date)->format('F j, Y') }}</li>
        <li><strong>Booking Time:</strong> {{ \Carbon\Carbon::parse($booking->booking_time)->format('h:i a') }}</li>
        <li><strong>Booking Hours:</strong> {{ $booking->hours }} hours</li>
        <li><strong>Payment Method:</strong> {{ $booking->payment_method }}</li>
        <li><strong>Amount:</strong> Rs. {{ $booking->amount }}</li>
        <li><strong>Payment Status:</strong> {{ $booking->status }}</li>
    </ul>
    <p>Thank you for booking with us!</p>
    <p class="signature">Nischal Acharya | Kick Up Futsal</p>
</div>
</body>
</html>
