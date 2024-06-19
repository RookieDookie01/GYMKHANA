<?php
require 'Plugin/Excel/autoload.php';

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

$fileName="Member_".TODAYNAME.".xlsx";
$spreadsheet = new Spreadsheet();
$sheet = $spreadsheet->getActiveSheet();

//header
$header=array("ID","NAME","EMAIL","CONTACT","PRICE PLAN","EDITED DATE","CREATE DATE");


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
$sql="SELECT * FROM customer WHERE customer_delete_date = '0000-00-00 00:00:00'";
$CustomerQuery=$mysqli->query($sql);

$char='B';
if($CustomerQuery->num_rows>0){
    $currentrow=2;
    while($rowData=$CustomerQuery->fetch_assoc()){

        $sheet->setCellValue('A'.$currentrow,$rowData['customer_id']);
        $sheet->setCellValue('B'.$currentrow,$rowData['customer_name']);
        $sheet->setCellValue('C'.$currentrow,$rowData['customer_email']);
        $sheet->setCellValue('D'.$currentrow,$rowData['customer_contact']);
        $sheet->setCellValue('E'.$currentrow,$rowData['customer_plan']);
        $sheet->setCellValue('F'.$currentrow,$rowData['customer_edit_date']);
        $sheet->setCellValue('G'.$currentrow,$rowData['customer_create_date']);
        $currentrow++;
    }
    //to set the width
    foreach (range('A', 'G') as $column) {
        $sheet->getColumnDimension($column)->setAutoSize(true);
    }
}else{
    $sheet->mergeCells("A2:G2");
    $sheet->setCellValue("A2","No data Available");
}


$writer = new Xlsx($spreadsheet);

header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment;filename="'.$fileName.'"');
header('Cache-Control: no-store, no-cache, must-revalidate, max-age=0');
header('Pragma: no-cache');


$writer->save('php://output');
exit;
