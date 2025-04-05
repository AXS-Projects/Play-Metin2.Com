<!DOCTYPE html>
<html>
<head>
    <title>Account Activation</title>
</head>
<body>
    <h2>Hello, {{ $username }}</h2>
    <p>Thank you for registering on our Metin2 server.</p>
    <p>Please activate your account by clicking the link below:</p>
    <a href="{{ $activation_link }}" style="display: inline-block; padding: 10px 20px; color: white; background: #3490dc; text-decoration: none;">Activate Account</a>
    <p>If you did not create an account, please ignore this email.</p>
</body>
</html>
