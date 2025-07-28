<!DOCTYPE html>
<html lang="ar">
<head>
    <meta charset="UTF-8">
    <title>قائمة المستندات</title>
    <style>
        body {
            font-family: 'Segoe UI', sans-serif;
            background-color: #f5f5f5;
            padding: 30px;
            margin: 0;
            direction: rtl;
        }

        .container {
            background: #f0f0f0;
            padding: 25px;
            border-radius: 8px;
            max-width: 1200px;
            margin: auto;
            box-shadow: 0 2px 6px rgba(0,0,0,0.1);
        }

        .header {
            margin-bottom: 20px;
            text-align: center;
        }

        .header h2 {
            color: #2e7d32;
            margin: 0;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            background: white;
            border-radius: 8px;
            overflow: hidden;
        }

        th, td {
            padding: 12px;
            border-bottom: 1px solid #ddd;
            text-align: center;
        }

        th {
            background-color: #2e7d32;
            color: white;
        }

        .btn-view {
            background-color: #2e7d32;
            color: white;
            padding: 6px 14px;
            border-radius: 4px;
            text-decoration: none;
        }
    </style>
</head>
<body>

<div class="container">
    <div class="header">
        <h2>قائمة الفواتير </h2>
    </div>

    <table>
        <thead>
        <tr>
            <th>رقم الفاتورة</th>
            <th>نوع الفاتورة</th>
            <th>التاريخ</th>
            <th>العميل </th>
            <th>المنتج </th>
            <th>اسم المستودع</th>
            <th>موظف المستودع</th>
            <th>        </th>
        </tr>
        </thead>
        <tbody>
        @foreach ($document as $document)
            <tr>
                <td>{{ $document->id }}</td>
                <td>{{ $document->type }}</td>
                <td>{{ $document->date }}</td>
                <td>{{ $document->partner->name ?? 'غير متوفر' }}</td>
                <td>{{ $document->warehouseProduct->product->name ?? 'غير متوفر' }}</td>
                <td>{{ $document->warehouseProduct->warehouse->name ?? 'غير متوفر' }}</td>
                <td>{{ $document->warehouseUser->user->full_name ?? 'غير متوفر' }}</td>
                <td>
                    <a href="{{ route('manager.documentLines.managerDocumentLine', $document->id) }}" class="btn-view">عرض التفاصيل</a>

                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>

</body>
</html>
