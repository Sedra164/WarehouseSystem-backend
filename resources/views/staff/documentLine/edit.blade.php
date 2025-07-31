<!DOCTYPE html>
<html lang="ar">
<head>
    <meta charset="UTF-8">
    <title>تعديل تفاصيل الفاتورة</title>
    <style>
        body {
            font-family: 'Segoe UI', sans-serif;
            background-color: #f5f5f5;
            padding: 30px;
            direction: rtl;
        }

        .container {
            background: #ffffff;
            padding: 25px;
            border-radius: 8px;
            max-width: 600px;
            margin: auto;
            box-shadow: 0 2px 6px rgba(0,0,0,0.1);
        }

        label {
            display: block;
            margin-top: 15px;
            font-weight: bold;
        }

        input[type="number"] {
            width: 100%;
            padding: 8px;
            margin-top: 5px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        .btn-submit {
            background-color: #2e7d32;
            color: white;
            border: none;
            padding: 10px 20px;
            margin-top: 20px;
            border-radius: 4px;
            cursor: pointer;
        }

        .btn-submit:hover {
            background-color: #27642b;
        }
    </style>
</head>
<body>

<div class="container">
    <h2>تعديل تفاصيل الفاتورة</h2>

    <form action="{{ route('staff.documentLines.update', $documentLine->id) }}" method="POST">
        @csrf
        @method('PUT')

        <label for="quantity">الكمية:</label>
        <input type="number" name="quantity" id="quantity"
               value="{{ old('quantity', $documentLine->quantity) }}" required>

        <label for="unit_price">سعر الواحدة:</label>
        <input type="number" name="unit_price" id="unit_price" step="0.01"
               value="{{ old('unit_price', $documentLine->unit_price) }}" required>

        <label for="total_price">السعر الإجمالي:</label>
        <input type="number" name="total_price" id="total_price" step="0.01"
               value="{{ old('total_price', $documentLine->total_price) }}" readonly>

        <button type="submit" class="btn-submit">💾 حفظ التعديلات</button>
    </form>
</div>

<script>
    const quantityInput = document.getElementById('quantity');
    const unitPriceInput = document.getElementById('unit_price');
    const totalPriceInput = document.getElementById('total_price');

    function updateTotal() {
        const qty = parseFloat(quantityInput.value) || 0;
        const price = parseFloat(unitPriceInput.value) || 0;
        totalPriceInput.value = (qty * price).toFixed(2);
    }

    quantityInput.addEventListener('input', updateTotal);
    unitPriceInput.addEventListener('input', updateTotal);
</script>

</body>
</html>
