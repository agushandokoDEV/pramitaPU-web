<?php

namespace App\Exports;

use App\Models\PengantaranDokter;
use App\Models\User;
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
use Maatwebsite\Excel\Concerns\Exportable;
use Carbon\Carbon;
// use Maatwebsite\Excel\Concerns\WithEvents;
// use Maatwebsite\Excel\Events\BeforeSheet;

class PengantaranDokterExport implements FromView,WithCustomStartCell,ShouldAutoSize
{
    use Exportable;

    private $from=null;
    private $to=null;
    private $user_id=null;

    public function __construct(String $from, String $to,String $user=null)
    {
        $this->from=$from;
        $this->to=$to;
        $this->user_id=$user;
    }
    
    public function view(): View
    {
        $query=PengantaranDokter::with(['user','dokter','uraianterpilih','uraianterpilih.jenis'])
            ->whereDate('created_at', '>=', $this->from)
            ->whereDate('created_at', '<=', $this->to)
            ->orderBy('created_at', 'DESC');

        $user=null;
        if($this->user_id != null){
            $user=User::where('id',$this->user_id)->first();
            $query->where('user_id',$this->user_id);
        }

        $data['list']=$query->get();
        $data['filter']=(object) array(
            'from'=>Carbon::parse($this->from)->isoFormat('D MMMM Y'),
            'to'=>Carbon::parse($this->to)->isoFormat('D MMMM Y'),
            'user'=>$user
        );

        return view('admin.pengantarandokter.laporan', ['data' => (object)$data]);
    }

    public function styles(Worksheet $sheet)
    {
        $sheet->getStyle('A1')->getFont()->setBold(true);
    }

    
    public function startCell(): string
    {
        return 'A4';
    }
}
