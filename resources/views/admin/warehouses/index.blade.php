<!DOCTYPE html>
<html lang="ar">
<head>
    <meta charset="UTF-8">
    <title>المستودعات</title>
    <link href="https://fonts.googleapis.com/css2?family=Cairo&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Cairo', sans-serif;
            background-color: #f5f5f5;
            margin: 0;
            padding: 20px;
            color: #000;
            direction: rtl;
        }

        .container {
            max-width: 1000px;
            margin: auto;
            background: #fff;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }

        h1 {
            text-align: center;
            color: #2e7d32;
            margin-bottom: 30px;
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
            margin-top: 10px;
        }

        th, td {
            padding: 12px;
            text-align: left;
            border-bottom: 1px solid #ccc;
        }

        th {
            background-color: #e6e6e6;
            color: #2e7d32;
        }

        .btn {
            padding: 6px 12px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 0.9rem;
        }

        .btn-edit {
            background-color: #2e7d32;
            color: white;
            text-decoration: none;
        }

        .btn-delete {
            background-color: #c62828;
            color: white;
            margin-right: 5px;
        }

        .no-data {
            text-align: center;
            color: #999;
            padding: 20px;
        }
    </style>
</head>
<body>
<div class="container">
    <h1>قائمة المستودعات</h1>

    <a href="{{ route('admin.warehouses.create') }}" class="add-btn">➕ إضافة مستودع جديد</a>

    @if($warehouse->isEmpty())
        <div class="no-data">لا يوجد مستودعات حالياً.</div>
    @else
        <table>
            <thead>
            <tr>
                <th>الاسم</th>
                <th>الموقع</th>
                <th>الوصف</th>
                <th>الإجراءات</th>
            </tr>
            </thead>
            <tbody>
            @foreach($warehouse as $warehouse)
                <tr>
                    <td>{{ $warehouse->name }}</td>
                    <td>{{ $warehouse->location }}</td>
                    <td>{{ $warehouse->description }}</td>
                    <td>
                        <a href="{{ route('admin.warehouses.edit', $warehouse->id) }}" class="btn btn-edit">تعديل</a>
                        <form action="{{ route('admin.warehouses.delete', $warehouse->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-delete" onclick="return confirm('هل أنت متأكد من الحذف؟')">حذف</button>
                        </form>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    @endif
</div>
</body>
</html>
