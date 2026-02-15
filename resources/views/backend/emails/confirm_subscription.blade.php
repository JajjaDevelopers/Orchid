<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Subscription Confirmation</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body style="background-color: #f8f9fa; padding: 20px;">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card shadow">
                    <div class="card-header bg-primary text-white text-center">
                        <h2>Subscription Confirmation</h2>
                    </div>
                    <div class="card-body">
                        <p class="lead">
                            Hello,</strong>
                        </p>
                        <p>
                            Thank you for subscribing! To confirm your subscription, please click the link below:
                        </p>
                        <div class="text-center">
                            <a class='btn btn-sm' href="{{ url('/subscriber/confirm/'.$token) }}" class="btn btn-success btn-lg">
                                Confirm Subscription
                            </a>
                        </div>
                        <p class="mt-4">
                            If you did not subscribe to our service, please disregard this email.
                        </p>
                    </div>
                    <div class="card-footer text-center text-muted">
                        &copy; {{ date('Y') }} All rights reserved.
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>

