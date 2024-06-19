<?php
require 'Plugin/Excel/autoload.php';

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

$fileName="Activity_".TODAYNAME.".xlsx";
$spreadsheet = new Spreadsheet();
$sheet = $spreadsheet->getActiveSheet();

//header
$header=array("ID","TITLE","DAY","TIME","TYPE","PLAN REQUIRED","EDITED DATE","CREATE DATE");


//style
$headerStyle=[
    'font' => [
        'bold' => true,
    ],
    'alignment' => [
        'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
        'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER,
    ],
];

$char='A';
$row='1';
foreach($header as $data){
    $sheet->setCellValue($char.$row, $data);
    $sheet->getStyle($char.$row)->applyFromArray($headerStyle);
    $char++;
}

// input data
$sql="SELECT a.*,b.plan_name FROM activity a
LEFT JOIN plan b ON a.plan_id=b.plan_id
WHERE  (a.activity_delete_date='0000-00-00 00:00:00' or a.activity_delete_date IS NULL)
ORDER BY plan_id;";
$activityQuery=$mysqli->query($sql);

$char='B';
if($activityQuery->num_rows>0){
    $currentrow=2;
    while($rowData=$activityQuery->fetch_assoc()){

        $sheet->setCellValue('A'.$currentrow,$rowData['activity_id']);
        $sheet->setCellValue('B'.$currentrow,$rowData['activity_name']);
        $sheet->setCellValue('C'.$currentrow,$rowData['activity_type']);
        $sheet->setCellValue('D'.$currentrow,$rowData['activity_day']);
        $sheet->setCellValue('E'.$currentrow,$rowData['activity_time']);
        $sheet->setCellValue('F'.$currentrow,($rowData['plan_id']=="0"?"No Plan Required":$rowData['plan_name']));
        $sheet->setCellValue('G'.$currentrow,$rowData['activity_edit_date']);
        $sheet->setCellValue('H'.$currentrow,$rowData['activity_create_date']);
        $currentrow++;
    }
    //to set the width
    foreach (range('A', 'H') as $column) {
        $sheet->getColumnDimension($column)->setAutoSize(true);
    }
}else{
    $sheet->mergeCells("A2:H2");
    $sheet->setCellValue("A2","No data Available");
}


$writer = new Xlsx($spreadsheet);

header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment;filename="'.$fileName.'"');
header('Cache-Control: no-store, no-cache, must-revalidate, max-age=0');
header('Pragma: no-cache');


$writer->save('php://output');
exit;
