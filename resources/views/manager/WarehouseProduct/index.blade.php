<!DOCTYPE html>
<html lang="ar">
<head>
    <meta charset="UTF-8">
    <title>قائمة منتجات المستودع</title>
    <style>
        body {
            font-family: 'Segoe UI', sans-serif;
            background-color: #f5f5f5;
            padding: 30px;
            margin: 0;
            direction: rtl;
        }

        .container {
            background: #e6e6e6;
            padding: 25px;
            border-radius: 8px;
            max-width: 1100px;
            margin: auto;
            box-shadow: 0 2px 6px rgba(0,0,0,0.1);
        }

        .header-title {
            text-align: center;
            color: #2e7d32;
            margin-bottom: 10px;
        }
        .actions {
            display: flex;
            margin-bottom: 20px;
            width: 100%;
            margin-top: 10px;
            text-align: right;
        }
        .add-btn {
            background-color: #2e7d32;
            color: white;
            padding: 8px 16px;
            border-radius: 4px;
            text-decoration: none;
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

        .low-stock {
            background-color: rgba(198, 40, 40, 0.5) !important;
            color: #721c24;
        }

        .btn-edit {
            background-color: #2e7d32;
            color: white;
            padding: 5px 12px;
            border-radius: 4px;
            text-decoration: none;
            margin-left: 5px;
        }

        .btn-delete {
            background-color: #c62828;
            color: white;
            border: none;
            padding: 6px 12px;
            border-radius: 5px;
            font-size: 1.1rem;
            cursor: pointer;
        }
    </style>
</head>
<body>

<div class="container">
    <h2 class="header-title">قائمة منتجات المستودع</h2>
    <div class="actions">
        <a href="{{ route('manager.WarehouseProducts.create') }}" class="add-btn">➕ إضافة منتج</a>
    </div>

    <table>
        <thead>
        <tr>
            <th>المنتج</th>
            <th>المستودع</th>
            <th>الكمية الحالية</th>
            <th>الحد الأدنى</th>
            <th>العمليات</th>
        </tr>
        </thead>
        <tbody>
        @forelse ($warehouseProduct as $wp)
            <tr class="{{ $wp->quantity < $wp->min_quantity ? 'low-stock' : '' }}">
                <td>{{ $wp->product->name ?? 'غير متوفر' }}</td>
                <td>{{ $wp->warehouse->name ?? 'غير متوفر' }}</td>
                <td>{{ $wp->quantity }}</td>
                <td>{{ $wp->min_quantity }}</td>
                <td>
                    <a href="{{ route('manager.WarehouseProducts.edit', $wp->id) }}" class="btn-edit">تعديل</a>
                    <form action="{{ route('manager.WarehouseProducts.delete', $wp->id) }}" method="POST" style="display:inline-block;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn-delete" onclick="return confirm('هل أنت متأكد من الحذف؟')">حذف</button>
                    </form>
                </td>
            </tr>
            @empty
                <tr>
                    <td colspan="4" style="text-align:center;">لا توجد بيانات لعرضها</td>
                </tr>
        @endforelse
        </tbody>
    </table>
</div>

</body>
</html>
