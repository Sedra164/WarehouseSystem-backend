<!DOCTYPE html>
<html lang="ar">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>عرض الأصناف</title>
    <link href="https://fonts.googleapis.com/css2?family=Cairo&display=swap" rel="stylesheet" />
    <style>
        body {
            background-color: #f5f5f5;
            font-family: 'Cairo', sans-serif;
            color: #000;
            margin: 0;
            padding: 20px;
            direction: rtl;
        }
        .container {
            max-width: 900px;
            margin: auto;
            background: #e6e6e6;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }
        h1 {
            color: #2e7d32;
            text-align: center;
            margin-bottom: 20px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            background: #fff;
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }
        th, td {
            padding: 12px 15px;
            border-bottom: 1px solid #ddd;
            text-align: right;
        }
        th {
            background-color: #2e7d32;
            color: #fff;
            font-weight: normal;
        }
        tr:hover {
            background-color: #c8e6c9;
        }
        .actions {
            display: flex;
            gap: 10px;
            justify-content: flex-end;
        }
        .btn {
            padding: 6px 12px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 0.9rem;
            color: white;
            transition: background-color 0.3s ease;
            text-decoration: none;
            display: inline-block;
        }
        .btn-edit {
            background-color: #2e7d32;
        }
        .btn-edit:hover {
            background-color:  #2e7d32;
        }
        .btn-delete {
            background-color: #c62828;
        }
        .btn-delete:hover {
            background-color: #8e1b1b;
        }
        .btn-add {
            background-color: #2e7d32;
            margin-bottom: 20px;
            display: inline-block;
        }
        .btn-add:hover {
            background-color: #27632a;
        }
        .no-data {
            text-align: center;
            padding: 20px;
            color: #666;
        }
    </style>
</head>
<body>
<div class="container">
    <h1 >قائمة الأصناف</h1>

    <a href="{{ route('admin.categories.create') }}" class="btn btn-add">➕ إضافة صنف جديد</a>

    @if($categories->count() > 0)
        <table>
            <thead>
            <tr>
                <th>الاسم</th>
                <th>الوصف</th>
                <th style="width: 160px;">الإجراءات</th>
            </tr>
            </thead>
            <tbody>
            @foreach($categories as $category)
                <tr>
                    <td>{{ $category->name }}</td>
                    <td>{{ $category->description }}</td>
                    <td>
                        <div class="actions">
                            <a href="{{ route('admin.categories.edit', $category->id) }}" class="btn btn-edit">تعديل</a>
                            <form action="{{ route('admin.categories.delete', $category->id) }}" method="POST" onsubmit="return confirm('هل أنت متأكد من حذف هذا الصنف؟');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-delete">حذف</button>
                            </form>
                        </div>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    @else
        <div class="no-data">لا يوجد أصناف حالياً.</div>
    @endif
</div>
</body>
</html>
