<?php
namespace NetEaseSdk\NEMessage;

use NetEaseSdk\NEMessage\NeComposeInterface;

final class UDFBody implements NeComposeInterface
{
    protected $body;

    public function getData(): array {
        return $this->body;
    }
    
    public function getType():int
    {
        return AbstractNeMessage::TYPE_UDF;
    }
    
    public function __set($name, $value)
    {
        $this->body[$name] = $value;
    }
    
    public function __get($name)
    {
        return $this->body[$name];
    }
}