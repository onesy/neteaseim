<?php

namespace NetEaseSdk\NEMessage;

class NeMessageShell {

    private static $body_register = [
    ];
    private $param = [
        'fromAccid' => null,
        'toAccids' => null,
        'type' => null,
        'body' => null,
        'option' => null,
        'pushcontent' => null,
        'payload' => null,
        'ext' => null,
        'bid' => null,
        'useYidun' => null,
    ];

    static private function regist_func() {
        self::$body_register[AbstractNeMessage::TYPE_TXT] = function() {
            return new TxtBody();
        };
        self::$body_register[AbstractNeMessage::TYPE_PIC] = function() {
            return new PicBody();
        };
        self::$body_register[AbstractNeMessage::TYPE_VOICE] = function() {
            return new VoiceBody();
        };
        self::$body_register[AbstractNeMessage::TYPE_VEDIO] = function() {
            return new VedioBody();
        };
        self::$body_register[AbstractNeMessage::TYPE_LOCATION] = function() {
            return new LocationBody();
        };
        self::$body_register[AbstractNeMessage::TYPE_FILE] = function() {
            return new FileBody();
        };
        self::$body_register[AbstractNeMessage::TYPE_UDF] = function() {
            return new UDFBody();
        };
    }

    static public function getInstance(int $type) {

        return new NeMessageShell($type);
    }

    private function __construct(int $type) {
//        parent::__construct();
        self::regist_func();
        $this->type = $type;
        $this->option = new MessageOptions();
        $fnc = self::$body_register[$type];
        $this->body = $fnc();
        
    }

    public function data(): array {
        $param = array_filter($this->param);
        $param['body'] = json_encode($this->body->getData());
        $param['option'] = $this->option->toString();
        $param['ope'] = $this->param['ope'];
        $param['type'] = $this->body->getType();
        if ($this->param['payload']) {
            $param['payload'] = json_encode($this->param['payload']->getData());
        }
//        echo json_encode($param);
        return $param;
    }

    public function __set($name, $value) {
        $this->param[$name] = $value;
    }

    public function __get($name) {
        return $this->param[$name];
    }

}
