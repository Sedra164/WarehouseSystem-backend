<!DOCTYPE html>
<html lang="ar">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link href="https://fonts.googleapis.com/css2?family=Cairo&display=swap" rel="stylesheet">
    <title>قائمة موظفي المخازن</title>
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
            max-width: 1200px;
            margin: auto;
            background: #fff;
            border-radius: 8px;
            padding: 20px;
            box-shadow: 0 2px 6px rgba(0,0,0,0.1);
        }
        h2 {
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
            font-size: 16px;
        }
        thead {
            background-color: #2e7d32;
            color: #fff;
        }
        th, td {
            padding: 12px 15px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }
        tbody tr:hover {
            background-color: #f1f1f1;
        }
        a.button {
            background-color: #2e7d32;
            color: white;
            padding: 7px 14px;
            text-decoration: none;
            border-radius: 5px;
            margin-right: 5px;
            font-size: 14px;
        }
        form.delete-form button {
            background-color: #c62828;
            color: white;
            padding: 7px 14px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 14px;
        }
    </style>
</head>
<body>
<div class="container">
    <h2 style="text-align: center">إدارة مدراءالمخازن</h2>
    <a href="{{ route('manager.warehouse_users.create') }}" class="add-btn">➕ إضافة مدير جديد لمستودع</a>
    <table>
        <thead>
        <tr>
            <th>اسم المستخدم</th>
            <th>اسم المخزن</th>
            <th>النوع</th>
            <th>إجراءات</th>
        </tr>
        </thead>
        <tbody>
        @forelse ($warehouseUser as $wu)
            <tr>
                <td>{{ $wu->user->full_name }}</td>
                <td>{{ $wu->warehouse->name }}</td>
                <td>{{ ucfirst($wu->type) }}</td>
                <td>
                    <a href="{{ route('manager.warehouse_users.edit', $wu->id) }}" class="button">تعديل</a>
                    <form action="{{ route('manager.warehouse_users.delete', $wu->id) }}" method="POST" class="delete-form" style="display:inline-block;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" onclick="return confirm('هل أنت متأكد من الحذف؟')">حذف</button>
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
