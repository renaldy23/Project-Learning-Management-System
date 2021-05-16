<?php

namespace App\Http\Controllers\Guru;

use App\Http\Controllers\Controller;
use App\Models\Submission;
use App\Models\Task;
use Illuminate\Http\Request;
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Spreadsheet;

class EksportController extends Controller
{
    public function submission_eksport($id)
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
}
