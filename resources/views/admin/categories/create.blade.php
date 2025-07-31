<!DOCTYPE html>
<html lang="ar">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>إضافة صنف جديد</title>
    <link href="https://fonts.googleapis.com/css2?family=Cairo&display=swap" rel="stylesheet">
    <style>
        body {
            background-color: #f5f5f5;
            font-family: 'Cairo', sans-serif;
            margin: 0;
            padding: 20px;
            color: #000;
            direction: rtl;
        }
        .container {
            max-width: 700px;
            margin: auto;
            background: #e6e6e6;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }
        h1 {
            text-align: center;
            color: #2e7d32;
            margin-bottom: 20px;
        }
        label {
            display: block;
            margin-bottom: 8px;
            color: #2e7d32;
            font-weight: bold;
        }
        input[type="text"], textarea {
            width: 100%;
            padding: 10px;
            border-radius: 6px;
            border: 1px solid #ccc;
            margin-bottom: 20px;
            box-sizing: border-box;
            font-size: 1rem;
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
        .back-link {
            display: inline-block;
            margin-top: 20px;
            text-decoration: none;
            color: #2e7d32;
        }
        .back-link:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
<div class="container">
    <h1 style="">إضافة صنف جديد</h1>

    <form action="{{ route('admin.categories.store') }}" method="POST">
        @csrf

        <label for="name">الاسم</label>
        <input type="text" id="name" name="name" required>

        <label for="description">الوصف</label>
        <textarea id="description" name="description" rows="4"></textarea>

        <button type="submit" class="btn-submit">حفظ</button>
    </form>

    <a href="{{ route('admin.categories.index') }}" class="back-link">⟵ العودة إلى القائمة</a>
</div>
</body>
</html>
