<?php

include_once dirname(dirname(dirname(__FILE__))) . DIRECTORY_SEPARATOR . "vendor" . DIRECTORY_SEPARATOR . "autoload.php";

$net_easy_im = new \NetEaseSdk\NetEaseIm(
        [
            'AppKey' => 'de2bc0cd90682e4a7c6458c242cdf059',
            'AppSecret' => '767ca6aab45a',
            ]);
$rtn = $net_easy_im->create_accid($accid = md5("ggh111"), $name = "name:ggh111");
var_dump($rtn);die;