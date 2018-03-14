<?php
namespace NetEaseSdk\NEMessage;

final class NeLocationMessage extends AbstractNeMessage
{
    
    private $body = [];
    
    private $type = 4;
    
    public function toString() {
        return json_encode($this->body);
    }
    
    public function getType():int
    {
        return $this->type;
    }
    
    public function set_title(string $title):void
    {
        $this->body['title'] = $title;
    }
    
    public function set_lng(float $lng):void
    {
        $this->body['lng'] = $lng;
    }
    
    public function set_lat(float $lat):void
    {
        $this->body['lat'] = $lat;
    }

}

