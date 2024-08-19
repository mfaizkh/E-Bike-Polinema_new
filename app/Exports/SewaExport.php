<?php

namespace App\Exports;

use Carbon\Carbon;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromQuery;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use PhpOffice\PhpSpreadsheet\Reader\Xml\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Style\Alignment as StyleAlignment;

class SewaExport implements WithHeadings, WithMapping, WithStyles, FromCollection
{
    use Exportable;

    private $index = 0;
    private $data;

    public function __construct($data)
    {
        $this->data = $data;
    }
   
    public function headings(): array
    {
        return [
            ['E-BIKE POLINEMA'],
            [' DATA RIWAYAT SEWA '],
            [
                'NO', 
                'NAMA',
                'TELEPON',
                'DURASI' ,               
                'BIAYA' ,               
                'WAKTU MULAI SEWA' , 
                'WAKTU PENGEMBALIAN' , 
                'FOTO PENGEMBALIAN' , 
            ],
        ];
    }
    
    public function collection()
    {
        return $this->data;
    }

   
    
    public function map($row): array
    {
        $row = (object) $row; 
        $this->index++;
        
       
        
        return [
            $this->index,
            $row->user->name,
            $row->user->telepon,
            $row->durasi.' Menit',
            $row->tagihan,
            $row->datetime,
            $row->datetime_kembali,
            'https://ebikepolinema.cloud/uploads/'.$row->foto_kembali,
        ];
    }
    
    
    public function styles(Worksheet $sheet)
    {
        $sheet->mergeCells('A1:H1');
        $sheet->mergeCells('A2:H2');

        // Pusatkan teks pada sel gabungan baris pertama dan kedua
        $sheet->getStyle('A1:H2')->getAlignment()->setHorizontal(StyleAlignment::HORIZONTAL_CENTER);
        // Jadikan teks pada sel gabungan baris pertama dan kedua menjadi tebal
        $sheet->getStyle('A1:H3')->getFont()->setBold(true);

        return [
            1 => ['font' => ['bold' => true]],
        ];
    }
    
   
}
