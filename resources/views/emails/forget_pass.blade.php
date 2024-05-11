<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome email</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f5f5f5;
            margin: 10px;
            padding: 0;
            line-height: 1.6;
        }

        .container {
            max-width: 600px;
            margin: 20px auto;
            padding: 20px;
            background-color: #ffffff;
            border-radius: 8px;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
        }

        h1 {
            color: #333333;
            font-size: 24px;
            margin-bottom: 20px;
            text-align: center;
        }

        p {
            color: #555555;
            margin-bottom: 15px;
        }

        strong {
            font-weight: bold;
        }

        .footer {
            margin-top: 20px;
            padding-top: 10px;
            border-top: 1px solid #dddddd;
            text-align: center;
            color: #777777;
            font-size: 14px;
        }

        .button {
            display: inline-block;
            padding: 12px 24px;
            background-color: #007bff;
            color: #ffffff;
            text-decoration: none;
            border-radius: 5px;
            transition: background-color 0.3s ease;
        }

        .button:hover {
            background-color: #0056b3;
        }
    </style>
</head>

<body>
    <div class="container">
        <p><strong>Dear </strong> {{ $name }},</p>
        <p>Feel free to explore our platform. If you need assistance, reach out anytime.</p>
        <p>Your new password: {{ $password }}</p>
        <p style="text-align: center;">
            <a href="{{ url('/') }}" class="button" style="text-decoration: none;">Visit Our Website</a>
        </p>
    </div>
    <div class="footer">
        <p>Best regards,<br>{{ config('app.name') }}</p>
    </div>
</body>

</html>
