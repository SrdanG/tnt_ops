<?php

namespace tnt\model;

class calculate{
    
    protected $start_time;
    protected $add_time;
    public $end_time;

    /*
     * strtotime() ( http://php.net/manual/en/function.strtotime.php )
     *  -> The function expects to be given a string containing an English date format 
     *     and will try to parse that format into a Unix timestamp (the number of seconds since January 1 1970 00:00:00 UTC), 
     *     relative to the timestamp given in now, or the current time if now is not supplied. 
     * 
     *  -> "900"
     *     As strtotime() parse time to seconds, so we should add minutes in seconds ( example: 900s = 15 min (900 = 15 min X 60 sec) )
     * 
     *  -> date('h:i:s', $temp);
     *      Calclulated time convert back from seconds to a human readable format
     */
    
    public function calculate_time($start_time, $add_time){
        
        $this->start_time = $start_time;
        $this->add_time   = $add_time;
        
        $this->end_time = strtotime($this->start_time) + $this->add_time*60;
        return date('h:i', $this->end_time);
        
    }
}

?>

