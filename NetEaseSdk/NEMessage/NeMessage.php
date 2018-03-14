<?php
namespace NetEaseSdk\NEMessage;

interface NEMessage
{
    public function toString():string;
    
    public function getType():int;
}