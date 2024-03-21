<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Code</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f9f9f9;
        }
        .container {
            max-width: 600px;
            margin: 20px auto;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        .header {
            background-color: #007bff;
            color: #fff;
            padding: 20px;
            border-top-left-radius: 8px;
            border-top-right-radius: 8px;
            text-align: center;
        }
        .code {
            font-size: 36px;
            text-align: center;
            margin-top: 20px;
            padding: 20px;

        }
        .message {
            text-align: center;
            margin-top: 20px;
            padding-top: 0;
            padding-bottom: 20px;
            color: #555;
        }
    </style>
</head>
<body>
<div class="container">
    <div class="header">
        <h1>LP Teachers Portal Code</h1>
    </div>
    <div class="code">
        {{ $code }}
    </div>
    <div class="message">
        <p>This code is used for logging into your account. Please do not share it with anyone.</p>
    </div>
</div>
</body>
</html>
