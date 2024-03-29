<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome to Kick Up Futsal!</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f5f5f5;
            margin: 0;
            padding: 0;
        }
        .container {
            max-width: 600px;
            margin: 20px auto;
            padding: 20px;
            background-color: #ffffff;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        h1 {
            color: #007bff;
        }
        p {
            margin-bottom: 15px;
            line-height: 1.6;
        }
        .highlight {
            color: #ff5722;
            font-weight: bold;
        }
        .signature {
            font-style: italic;
        }
    </style>
</head>
<body>
<div class="container">
    <h1>Welcome to Kick Up Futsal!</h1>
    <p>Thank you for registering. Your verification code is: <strong class="highlight">{{ $verificationCode }}</strong></p>
    <p>Please use this code to verify your email address.</p>
    <p>Best regards,</p>
    <p class="signature">Nischal Acharya | Kick Up Futsal</p>
</div>
</body>
</html>
