<?php
class Prediction extends Dbh
{
    private $count=0;
    private $last_count=0;
    public function Faults_Prediction($model, $engine_type, $region, $make_year, $to)
    {
        $table = $this->Connect();
        $result1 = $table->query("SELECT COUNT(*) as total FROM service_details WHERE model ='$model' AND engine_type='$engine_type' AND region ='$region' AND make_year='$make_year' AND mileage_range='$to';");
        if($result1->num_rows > 0)
        {
            while($row = $result1->fetch_assoc())
            {
                $this->count = $row['total'];
            }
            $result = $table->query("SELECT last_count FROM prediction WHERE model ='$model' AND engine_type='$engine_type' AND region='$region' AND make_year='$make_year' AND mileage_range='$to';");
            if($result->num_rows > 0)
            {
                while($row = $result->fetch_assoc())
                {
                    $this->last_count = $row['last_count'];
                }
                if(($this->count - $this->last_count) >= 1)
                {
                    $this->predict_update($table,$model,$engine_type,$region,$make_year,$to,$this->count);
                    $data = $this->predict_display($table,$model,$engine_type,$region,$make_year,$to);
                    return $data;
                }
                else
                {
                    $data = $this->predict_display($table,$model,$engine_type,$region,$make_year,$to);
                    return $data;
                }
            }
        }
        else
        {
            return "no such records available";
        }
        $this->closeConnect();

    }
    private function predict_update($db,$model,$engine_type,$region,$make_year,$to,$count1)
    {
        $result = $db->query("SELECT oil_filter, engine_oil, washer_plug_drain, dust_and_pollen_filter, whell_alignment_and_balancing, air_clean_filter, fuel_filter, spark_plug, brake_fluid, brake_and_clutch_oil, transmission_fluid, brake_pads, clutch, coolant FROM service_details LIMIT 1;");
        if($result->num_rows > 0)
        {
            $part = $result->fetch_fields();
            foreach($part as $value)
            {
                $this->predict_update_part($db,$model,$engine_type,$region,$make_year,$value->name,$to,$count1);
            }
        }
    }
    private function predict_update_part($db,$model,$engine_type, $region,$make_year,$part,$to,$count1)
    {
        $percent=0;
        $result = $db->query("SELECT COUNT(".$part.") as percent FROM service_details WHERE model='$model' AND region ='$region' AND make_year='$make_year' AND mileage_range='$to' GROUP BY ".$part." HAVING ".$part."=1;");
        if($result->num_rows > 0)
        {
             while($row = $result->fetch_assoc())
             {
                 $percent = round(($row['percent']/$count1),2)*100;
             }
             $res = $db->query("UPDATE prediction SET ".$part."='$percent',last_count='$count1' WHERE model='$model' AND engine_type='$engine_type' AND region='$region' AND make_year='$make_year' AND mileage_range='$to';");
        }
    }
    public function predict_display($db,$model,$engine_type,$region,$make_year,$to)
    {
        $result = $db->query("SELECT oil_filter, engine_oil, washer_plug_drain, dust_and_pollen_filter, whell_alignment_and_balancing, air_clean_filter, fuel_filter, spark_plug, brake_fluid, brake_and_clutch_oil, transmission_fluid, brake_pads, clutch, coolant FROM prediction WHERE model='$model' AND engine_type='$engine_type' AND region='$region' AND make_year='$make_year' AND mileage_range='$to';");
        if($result->num_rows > 0)
        {
            $output= array();
            $i = 0;
            $parts = $result->fetch_fields();
            $col = $result->fetch_array();
            foreach($parts as $val)
            {
                if($col[$i]==null)
                {
                    $i +=1;
                }
                else
                {
                    $output[] = array('Name' => $val->name, 'Index' => floatval($col[$i]));
                    $i +=1;
                }
            }
            return $output;
        }
    }
    public function predict_init()
    {
        $db = $this->Connect();
        $res = $db->query("SELECT brand,model,engine_type,make_year,region FROM service_details GROUP BY model,engine_type,make_year,region;");
        if($res->num_rows > 0)
        {
            while($row = $res->fetch_assoc())
            {
                $brand=$row['brand'];
                $model=$row['model'];
                $engine_type=$row['engine_type'];
                $make_year=$row['make_year'];
                $region=$row['region'];
                $result = $db->query("SELECT COUNT(*) as total,mileage_range FROM service_details WHERE model='$model' AND engine_type='$engine_type' AND make_year='$make_year' AND region='$region' GROUP BY mileage_range;");
                if($result->num_rows > 0)
                {
                    while($row = $result->fetch_assoc())
                    {
                        $total =$row['total'];
                        $to = $row['mileage_range'];
                        $result1 = $db->query("SELECT oil_filter, engine_oil, washer_plug_drain, dust_and_pollen_filter, whell_alignment_and_balancing, air_clean_filter, fuel_filter, spark_plug, brake_fluid, brake_and_clutch_oil, transmission_fluid, brake_pads, clutch, coolant FROM service_details LIMIT 1;");
                        if($result1->num_rows > 0)
                        {
                            $parts = $result1->fetch_fields();
                            foreach($parts as $val)
                            {
                                $this->predict_insert($db,$brand,$model,$engine_type,$region,$make_year,$to,$val->name,$total);
                            }
                        }
                    }
                }
            }
        }
        $this->closeConnect();
    }
    private function predict_insert($db,$brand,$model,$engine_type,$region,$make_year,$to,$part,$count1)
    {
        $vehicle_type='car';
        $result = $db->query("SELECT brand,model,engine_type,region,make_year,mileage_range FROM prediction WHERE brand='$brand' AND model='$model' AND engine_type='$engine_type' AND region='$region' AND make_year='$make_year' AND mileage_range='$to';");
        if($result->num_rows > 0)
        {
            $result1 = $db->query("SELECT COUNT(*) as percent FROM service_details WHERE model='$model' AND region ='$region' AND make_year='$make_year' AND mileage_range='$to' GROUP BY ".$part." HAVING ".$part." = 1;");
            if($result1->num_rows > 0)
            {
                 while($row = $result1->fetch_assoc())
                 {
                     $percent = round(($row['percent']/$count1),4)*100;
                 }
                 $res = $db->query("UPDATE prediction SET ".$part."='$percent',last_count='$count1' WHERE model='$model' AND engine_type='$engine_type' AND region='$region' AND make_year='$make_year' AND mileage_range='$to';");
            }
        }
        else
        {
            $result1 = $db->query("SELECT COUNT(*) as percent FROM service_details WHERE model='$model' AND engine_type='$engine_type' AND region ='$region' AND make_year='$make_year' AND mileage_range='$to' GROUP BY ".$part." HAVING ".$part." = 1;");
            if($result1->num_rows > 0)
            {
                 while($row = $result1->fetch_assoc())
                 {
                     $percent = round(($row['percent']/$count1),4)*100;
                 }
                 $res = $db->prepare("INSERT INTO prediction(vehicle_type,brand,model,engine_type,make_year,region,mileage_range,last_count,".$part.") VALUES(?,?,?,?,?,?,?,?,?);");
                 $res->bind_param("sssssssss", $vehicle_type,$brand,$model,$engine_type,$make_year,$region,$to,$count1,$percent);
                 $res->execute();
            }
        }
    }
    public function general_service($model, $engine_type)
    {
        $table = $this->Connect();
        $result = $table->query("SELECT brand,model,engine_type,10k,cost10k,20k,cost20k,30k,cost30k,40k,cost40k,50k,cost50k,60k,cost60k,70k,cost70k,Above80k,cost80k,total_general FROM general WHERE model='$model' AND engine_type='$engine_type';");
        if($result->num_rows > 0)
        {
            while($row = $result->fetch_assoc())
            {
                echo json_encode($row);
            }
        }
        else
        {
            echo 0;
        }
        $this->closeConnect();
    }
}
?>