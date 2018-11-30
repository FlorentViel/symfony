<?php 

namespace App\Service;

class EventService 
{

    private $events = [
        [
            'id' => 1, 
            'title' => 'titre1', 
            'description' => "azjjiajijaej",
            "start_date"=> "2018-11-29 08:00:00",
            "end_date"=> "2018-11-29 23:00:00"
        ],
    
        [
            'id' => 2, 
            'title' => 'titre2', 
            'description' => "azjjiajijaej",
            "start_date"=> "2018-12-29 08:00:00",
            "end_date"=> "2018-12-29 23:00:00"
        ],
    
        [
            'id' => 3, 
            'title' => 'titre3', 
            'description' => "azjjiajijaej",
            "start_date"=> "2017-11-29 08:00:00",
            "end_date"=> "2017-11-29 23:00:00"
            
        ]        
    ];

    public function listEvent() {
 


        return $this->events;   
    }

    public function getOne($id){
        
        foreach ($this->events as $key => $value) {
            if ($value['id'] == $id)
                return $value;
        }
        return null;
    }
}