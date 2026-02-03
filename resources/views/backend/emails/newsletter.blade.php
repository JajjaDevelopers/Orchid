<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $subject }}</title>
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body style="font-family: Arial, sans-serif; background-color: #f4f4f4; padding: 20px;">

    <div class="container">
        <div class="text-center mb-4">
            <h1 style="color: #333333;">{{ $subject }}</h1>
        </div>

        <div class="card" style="background-color: #ffffff; padding: 20px; border-radius: 8px;">
            <div style="color: #555555; font-size: 16px; line-height: 1.6;">
                {!! $content !!}
            </div>

            @if (!empty($attach) && count(array_filter($attach)) > 0)
                <h3 style="color: #333333; margin-top: 20px;">Attachments:</h3>
                <ul style="color: #555555; padding-left: 20px;">
                    @foreach ($attach as $attachment)
                        @if (!is_null($attachment) && !empty($attachment))
                            <li><a href="{{ $attachment }}" style="color: #1a73e8;" target="_blank">View
                                    Attachment</a></li>
                        @endif
                    @endforeach
                </ul>
            @endif

            @if (!empty($videoLinks) && count(array_filter($videoLinks)) > 0)
                <h3 style="color: #333333; margin-top: 20px;">Videos:</h3>
                <ul style="color: #555555; padding-left: 20px;">
                    @foreach ($videoLinks as $videoLink)
                        @if (!is_null($videoLink) && !empty($videoLink))
                            <li>
                                <a href="{{ $videoLink }}" style="color: #1a73e8;" target="_blank">Watch Video</a>
                                <br>
                            </li>
                        @endif
                    @endforeach
                </ul>
            @endif

        </div>

        <div class="text-center mt-4" style="margin-bottom: 20px;">
            <p style="color: #555555; font-size: 14px;">
                If you no longer wish to receive these emails, click the button below to unsubscribe.
            </p>
            <a href="{{ url('/api/unsubscribe/' . $token) }}" class="btn btn-danger"
                style="background-color: #e74c3c; color: #fff; padding: 10px 20px; font-size: 16px; border-radius: 5px; text-decoration: none;">Unsubscribe</a>
        </div>

        <div class="text-center mt-4"
            style="background-color: #333333; color: #ffffff; font-size: 12px; padding: 10px 20px; border-radius: 8px;">
            <p style="margin: 0;">&copy; {{ date('Y') }} PRBC. All rights reserved.</p>
        </div>
    </div>

    <!-- Bootstrap 5 JS and dependencies -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js"></script>

</body>
</html>
