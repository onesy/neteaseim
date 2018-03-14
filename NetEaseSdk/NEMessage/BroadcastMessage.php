<?php
namespace NetEaseSdk\NEMessage;

class BroadcastMessage
{
    public $body; // 广播消息内容，最大4096字符
    
    public $from; // 发送者accid, 用户帐号，最大长度32字符，必须保证一个APP内唯一
    
    public $isOffline; // 是否存离线，true或false，默认false
    
    public $ttl; // 存离线状态下的有效期，单位小时，默认7天
    
    public $targetOs; // 目标客户端，默认所有客户端，jsonArray，格式：["ios","aos","pc","web","mac"]
    
    public function __set($name, $value) {
        $this->body[$name] = $value;
    }
    
    public function __get($name) {
        return $this->body[$name];
    }
    
    public function toString()
    {
        return json_encode($this->body);
    }
}