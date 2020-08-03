<?php
class Index_generation extends Dbh
{
    private $max=0;
    private $range=10000;
    public function general($vehicle_type,$brand,$model,$engine_type,$service1,$cost1,$service2,$cost2,$service3,$cost3,$service4,$cost4,$service5,$cost5,$service6,$cost6,$service7,$cost7,$service8,$cost8,$total)
    {
        $db = $this->Connect();
        $update = $db->query("SELECT slno FROM general WHERE brand ='$brand' AND model ='$model' AND engine_type ='$engine_type';");
        if($update->num_rows < 1)
        {
            $result = $db->query("SELECT MAX(total_general) as max_total FROM general");
            if($result->num_rows > 0)
            {
                while($row = $result->fetch_assoc())
                {
                    $this->max = $row['max_total']; 
                }
                if($this->max >= $total)
                {
                    $index = round((($total/$this->max)*2),2);
                    if($index == 0)
                    {
                        $index = 0.01;
                    }
                    $query = $db->prepare("INSERT INTO general(vehicle_type, brand, model, engine_type, 10k, cost10k, 20k, cost20k, 30k, cost30k, 40k, cost40k, 50k, cost50k, 60k, cost60k, 70k, cost70k, Above80k, cost80k, total_general, index_general) VALUES(?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?);");
                    $query->bind_param("ssssssssssssssssssssss", $vehicle_type, $brand, $model, $engine_type,$service1, $cost1, $service2, $cost2, $service3, $cost3, $service4, $cost4, $service5, $cost5, $service6, $cost6, $service7, $cost7, $service8, $cost8, $total, $index);
                    $query->execute();
                    $this->closeConnect();
                }
                else
                {
                    $this->max = $total;
                    $result1 = $db->query("SELECT model, engine_type, total_general FROM general");
                    while($row = $result1->fetch_assoc())
                    {
                        $model = $row['model'];
                        $engine_type = $row['engine_type'];
                        $total_general = $row['total_general'];
                        $index = round((($total_general/$this->max)*2),2);
                        if($index == 0)
                        {
                            $index = 0.01;
                        }
                        $query = $db->prepare("UPDATE general SET index_general = ? WHERE model = ? AND engine_type = ?;");
                        $query->bind_param("sss", $index, $model, $engine_type);
                        $query->execute();
                    }
                    $index = round((($total/$this->max)*2),2);
                    if($index == 0)
                    {
                        $index = 0.01;
                    }
                    $query = $db->prepare("INSERT INTO general(vehicle_type, brand, model, engine_type, 10k, cost10k, 20k, cost20k, 30k, cost30k, 40k, cost40k, 50k, cost50k, 60k, cost60k, 70k, cost70k, Above80k, cost80k, total_general, index_general) VALUES(?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?);");
                    $query->bind_param("ssssssssssssssssssssss", $vehicle_type, $brand, $model, $engine_type,$service1, $cost1, $service2, $cost2, $service3, $cost3, $service4, $cost4, $service5, $cost5, $service6, $cost6, $service7, $cost7, $service8, $cost8, $total, $index);
                    $query->execute();
                    $this->closeConnect();
                }
            }
            else
            {
                $index = round((($total/$total)*2),2);
                if($index == 0)
                {
                    $index = 0.01;
                }
                $query = $db->prepare("INSERT INTO general(vehicle_type, brand, model, engine_type, 10k, cost10k, 20k, cost20k, 30k, cost30k, 40k, cost40k, 50k, cost50k, 60k, cost60k, 70k, cost70k, Above80k, cost80k, total_general, index_general) VALUES(?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?);");
                $query->bind_param("ssssssssssssssssssssss", $vehicle_type, $brand, $model, $engine_type,$service1, $cost1, $service2, $cost2, $service3, $cost3, $service4, $cost4, $service5, $cost5, $service6, $cost6, $service7, $cost7, $service8, $cost8, $total, $index);
                $query->execute();
                $this->closeConnect();
            }           
        }
        else
        {
            $slno;
            while($row = $update->fetch_assoc())
            {
                $slno = $row['slno'];
            }
            $query = $db->prepare("UPDATE general SET vehicle_type=?, brand=?, model=?, engine_type=?, 10k=?, cost10k=?, 20k=?, cost20k=?, 30k=?, cost30k=?, 40k=?, cost40k=?, 50k=?, cost50k=?, 60k=?, cost60k=?, 70k=?, cost70k=?, Above80k=?, cost80k=?, total_general=? WHERE slno=?;");
            $query->bind_param("ssssssssssssssssssssss", $vehicle_type, $brand, $model, $engine_type,$service1, $cost1, $service2, $cost2, $service3, $cost3, $service4, $cost4, $service5, $cost5, $service6, $cost6, $service7, $cost7, $service8, $cost8, $total, $slno);
            if($query->execute() == TRUE)
            {
                $result = $db->query("SELECT MAX(total_general) as max_total FROM general");
                if($result->num_rows > 0)
                {
                    while($row = $result->fetch_assoc())
                    {
                        $this->max = $row['max_total'];
                    }
                    if($this->max > $total)
                    {
                        $index = round((($total/$this->max)*2),2);
                        if($index == 0)
                        {
                            $index = 0.01;
                        }
                        $query = $db->prepare("UPDATE general SET index_general=? WHERE slno=?;");
                        $query->bind_param("ss", $index, $slno);
                        $query->execute();
                        $this->closeConnect();
                    }
                    else
                    {
                        $this->General_index_init();
                    }
                }
            }
        }
    }
    public function General_index_init()
    {
        $db = $this->Connect();
        $result = $db->query("SELECT MAX(total_general) as max_total FROM general;");
        if($result->num_rows > 0)
        {
            while($row = $result->fetch_assoc())
            {
               $this->max = $row['max_total'];
            }
        }
        $res = $db->query("SELECT model, engine_type, total_general FROM general;");
        if($res->num_rows > 0)
        {
            while($row = $res->fetch_assoc())
            {
                $model = $row['model'];
                $engine = $row['engine_type'];
                $total = $row['total_general'];
                $index = round((($total/$this->max)*2),2);
                if($index == 0)
                {
                    $index = 0.01;
                }
                $query = $db->prepare("UPDATE general SET index_general =? WHERE model =? AND engine_type =?;");
                $query->bind_param("sss", $index, $model, $engine);
                $query->execute();
            }
        }
        $this->closeConnect();
    }
    public function accidental($vehicle_type,$brand,$model,$engine_type,$part1,$part2,$part3,$part4,$part5,$part6,$part7,$part8,$part9,$part10,$part11,$part12,$part13,$part14,$part15,$total)
    {
        $db = $this->Connect();
        $update = $db->query("SELECT slno FROM general WHERE brand ='$brand' AND model ='$model' AND engine_type ='$engine_type';");
        if($update->num_rows < 1)
        {
            $result = $db->query("SELECT MAX(total_acc) as max_total FROM general_standard;");
            if($result->num_rows > 0)
            {
                while($row = $result->fetch_assoc())
                {
                   $this->max = $row['max_total'];
                }
                if($this->max >= $total)
                {
                    $index = round((($total/$this->max)*2),2);
                    if($index == 0)
                    {
                        $index = 0.01;
                    }
                    $query = $db->prepare("INSERT INTO general_standard(vehicle_type, brand, model, engine_type,bonnet, door, front_bumper, rear_bumper, front_headlight, rear_headlight, side_mirror, tail_light, clutch_plate, barke_pad, front_windsheild, rear_windsheild, ac_evaporator, radiator, battery, total_acc, index_acc) VALUES(?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?);");
                    $query->bind_param("sssssssssssssssssssss", $vehicle_type, $brand, $model, $engine_type,$part1,$part2,$part3,$part4,$part5,$part6,$part7,$part8,$part9,$part10,$part11,$part12,$part13,$part14,$part15,$total, $index);
                    $query->execute();
                    $this->closeConnect();
                }
                else
                {
                    $this->max = $total;
                    $result1 = $db->query("SELECT model, engine_type, total_acc FROM general_standard");
                    while($row = $result1->fetch_assoc())
                    {
                        $model = $row['model'];
                        $engine_type = $row['engine_type'];
                        $total_acc = $row['total_acc'];
                        $index = round((($total_acc/$this->max)*2),2);
                        if($index == 0)
                        {
                            $index = 0.01;
                        }
                        $query = $db->prepare("UPDATE general_standard SET index_acc = ? WHERE model = ? AND engine_type = ?;");
                        $query->bind_param("sss", $index, $model, $engine_type);
                        $query->execute();
                    }
                    $index = round((($total/$this->max)*2),2);
                    if($index == 0)
                    {
                        $index = 0.01;
                    }
                    $query = $db->prepare("INSERT INTO general_standard(vehicle_type, brand, model, engine_type,bonnet, door, front_bumper, rear_bumper, front_headlight, rear_headlight, side_mirror, tail_light, clutch_plate, barke_pad, front_windsheild, rear_windsheild, ac_evaporator, radiator, battery, total_acc, index_acc) VALUES(?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?);");
                    $query->bind_param("sssssssssssssssssssss", $vehicle_type, $brand, $model, $engine_type,$part1,$part2,$part3,$part4,$part5,$part6,$part7,$part8,$part9,$part10,$part11,$part12,$part13,$part14,$part15,$total, $index);
                    $query->execute();
                    $this->closeConnect();
                }
            }
            else
            {
                $index = round((($total/$total)*2),2);
                if($index == 0)
                {
                    $index = 0.01;
                }
                $query = $db->prepare("INSERT INTO general_standard(vehicle_type, brand, model, engine_type,bonnet, door, front_bumper, rear_bumper, front_headlight, rear_headlight, side_mirror, tail_light, clutch_plate, barke_pad, front_windsheild, rear_windsheild, ac_evaporator, radiator, battery, total_acc, index_acc) VALUES(?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?);");
                $query->bind_param("sssssssssssssssssssss", $vehicle_type, $brand, $model, $engine_type,$part1,$part2,$part3,$part4,$part5,$part6,$part7,$part8,$part9,$part10,$part11,$part12,$part13,$part14,$part15,$total, $index);
                $query->execute();
                $this->closeConnect();
            }
        }
        else
        {
            $slno;
            while($row = $update->fetch_assoc())
            {
                $slno = $row['slno'];
            }
            $query = $db->prepare("UPDATE general_standard SET vehicle_type=?, brand=?, model=?, engine_type=?,bonnet=?, door=?, front_bumper=?, rear_bumper=?, front_headlight=?, rear_headlight=?, side_mirror=?, tail_light=?, clutch_plate=?, barke_pad=?, front_windsheild=?, rear_windsheild=?, ac_evaporator=?, radiator=?, battery=?, total_acc=? WHERE slno=?;");
            $query->bind_param("sssssssssssssssssssss", $vehicle_type, $brand, $model, $engine_type,$part1,$part2,$part3,$part4,$part5,$part6,$part7,$part8,$part9,$part10,$part11,$part12,$part13,$part14,$part15,$total, $slno);
            $query->execute();
            $result = $db->query("SELECT MAX(total_acc) as max_total FROM general_standard;");
            if($result->num_rows > 0)
            {
                while($row = $result->fetch_assoc())
                {
                   $this->max = $row['max_total'];
                }
                if($this->max > $total)
                {
                    $index = round((($total/$this->max)*2),2);
                    if($index == 0)
                    {
                        $index = 0.01;
                    }
                    $query = $db->prepare("UPDATE general_standard SET index_acc=? WHERE slno=?;");
                    $query->bind_param("ss", $index, $slno);
                    $query->execute();
                    $this->closeConnect();
                }
                else
                {
                    $this->Accidental_index_init();
                }
            }
        }
    }
    public function Accidental_index_init()
    {
        $db = $this->Connect();
        $result = $db->query("SELECT MAX(total_acc) as max_total FROM general_standard;");
        if($result->num_rows > 0)
        {
            while($row = $result->fetch_assoc())
            {
               $this->max = $row['max_total'];
            }
        }
        $res = $db->query("SELECT model, engine_type, total_acc FROM general_standard;");
        if($res->num_rows > 0)
        {
            while($row = $res->fetch_assoc())
            {
                $model = $row['model'];
                $engine = $row['engine_type'];
                $total = $row['total_acc'];
                $index = round((($total/$this->max)*2),2);
                if($index == 0)
                {
                    $index = 0.01;
                }
                $query = $db->prepare("UPDATE general_standard SET index_acc =? WHERE model =? AND engine_type =?;");
                $query->bind_param("sss", $index, $model, $engine);
                $query->execute();
            }
        }
        $this->closeConnect();
    }
    public function labour($vehicle_type,$brand, $model,$engine_type,$labour_cost)
    {
        $db = $this->Connect();
        $update = $db->query("SELECT slno FROM general WHERE brand ='$brand' AND model ='$model' AND engine_type ='$engine_type';");
        if($update->num_rows > 0)
        {
            $slno;
            while($row = $update->fetch_assoc())
            {
                $slno = $row['slno'];
            }
            $query = $db->prepare("UPDATE general SET labour_cost=? WHERE slno=?;");
            $query->bind_param("ss", $labour_cost, $slno);
            if($query->execute() == TRUE)
            {
                $result = $db->query("SELECT MAX(labour_cost) as max_total FROM general");
                if($result->num_rows > 0)
                {
                    while($row = $result->fetch_assoc())
                    {
                        $this->max = $row['max_total'];
                    }
                    if($this->max >= $labour_cost)
                    {
                        $index = round((($labour_cost/$this->max)),2);
                        if($index == 0)
                        {
                            $index = 0.01;
                        }
                        $query = $db->prepare("UPDATE general SET index_labour=? WHERE slno=?;");
                        $query->bind_param("ss", $index, $slno);
                        $query->execute();
                        $this->closeConnect();
                    }
                    else
                    {
                        $this->Labour_index_init();
                    }
                }
            }
        }
    }
    public function Labour_index_init()
    {
        $db = $this->Connect();
        $result = $db->query("SELECT MAX(labour_cost) as max_total FROM general;");
        if($result->num_rows > 0)
        {
            while($row = $result->fetch_assoc())
            {
               $this->max = $row['max_total'];
            }
        }
        $res = $db->query("SELECT model, engine_type, labour_cost FROM general;");
        if($res->num_rows > 0)
        {
            while($row = $res->fetch_assoc())
            {
                $model = $row['model'];
                $engine = $row['engine_type'];
                $labour_cost = $row['labour_cost'];
                $index = round(($labour_cost/$this->max),2);
                if($index == 0)
                {
                    $index = 0.01;
                }
                $query = $db->prepare("UPDATE general SET index_labour =? WHERE model =? AND engine_type =?;");
                $query->bind_param("sss", $index, $model, $engine);
                $query->execute();
            }
        }
        $this->closeConnect();
    }
    public function insurance($vehicle_type,$brand, $model,$engine_type,$insurance)
    {
        $db = $this->Connect();
        $update = $db->query("SELECT slno FROM general WHERE brand ='$brand' AND model ='$model' AND engine_type ='$engine_type';");
        if($update->num_rows > 0)
        {
            $slno;
            while($row = $update->fetch_assoc())
            {
                $slno = $row['slno'];
            }
            $query = $db->prepare("UPDATE general SET insurance=? WHERE slno=?;");
            $query->bind_param("ss", $insurance, $slno);
            if($query->execute() == TRUE)
            {
                $result = $db->query("SELECT MAX(insurance) as max_total FROM general");
                if($result->num_rows > 0)
                {
                    while($row = $result->fetch_assoc())
                    {
                        $this->max = $row['max_total'];
                    }
                    if($this->max >= $insurance)
                    {
                        $index = round((($insurance/$this->max)),2);
                        if($index == 0)
                        {
                            $index = 0.01;
                        }
                        $query = $db->prepare("UPDATE general SET index_insurance=? WHERE slno=?;");
                        $query->bind_param("ss", $index, $slno);
                        $query->execute();
                        $this->closeConnect();
                    }
                    else
                    {
                        $this->Insurance_index_init();
                    }
                }
            }
        }
    }
    public function Insurance_index_init()
    {
        $db = $this->Connect();
        $result = $db->query("SELECT MAX(insurance) as max_total FROM general;");
        if($result->num_rows > 0)
        {
            while($row = $result->fetch_assoc())
            {
               $this->max = $row['max_total'];
            }
        }
        $res = $db->query("SELECT model, engine_type, insurance FROM general;");
        if($res->num_rows > 0)
        {
            while($row = $res->fetch_assoc())
            {
                $model = $row['model'];
                $engine = $row['engine_type'];
                $insurance = $row['insurance'];
                $index = round((($insurance/$this->max)),2);
                if($index == 0)
                {
                    $index = 0.01;
                }
                $query = $db->prepare("UPDATE general SET index_insurance =? WHERE model =? AND engine_type =?;");
                $query->bind_param("sss", $index, $model, $engine);
                $query->execute();
            }
        }
        $this->closeConnect();
    }
    public function service($vehicle_type, $brand, $model,$engine_type,$make_year,$region,$mileage_range,$mileage,$part1,$part2,$part3,$part4,$part5,$part6,$part7,$part8,$part9,$part10,$part11,$part12,$part13,$part14,$total)
    {
        $from = (floor(round(($mileage/$this->range),1)) * $this->range) + 1;
        $to = ($from - 1) + $this->range;
        $db = $this->Connect();
        $result = $db->query("SELECT MAX(cost) as max_total FROM service_details WHERE mileage BETWEEN '$from' AND '$to';");
        if($result->num_rows > 0)
        {
            while($row = $result->fetch_assoc())
            {
               $this->max = $row['max_total'];
            }
            if($this->max >= $total)
            {
                $index = round((($total/$this->max)*3),2);
                if($index == 0)
                {
                    $index = 0.01;
                }
                $query1 = $db->prepare("INSERT INTO service_details(vehicle_type, brand, model, engine_type, make_year, region, mileage_range, mileage, oil_filter, engine_oil, washer_plug_drain, dust_and_pollen_filter, whell_alignment_and_balancing, air_clean_filter, fuel_filter, spark_plug, brake_fluid, brake_and_clutch_oil, transmission_fluid, brake_pads, clutch, coolant, cost, index_service) VALUES(?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?);");
                $query1->bind_param("ssssssssssssssssssssssss", $vehicle_type, $brand, $model, $engine_type, $make_year, $region, $mileage_range, $mileage, $part1, $part2, $part3, $part4, $part5, $part6, $part7, $part8, $part9, $part10, $part11, $part12, $part13, $part14, $total, $index);
                $query1->execute();
                $this->closeConnect();
            }
            else
            {
                $this->max = $total;
                $result1 = $db->query("SELECT slno, cost FROM service_details WHERE mileage BETWEEN '$from' AND '$to';");
                while($row = $result1->fetch_assoc())
                {
                    $slno = $row['slno'];
                    $cost = $row['cost'];
                    $index = round((($cost/$this->max)*3),2);
                    if($index == 0)
                    {
                        $index = 0.01;
                    }
                    $query = $db->prepare("UPDATE service_details SET index_service = ? WHERE slno =?;");
                    $query->bind_param("ss", $index, $slno);
                    $query->execute();
                }
                $index = round((($total/$this->max)*3),2);
                if($index == 0)
                {
                    $index = 0.01;
                }
                $query1 = $db->prepare("INSERT INTO service_details(vehicle_type, brand, model, engine_type, make_year, region, mileage_range, mileage, oil_filter, engine_oil, washer_plug_drain, dust_and_pollen_filter, whell_alignment_and_balancing, air_clean_filter, fuel_filter, spark_plug, brake_fluid, brake_and_clutch_oil, transmission_fluid, brake_pads, clutch, coolant, cost, index_service) VALUES(?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?);");
                $query1->bind_param("sssssssssssssssssssssssss", $vehicle_type, $brand, $model, $engine_type, $make_year, $region, $mileage_range, $mileage, $part1, $part2, $part3, $part4, $part5, $part6, $part7, $part8, $part9, $part10, $part11, $part12, $part13, $part14, $total, $index);
                $query1->execute();
                $this->closeConnect();
            }
        }
        else
        {
            $index = round((($total/$total)*3),2);
            if($index == 0)
            {
                $index = 0.01;
            }
            $query1 = $db->prepare("INSERT INTO service_details(vehicle_type, brand, model, engine_type, make_year, region, mileage_range, mileage, oil_filter, engine_oil, washer_plug_drain, dust_and_pollen_filter, whell_alignment_and_balancing, air_clean_filter, fuel_filter, spark_plug, brake_fluid, brake_and_clutch_oil, transmission_fluid, brake_pads, clutch, coolant, cost, index_service) VALUES(?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?);");
            $query1->bind_param("sssssssssssssssssssssss", $vehicle_type, $brand, $model, $engine_type, $make_year, $region, $mileage_range, $mileage, $part1, $part2, $part3, $part4, $part5, $part6, $part7, $part8, $part9, $part10, $part11, $part12, $part13, $part14, $total, $index);
            $query1->execute();
            $this->closeConnect();
        }
    }
    public function Service_index_init()
    {
        $db = $this->Connect();
        $from = 1;
        $to = 10000;
        $result = $db->query("SELECT MAX(mileage) as max_mileage FROM service_details;");
        if($result->num_rows > 0)
        {
            while($row = $result->fetch_assoc())
            {
               $max_mileage = $row['max_mileage'] + $this->range;
            }
            while($to <= $max_mileage)
            {
                $result1 = $db->query("SELECT MAX(cost) as maximum FROM service_details WHERE mileage BETWEEN '$from' AND '$to';");
                if($result1->num_rows > 0)
                {
                    while($row = $result1->fetch_assoc())
                    {
                        $this->max = $row['maximum'];
                    }
                    $res = $db->query("SELECT slno, cost FROM service_details WHERE mileage BETWEEN '$from' AND '$to';");
                    while($row = $res->fetch_assoc())
                    {
                        $slno = $row['slno'];
                        $cost = $row['cost'];
                        $index = round((($cost/$this->max)*3),2);
                        if($index == 0)
                        {
                            $index = 0.01;
                        }
                        $query = $db->prepare("UPDATE service_details SET index_service =? WHERE slno =?;");
                        $query->bind_param("ss", $index, $slno);
                        $query->execute();
                    }
                }
                $from +=$this->range;
                $to +=$this->range;
            }
        }
        $this->closeConnect();
    }
    public function pollution_init()
    {
        $bar_hsu = 65;
        $bar_co = 0.5;
        $bar_hc = 750;
        $total_bar = $bar_hsu + $bar_co + $bar_hc + 0.5;
        $db = $this->Connect();
        $result = $db->query("SELECT slno,total FROM pollution");
        if($result->num_rows > 0)
        {
            while($row = $result->fetch_assoc())
            {
                $slno = $row['slno'];
                $total = $row['total'];
                $index = round(($total/$total_bar),2);
                if($index >= 1)
                {
                    $index = 1;
                }
                $res = $db->query("UPDATE pollution SET index_pollution = '$index' WHERE slno = '$slno';");
            }
        }
        $this->closeConnect();
    }
}
?>