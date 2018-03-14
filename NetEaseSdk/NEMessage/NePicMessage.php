<?php
namespace NetEaseSdk\NEMessage;

final class NePicMessage extends AbstractNeMessage
{
    
    private $body = [];
    
    private $type = 1;
    
    public function toString() {
        return json_encode($this->body);
    }
    
    public function getType():int
    {
        return $this->type;
    }
    
    public function set_name(string $name):void
    {
        $this->body['name'] = $name;
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
    
    public function set_weight(int $weight):void
    {
        $this->body['w'] = $weight;
    }
    
    public function set_height(int $height):void
    {
        $this->body['h'] = $height;
    }
    
    public function set_size(int $size):void
    {
        $this->body['size'] = $size;
    }

}

