<?php
namespace NetEaseSdk\NEMessage;

abstract class AbstractNeMessage implements NeMessage
{
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