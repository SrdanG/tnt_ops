
<?php 
    
    /* get flight arrived time from DB */

    $flight_arrived = new tnt\model\db();   
    $flight_arrived_time = $flight_arrived->get_times('flight_arrived','arrived_time');
    
    /* get truck departured time from DB */
    
    $truck_departured = new tnt\model\db();   
    $truck_departured_time = $truck_departured->get_times('morning_times','truck_departured');
    
    /* get schedule flight departured time from DB */
    
    $schedule_flight_arrived = new tnt\model\db();
    $schedule_flight_arrived_time = $schedule_flight_arrived->get_schedule_times('schedule_times','schedule_flight_arrived');
    
    
    
    
    /*
     * if ($flight_arrived_time) 
     *      -> check if return $array from class is TRUE 
     *              - so if any times are inserted for current date
     * 
     * $last = array_slice($flight_arrived_time, -1, 1, true); 
     *      -> take just last value from array ( fetchall() return all rows with current date in DB )
     *              - in case that there is a more then one time for one date(day) take just the last added from inser form
     *      -> see PHP manual for array_slice function - http://php.net/array_slice
     * 
     * foreach ($last as $key => $value) {
            $time_flight_arrived = $value['flight_arrived'] ;
     *      -> save to variable value from array of result from class (db)
     * 
     */
    
    if ($flight_arrived_time) {
        $last = array_slice($flight_arrived_time, -1, 1, true);
        foreach ($last as $key => $value) {
            $time_flight_arrived = $value['arrived_time'] ;
        }  
    }else{
        $time_flight_arrived = "cas ni znan";
    }
    
    /*calculate tiimes */
    
        if ($time_flight_arrived == "cas ni znan"){
            
            $goods_arrived = "cas ni znan"; 
            
            if ($truck_departured_time) {
                $last = array_slice($truck_departured_time, -1, 1, true);
                 foreach ($last as $key => $value) {
                    $truck_departured = $value['truck_departured'] ;
                  }  
                  
                $truck_arrived_object = new \tnt\model\calculate();
                $truck_arrived = $truck_arrived_object->calculate_time($truck_departured, '35');
        
                $end_sorting_object = new \tnt\model\calculate();
                $end_sorting = $end_sorting_object->calculate_time($truck_arrived, '10');
        
                $goto_transit_object = new \tnt\model\calculate();
                $goto_transit = $goto_transit_object->calculate_time($end_sorting, '15');
                                    
            }else{
                $truck_departured = "cas ni znan";
                $truck_arrived = "cas ni znan";
                $end_sorting = "cas ni znan";
                $goto_transit = "cas ni znan";
       }
        
            
                    
    }else {
        
        $goods_arrived_object = new \tnt\model\calculate();
        $goods_arrived = $goods_arrived_object->calculate_time($time_flight_arrived, '20');
        
        if ($truck_departured_time) {
                $last = array_slice($truck_departured_time, -1, 1, true);
                 foreach ($last as $key => $value) {
                    $truck_departured = $value['truck_departured'] ;
                  }  
        }else{
            $truck_departured_object = new \tnt\model\calculate();
            $truck_departured = $truck_departured_object->calculate_time($goods_arrived, '40');
        }
        
        
        $truck_arrived_object = new \tnt\model\calculate();
        $truck_arrived = $truck_arrived_object->calculate_time($truck_departured, '35');
        
        $end_sorting_object = new \tnt\model\calculate();
        $end_sorting = $end_sorting_object->calculate_time($truck_arrived, '10');
        
        $goto_transit_object = new \tnt\model\calculate();
        $goto_transit = $goto_transit_object->calculate_time($end_sorting, '15');
        
     }
    
     
     if ($schedule_flight_arrived_time) {
        $last = array_slice($schedule_flight_arrived_time, -1, 1, true);
        foreach ($last as $key => $value) {
            $time_schedule_flight_arrived = $value['schedule_flight_arrived'] ;
        }   
        
        $schedule_goods_arrived_object = new \tnt\model\calculate();
        $schedule_goods_arrived = $schedule_goods_arrived_object->calculate_time($time_schedule_flight_arrived, '20');
        
        $schedule_departured_object = new \tnt\model\calculate();
        $schedule_truck_departured = $schedule_departured_object->calculate_time($schedule_goods_arrived, '40');
        
        $schedule_truck_arrived_object = new \tnt\model\calculate();
        $schedule_truck_arrived = $schedule_truck_arrived_object->calculate_time($schedule_truck_departured, '35');
        
        $schedule_end_sorting_object = new \tnt\model\calculate();
        $schedule_end_sorting = $schedule_end_sorting_object->calculate_time($schedule_truck_arrived, '10');
        
        $schedule_goto_transit_object = new \tnt\model\calculate();
        $schedule_goto_transit = $schedule_goto_transit_object->calculate_time($schedule_end_sorting, '15');
        
    }else{ 
        $time_schedule_flight_arrived = "cas ni znan";
    }

    
    
?>

 
        
        <h1>Jutranji proces</h1>
        
        <h2>Danes: <?php echo date('d.m.y') ?> </h2>
        <h2>Ura: <?php echo date('H:i:s', strtotime('+2 hours'))?> </h2>
        <br/>
        
            <table id="jutarnji" class="table table-striped table-hover dt-responsive" style="width:100%">
			<thead>
              <tr>
                <th>PROCES</th>
                <th>PREDVIDENO</th>		
                <th>DEJANSKO</th>
                <th>POTREBEN CAS</th>
              </tr>
			</thead>
            
			<tbody>
              <tr>
                <td>Pristanek aviona</td>
                <td><?php echo $time_schedule_flight_arrived; ?></td>
                
                <?php if ($time_flight_arrived === "cas ni znan"):  ?>
                    <td><?php echo $time_flight_arrived; ?></td>
                <?php elseif (strtotime($time_flight_arrived) <= strtotime($time_schedule_flight_arrived)):  ?>
                    <td class="green"><?php echo $time_flight_arrived; ?></td>
                <?php elseif (strtotime($time_flight_arrived) > strtotime($time_schedule_flight_arrived)): ?>
                    <td class="red"><?php echo $time_flight_arrived; ?></td>
                <?php endif ?>
                    
                <td></td>
              </tr>
              
              <tr>
                <td>Prihod robe</td>
                <td><?php echo $schedule_goods_arrived ?></td>	
                
                <?php if ($goods_arrived === "cas ni znan"):  ?>
                    <td><?php echo $goods_arrived; ?></td>
                <?php elseif (strtotime($goods_arrived) <= strtotime($schedule_goods_arrived)):  ?>
                    <td class="green"><?php echo $goods_arrived; ?></td>
                <?php elseif (strtotime($goods_arrived) > strtotime($schedule_goods_arrived)): ?>
                    <td class="red"><?php echo $goods_arrived; ?></td>
                <?php endif ?>
                
                <td>cca 0:20</td>
              </tr>
              
              <tr>
                <td>Odhod Kamiona</td>
                <td><?php echo $schedule_truck_departured ?></td>	
                
                <?php if ($truck_departured === "cas ni znan"):  ?>
                    <td><?php echo $truck_departured; ?></td>
                <?php elseif (strtotime($truck_departured) <= strtotime($schedule_truck_departured)):  ?>
                    <td class="green"><?php echo $truck_departured; ?></td>
                <?php elseif (strtotime($truck_departured) > strtotime($schedule_truck_departured)): ?>
                    <td class="red"><?php echo $truck_departured; ?></td>
                <?php endif ?>
                
                <td>cca 0:40</td>
              </tr>
              
              <tr>
                <td>Prihod v LJ1</td>
                <td><?php echo $schedule_truck_arrived ?></td>	
                
                <?php if ($truck_arrived === "cas ni znan"):  ?>
                    <td><?php echo $truck_arrived; ?></td>
                <?php elseif (strtotime($truck_arrived) <= strtotime($schedule_truck_arrived)):  ?>
                    <td class="green"><?php echo $truck_arrived; ?></td>
                <?php elseif (strtotime($truck_arrived) > strtotime($schedule_truck_arrived)): ?>
                    <td class="red"><?php echo $truck_arrived; ?></td>
                <?php endif ?>
                
                <td>cca 0:35</td>
              </tr>
              
              <tr>
                <td>Konec sortiranja</td>
                <td><?php echo $schedule_end_sorting ?></td>		
                
                <?php if ($end_sorting === "cas ni znan"):  ?>
                    <td><?php echo $end_sorting; ?></td>
                <?php elseif (strtotime($end_sorting) <= strtotime($schedule_end_sorting)):  ?>
                    <td class="green"><?php echo $end_sorting; ?></td>
                <?php elseif (strtotime($end_sorting) > strtotime($schedule_end_sorting)): ?>
                    <td class="red"><?php echo $end_sorting; ?></td>
                <?php endif ?>
                
                <td>cca 0:10</td>
              </tr>
              
              <tr>
                <td>Odhod na relacije</td>
                <td><?php echo $schedule_goto_transit ?></td>	
                
                 <?php if ($goto_transit === "cas ni znan"):  ?>
                    <td><?php echo $goto_transit; ?></td>
                <?php elseif (strtotime($goto_transit) <= strtotime($schedule_goto_transit)):  ?>
                    <td class="green"><?php echo $goto_transit; ?></td>
                <?php elseif (strtotime($goto_transit) > strtotime($schedule_goto_transit)): ?>
                    <td class="red"><?php echo $goto_transit; ?></td>
                <?php endif ?>
                
                <td>cca 0:15</td>
              </tr>
              </tbody>
            </table>
 
 

