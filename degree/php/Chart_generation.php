<?php
include 'include/Dbh.php';
include 'include/Charts.php';
$chart = new Charts();
if(!empty($_POST['model']) && isset($_POST['model']) && !empty($_POST['type']) && isset($_POST['type']))
{
    $model = $_POST['model'];
    $type = $_POST['type'];
    $index = $chart->index_to_chart($model, $type);
    if($index == 0)
    {
        echo "0";
    }
    else
    {
        echo json_encode($index);
    }
}
?>