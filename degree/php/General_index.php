<?php
include 'include/Dbh.php';
include 'include/Index_generation.php';
include 'include/Prediction.php';
include 'include/Charts.php';
//$c = new Charts();
//$index = $c->index_to_chart('amaze', 'diesel', 2);
//echo json_encode($index);
$i = new Index_generation();
//$i->General_index_init();
//$i->general('car', 'honda', 'amaz','petrol', 'oil filter,engine oil,wheel alignment,drain washer', '3000', 'oil filter,engine oil,wheel alignment,drain washer', '15000', 'oil filter,engine oil,wheel alignment,drain washer', '6000', 'oil filter,engine oil,wheel alignment,drain washer', '8000', 'oil filter,engine oil,wheel alignment,drain washer', '9000', 'oil filter,engine oil,wheel alignment,drain washer', '6000', 'oil filter,engine oil,wheel alignment,drain washer', '17000', 'oil filter,engine oil,wheel alignment,drain washer', '8000', '20000');
//$i->accidental('car','toyota','fortuner','diesel','20444','33000','14206','15790','46183','18499','19899','13782','9565','2999','161993','56737','12799','50327','6899','321129');
$i->Accidental_index_init();
//$i->Labour_index_init();
//$i->labour('car','honda','amaz','petrol','900');
//$i->Insurance_index_init();
//$i->insurance('car','honda','amaz','petrol','100000');
//$i->Service_index_init();
/*$mileage=126876;
$range=10000;
$from = (floor(round(($mileage/$range),1)) * $range) + 1;
$to = ($from - 1) + $range;
echo $from , $to;*/
//$i->service('car','honda','amaze','diesel','2016','mumbai','20000','17000','1','1','1','1','1','1','1','0','1','1','0','0','1','1','8600');
//$a = new Prediction();
//$a->Faults_Prediction('amaze', 'diesel', '100001','110000');
//$a->general_service('amaze','diesel');
//$i->pollution_init();
$b= new Prediction();
$b->predict_init();
//$b->Faults_Prediction('amaze','diesel','mumbai','2016','20000');
//$data = $b->Faults_Prediction('city','petrol','chennai','2017','20000');
//echo json_encode($data);
?>