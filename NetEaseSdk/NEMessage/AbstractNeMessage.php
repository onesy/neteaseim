<?php
namespace NetEaseSdk\NEMessage;

abstract class AbstractNeMessage implements NeMessage
{
    const TYPE_TXT = 0;
    const TYPE_PIC = 1;
    const TYPE_VOICE = 2;
    const TYPE_VEDIO = 3;
    const TYPE_LOCATION = 4;
    const TYPE_FILE = 6;
    const TYPE_UDF = 100;
    
    
    public $from;
    
    public $ope;
    
    public $to;
    
    public $options;
    
    public $payload;
    
    public $pushcontent;
    
    public $ext;
    
    public function __construct() {
        $this->options = new MessageOptions();
    }
    
    public function get_options():string
    {
        return $this->options->toString();
    }
    
    public function set_push_payload(array $content, callable $can_push):void {
        if ($can_push()) {
            $this->payload = json_encode($content);
        }
    }
}