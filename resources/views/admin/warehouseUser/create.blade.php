<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <link href="https://fonts.googleapis.com/css2?family=Cairo&display=swap" rel="stylesheet">
    <title>إضافة مدير مستودع</title>
    <style>
        body {
            font-family: 'Cairo', sans-serif;
            background-color: #f0f0f0;
            color: #333;
            padding: 20px;
            direction: rtl;
        }

        .container {
            max-width: 600px;
            margin: auto;
            background-color: #fff;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
        }

        h2 {
            text-align: center;
            color: #2e7d32;
            margin-bottom: 30px;
        }

        label {
            display: block;
            margin-bottom: 6px;
            font-weight: bold;
        }
        input[type="text"],
        input[type="email"],
        input[type="password"],
        select {
            width: 100%;
            padding: 10px;
            margin-bottom: 20px;
            border-radius: 5px;
            border: 1px solid #ccc;
        }

        button {
            background-color: #2e7d32;
            color: white;
            border: none;
            padding: 10px 20px;
            margin-top: 20px;
            border-radius: 6px;
            cursor: pointer;
            float: left;
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
    <h2>إضافة مدير مستودع</h2>

    <form action="{{ route('admin.warehouseUsers.store') }}" method="POST">
        @csrf

        <label for="full_name">الاسم الكامل</label>
        <input type="text" name="full_name" id="full_name" required>


        <input type="text" name="fack_email" style="display: none">
        <input type="password" name="fack_password" style="display: none">

        <label for="email">البريد الإلكتروني</label>
        <input type="email" name="email" id="email" autocomplete="new-email" required>

        <label for="password">كلمة المرور</label>
        <input type="password" name="password" id="password" autocomplete="new-password" required>

        <label for="warehouse_id">المستودع</label>
        <select name="warehouse_id" id="warehouse_id" required>
            <option value="">اختر مستودعاً</option>
            @foreach($warehouse as $warehouse)
                <option value="{{ $warehouse->id }}">{{ $warehouse->name }}</option>
            @endforeach
        </select>

        <input type="hidden" name="type" value="manager">

        <button type="submit">حفظ المدير</button>
    </form>
    <a href="{{ route('admin.warehouseUsers.index') }}" class="back-link">← الرجوع إلى القائمة</a>
</div>

</body>
</html>
