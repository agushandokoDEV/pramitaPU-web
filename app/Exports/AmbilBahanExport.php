<?php
// https://laraveldaily.com/laravel-excel-3-0-export-custom-array-excel/
namespace App\Exports;

use App\Models\AmbilBahan;
use PhpOffice\PhpSpreadsheet\Shared\Date;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithCustomStartCell;
// use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
// use Maatwebsite\Excel\Concerns\WithStyles;
// use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use Maatwebsite\Excel\Concerns\FromArray;
// use Maatwebsite\Excel\Concerns\WithTitle;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class AmbilBahanExport implements FromView,WithCustomStartCell,ShouldAutoSize
{
    /**
    * @return \Illuminate\Support\Collection
    */
    // public function collection()
    // {
    //     // return AmbilBahan::all();
    //     return AmbilBahan::with(['user','lab'])
    //     // ->whereDate('created_at', '>=', $from)
    //     // ->whereDate('created_at', '<=', $to)
    //     ->get();
    // }

    // public function query()
    // {
    //     return AmbilBahan::with(['user','lab'])->query();
    // }

    // public function array(): array
    // {
    //     return [
    //         [
    //             'name' => 'Povilas',
    //             'email' => 'povilas@laraveldaily.com',
    //         ],
    //         [
    //             'name' => 'Taylor',
    //             'email' => 'taylor@laravel.com',
    //             'tabung'=>[
    //                 ['nama'=>'a'],
    //                 ['nama'=>'b'],
    //             ]
    //         ],
    //     ];
    // }


    public function view(): View
    {
        $data=AmbilBahan::with(['user','lab','listtabung','listtabung.tabung'])
        // ->whereDate('created_at', '>=', $from)
        // ->whereDate('created_at', '<=', $to)
        ->orderBy('created_at', 'DESC')
        ->get();

        // dd($data);

        return view('admin.ambilbahan.laporan', ['data' => $data]);
    }

    public function styles(Worksheet $sheet)
    {
        $sheet->getStyle('A1')->getFont()->setBold(true);
    }

    // public function map($data): array
    // {
    //     return [
    //         // Date::dateTimeToExcel($data->created_at),
    //         $data->created_at,
    //         $data->user->namalengkap,
    //         $data->lab->nama,
    //         $data->nama_pasien,
    //         $data->yg_menyerahkan,
    //         $data->yg_menerima,
    //         $data->approved_at
    //         // Date::dateTimeToExcel($data->approved_at),
    //     ];
    // }
    public function startCell(): string
    {
        return 'A4';
    }

    // public function headings(): array
    // {
    //     return [
    //         'Tanggal',
    //         'Nama Petugas',
    //         'Tujuan Lab',
    //         'Nama Pasien',
    //         'Yang Menyerahkan',
    //         'Yang Menerima',
    //         'Jam'
    //     ];
    // }

    // public function styles(Worksheet $sheet)
    // {
    //     $sheet->getStyle('A4')->getFont()->setBold(true);
    // }
}