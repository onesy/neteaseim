<?php
namespace NetEaseSdk\NEMessage;

final class NeTxtMessage extends AbstractNeMessage
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
    
    public function set_message(string $message):void
    {
        $this->body['msg'] = $message;
    }

}

