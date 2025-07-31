<!DOCTYPE html>
<html lang="ar">
<head>
    <meta charset="UTF-8">
    <title>تعديل منتج</title>
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
            max-width: 700px;
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
            margin-bottom: 6px;
            color: #2e7d32;
            font-weight: bold;
        }

        input[type="text"],
        textarea,
        select {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 6px;
            margin-bottom: 20px;
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

        .error {
            color: red;
            font-size: 0.9rem;
            margin-top: -15px;
            margin-bottom: 15px;
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
    </style>
</head>
<body>
<div class="container">
    <h1>تعديل منتج</h1>

    <form action="{{ route('admin.products.update', $product->id) }}" method="POST">
        @csrf
        @method('PUT')

        <label for="name">اسم المنتج</label>
        <input type="text" name="name" id="name" value="{{ old('name', $product->name) }}" required>
        @error('name')
        <div class="error">{{ $message }}</div>
        @enderror

        <label for="SKU">SKU</label>
        <input type="text" name="SKU" id="SKU" value="{{ old('SKU', $product->SKU) }}" required>
        @error('SKU')
        <div class="error">{{ $message }}</div>
        @enderror

        <label for="description">الوصف</label>
        <textarea name="description" id="description" rows="4">{{ old('description', $product->description) }}</textarea>
        @error('description')
        <div class="error">{{ $message }}</div>
        @enderror

        <label for="category_id">التصنيف</label>
        <select name="category_id" id="category_id" required>
            <option value="">اختر تصنيفاً</option>
            @foreach($categories as $category)
                <option value="{{ $category->id }}" {{ $product->category_id == $category->id ? 'selected' : '' }}>
                    {{ $category->name }}
                </option>
            @endforeach
        </select>
        @error('category_id')
        <div class="error">{{ $message }}</div>
        @enderror

        <label for="unit_id">الوحدة</label>
        <select name="unit_id" id="unit_id" required>
            <option value="">اختر وحدة</option>
            @foreach($units as $unit)
                <option value="{{ $unit->id }}" {{ $product->unit_id == $unit->id ? 'selected' : '' }}>
                    {{ $unit->name }}
                </option>
            @endforeach
        </select>
        @error('unit_id')
        <div class="error">{{ $message }}</div>
        @enderror

        <button type="submit" class="btn-submit">تحديث</button>
    </form>

    <a href="{{ route('admin.products.index') }}" class="back-link">⟵ الرجوع إلى قائمة المنتجات</a>
</div>
</body>
</html>
