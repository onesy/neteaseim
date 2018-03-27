<?php
namespace NetEaseSdk\NEMessage;

interface NeMessage
{
    public function toString():string;
    
    public function getType():int;
}