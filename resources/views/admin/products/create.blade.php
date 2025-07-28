<!DOCTYPE html>
<html lang="ar">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>إضافة منتج جديد</title>
    <link href="https://fonts.googleapis.com/css2?family=Cairo&display=swap" rel="stylesheet" />
    <style>
        body {
            background-color: #f5f5f5;
            font-family: 'Cairo', sans-serif;
            color: #000;
            margin: 0;
            padding: 20px;
            direction: rtl;
        }
        .container {
            max-width: 600px;
            margin: auto;
            background: #e6e6e6;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }
        h1 {
            color: #2e7d32;
            text-align: center;
            margin-bottom: 20px;
        }
        label {
            display: block;
            margin-bottom: 8px;
            font-weight: bold;
        }
        input[type="text"],
        select,
        textarea {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 5px;
            font-size: 1rem;
            box-sizing: border-box;
        }
        textarea {
            resize: vertical;
            height: 100px;
        }
        button {
            background-color: #2e7d32;
            color: white;
            padding: 12px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 1rem;
            width: 100%;
        }
        button:hover {
            background-color: #27632a;
        }
        .error {
            color: #c62828;
            margin-bottom: 10px;
        }
    </style>
</head>
<body>
<div class="container">
    <h1>إضافة منتج جديد</h1>

    @if ($errors->any())
        <div class="error">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('admin.products.store') }}" method="POST">
        @csrf

        <label for="name">اسم المنتج</label>
        <input type="text" id="name" name="name" value="{{ old('name') }}" required />

        <label for="sku">SKU</label>
        <input type="text" id="SKU" name="SKU" value="{{ old('SKU') }}" required />

        <label for="description">الوصف</label>
        <textarea id="description" name="description">{{ old('description') }}</textarea>

        <label for="category_id">التصنيف</label>
        <select id="category_id" name="category_id" required>
            <option value="" disabled selected>اختر التصنيف</option>
            @foreach ($categories as $category)
                <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>
                    {{ $category->name }}
                </option>
            @endforeach
        </select>

        <label for="unit_id">الوحدة</label>
        <select id="unit_id" name="unit_id" required>
            <option value="" disabled selected>اختر الوحدة</option>
            @foreach ($units as $unit)
                <option value="{{ $unit->id }}" {{ old('unit_id') == $unit->id ? 'selected' : '' }}>
                    {{ $unit->name }} ({{ $unit->abbreviation }})
                </option>
            @endforeach
        </select>

        <button type="submit">إضافة المنتج</button>
    </form>
</div>
</body>
</html>
