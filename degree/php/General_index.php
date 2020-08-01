<?php
include 'include/Dbh.php';
include 'include/Index_generation.php';
include 'include/Prediction.php';
$i = new Index_generation();
//$i->General_index_init();
//$i->general('car', 'honda', 'amaz','petrol', 'oil filter,engine oil,wheel alignment,drain washer', '3000', 'oil filter,engine oil,wheel alignment,drain washer', '15000', 'oil filter,engine oil,wheel alignment,drain washer', '6000', 'oil filter,engine oil,wheel alignment,drain washer', '8000', 'oil filter,engine oil,wheel alignment,drain washer', '9000', 'oil filter,engine oil,wheel alignment,drain washer', '6000', 'oil filter,engine oil,wheel alignment,drain washer', '17000', 'oil filter,engine oil,wheel alignment,drain washer', '8000', '20000');
//$i->Accidental_index_init();
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
//$i->service('car','honda','city','diesel','126785','1','1','1','1','1','1','1','0','1','1','0','0','1','1','8600');
//$a = new Prediction();
//$a->Faults_Prediction('amaze', 'diesel', '100001','110000');
//$a->general_service('amaze','diesel');
$b= new Prediction();
$b->predict_init();
//$b->predict_display();
?>