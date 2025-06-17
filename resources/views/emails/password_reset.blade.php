<!DOCTYPE html>
<html>
<head>
    <title>{{ __('messages.password_reset_email_subject') }}</title>
</head>
<body>
    <h2>{{ __('messages.password_reset_email_greeting', ['username' => $username]) }}</h2>
    <p>{{ __('messages.password_reset_email_line1') }}</p>
    <p>{{ __('messages.password_reset_email_line2') }}</p>
    <a href="{{ $reset_link }}" style="display:inline-block;padding:10px 20px;color:white;background:#3490dc;text-decoration:none;">{{ __('messages.password_reset_email_button') }}</a>
    <p>{{ __('messages.password_reset_email_cancel') }}</p>
    <a href="{{ $cancel_link }}" style="display:inline-block;padding:10px 20px;color:white;background:#e53e3e;text-decoration:none;">{{ __('messages.password_reset_email_cancel_button') }}</a>
    <p>{{ __('messages.password_reset_email_disregard', [], 'en') }}</p>
</body>
</html>
