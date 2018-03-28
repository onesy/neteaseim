<?php
namespace NetEaseSdk\NEMessage;

class NeSelfDefineMessage extends AbstractNeMessage
{
    
    private $body = [];
    
    private $type = 0;
    
    public function toString():string {
        return json_encode($this->body);
    }
    
    public function getType():int
    {
        return $this->type;
    }
    
    public function __set($name, $value) {
        $this->body[$name] = $value;
    }
    
    public function __get($name) {
        return $this->body[$name];
    }

}

