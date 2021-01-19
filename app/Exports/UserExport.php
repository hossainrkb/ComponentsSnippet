<?php
namespace App\Exports;

use App\Models\User;
use Maatwebsite\Excel\Events\AfterSheet;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class UserExport implements FromQuery,ShouldAutoSize,WithMapping,WithHeadings ,WithEvents{
    use Exportable;
        public function query()
    {
        return User::query()->with('address');
    }
    // public function collection() {
    //     return User::with('address')->get();
    // }
     public function map($user): array
    {
        return [
            $user->id,
            $user->email,
            $user->address->address
            // Date::dateTimeToExcel($invoice->created_at),
        ];
    }
       public function headings(): array
    {
        return [
            '#',
            'Email',
            'Address',
          
        ];
    }
        public function registerEvents(): array
    {
        return [
            AfterSheet::class => function (AfterSheet $event) {
                $event->sheet->getStyle('A1:C1')->applyFromArray([
                    'font' => [
                        'bold' => true
                    ]
                ]);
            }
        ];
    }
}