<!DOCTYPE html>
<html lang="ar">
<head>
    <meta charset="UTF-8">
    <title>تعديل الفاتورة</title>
    <style>
        body {
            font-family: 'Segoe UI', sans-serif;
            background-color: #f5f5f5;
            padding: 30px;
            direction: rtl;
        }

        .container {
            background: #fff;
            padding: 25px;
            max-width: 800px;
            margin: auto;
            border-radius: 8px;
            box-shadow: 0 2px 6px rgba(0,0,0,0.1);
        }

        h2 {
            text-align: center;
            color: #2e7d32;
            margin-bottom: 25px;
        }
        input[type="text"],
        textarea {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 6px;
        }

        textarea {
            resize: vertical;
            height: 100px;
        }

        label {
            display: block;
            margin-bottom: 6px;
            font-weight: bold;
            color: #333;
        }

        input, select {
            width: 100%;
            padding: 10px;
            margin-bottom: 20px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        button {
            background-color: #2e7d32;
            color: white;
            padding: 10px 25px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            display: block;
            margin: auto;
            float: left;
        }

        button:hover {
            background-color: #256029;
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
        function togglePartnerField() {
            const type = document.getElementById("type").value;
            const partnerField = document.getElementById("partner-container");
            if (type === "waste") {
                partnerField.classList.add("hidden");
            } else {
                partnerField.classList.remove("hidden");
            }
        }

        window.addEventListener('DOMContentLoaded', () => {
            togglePartnerField();
        });
    </script>
</head>
<body>

<div class="container">
    <h2>تعديل الفاتورة</h2>

    <form action="{{ route('staff.documents.update', $document->id) }}" method="POST">
        @csrf
        @method('PUT')

        <label for="type">نوع الفاتورة</label>
        <select name="type" id="type" onchange="togglePartnerField()" required>
            <option value="purchase" {{ $document->type === 'purchase' ? 'selected' : '' }}>وارد</option>
            <option value="sale" {{ $document->type === 'sale' ? 'selected' : '' }}>صادر</option>
            <option value="waste" {{ $document->type === 'waste' ? 'selected' : '' }}>إتلاف</option>
        </select>

        <label for="date">تاريخ الفاتورة</label>
        <input type="date" name="date" id="date" value="{{ old('date', $document->date) }}" required>

        <div id="partner-container">
            <label for="partner_id">اسم العميل</label>
            <select name="partner_id" id="partner_id">
                <option value="" disabled>اختر الشريك</option>
                @foreach($partner as $partner)
                    <option value="{{ $partner->id }}" {{ $document->partner_id == $partner->id ? 'selected' : '' }}>
                        {{ $partner->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <label for="warehouse_product_id">المنتج</label>
        <select name="warehouse_product_id" id="warehouse_product_id" required>
            @foreach($warehouseProduct as $wp)
                <option value="{{ $wp->id }}" {{ $document->warehouse_product_id == $wp->id ? 'selected' : '' }}>
                    {{ $wp->product->name ?? 'منتج غير معروف' }}
                </option>
            @endforeach
        </select>

        <label for="warehouse_user_id">الموظف (والمستودع)</label>
        <select name="warehouse_user_id" id="warehouse_user_id" required>
            @foreach($warehouseUser as $wu)
                <option value="{{ $wu->id }}" {{ $document->warehouse_user_id == $wu->id ? 'selected' : '' }}>
                    {{ $wu->user->full_name }} - ({{ $wu->warehouse->name }})
                </option>
            @endforeach
        </select>

        <label for="notes">ملاحظات</label>
        <textarea name="notes" id="notes">{{ old('notes',$document->notes)  }}</textarea>

        <button type="submit">💾 تحديث الفاتورة</button>
        <a href="{{ route('staff.documents.index') }}" class="back-link">← الرجوع إلى القائمة</a>
    </form>
</div>

</body>
</html>
