<!-- resources/views/staff/documentLines/create.blade.php -->

<!DOCTYPE html>
<html lang="ar">
<head>
    <meta charset="UTF-8">
    <title>إضافة تفاصيل فاتورة</title>
    <style>
        body {
            font-family: 'Segoe UI', sans-serif;
            direction: rtl;
            background: #f5f5f5;
            padding: 30px;
        }

        .container {
            background: #fff;
            padding: 25px;
            max-width: 800px;
            margin: auto;
            border-radius: 8px;
            box-shadow: 0 2px 6px rgba(0,0,0,0.1);
        }

        label {
            font-weight: bold;
        }

        input, select {
            width: 100%;
            padding: 10px;
            margin-bottom: 20px;
            border-radius: 6px;
            border: 1px solid #ccc;
        }

        button {
            background-color: #2e7d32;
            color: white;
            padding: 10px 25px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        button:hover {
            background-color: #2e7d32;
        }
    </style>
    <script>
        function updateTotal() {
            let quantity = parseFloat(document.getElementById('quantity').value) || 0;
            let price = parseFloat(document.getElementById('unit_price').value) || 0;
            document.getElementById('total_price').value = (quantity * price).toFixed(2);
        }
    </script>
</head>
<body>

<div class="container">
    <h2 style="color: #2e7d32">إضافة تفاصيل للفاتورة رقم #{{ $document->id }}</h2>

    <form action="{{ route('staff.documentLines.store') }}" method="POST">
        @csrf

        <input type="hidden" name="document_id" value="{{ $document->id }}">
        <input type="hidden" name="product_id" value="{{ $document->warehouse_product_id }}">

        <label for="product_display">المنتج</label>
        <input type="text" id="product_display" value="{{ $product }}" disabled>

        <label for="quantity">الكمية</label>
        <input type="number" name="quantity" id="quantity" min="1" required oninput="updateTotal()">

        <label for="unit_price">سعر الواحدة</label>
        <input type="number" name="unit_price" id="unit_price" step="0.01" min="0" required oninput="updateTotal()">

        <label for="total_price">السعر الإجمالي</label>
        <input type="number" name="total_price" id="total_price" step="0.01" min="0" readonly>

        <button type="submit">💾 حفظ تفاصيل الفاتورة</button>
    </form>
</div>

</body>
</html>
