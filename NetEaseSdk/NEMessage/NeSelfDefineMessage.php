<?php
namespace NetEaseSdk\NEMessage;

class NeSelfDefineMessage extends AbstractNeMessage
{
    
    private $body = [];
    
    private $type = 0;
    
    public function toString() {
        return json_encode($this->body);
    }
    
    public function getType():int
    {
        return $this->type;
    }
    
    public function __set($name, $value) {
        $this->body[$name] = $value;
    }

}

