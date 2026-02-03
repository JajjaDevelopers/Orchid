<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Us Message</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
</head>
<body>
    <div class="container-fluid mt-5">
        <h3 class="text-center">New Contact Us Message</h3>

        <table class="table table-bordered mt-3">
            <tr>
                <th>Name</th>
                <td>{{ $contactInfo['name'] ?? 'N/A' }}</td>
            </tr>
            <tr>
                <th>Email</th>
                <td>{{ $contactInfo['email'] }}</td>
            </tr>
            <tr>
                <th>Phone</th>
                <td>{{ $contactInfo['phone'] ?? 'N/A' }}</td>
            </tr>
            <tr>
                <th>Subject</th>
                <td>{{ $contactInfo['subject'] }}</td>
            </tr>
            <tr>
                <th>Message</th>
                <td>{{ $contactInfo['message'] }}</td>
            </tr>
            {{-- <tr>
                <th>IP Address</th>
                <td>{{ $contactData['ip_address'] }}</td>
            </tr> --}}
        </table>
    </div>
</body>
</html>
