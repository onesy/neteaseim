<?php
namespace NetEaseSdk\NEMessage;

abstract class AbstractNeMessage implements NeMessage
{
    public $from;
    
    public $ope;
    
    public $to;
    
    public $options;
    
    public function __construct() {
        $this->options = new MessageOptions();
    }
    
    public function get_options():string
    {
        return $this->options->toString();
    }
}