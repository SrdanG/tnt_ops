<?php

/*
 * namespace should be followed PSR-0 standard: 
 * 
 * vendor_name\folder_name
 */
namespace tnt\model;

class db {
    
    protected $con;
    protected $current_date;

    public function __construct() {
        
          try {
            $db_host = 'localhost';  
            $db_name = 'merdenom_tntops'; 
            $db_user = 'merdenom_tntops'; 
            $user_pw = 'kiwikiwi101';

            /*
             * Because we are in namespace tnt\model..
             * ..we must put "\" before inic. a class PDO - otherwise PHP will not find object/class PDO
             * ..with "\"  we tell PHP to look back in global namespace - in which PDO object is! And not in tnt\model namespace
             * Reference: Video 11 in PHP OOP Essential
             */
            $this->con = new \PDO('mysql:host='.$db_host.'; dbname='.$db_name, $db_user, $user_pw);  
            
        }catch (PDOException $e) {  
            echo "Connection to DB failed.";
            // log errors to file 
            file_put_contents('PDOErrors.txt',$e->getMessage(), FILE_APPEND);  
            die(); 
        }
        
    }
    
    public function insert_times($table_name, $column_name, $value){
        
        try{
            
            $this->current_date = date('Y-m-d');
            $sql = "INSERT INTO $table_name($column_name, date_inserted) VALUES (:value, :date)";
            $stmt = $this->con->prepare($sql);
            $stmt->execute(array(
                'value' => $value,
                'date'  => $this->current_date
                ));
        
        }catch (PDOException $e){
            echo "Could not execute" . $e->getMessage();
        }
    }

     
    public function get_times($table_name,$column_name){
        
        try{
            
            $this->current_date = date('Y-m-d');
            $sql = "SELECT $column_name FROM $table_name WHERE date_inserted = :date";
            $stmt = $this->con->prepare($sql);
            
            if ($stmt){
                    $stmt->execute(array(
                    'date'  => $this->current_date
                    ));
                    $result = $stmt->fetchall();
                    $error = $stmt->errorInfo();
            }
           
           /*
            * PDOStatement::fetchAll() returns an array containing all of the remaining rows in the result set. 
            * The array represents each row as either an array of column values or an object 
            * with properties corresponding to each column name. 
            * An empty array is returned if there are zero results to fetch, or FALSE on failure. 
            */ 
            
           if ($result){
		return $result;
            
            /*
             * $error - return array
             *      - see PHP Manual and print_r($error) to see what it means $error[2]
             */
                
            }elseif (empty($error[2])){
		echo "No results for that query ";
            }else{
		echo "Query failed with error: " . $error[2];
            }
            
        }catch (PDOException $e){
            echo "Could not execute" . $e->getMessage();
        }
        
        
    }

    
        public function get_schedule_times($table_name,$column_name){
        
        try{
            $sql = "SELECT $column_name FROM $table_name ORDER BY id DESC LIMIT 1";
            $stmt = $this->con->prepare($sql);
            
            if ($stmt){
                    $stmt->execute(array(
                    ));
                    $result = $stmt->fetchall();
                    $error = $stmt->errorInfo();
            }
           
           /*
            * PDOStatement::fetchAll() returns an array containing all of the remaining rows in the result set. 
            * The array represents each row as either an array of column values or an object 
            * with properties corresponding to each column name. 
            * An empty array is returned if there are zero results to fetch, or FALSE on failure. 
            */ 
            
           if ($result){
		return $result;
            
            /*
             * $error - return array
             *      - see PHP Manual and print_r($error) to see what it means $error[2]
             */
                
            }elseif (empty($error[2])){
		echo "No results for that query ";
            }else{
		echo "Query failed with error: " . $error[2];
            }
            
        }catch (PDOException $e){
            echo "Could not execute" . $e->getMessage();
        }
        
        
    }
}

?>
