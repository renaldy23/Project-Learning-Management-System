<?php 

namespace App\Eksport;

use App\Models\Guru;
use App\Models\Siswa;
use App\Models\Submission;
use App\Models\Task;
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Spreadsheet;

class EksportHandler
{
    public static function eksport_submission($id)
    {
        $task = Task::findOrFail($id);
        $submission = Submission::where("task_id",$id)->get();
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();

        $sheet->setCellValue("A1", "No");
        $sheet->setCellValue("B1", "Nama Siswa");
        $sheet->setCellValue("C1", "Status");
        $sheet->setCellValue("D1", "Grade");
        $sheet->setCellValue("E1", "Submitted At");

        $i = 2;
        $no = 1;
        foreach ($submission as $item) {
            $sheet->setCellValue("A" . $i, $no++);
            $sheet->setCellValue("B" . $i, $item->siswa->name);
            $sheet->setCellValue("C" . $i, $item->status);
            $sheet->setCellValue("D" . $i, $item->grade);
            $sheet->setCellValue("E" . $i, $item->submitted_at);
            $i++;
        }

        header("Content-type: application/vnd-ms-excel");
        header("Content-Disposition: attachment; filename=$task->title.xlsx");
        $writer = IOFactory::createWriter($spreadsheet, 'Xlsx');
        $writer->save('php://output');
    }

    public static function siswa_excel($kelas_id){
        $siswa = Siswa::with("kelas","jurusan")->where("kelas_id",$kelas_id)->get();
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();

        $sheet->setCellValue("A1", "No");
        $sheet->setCellValue("B1", "Nama Siswa");
        $sheet->setCellValue("C1", "Nomor Induk Siswa");
        $sheet->setCellValue("D1", "Kelas");
        $sheet->setCellValue("E1", "Jurusan");
        $sheet->setCellValue("F1", "Username");
        $sheet->setCellValue("G1", "Password");

        $i = 2;
        $no = 1;
        foreach ($siswa as $val) {
            $sheet->setCellValue("A" . $i, $no++);
            $sheet->setCellValue("B" . $i, $val->name);
            $sheet->setCellValue("C" . $i, $val->nis);
            $sheet->setCellValue("D" . $i, $val->kelas->nama_kelas);
            $sheet->setCellValue("E" . $i, $val->jurusan->nama_jurusan);
            $sheet->setCellValue("F" . $i, $val->username);
            $sheet->setCellValue("G" . $i, $val->password_without_hash);
            $i++;
        }

        header("Content-type: application/vnd-ms-excel");
        header("Content-Disposition: attachment; filename=Data Akun LMS - ".date("Y-m-d").".xlsx");
        $writer = IOFactory::createWriter($spreadsheet, 'Xlsx');
        $writer->save('php://output');
    }

    public static function guru_excel()
    {
        $guru = Guru::all();
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();

        $sheet->setCellValue("A1", "No");
        $sheet->setCellValue("B1", "Nama Guru");
        $sheet->setCellValue("C1", "Nomor Induk Pegawai");
        $sheet->setCellValue("D1", "Username");
        $sheet->setCellValue("E1", "Password");

        $i = 2;
        $no = 1;
        foreach ($guru as $item) {
            $sheet->setCellValue("A" . $i, $no++);
            $sheet->setCellValue("B" . $i, $item->name);
            $sheet->setCellValue("C" . $i, $item->nip);
            $sheet->setCellValue("D" . $i, $item->username);
            $sheet->setCellValue("E" . $i, $item->password_without_hash);
            $i++;
        }

        header("Content-type: application/vnd-ms-excel");
        header("Content-Disposition: attachment; filename=Data Akun LMS(GURU) - ".date("Y-m-d").".xlsx");
        $writer = IOFactory::createWriter($spreadsheet, 'Xlsx');
        $writer->save('php://output');
    }
}


?>