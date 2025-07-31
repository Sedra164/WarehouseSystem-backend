<!-- resources/views/staff/documents/create.blade.php -->

<!DOCTYPE html>
<html lang="ar">
<head>
    <meta charset="UTF-8">
    <title>إضافة فاتورة</title>
    <style>
        body {
            font-family: 'Segoe UI', sans-serif;
            direction: rtl;
            background: #f5f5f5;
            padding: 30px;
        }

        .container {
            background: #fff;
            padding: 25px;
            max-width: 800px;
            margin: auto;
            border-radius: 8px;
            box-shadow: 0 2px 6px rgba(0,0,0,0.1);
            height: 650px;

        }

        label {
            font-weight: bold;
        }

        select, input, textarea {
            width: 100%;
            padding: 10px;
            margin-bottom: 20px;
            border-radius: 6px;
            border: 1px solid #ccc;
        }

        button {
            background-color: #2e7d32;
            color: white;
            padding: 10px 25px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            float: left;
        }

        .hidden {
            display: none;
        }
        a.back-link {
            display: inline-block;
            margin-top: 20px;
            color: #2e7d32;
            text-decoration: none;
        }
    </style>

    <script>
        function togglePartner() {
            const type = document.getElementById("type").value;
            const partnerField = document.getElementById("partner-field");

            if (type === "waste") {
                partnerField.classList.add("hidden");
            } else {
                partnerField.classList.remove("hidden");
            }
        }

        window.addEventListener('DOMContentLoaded', togglePartner);
    </script>
</head>
<body>

<div class="container">
    <h2 style="color: #2e7d32; text-align: center">إضافة فاتورة جديدة</h2>

    <form action="{{ route('staff.documents.store') }}" method="POST">
        @csrf

        <label for="type">نوع الفاتورة</label>
        <select name="type" id="type" onchange="togglePartner()" required>
            <option disabled selected>اختر نوع الفاتورة</option>
            <option value="purchase">وارد</option>
            <option value="sale">صادر</option>
            <option value="waste">إتلاف</option>
        </select>

        <label for="date">تاريخ الفاتورة</label>
        <input type="date" name="date" required>

        <div id="partner-field">
            <label for="partner_id">اسم العميل</label>
            <select name="partner_id">
                <option disabled selected>اختر العميل</option>
                @foreach($partner as $partner)
                    <option value="{{ $partner->id }}">{{ $partner->name }}</option>
                @endforeach
            </select>
        </div>

        <label for="warehouse_product_id">المنتج</label>
        <select name="warehouse_product_id" required>
            <option disabled selected>اختر المنتج</option>
            @foreach($warehouseProduct as $wp)
                <option value="{{ $wp->id }}">{{ $wp->product->name }}</option>
            @endforeach
        </select>

        <label for="warehouse_user_id">الموظف (والمستودع)</label>
        <input type="text" value="{{$userName}}-{{$warehouseName}}" disabled>
        <input type="hidden" name="warehouse_user_id" value="{{$warehouseUserId}}">

        <label for="notes">ملاحظات</label>
        <textarea name="notes"></textarea>

        <button type="submit">💾 حفظ الفاتورة والانتقال لإضافة للتفاصيل</button>
        <a href="{{ route('staff.documents.index') }}" class="back-link">← الرجوع إلى القائمة</a>
    </form>
</div>

</body>
</html>

