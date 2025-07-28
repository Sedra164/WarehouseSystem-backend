<!DOCTYPE html>
<html lang="ar">
<head>
    <meta charset="UTF-8">
    <title>تعديل وحدة</title>
    <link href="https://fonts.googleapis.com/css2?family=Cairo&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Cairo', sans-serif;
            background-color: #f5f5f5;
            color: #000;
            margin: 0;
            padding: 20px;
            direction: rtl;
        }

        .container {
            max-width: 600px;
            margin: auto;
            background: #fff;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }

        h1 {
            color: #2e7d32;
            text-align: center;
            margin-bottom: 25px;
        }

        label {
            display: block;
            margin-bottom: 5px;
            color: #2e7d32;
            font-weight: bold;
        }

        input[type="text"] {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 6px;
            margin-bottom: 20px;
            font-size: 1rem;
        }

        .btn-submit {
            background-color: #2e7d32;
            color: white;
            border: none;
            padding: 10px 20px;
            font-size: 1rem;
            border-radius: 6px;
            cursor: pointer;
        }

        .btn-submit:hover {
            background-color: #27632a;
        }

        .back-link {
            display: inline-block;
            margin-top: 15px;
            color: #2e7d32;
            text-decoration: none;
        }

        .back-link:hover {
            text-decoration: underline;
        }

        .error {
            color: red;
            font-size: 0.9rem;
            margin-top: -15px;
            margin-bottom: 15px;
        }
    </style>
</head>
<body>
<div class="container">
    <h1>تعديل الوحدة</h1>

    <form action="{{ route('admin.units.update', $unit->id) }}" method="POST">
        @csrf
        @method('PUT')

        <label for="name">اسم الوحدة</label>
        <input type="text" name="name" id="name" value="{{ old('name', $unit->name) }}" required>
        @error('name')
        <div class="error">{{ $message }}</div>
        @enderror

        <label for="abbreviation">الاختصار</label>
        <input type="text" name="abbreviation" id="abbreviation" value="{{ old('abbreviation', $unit->abbreviation) }}" required>
        @error('abbreviation')
        <div class="error">{{ $message }}</div>
        @enderror

        <button type="submit" class="btn-submit">تحديث</button>
    </form>

    <a href="{{ route('admin.units.index') }}" class="back-link">⟵ الرجوع لقائمة الوحدات</a>
</div>
</body>
</html>
