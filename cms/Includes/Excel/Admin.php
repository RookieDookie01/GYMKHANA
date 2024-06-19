<?php
require 'Plugin/Excel/autoload.php';

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

$fileName="Admin_".TODAYNAME.".xlsx";
$spreadsheet = new Spreadsheet();
$sheet = $spreadsheet->getActiveSheet();

//header
$header=array("ID","NAME","EMAIL","CONTACT","POSITION","STATUS","EDITED DATE","CREATE DATE");


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
$sql="SELECT * FROM admin WHERE admin_delete_date = '0000-00-00 00:00:00' or admin_delete_date IS NULL";
$adminQuery=$mysqli->query($sql);

$char='B';
if($adminQuery->num_rows>0){
    $currentrow=2;
    while($rowData=$adminQuery->fetch_assoc()){

        $sheet->setCellValue('A'.$currentrow,$rowData['admin_id']);
        $sheet->setCellValue('B'.$currentrow,$rowData['admin_name']);
        $sheet->setCellValue('C'.$currentrow,$rowData['admin_gmail']);
        $sheet->setCellValue('D'.$currentrow,$rowData['admin_contact']);
        $sheet->setCellValue('E'.$currentrow,$rowData['admin_position']);
        $sheet->setCellValue('F'.$currentrow,$rowData['admin_status']);
        $sheet->setCellValue('G'.$currentrow,$rowData['admin_edit_date']);
        $sheet->setCellValue('H'.$currentrow,$rowData['admin_create_date']);
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
