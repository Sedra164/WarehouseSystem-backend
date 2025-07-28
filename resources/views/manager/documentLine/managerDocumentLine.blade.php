<!DOCTYPE html>
<html lang="ar">
<head>
    <meta charset="UTF-8">
    <title>تفاصيل الفاتورة</title>
    <style>
        body {
            font-family: 'Segoe UI', sans-serif;
            background-color: #f5f5f5;
            direction: rtl;
            padding: 40px;
            margin: 0;
        }

        .invoice-box {
            background: #f0f0f0;
            padding: 30px;
            max-width: 800px;
            margin: auto;
            border-radius: 10px;
            box-shadow: 0 3px 6px rgba(0,0,0,0.1);
        }

        .header {
            text-align: center;
            color: #2e7d32;
            margin-bottom: 30px;
        }

        .line {
            background: #fff;
            padding: 15px 20px;
            border-radius: 8px;
            margin-bottom: 15px;
            box-shadow: 0 1px 4px rgba(0,0,0,0.08);
        }

        .line h4 {
            margin: 0 0 10px 0;
            color: #2e7d32;
        }

        .line p {
            margin: 5px 0;
            color: #333;
        }

        .btn-back {
            background-color: #2e7d32;
            display: inline-block;
            justify-content: center;
            align-content: center;
            margin-top: 20px;
            text-decoration: none;
            color: #fff;
            font-weight: bold;
            border: 1px solid #2e7d32;
            padding: 8px 16px;
            border-radius: 5px;
        }

    </style>
</head>
<body>

<div class="invoice-box">
    <div class="header">
        <h2>🧾 تفاصيل الفاتورة</h2>
    </div>

    @foreach($documentline as $line)
        <div class="line">
            <h4>الوثيقة: {{ $line->document->type ?? 'غير محدد' }}</h4>
            <p><strong>اسم المنتج:</strong> {{ $line->document->warehouseProduct->product->name ?? 'غير متوفر' }}</p>
            <p><strong>الكمية:</strong> {{ $line->quantity }}</p>
            <p><strong>سعر الوحدة:</strong> {{ $line->unit_price }} ل.س</p>
            <p><strong>السعر الإجمالي:</strong> {{ $line->quantity * $line->unit_price }} ل.س</p>
        </div>
    @endforeach

    <a href="{{ route('manager.documents.managerDocument') }}" class="btn-back"> رجوع</a>
</div>

</body>
</html>
