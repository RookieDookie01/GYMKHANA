<?php
require 'Plugin/Excel/autoload.php';

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

$fileName="Trainer_".TODAYNAME.".xlsx";
$spreadsheet = new Spreadsheet();
$sheet = $spreadsheet->getActiveSheet();

//header
$header=array("ID","NAME","EMAIL","CONTACT","ADDRESS","AGE","HEIGHT","WEIGHT","EDITED DATE","CREATE DATE");


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
$sql="SELECT * FROM trainer WHERE trainer_delete_date = '0000-00-00 00:00:00'";
$trainerQuery=$mysqli->query($sql);

$char='B';
if($trainerQuery->num_rows>0){
    $currentrow=2;
    while($rowData=$trainerQuery->fetch_assoc()){

        $sheet->setCellValue('A'.$currentrow,$rowData['trainer_id']);
        $sheet->setCellValue('B'.$currentrow,$rowData['trainer_name']);
        $sheet->setCellValue('C'.$currentrow,$rowData['trainer_email']);
        $sheet->setCellValue('D'.$currentrow,$rowData['trainer_contact']);
        $sheet->setCellValue('E'.$currentrow,$rowData['trainer_address']);
        $sheet->setCellValue('F'.$currentrow,$rowData['trainer_age']);
        $sheet->setCellValue('G'.$currentrow,$rowData['trainer_height']);
        $sheet->setCellValue('H'.$currentrow,$rowData['trainer_weight']);
        $sheet->setCellValue('I'.$currentrow,$rowData['trainer_edit_date']);
        $sheet->setCellValue('J'.$currentrow,$rowData['trainer_create_date']);
        $currentrow++;
    }
    //to set the width
    foreach (range('A', 'J') as $column) {
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
