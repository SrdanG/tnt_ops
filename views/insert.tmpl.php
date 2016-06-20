
 
        <h1>Stran za vnos dejanskega casa</h1>
        
		
        <div class="insert-form">
		
            <form action="insert.php" method="get">
               
                    <label for="scheduled">Pristanek aviona:</label>
                    <input type="time" name="arrived" class="time"> 
                    <input type="submit" value="Submit" class="btn btn-success btn-lg" /> 
                 
            </form>   
             
            <br/> <br/>       
                    
            <form action="insert.php" method="get">
               
                    <label for="scheduled">Odhod kamiona:</label>
                    <input type="time" name="departured" class="time">
                    <input type="submit" value="Submit" class="btn btn-success btn-lg" /> 
                 
            </form> 
             
            <br/> <br/>       
                    
            <form action="insert.php" method="get">
               
                    <label for="scheduled">Predvideni cas pristanek aviona:</label>
                    <input type="time" name="schedule" class="time">
                    <input type="submit" value="Submit" class="btn btn-success btn-lg" /> 
                 
            </form> 
            
            
	</div>
         
 

<?php 

    /*
     * 

        Well, they don't do the same thing, really.

        $_SERVER['REQUEST_METHOD'] contains the request method (surprise).
        $_POST contains any post data.

        It's possible for a POST request to contain no POST data.

        I check the request method — I actually never thought about testing the $_POST array. 
        I check the required post fields, though. So an empty post request would give the user a lot of error messages - which makes sense to me.
     * 
     */

    if (($_SERVER['REQUEST_METHOD'] == 'GET') && !empty($_GET['arrived'])){
        
            $flight_arrived = new tnt\model\db();
            $flight_arrived->insert_times('flight_arrived','arrived_time', $_GET['arrived']);
            
            echo "Time successfully added.";
    }
  
    if (($_SERVER['REQUEST_METHOD'] == 'GET') && !empty($_GET['departured'])){
            
            $truck_departured = new tnt\model\db();
            $truck_departured->insert_times('morning_times','truck_departured', $_GET['departured']);
            
            echo "Time successfully added.";
    }
    
    if (($_SERVER['REQUEST_METHOD'] == 'GET') && !empty($_GET['schedule'])){
            
            $schedule_flight_arrived = new tnt\model\db();
            $schedule_flight_arrived->insert_times('schedule_times','schedule_flight_arrived', $_GET['schedule']);
            
            echo "Time successfully added.";
    }
    
?>