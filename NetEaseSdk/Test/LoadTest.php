<?php
use NetEaseSdk\NEMessage\NeMessageShell;
use NetEaseSdk\NEMessage\AbstractNeMessage;
use NetEaseSdk\NEMessage\PayloadBody;

include_once dirname(dirname(dirname(__FILE__))) . DIRECTORY_SEPARATOR . "vendor" . DIRECTORY_SEPARATOR . "autoload.php";

//$net_easy_im = new \NetEaseSdk\NetEaseIm(
//        [
//            'AppKey' => '',
//            'AppSecret' => '',
//            ]);
//$rtn = $net_easy_im->create_accid($accid = md5("aggh111"), $name = "name:aggh111");
//var_dump($rtn);die;
$netease_img = new NetEaseSdk\NetEaseIm([
    'AppKey' => '',
    'AppSecret' => ''
]);
$from = "";
$to = "";
//$message = NeMessageShell::getInstance(AbstractNeMessage::TYPE_TXT);
//$message->from = $from;
//$message->to = $to;
//$message->ope = 0;
//$message->body->msg="hello world";
//$message->payload = json_encode(["sno" => "kkhhnmn"]);
//$rtn = $netease_img->message_send($message);
//var_dump($rtn);
$message2 = NeMessageShell::getInstance(AbstractNeMessage::TYPE_PIC);
$message2->from = $from;
$message2->to = $to;
$message2->ope = 0;
$message2->body->name = "caeser";
$message2->body->md5 = "9894907e4ad9de4678091277509361f7";
$message2->body->url = "http://nimtest.nos.netease.com/cbc500e8-e19c-4b0f-834b-c32d4dc1075e";
$message2->body->w = 6814;
$message2->body->h = 2332;
$message2->body->size = 388245;
$message2->body->ext = "123";
$message2->pushcontent = "hello world";
$payloadbody = new PayloadBody();
$payloadbody->msg = "hello world";
$message2->payload = $payloadbody;
$message2->pushcontent = "pushed content";
$rtn2 = $netease_img->message_send($message2);
var_dump($rtn2);die;