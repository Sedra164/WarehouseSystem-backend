<!DOCTYPE html>
<html lang="ar">
<head>
    <meta charset="UTF-8">
    <title>قائمة الشركاء</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.rtl.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f5f5f5;
            font-family: 'Segoe UI', sans-serif;
            direction: rtl;
            padding: 20px;
        }
        .main-box {
            background: #e6e6e6;
            border-radius: 8px;
            padding: 30px;
            box-shadow: 0 2px 6px rgba(0,0,0,0.1);
            max-width: 1100px;
            margin: auto;
        }
        .btn-add {
            background-color: #2e7d32;
            color: white;
            font-weight: bold;
        }
        .btn-add:hover {
            background-color: #27692b;

        }
        .table th {
            background-color: #2e7d32;
            color: white;
            text-align: center;
        }
        .table td {
            text-align: center;
            vertical-align: middle;
        }
        .title-box {
            display: flex;
            justify-content: space-between;
            align-items: center;
            flex-wrap: wrap;
            margin-bottom: 20px;
        }
        .title-box h2 {
            margin: 0 auto;
            color: #2e7d32;
            font-weight: bold;
        }
    </style>
</head>
<body>

<div class="main-box">
    <div class="title-box">
        <h2 class="text-center w-100">قائمة الشركاء</h2>
        <div class="d-flex justify-content-end">
            <a href="{{ route('manager.partners.create') }}" class="btn btn-add">➕ إضافة شريك</a>
        </div>
    </div>

    <table class="table table-bordered table-striped">
        <thead>
        <tr>
            <th>#</th>
            <th>الاسم</th>
            <th>النوع</th>
            <th>البريد الإلكتروني</th>
            <th>الهاتف</th>
            <th>العنوان</th>
            <th>الخيارات</th>
        </tr>
        </thead>
        <tbody>
        @forelse ($partner as $partner)
            <tr>
                <td>{{ $partner->id }}</td>
                <td>{{ $partner->name }}</td>
                <td>{{ $partner->type === 'customer' ? 'زبون' : 'مورد' }}</td>
                <td>{{ $partner->email }}</td>
                <td>{{ $partner->phone }}</td>
                <td>{{ $partner->address }}</td>
                <td>
                    <a href="{{ route('manager.partners.edit', $partner->id) }}" class="btn btn-sm btn-success">تعديل</a>
                    <form action="{{ route('manager.partners.delete', $partner->id) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-sm btn-danger" onclick="return confirm('هل أنت متأكد من الحذف؟')">حذف</button>
                    </form>
                </td>
            </tr>
        @empty
            <tr>
                <td colspan="7">لا يوجد شركاء حالياً.</td>
            </tr>
        @endforelse
        </tbody>
    </table>
</div>

</body>
</html>
