<!DOCTYPE html>
<html lang="ar">
<head>
    <meta charset="UTF-8">
    <title>قائمة الفواتير</title>
    <style>
        body {
            font-family: 'Segoe UI', sans-serif;
            background-color: #f5f5f5;
            padding: 30px;
            direction: rtl;
            margin: 0;
        }

        .container {
            max-width: 1100px;
            background: #e6e6e6;
            margin: auto;
            padding: 25px;
            border-radius: 8px;
            box-shadow: 0 2px 6px rgba(0,0,0,0.1);
        }

        h2 {
            text-align: center;
            color: #2e7d32;
            margin-bottom: 20px;
        }
        .add-btn {
            background-color: #2e7d32;
            color: white;
            padding: 10px 20px;
            text-decoration: none;
            border-radius: 6px;
            margin-bottom: 20px;
            display: inline-block;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            background: white;
            border-radius: 8px;
            overflow: hidden;
            margin-bottom: 20px;
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

        .btn {
            padding: 5px 12px;
            border-radius: 5px;
            color: white;
            text-decoration: none;
            margin: 2px;
            display: inline-block;
        }
        .btn-edit { background-color: #388e3c; }
        .btn-delete { background-color: #c62828; }
        .btn-show { background-color: #6c757d; }

        form {
            display: inline-block;
        }
    </style>
</head>
<body>

<div class="container">
    <h2>قائمة الفواتير</h2>
    <a href="{{ route('staff.documents.create') }}" class="add-btn">➕ إضافة فاتورة جديدة </a>
    <table>
        <thead>
        <tr>
            <th>#</th>
            <th>نوع الفاتورة</th>
            <th>تاريخ الفاتورة</th>
            <th>اسم المنتج </th>
            <th>اسم العميل</th>
            <th>المستودع</th>
            <th>اسم الموظف</th>
            <th>العمليات</th>
        </tr>
        </thead>
        <tbody>
        @foreach ($document as $doc)
            <tr>
                <td>{{$doc->id}}</td>
                <td>{{ $doc->type == 'purchase' ? 'وارد' : ($doc->type == 'sale' ? 'صادر' : 'إتلاف') }}</td>
                <td>{{ $doc->date }}</td>
                <td>{{$doc->warehouseProduct->product->name??'غير متوفر'}}</td>
                <td>{{ $doc->partner->name ?? '—' }}</td>
                <td>{{ $doc->warehouseUser->warehouse->name ?? 'غير متوفر' }}</td>
                <td>{{ $doc->warehouseUser->user->full_name ?? 'غير متوفر' }}</td>
                <td>
                    <a href="{{ route('staff.documentLines.index', $doc->id) }}" class="btn btn-show">عرض التفاصيل</a>
                    <a href="{{ route('staff.documents.edit', $doc->id) }}" class="btn btn-edit">تعديل</a>
                    <form action="{{ route('staff.documents.delete', $doc->id) }}" method="POST" onsubmit="return confirm('هل أنت متأكد من الحذف؟')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-delete">حذف</button>
                    </form>
                </td>
            </tr>
        @endforeach
        </tbody>

    </table>
    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none; ">
        @csrf
    </form>
    <a href="#" style="color: #2e7d32; text-decoration: none;" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" class="logout-link">
        🔓 هل تريد تسجيل الخروج؟
    </a>

</div>

</body>
</html>
