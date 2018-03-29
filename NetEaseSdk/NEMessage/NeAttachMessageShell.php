<?php

namespace NetEaseSdk\NEMessage;

class NeAttachMessageShell {

    const P2P_MSG = 0;
    const GROUP_MSG = 1;

    private $param = [
        'from' => null,
        'to' => null,
        'msgtype' => null,
        'attach' => null,
        'option' => null,
        'pushcontent' => null,
        'payload' => null,
        'sound' => null,
        'save' => null,
    ];

    public function __construct(int $msgType)
    {
        $this->msgtype = $msgType;
        $this->option = new MessageOptions();
        $this->attach = new TxtBody();
    }

    public function data(): array
    {
        $param = array_filter($this->param);
        $param['attach'] = json_encode($this->attach->getData());
        $param['option'] = $this->option->toString();
        $param['msgtype'] = $this->msgtype;
        if ($this->param['payload']) {
            $param['payload'] = json_encode($this->param['payload']->getData());
        }
//        var_dump($param);die;
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