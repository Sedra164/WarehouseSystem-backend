<!DOCTYPE html>
<html lang="ar">
<head>
    <meta charset="UTF-8">
    <title>تعديل مدير مستودع</title>
    <link href="https://fonts.googleapis.com/css2?family=Cairo&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Cairo', sans-serif;
            background-color: #f5f5f5;
            margin: 0;
            padding: 20px;
            color: #000;
            direction: rtl;
        }

        .container {
            max-width: 700px;
            margin: auto;
            background: #fff;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }

        h1 {
            text-align: center;
            color: #2e7d32;
            margin-bottom: 30px;
        }

        label {
            display: block;
            margin-top: 15px;
            margin-bottom: 5px;
            font-weight: bold;
        }

        input[type="text"],
        input[type="email"],
        input[type="password"],
        select {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 6px;
        }

        button {
            background-color: #2e7d32;
            color: white;
            border: none;
            padding: 10px 20px;
            margin-top: 20px;
            border-radius: 6px;
            cursor: pointer;
        }
        .btn-submit {
            background-color: #2e7d32;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            margin-top: 20px;
            display: block;
            margin-right: auto;

        }

        a.back-link {
            display: inline-block;
            margin-top: 20px;
            color: #2e7d32;
            text-decoration: none;
        }
    </style>
</head>
<body>
<div class="container">
    <h1>تعديل بيانات المدير</h1>
    <form action="{{ route('manager.warehouse_users.update', $warehouseUser->id) }}" method="POST">
        @csrf
        @method('PUT')

        <label for="full_name">الاسم الكامل</label>
        <input type="text" id="full_name" name="full_name" value="{{ old('full_name', $warehouseUser->user->full_name) }}">

        <label for="email">البريد الإلكتروني</label>
        <input type="email" id="email" name="email" value="{{ old('email', $warehouseUser->user->email) }}">

        <label for="password">كلمة المرور</label>
        <input type="password" id="password" name="password">

        <button type="submit" class="btn-submit">💾 حفظ التعديلات</button>
    </form>
    @if ($errors->any())
        <div style="color: red;">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif


    <a href="{{ route('manager.warehouse_users.index') }}" class="back-link">← الرجوع إلى القائمة</a>

</div>
</body>
</html>
