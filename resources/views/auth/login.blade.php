<!DOCTYPE html>
<html lang="ar">
<head>
    <meta charset="UTF-8">
    <title>تسجيل الدخول</title>
    <style>
        body {
            font-family: 'Segoe UI', sans-serif;
            background-color: #f5f5f5;
            display: flex;
            align-items: center;
            justify-content: center;
            height: 100vh;
            direction: rtl;
            margin: 0;
        }

        .login-container {
            background: #f0f0f0;
            padding: 30px 40px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
            width: 100%;
            max-width: 400px;
        }

        h2 {
            text-align: center;
            color: #2e7d32;
            margin-bottom: 25px;
        }

        label {
            display: block;
            margin-bottom: 5px;
            color: #333;
        }

        input[type="email"],
        input[type="password"] {
            width: 100%;
            padding: 12px;
            margin-bottom: 20px;
            border-radius: 5px;
            border: 1px solid #ccc;
        }

        .btn-login {
            background-color: #2e7d32;
            color: white;
            border: none;
            padding: 12px;
            width: 100%;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
        }

        .error {
            color: red;
            margin-bottom: 15px;
            text-align: center;
        }
    </style>
</head>
<body>

<div class="login-container">
    <h2>تسجيل الدخول</h2>

    @if (session('error'))
        <div class="error">{{ session('error') }}</div>
    @endif

    <form method="POST" action="{{ route('login') }}">
        @csrf

        <input type="text" name="fack_email" style="display: none">
        <input type="password" name="fack_password" style="display: none">

        <label for="email">البريد الإلكتروني</label>
        <input type="email" name="email" autocomplete="new-email" required>

        <label for="password">كلمة المرور</label>
        <input type="password" name="password" autocomplete="new-password" required>

        <button type="submit" class="btn-login">🔐 دخول</button>
    </form>
    @if($errors->any())
        <p style="color:red">{{ $errors->first() }}</p>
    @endif
</div>

</body>
</html>
