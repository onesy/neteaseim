<?php
namespace NetEaseSdk\NEMessage;

final class TxtBody implements NeComposeInterface
{
    protected $body;
    
    public function __construct() {
        ;
    }
    
    public function __set($name, $value)
    {
        $this->body[$name] = $value;
    }
    
    public function __get($name)
    {
        return $this->body[$name];
    }
    
    public function getType(): int
    {
        return AbstractNeMessage::TYPE_TXT;
    }

    public function getData():array {
        return $this->body;
    }

}