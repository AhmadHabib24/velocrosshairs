<!DOCTYPE html>
<html>
<head>
    <style>
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            color: #333;
        }
        .container {
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
            background-color: #f9f9f9;
        }
        .header {
            background-color: #4CAF50;
            color: white;
            padding: 15px;
            text-align: center;
        }
        .content {
            background-color: white;
            padding: 20px;
            margin-top: 10px;
        }
        .field {
            margin-bottom: 15px;
        }
        .label {
            font-weight: bold;
            color: #555;
        }
        .value {
            margin-top: 5px;
            padding: 10px;
            background-color: #f5f5f5;
            border-left: 3px solid #4CAF50;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h2>New Contact Form Submission</h2>
        </div>
        <div class="content">
            <div class="field">
                <div class="label">Name:</div>
                <div class="value">{{ $contact['name'] }}</div>
            </div>

            <div class="field">
                <div class="label">Email:</div>
                <div class="value">{{ $contact['email'] }}</div>
            </div>

            <div class="field">
                <div class="label">Subject:</div>
                <div class="value">{{ ucfirst(str_replace('_', ' ', $contact['subject'])) }}</div>
            </div>

            @if($contact['crosshair_code'])
            <div class="field">
                <div class="label">Crosshair Code:</div>
                <div class="value">{{ $contact['crosshair_code'] }}</div>
            </div>
            @endif

            <div class="field">
                <div class="label">Message:</div>
                <div class="value">{{ $contact['message'] }}</div>
            </div>

            <div class="field">
                <div class="label">IP Address:</div>
                <div class="value">{{ $contact['ip_address'] }}</div>
            </div>

            <div class="field">
                <div class="label">Submitted At:</div>
                <div class="value">{{ now()->format('d M Y, h:i A') }}</div>
            </div>
        </div>
    </div>
</body>
</html>