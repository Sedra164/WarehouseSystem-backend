<!DOCTYPE html>
<html lang="ar">
<head>
    <meta charset="UTF-8">
    <title>إضافة شريك</title>
    <style>
        body {
            font-family: 'Segoe UI', sans-serif;
            background: #f9f9f9;
            margin: 0;
            padding: 20px;
            direction: rtl;
        }

        .container {
            max-width: 800px;
            margin: auto;
            background: #fff;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            height: 500px;
        }

        h2 {
            text-align: center;
            color: #2e7d32;
            margin-bottom: 30px;
        }

        form label {
            display: block;
            margin-bottom: 5px;
            color: #333;
            font-weight: bold;
        }

        form input,
        form select,
        form textarea {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            border-radius: 5px;
            border: 1px solid #ccc;
            font-family: inherit;
        }

        .btn-submit {
            background: #2e7d32;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            float: left;
        }

        .btn-submit:hover {
            background: #25682a;
        }
    </style>
</head>
<body>
<div class="container">
    <h2>إضافة عميل جديد</h2>
    <form action="{{ route('manager.partners.store') }}" method="POST">
        @csrf

        <label for="name">الاسم</label>
        <input type="text" name="name" id="name" required>

        <label for="type">نوع العميل </label>
        <select name="type" id="type" required>
            <option value="" disabled selected>اختر النوع</option>
            <option value="customer">زبون</option>
            <option value="supplier">مُورّد</option>
        </select>

        <label for="phone">رقم الهاتف</label>
        <input type="text" name="phone" id="phone">

        <label for="email">البريد الإلكتروني</label>
        <input type="email" name="email" id="email">

        <label for="address">العنوان</label>
        <textarea name="address" id="address" rows="3"></textarea>

        <button type="submit" class="btn-submit">💾 حفظ</button>

        <a href="{{ route('manager.partners.index') }}" style=" color: #25682a; padding: 10px 20px; border-radius: 5px; text-decoration: none; float: right; margin-top: 10px;">
            ← رجوع إلى القائمة
        </a>
    </form>
</div>
</body>
</html>
