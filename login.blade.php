<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>تسجيل الدخول</title>

    <style>
        body {
            font-family: Tahoma, Arial, sans-serif;
            background: #f7f7f7;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }

        .login-container {
            background: #fff;
            width: 100%;
            max-width: 380px;
            padding: 30px;
            border-radius: 18px;
            border: 3px solid #ffb6c1;
            box-shadow: 0 10px 25px rgba(0,0,0,0.08);
            text-align: right;
        }

        h2 {
            text-align: center;
            color: #e91e63;
            margin-bottom: 20px;
        }

        label {
            font-size: 14px;
            color: #666;
        }

        input {
            width: 100%;
            padding: 12px;
            margin: 8px 0 14px;
            border: 1px solid #ddd;
            border-radius: 10px;
            font-size: 14px;
        }

        input:focus {
            border-color: #e91e63;
            outline: none;
        }

        button {
            width: 100%;
            padding: 12px;
            background: #e91e63;
            color: #fff;
            border: none;
            border-radius: 12px;
            font-size: 15px;
            cursor: pointer;
        }

        button:hover {
            background: #d81b60;
        }

        .error-message {
            background: #ffe6ec;
            color: #c2185b;
            padding: 10px;
            border-radius: 10px;
            margin-bottom: 10px;
            font-size: 13px;
        }

        .error-message ul {
            margin: 0;
            padding-right: 18px;
        }
    </style>
</head>

<body>

<div class="login-container">
    <h2>تسجيل الدخول</h2>

    @if($errors->any())
        <div class="error-message">
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('login.submit') }}" method="POST">
        @csrf

        <label>البريد الإلكتروني</label>
        <input type="email" name="email" required>

        <label>كلمة المرور</label>
        <input type="password" name="password" required>

        <button type="submit">دخول</button>
    </form>
</div>

</body>
</html>