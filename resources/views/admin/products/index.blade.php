<link href="https://fonts.googleapis.com/css2?family=Cairo&display=swap" rel="stylesheet" />
    <div class="container" style="font-family:'Cairo'; padding: 20px; max-width: 1200px; margin: auto;direction: rtl;">

        <h2 style="color: #2e7d32; margin-bottom: 20px;">قائمة المنتجات</h2>

        <a href="{{ route('admin.products.create') }}"
           style="display: inline-block; background-color: #2e7d32; color: white; padding: 10px 20px; border-radius: 8px; text-decoration: none; margin-bottom: 25px; box-shadow: 0 2px 4px rgba(0,0,0,0.1);">
            ➕ إضافة منتج جديد
        </a>

        @if($product->count() > 0)
            <table style="width: 100%; border-collapse: collapse; background: #fff; box-shadow: 0 2px 6px rgba(0,0,0,0.1); color: #000;">
                <thead style="background-color: #2e7d32; color: white; font-weight: 600;">
                <tr>
                    <th style="padding: 12px; border: 1px solid #ddd;">اسم المنتج</th>
                    <th style="padding: 12px; border: 1px solid #ddd;">SKU</th>
                    <th style="padding: 12px; border: 1px solid #ddd;">الوصف</th>
                    <th style="padding: 12px; border: 1px solid #ddd;">التصنيف</th>
                    <th style="padding: 12px; border: 1px solid #ddd;">الواحدة</th>
                    <th style="padding: 12px; border: 1px solid #ddd;">إجراءات</th>
                </tr>
                </thead>
                <tbody>
                @foreach($product as $product)
                    <tr style="border-bottom: 1px solid #ddd;">
                        <td style="padding: 12px;">{{ $product->name }}</td>
                        <td style="padding: 12px;">{{ $product->sku }}</td>
                        <td style="padding: 12px;">{{ $product->description }}</td>
                        <td style="padding: 12px;">{{ $product->category->name ?? 'بدون تصنيف' }}</td>
                        <td style="padding: 12px;">{{ $product->unit->name ?? 'بدون وحدة' }}</td>
                        <td style="padding: 12px;">
                            <a href="{{ route('admin.products.edit', $product->id) }}"
                               style="background-color: #2e7d32; color: white; padding: 6px 12px; border-radius: 5px; text-decoration: none; margin-right: 5px; font-size: 0.9rem;">
                                تعديل
                            </a>

                            <form action="{{ route('admin.products.delete', $product->id) }}" method="POST" style="display: inline-block;" onsubmit="return confirm('هل أنت متأكد من حذف المنتج؟');">
                                @csrf
                                @method('DELETE')
                                <button type="submit"
                                        style="background-color: #c62828; color: white; border: none; padding: 6px 12px; border-radius: 5px; font-size: 1.3rem; cursor: pointer;">
                                    حذف
                                </button>
                            </form>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        @else
            <p style="color: #c62828; font-weight: 600;">لا توجد منتجات حالياً.</p>
        @endif

    </div>

