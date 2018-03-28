<?php
namespace NetEaseSdk\NEMessage;

use NetEaseSdk\NEMessage\NeComposeInterface;

final class LocationBody implements NeComposeInterface
{
    protected $body;

    public function getData(): array {
        return $this->body;
    }
    
    public function getType():int
    {
        return AbstractNeMessage::TYPE_LOCATION;
    }
    
    public function __set($name, $value)
    {
        $this->body[$name] = $value;
    }
    
    public function __get($name)
    {
        return $this->body[$name];
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