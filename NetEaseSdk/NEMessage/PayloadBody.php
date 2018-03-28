<?php
namespace NetEaseSdk\NEMessage;

use NetEaseSdk\NEMessage\NeComposeInterface;

final class PayloadBody implements NeComposeInterface
{
    protected $pushcontent = [];

    public function getData(): array {
        return $this->pushcontent;
    }
    
    /**
     * useless
     * 
     * @return int
     */
    public function getType():int
    {
        return AbstractNeMessage::TYPE_LOCATION;
    }
    
    public function __set($name, $value)
    {
        $this->pushcontent[$name] = $value;
    }
    
    public function __get($name)
    {
        return $this->pushcontent[$name];
    }
}