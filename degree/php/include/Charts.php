<?php
class Charts extends Dbh
{
    private function Overall_index($model, $engine_type, $count)
    {
        $general=0;$labour=0;$accidental=0;$insurance=0;$service=0;
        $db = $this->Connect();
        $result = $db->query("SELECT index_general, index_labour, index_insurance FROM general WHERE model='$model' AND engine_type='$engine_type';");
        if($result->num_rows > 0)
        {
            while($row = $result->fetch_assoc())
            {
                $general = round($row['index_general'],1);
                if($general == 0)
                {
                    $general=0.1;
                }
                $labour = round($row['index_labour'],1);
                if($labour==0)
                {
                    $labour=0.1;
                }
                $insurance = round($row['index_insurance'],1);
                if($insurance==0)
                {
                    $insurance=0.1;
                }
            }
        }
        else
        {
            return 0;
        }
        $result1 = $db->query("SELECT index_acc FROM general_standard WHERE model='$model' AND engine_type='$engine_type';");
        if($result1->num_rows > 0)
        {
            while($row = $result1->fetch_assoc())
            {
                $accidental = round($row['index_acc'],1);
                if($accidental==0)
                {
                    $accidental = 0.1;
                }
            }
        }
        $result2 = $db->query("SELECT AVG(index_service) as index1 FROM service_details WHERE model='$model' AND engine_type='$engine_type';");
        if($result2->num_rows > 0)
        {
            while($row = $result2->fetch_assoc())
            {
                $service = round($row['index1'],1);
                if($service==0)
                {
                    $service=0.1;
                }
            }
        }
        $result3 = $db->query("SELECT AVG(index_pollution) as index2 FROM pollution WHERE model = '$model' AND engine_type = '$engine_type';");
        if($result3->num_rows > 0)
        {
            while($row = $result3->fetch_assoc())
            {
                $pollution = round($row['index2'],1);
                if($pollution==0)
                {
                    $pollution=0.1;
                }
            }
        }
        $this->closeConnect();
        $overall = round(($general + $labour + $insurance + $accidental + $service +$pollution),1);
        if($count == 1)
        {
            $index[] = array('Name' => "TOTAL", 'Index' => floatval($overall));
            return $index;
        }
        else
        {
            $index[] = array('Name' => "General", 'Index' => floatval($general));
            $index[] = array('Name' => "Service", 'Index' => floatval($service));
            $index[] = array('Name' => "Accidental", 'Index' => floatval($accidental));
            $index[] = array('Name' => "Insurance", 'Index' => floatval($insurance));
            $index[] = array('Name' => "Labour", 'Index' => floatval($labour));
            $index[] = array('Name' => "Pollution", 'Index' => floatval($pollution));
            return $index;
        }
    }
    public function index_to_chart($model,$engine_type, $count)
    {
        $output[] = array();
        $output = $this->Overall_index($model, $engine_type, $count);
        return $output;
    }
}
?>