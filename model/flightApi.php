<?php

namespace tnt\model ;

class flightApi {

    public function scheduled() {
        
        $options = array(
                 'trace' => true,
                 'exceptions' => 0,
                 'login' => 'sampleUser',
                 'password' => 'abc123abc123abc123abc123abc123abc123',
                 );
        $client = new SoapClient('http://flightxml.flightaware.com/soap/FlightXML2/wsdl', $options);

        // get the scheduled.
        $params = array("airport" => "LJLJ","howMany" => 1, "offset" => 0 );
        $scheduled = $client->Scheduled($params);
        print_r($scheduled);

        
    }
    
    public function arrived(){
        
        $options = array(
                 'trace' => true,
                 'exceptions' => 0,
                 'login' => 'sampleUser',
                 'password' => 'abc123abc123abc123abc123abc123abc123',
                 );
        $client = new SoapClient('http://flightxml.flightaware.com/soap/FlightXML2/wsdl', $options);

        // get the weather.
        $params = array("airport" => "LJLJ","howMany" => 1, "offset" => 0 );
        $arrived = $client->Arrived($params);
        print_r($arrived);
    }

}

?>
