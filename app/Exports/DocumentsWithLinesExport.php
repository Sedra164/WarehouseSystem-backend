<?php

namespace App\Exports;

use App\Models\Document;
use App\Models\WarehouseUser;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\WithTitle;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class DocumentsWithLinesExport implements FromCollection, WithHeadings,WithStyles,WithTitle,ShouldAutoSize
{
    /**
    * @return \Illuminate\Support\Collection
    */
    protected $warehouseId;

    public function __construct($userId)
    {
        $this->warehouseId = WarehouseUser::where('user_id', $userId)->value('warehouse_id');
    }
    public function collection()
    {
        return Document::whereHas('warehouseUser', function ($query) {
            $query->where('warehouse_id', $this->warehouseId);
        })
            ->with(['documentLine','partner', 'warehouseProduct.product', 'warehouseUser.user'])
            ->get()
            ->flatMap(function ($document) {
                return $document->documentLine->map(function ($line) use ($document) {
                    return [
                        'document_id'     => $document->id,
                        'type'            => $document->type,
                        'date'            => $document->date,
                        'employee'        => $document->warehouseUser->user->full_name ?? '',
                        'warehouse'       =>$document->warehouseUser->warehouse->name??'',
                        'partner'         => $document->partner->name ?? '',
                        'product'         => $document->warehouseProduct->product->name ?? '',
                        'quantity'        => $line->quantity,
                        'unit_price'      => $line->unit_price,
                        'total_price'     => $line->total_price,
                        'notes'           => $document->notes,
                    ];
                });
            });
    }

        public function headings(): array
    {
        return [
            'رقم الفاتورة',
            'نوع الفاتورة',
            'تاريخ الفاتورة',
            'اسم الموظف',
            'اسم المستودع',
            'اسم العميل',
            'المنتج',
            'الكمية',
            'سعر الوحدة',
            'السعر الإجمالي',
            'ملاحظات',
        ];
    }
    public function styles(Worksheet $sheet){
        return[ 1 => ['font' => ['bold' => true, 'color' => ['rgb' => '1B5E20']]]];
    }
    public function title():string{
        return 'تفاصيل الفاتورة';
    }

}
