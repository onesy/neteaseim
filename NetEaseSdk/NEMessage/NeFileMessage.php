<?php
namespace NetEaseSdk\NEMessage;

final class NeFIleMessage extends AbstractNeMessage
{
    
    private $body = [];
    
    private $type = 6;
    
    public function toString(): string {
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
    
    public function set_size(int $size):void
    {
        $this->body['size'] = $size;
    }

}

