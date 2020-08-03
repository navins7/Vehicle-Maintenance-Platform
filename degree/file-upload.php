<?php
include 'Dbh.php';

$uploadfile=$_FILES['uploadfile']['tmp_name'];

require 'PHPExcel/Classes/PHPExcel.php';
require_once 'PHPExcel/Classes/PHPExcel/IOFactory.php';

$objExcel=PHPExcel_IOFactory::load($uploadfile);
foreach($objExcel->getWorksheetIterator() as $worksheet)
{
	$highestrow=$worksheet->getHighestRow();

	for($row=0;$row<=$highestrow;$row++)
	{
    $vehicle_type=$worksheet->getCellByColumnAndRow(0,$row)->getValue();
	$brand=$worksheet->getCellByColumnAndRow(1,$row)->getValue();
    $model=$worksheet->getCellByColumnAndRow(2,$row)->getValue();
    $engine_type=$worksheet->getCellByColumnAndRow(3,$row)->getValue();
    $year=$worksheet->getCellByColumnAndRow(4,$row)->getValue();
    $region=$worksheet->getCellByColumnAndRow(5,$row)->getValue();
    $mileage_range=$worksheet->getCellByColumnAndRow(6,$row)->getValue();
    $mileage=$worksheet->getCellByColumnAndRow(7,$row)->getValue();
    $oil_filter=$worksheet->getCellByColumnAndRow(8,$row)->getValue();
    $engine_oil=$worksheet->getCellByColumnAndRow(9,$row)->getValue();
    $washer_plug_drain=$worksheet->getCellByColumnAndRow(10,$row)->getValue();
    $dust_and_pollen_filter=$worksheet->getCellByColumnAndRow(11,$row)->getValue();
    $whell_alignment_and_balancing=$worksheet->getCellByColumnAndRow(12,$row)->getValue();
    $air_clean_filter=$worksheet->getCellByColumnAndRow(13,$row)->getValue();
    $fuel_filter=$worksheet->getCellByColumnAndRow(14,$row)->getValue();
    $spark_plug=$worksheet->getCellByColumnAndRow(15,$row)->getValue();
    $brake_fluid=$worksheet->getCellByColumnAndRow(16,$row)->getValue();
    $brake_and_clutch_oil=$worksheet->getCellByColumnAndRow(17,$row)->getValue();
    $transmission_fluid=$worksheet->getCellByColumnAndRow(18,$row)->getValue();
    $brake_pads=$worksheet->getCellByColumnAndRow(19,$row)->getValue();
    $clutch=$worksheet->getCellByColumnAndRow(20,$row)->getValue();
    $coolant=$worksheet->getCellByColumnAndRow(21,$row)->getValue();
    $cost=$worksheet->getCellByColumnAndRow(22,$row)->getValue();
    $index_service=$worksheet->getCellByColumnAndRow(23,$row)->getValue();
    
       
		if($brand!='')
		{
			$insertqry="INSERT INTO `service_details`( 'vehicle_type','brand','model','engine_type','year','region','mileage_range','mileage','oil_filter',
'engine_oil','washer_plug_drain','dust_and_pollen_filter','whell_alignment_and_balancing','air_clean_filter','fuel_filter','spark_plug',
'brake_fluid','brake_and_clutch_oil','transmission_fluid','brake_pads','clutch','coolant','cost','index_service') VALUES ('$vehicle_type' ,'$brand',
'$model',
'$engine_type',
'$year',
'$region',
'$mileage_range',
'$mileage',
'$oil_filter',
'$engine_oil',
'$washer_plug_drain',
'$dust_and_pollen_filter','$whell_alignment_and_balancing',
'$air_clean_filter',
'$fuel_filter',
'$spark_plug',
'$brake_fluid',
'$brake_and_clutch_oil',
'$transmission_fluid',
'$brake_pads',
'$clutch',
'$coolant',
'$cost',
'$index_service'
})";
			$insertres=mysqli_query($con,$insertqry);
		}
	}
}
header('Location: connect.php');
?>