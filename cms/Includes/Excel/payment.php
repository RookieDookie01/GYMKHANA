<?php
require 'Plugin/Excel/autoload.php';

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

$fileName="Payment_".TODAYNAME.".xlsx";
$spreadsheet = new Spreadsheet();
$sheet = $spreadsheet->getActiveSheet();

//header
$header=array("ID","NAME","AMOUNT","PAYMENT METHOD","PAYMENT STATUS");


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
$sql="SELECT a.*,b.customer_name FROM payment a
 LEFT JOIN customer b ON a.customer_id=b.customer_id
 ORDER BY payment_status";
$paymentQuery=$mysqli->query($sql);

$char='B';
if($paymentQuery->num_rows>0){
    $currentrow=2;
    while($rowData=$paymentQuery->fetch_assoc()){

        $sheet->setCellValue('A'.$currentrow,$rowData['paymet_id']);
        $sheet->setCellValue('B'.$currentrow,$rowData['customer_name']);
        $sheet->setCellValue('C'.$currentrow,$rowData['payment_amount']);
        $sheet->setCellValue('D'.$currentrow,$rowData['payment_method']);
        $sheet->setCellValue('E'.$currentrow,$rowData['payment_status']);

        $currentrow++;
    }
    //to set the width
    foreach (range('A', 'E') as $column) {
        $sheet->getColumnDimension($column)->setAutoSize(true);
    }
}else{
    $sheet->mergeCells("A2:E2");
    $sheet->setCellValue("A2","No data Available");
}


$writer = new Xlsx($spreadsheet);

header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment;filename="'.$fileName.'"');
header('Cache-Control: no-store, no-cache, must-revalidate, max-age=0');
header('Pragma: no-cache');


$writer->save('php://output');
exit;
