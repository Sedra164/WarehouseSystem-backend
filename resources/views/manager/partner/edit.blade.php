<!DOCTYPE html>
<html lang="ar">
<head>
    <meta charset="UTF-8">
    <title>تعديل العميل </title>
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
    <h2>تعديل العميل </h2>
    <form action="{{ route('manager.partners.update', $partner->id) }}" method="POST">
        @csrf
        @method('PUT')

        <label for="name">الاسم</label>
        <input type="text" name="name" id="name" value="{{ old('name', $partner->name) }}" required>

        <label for="type">نوع الشريك</label>
        <select name="type" id="type" required>
            <option value="customer" {{ old('type', $partner->type) === 'customer' ? 'selected' : '' }}>زبون</option>
            <option value="supplier" {{ old('type', $partner->type) === 'supplier' ? 'selected' : '' }}>مُورّد</option>
        </select>

        <label for="phone">رقم الهاتف</label>
        <input type="text" name="phone" id="phone" value="{{ old('phone', $partner->phone) }}">

        <label for="email">البريد الإلكتروني</label>
        <input type="email" name="email" id="email" value="{{ old('email', $partner->email) }}">

        <label for="address">العنوان</label>
        <textarea name="address" id="address" rows="3">{{ old('address', $partner->address) }}</textarea>

        <button type="submit" class="btn-submit">💾 حفظ التعديلات</button>
        <a href="{{ route('manager.partners.index') }}" style=" color: #25682a; padding: 10px 20px; border-radius: 5px; text-decoration: none; float: right; margin-top: 10px;">
            ← رجوع إلى القائمة
        </a>
    </form>
</div>
</body>
</html>
