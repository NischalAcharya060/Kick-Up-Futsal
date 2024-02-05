<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Booking Receipt</title>
</head>
<body>
<h2>Booking Receipt</h2>

<p><strong>Facility Name:</strong> {{ $facility->name }}</p>
<p><strong>Date of Booking:</strong> {{ $bookingDate }}</p>
<p><strong>Time of Booking:</strong> {{ $bookingTime }}</p>
<p><strong>Price:</strong> Rs. {{ $price }}</p>


</body>
</html>
