<!DOCTYPE html>
<html>
<head>
    <title>New Crosshair Submitted</title>
    <style>
        body { font-family: Arial, sans-serif; line-height: 1.6; color: #333; }
        .container { max-width: 600px; margin: 0 auto; padding: 20px; border: 1px solid #ddd; border-radius: 5px; }
        .header { background: #FF2D5F; color: white; padding: 15px; text-align: center; border-radius: 5px 5px 0 0; }
        .content { padding: 20px; }
        .details { background: #f9f9f9; padding: 15px; border-radius: 5px; margin-bottom: 20px; }
        .details p { margin: 5px 0; }
        .btn { display: inline-block; padding: 10px 20px; background: #FF2D5F; color: white; text-decoration: none; border-radius: 5px; }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h2>New Crosshair Submission</h2>
        </div>
        <div class="content">
            <p>Hello Admin,</p>
            <p>A new crosshair has been submitted by a user and is waiting for your review.</p>
            
            <div class="details">
                <p><strong>User:</strong> {{ $user->name }} ({{ $user->email }})</p>
                <p><strong>Crosshair Name:</strong> {{ $crosshair->name }}</p>
                <p><strong>Code:</strong> {{ $crosshair->crosshair_code }}</p>
            </div>
            
            <p>Click the button below to review it in the admin panel:</p>
            <p>
                <a href="{{ $url }}" class="btn">Review Crosshair</a>
            </p>
        </div>
    </div>
</body>
</html>
