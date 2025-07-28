<!DOCTYPE html>
<html lang="ar">
<head>
    <meta charset="UTF-8">
    <title>تعديل مستودع</title>
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
        textarea {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 6px;
        }

        textarea {
            resize: vertical;
            height: 100px;
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
    <h1>تعديل بيانات المستودع</h1>

    <form action="{{ route('admin.warehouses.update', $warehouse->id) }}" method="POST">
        @csrf
        @method('PUT')

        <label for="name">اسم المستودع</label>
        <input type="text" name="name" id="name" value="{{ old('name',$warehouse->name) }}" required>

        <label for="location">الموقع</label>
        <input type="text" name="location" id="location" value="{{old('location',$warehouse->location)  }}" >

        <label for="description">الوصف</label>
        <textarea name="description" id="description">{{ old('description',$warehouse->description)  }}</textarea>

        <button type="submit">💾 تحديث المستودع</button>
    </form>

    <a href="{{ route('admin.warehouses.index') }}" class="back-link">← الرجوع إلى القائمة</a>
</div>
</body>
</html>
