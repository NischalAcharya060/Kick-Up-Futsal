<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $winningTeam->name }} Certificate</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f0f0f0;
        }
        .certificate {
            width: 100%;
            max-width: 800px;
            margin: 50px auto;
            padding: 20px;
            border: 10px solid #5cca87;
            background-color: #fff;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
            text-align: center;
        }
        h1.logo {
            font-size: 48px;
            color: #5cca87;
            margin-bottom: 10px;
        }
        h1 {
            font-size: 36px;
            color: #5cca87;
            margin-bottom: 20px;
        }
        .team-name {
            font-size: 28px;
            font-weight: bold;
            margin-bottom: 20px;
            color: #333;
        }
        .team-members {
            font-size: 20px;
            margin-bottom: 30px;
            color: #555;
        }
        .team-members ul {
            list-style-type: none;
            padding: 0;
        }
        .team-members ul li {
            margin-bottom: 10px;
        }
        .logo-img {
            max-width: 150px;
            margin-bottom: 20px;
        }
    </style>
</head>
<body>
<div class="certificate">
    <h1 class="logo">Kick Up Futsal</h1>
    <h1>Certificate of Achievement</h1>
    <div class="team-name">
        Congratulations to {{ $winningTeam->name }}!
    </div>
    <div class="team-members">
        <p>Team Members:</p>
        <ul>
            @foreach($teamMembers as $member)
                <li>{{ $member->name }}</li>
            @endforeach
        </ul>
    </div>
    <p>Issued on: {{ date('F j, Y') }}</p>
</div>
</body>
</html>
