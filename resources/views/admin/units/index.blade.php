<!DOCTYPE html>
<html lang="ar">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>قائمة الوحدات</title>
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
            max-width: 1000px;
            margin: auto;
            background: #fff;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }

        h1 {
            color: #2e7d32;
            text-align: center;
            margin-bottom: 30px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        th, td {
            padding: 12px;
            border: 1px solid #ddd;
            text-align: center;
        }

        th {
            background-color: #e6e6e6;
            color: #2e7d32;
        }

        .btn {
            padding: 6px 12px;
            border: none;
            border-radius: 5px;
            color: white;
            font-size: 0.9rem;
            cursor: pointer;
            text-decoration: none;
        }

        .btn-primary {
            background-color: #2e7d32;
        }

        .btn-danger {
            background-color: #c62828;
        }

        .btn:hover {
            opacity: 0.9;
        }


        .btn-add {
            background-color: #2e7d32;
            margin-bottom: 20px;
            display: inline-block;
        }
        .btn-add:hover {
            background-color: #27632a;
        }
    </style>
</head>
<body>
<div class="container">
    <h1>قائمة الوحدات</h1>

        <a href="{{ route('admin.units.create') }}" class="btn btn-add">➕ إضافة واحدة جديدة</a>

    @if($unit->count())
        <table>
            <thead>
            <tr>
                <th>الاسم</th>
                <th>الاختصار</th>
                <th>الإجراءات</th>
            </tr>
            </thead>
            <tbody>
            @foreach($unit as $unit)
                <tr>
                    <td>{{ $unit->name }}</td>
                    <td>{{ $unit->abbreviation }}</td>
                    <td>
                        <a href="{{ route('admin.units.edit', $unit->id) }}" class="btn btn-primary">تعديل</a>
                        <form action="{{ route('admin.units.delete', $unit->id) }}" method="POST" style="display:inline-block;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger" onclick="return confirm('هل أنت متأكد من الحذف؟')">حذف</button>
                        </form>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    @else
        <p style="text-align:center; color: #c62828;">لا توجد وحدات مضافة حالياً.</p>
    @endif
</div>
</body>
</html>
