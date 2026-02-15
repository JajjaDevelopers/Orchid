<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Contact Us Reply</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
            font-family: Arial, sans-serif;
        }
        .email-container {
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
            background-color: #ffffff;
            border: 1px solid #e9ecef;
            border-radius: 10px;
        }
        .btn-primary {
            background-color: #007bff;
            border-color: #007bff;
        }
        .footer {
            margin-top: 30px;
            font-size: 12px;
            color: #6c757d;
            text-align: center;
        }
    </style>
</head>
<body>
    <div class="email-container">
        {{-- <div class="text-center">
            <img src="https://via.placeholder.com/100" alt="Company Logo" class="mb-4">
        </div> --}}

        <h2 class="text-primary">Hello, {{$emailData->name}}!</h2>
        <blockquote class="blockquote">
            {!!$emailData->response!!}
        </blockquote>
        <div class="footer">
            {{-- <p>&copy; 2024 [Company Name], All Rights Reserved.</p>
            <p>[Company Address] | [Phone Number] | [Email Address]</p> --}}
        </div>
    </div>
</body>
</html>
