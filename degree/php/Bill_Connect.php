<?php
include 'include/Dbh.php';
include 'include/Index_generation.php';
if(!empty($_POST['vehsdicle_type']) && isset($_POST['vehicle_type']))
{
    $value=array();
    $value = $_POST['modal-example'];
    for($i=0;$i<$value.length();$i++)
    {
        //$part."$i" = value[$i];
    }
service($vehicle_type, $brand, $model,$engine_type,$make_year,$region,$mileage_range,$mileage,$part1,$part2,$part3,$part4,$part5,$part6,$part7,$part8,$part9,$part10,$part11,$part12,$part13,$part14,$total)   ;
}
if(!empty($_POST['vehicle_type']) && isset($_POST['vehicle_type']))
{
    $s = new Index_generation();
    $s->service('car','honda','amaze','petrol','2017','chennai','20000','24138','1','1','0','1','0','0','0','0','0','0','0','0','0','0','5678');
}
if(!empty($_POST['count']) && isset($_POST['count']))
{
    $s = new Index_generation();
    $s->service('car','honda','amaze','petrol','2017','chennai','10000','9072','0','0','0','0','1','0','0','0','0','0','0','0','0','0','708');
}
?>