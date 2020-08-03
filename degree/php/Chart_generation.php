<?php
include 'include/Dbh.php';
include 'include/Charts.php';
include 'include/Prediction.php';
if(!empty($_POST['model']) && isset($_POST['model']) && !empty($_POST['variant']) && isset($_POST['variant']) && !empty($_POST['count']) && isset($_POST['count']))
{
    $chart = new Charts();
    $model = $_POST['model'];
    $variant = $_POST['variant'];
    $count = $_POST['count'];
    $index = $chart->index_to_chart($model, $variant, $count);
    if(!empty($index))
    {
        echo json_encode($index);
    }
    else
    {
        echo 0;
    }
}
if(!empty($_POST['model']) && isset($_POST['model']) && !empty($_POST['variant']) && isset($_POST['variant']) && !empty($_POST['make_year']) && isset($_POST['make_year']) && !empty($_POST['region']) && isset($_POST['region']) && !empty($_POST['range']) && isset($_POST['range']))
{
    $data = new Prediction();
    $model = $_POST['model'];
    $variant = $_POST['variant'];
    $make_year = $_POST['make_year'];
    $region = $_POST['region'];
    $range = $_POST['range'];
    $j = $data->Faults_Prediction($model,$variant,$region,$make_year,$range);
    if(!empty($j))
    {
        echo json_encode($j);
    }    
    else
    {
        echo 0;
    }
}
?>