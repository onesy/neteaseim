<?php
namespace NetEaseSdk\NEMessage;

class MessageOptions
{
    public $options = [];
    
    public function __construct() {
        $this->set_badge(true);
    }
    public function toString():string
    {
        return json_encode($this->options);
    }
    
    public function set_roam(bool $option):void
    {
        $this->options['roam'] = $option;
    }
    
    public function set_history(bool $option):void
    {
        $this->options['history'] = $option;
    }
    
    public function set_sendersync(bool $option):void
    {
        $this->options['sendersync'] = $option;
    }
    
    public function set_push(bool $option):void
    {
        $this->options['push'] = $option;
    }
    
    public function set_route(bool $option):void
    {
        $this->options['route'] = $option;
    }
    
    public function set_badge(bool $option):void
    {
        $this->options['badge'] = $option;
    }
    
    public function set_need_push_nick(bool $option):void
    {
        $this->options['needPushNick'] = $option;
    }
    
    public function set_persistent(bool $option):void
    {
        $this->options['persistent'] = $option;
    }
}