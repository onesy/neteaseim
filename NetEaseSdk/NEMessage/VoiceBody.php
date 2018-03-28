<?php
namespace NetEaseSdk\NEMessage;

use NetEaseSdk\NEMessage\NeComposeInterface;

final class VoiceBody implements NeComposeInterface
{
    protected $body;
    
    public function getData(): array {
        return $this->body;
    }
    
    public function getType():int
    {
        return AbstractNeMessage::TYPE_VOICE;
    }
    
    public function __set($name, $value)
    {
        $this->body[$name] = $value;
    }
    
    public function __get($name)
    {
        return $this->body[$name];
    }
    
    public function set_duration(int $duration):void
    {
        $this->body['dur'] = $duration;
    }
    
    public function set_md5(string $md5):void
    {
        $this->body['md5'] = $md5;
    }
    
    public function set_url(string $url):void
    {
        $this->body['url'] = $url;
    }
    
    public function set_ext(string $ext):void
    {
        $this->body['ext'] = $ext;
    }
    
    public function set_size(int $size):void
    {
        $this->body['size'] = $size;
    }

}