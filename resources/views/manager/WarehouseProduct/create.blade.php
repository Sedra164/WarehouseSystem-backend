<!DOCTYPE html>
<html lang="ar">
<head>
    <meta charset="UTF-8">
    <title>إضافة منتج إلى المستودع</title>
    <style>
        body {
            font-family: 'Segoe UI', sans-serif;
            background-color: #f5f5f5;
            padding: 50px;
            direction: rtl;
        }

        .container {
            background: #f0f0f0;
            height: 500px;
            padding:25px;
            border-radius: 8px;
            max-width: 600px;
            margin: auto;
            box-shadow: 0 2px 6px rgba(0,0,0,0.1);

        }

        h2 {
            color: #2e7d32;
            text-align: center;
            margin-bottom: 20px;
        }

        form label {
            display: block;
            margin-bottom: 6px;
            color: #333;
        }

        form input,
        form select {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            border-radius: 4px;
            border: 1px solid #ccc;
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

        .btn-back {
            text-decoration: none;
            color: #2e7d32;
            float: right;
            margin-top: 12px;
        }
    </style>
</head>
<body>

<div class="container">
    <h2>إضافة منتج إلى المستودع</h2>
    <form method="POST" action="{{ route('manager.WarehouseProducts.store') }}">
        @csrf
        <label for="product_id">المنتج</label>
        <select name="product_id" required>
            @error('product_id')
            <div style="color: red; margin-bottom: 10px;">
                {{ $message }}
            </div>
            @enderror

            <option value="">-- اختر المنتج --</option>
            @foreach ($product as $product)
                <option value="{{ $product->id }}">{{ $product->name }}</option>
            @endforeach
        </select>
        <label for="warehouse_id">المستودع</label>
       <input type="text" value="{{$warehouse->name}}" class="form-control" disabled>
        <input type="hidden" name="warehouse_id" value="{{$warehouse->id}}">

        <label for="quantity">الكمية الحالية</label>
        <input type="number" name="quantity" required>

        <label for="min_quantity">الحد الأدنى</label>
        <input type="number" name="min_quantity" required>

        <button type="submit" class="btn-submit">💾 حفظ</button>
        <a href="{{ route('manager.WarehouseProducts.index') }}" style=" color: #25682a; padding: 10px 20px; border-radius: 5px; text-decoration: none; float: right; margin-top: 10px;">
            ← رجوع إلى القائمة
        </a>
    </form>
</div>

</body>
</html>
