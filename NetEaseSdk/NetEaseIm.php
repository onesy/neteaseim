<?php
namespace NetEaseSdk;

use \NetEaseSdk\NEException\NEParamsCheckException;
use NetEaseSdk\NetEaseImResponse;
use NetEaseSdk\NEMessage\AbstractNeMessage;

class NetEaseIm
{
    private $http_request = null;
    private $AppKey;                //开发者平台分配的AppKey
    private $AppSecret;             //开发者平台分配的AppSecret,可刷新
    private $Nonce;     //随机数（最大长度128个字符）
    private $CurTime;              //当前UTC时间戳，从1970年1月1日0点0 分0 秒开始到现在的秒数(String)
    private $CheckSum;    //SHA1(AppSecret + Nonce + CurTime),三个参数拼接的字符串，进行SHA1哈希计算，转化成16进制字符(String，小写)
    
    const CONTENT_TYPE = "application/x-www-form-urlencoded;charset=utf-8";
    const HEX_DIGITS = "0123456789abcdef";
    /////////////////////protocal
    const OP_P2P_BLACK = 1;
    const OP_P2P_MUTE = 2;
    // 取消黑名单或静音
    const OP_UNSET = 0;
    // 加入黑名单或静音
    const OP_SET=1;
    public function __construct(array $config) {
        $this->netease_im_check_config($config);
        $this->http_request = new HttpRequest();
        $this->http_request->add_header("AppKey", $this->AppKey);
//        $this->http_request->add_header("AppSecret", $this->AppSecret);
        $this->http_request->add_header("Content-Type", self::CONTENT_TYPE);
    }
    
    private function netease_im_check_config(array $config):bool
    {
        if (empty($config['AppKey'])) {
            throw new NEParamsCheckException("param check faild AppKey is neccesary");
        }
        if (empty($config['AppSecret'])) {
            throw new NEParamsCheckException("Param check faild AppSecret is neccesary");
        }
        
        $this->AppKey = $config['AppKey'];
        $this->AppSecret = $config['AppSecret'];
        return true;
    }
    
    /**
     * API checksum校验生成
     * @param  void
     * @return $CheckSum(对象私有属性)
     */
    private function checkSumBuilder():string {
        //此部分生成随机字符串
        $hex_digits = self::HEX_DIGITS;
        for ($i = 0; $i < 128; $i++) {   //随机字符串最大128个字符，也可以小于该数
            $this->Nonce .= $hex_digits[rand(0, 15)];
        }
        $this->CurTime = time(); //当前时间戳，以秒为单位

        $join_string = $this->AppSecret . $this->Nonce . $this->CurTime;
        $this->CheckSum = sha1($join_string);
        $this->http_request->add_header("CurTime", $this->CurTime);
        $this->http_request->add_header("Nonce", $this->Nonce);
        $this->http_request->add_header("CheckSum", $this->CheckSum);
        return $this->CheckSum;
    }
    
    
    #########################################accid crud
    /**
     * create netease response
     * 
     * @tested
     * @param string $accid
     * @param string $name
     * @param array $left_param
     * @return \NetEaseSdk\NetEaseImResponse
     */
    public function create_accid(
            string $accid, string $name, array $left_param = []):NetEaseImResponse
    {
        $this->checkSumBuilder();
        $data = [
            'accid' => $accid,
            'name' => $name,
        ];
        $data = array_merge($left_param, $data);
        $this->http_request->set_url(NEConstants::create_accid);
        $this->http_request->set_data($data);
        return new NetEaseImResponse(
                function(){return $this->http_request->https_post();});
    }
    
    public function update_accid(
            string $accid, array $props, string $token): NetEaseImResponse
    {
        $this->checkSumBuilder();
        $data = [
            'accid' => $accid,
            'props' => json_encode($props),
            'token' => $token,
        ];
        $this->http_request->set_url(NEConstants::update_accid);
        $this->http_request->set_data($data);
        return new NetEaseImResponse(
                function(){return $this->http_request->https_post();});
    }
    
    public function refresh_accid_token(string $accid): NetEaseImResponse
    {
        $this->checkSumBuilder();
        $data = [
            'accid' => $accid
        ];
        $this->http_request->set_url(NEConstants::refresh_accid);
        $this->http_request->set_data($data);
        return new NetEaseImResponse(
                function(){return $this->http_request->https_post();});
    }
    
    public function block_accid(
            string $accid, bool $needkick = false): NetEaseImResponse
    {
        $this->checkSumBuilder();
        $data = [
            'accid' => $accid,
            'needkick' => $needkick ? 'true': 'false',
        ];
        $this->http_request->set_url(NEConstants::block_accid);
        $this->http_request->set_data($data);
        return new NetEaseImResponse(
                function(){return $this->http_request->https_post();});
    }
    
    public function unblock_accid(string $accid): NetEaseImResponse
    {
        $this->checkSumBuilder();
        $data = [
            'accid' => $accid,
        ];
        $this->http_request->set_url(NEConstants::unblock_accid);
        $this->http_request->set_data($data);
        return new NetEaseImResponse(
                function(){return $this->http_request->https_post();});
    }
    
    ###########################################accid infos start
    
    public function update_accid_info(
            string $accid, string $name = '',string $icon = '',
            string $sign = '', string $email = '', string $birth = '', 
            string $mobile = '', int $gender = 0, array $ex = []): NetEaseImResponse
    {
        $this->checkSumBuilder();
        $data['accid'] = $accid;
        if (!empty($name))$data['name'] = $name;
        if (!empty($icon))$data['icon'] = $icon;
        if (!empty($sign))$data['sign'] = $sign;
        if (!empty($email))$data['email'] = $email;
        if (!empty($birth))$data['birth'] = $birth;
        if (!empty($mobile))$data['mobile'] = $mobile;
        if (!empty($gender))$data['gender'] = $gender;
        if (!empty($ex))$data['ex'] = json_encode ($ex);
        $this->http_request->set_url(NEConstants::update_accid_info);
        $this->http_request->set_data($data);
        return new NetEaseImResponse(
                function(){return $this->http_request->https_post();});
    }
    
    public function get_accid_infos(array $accids):NetEaseImResponse
    {
        $this->checkSumBuilder();
        if (count($accids) > 200) throw new NEParamsCheckException(
                "count of accids in query can not over 200");
        $data['accid'] = json_encode($accids);
        $this->http_request->set_url(NEConstants::get_accid_infos);
        $this->http_request->set_data($data);
        return new NeResponse\AccifUInfosResponse(function(){
            return $this->http_request->https_post();
        });
    }
    #############################################accid infos end
    #############################################member setting start
    public function set_donnop(
            string $accid, bool $donnp_open = true):NetEaseImResponse
    {
        $this->checkSumBuilder();
        $data['accid'] = $accid;
        $data['donnopOpen'] = $donnp_open?'true':'false';
        $this->http_request->set_url(NEConstants::set_dunnop);
        $this->http_request->set_data($data);
        return new NetEaseImResponse(function(){
            return $this->http_request->https_post();
        });
    }
    #############################################member setting end
    #############################################member relations ship
    public function add_friend(
            string $accid, string $faccid, int $type, string $msg):NetEaseImResponse
    {
        $this->checkSumBuilder();
        $data['accid'] = $accid;
        $data['faccid'] = $faccid;
        $data['type'] = $type;
        $data['msg'] = $msg;
        $this->http_request->set_url(NEConstants::add_friends);
        $this->http_request->set_data($data);
        return new NetEaseImResponse(function(){
            return $this->http_request->https_post();
        });
    }
    
    public function update_friends(
            string $accid, string $faccid, string $alias, string $ex):NetEaseImResponse
    {
        $this->checkSumBuilder();
        $data['accid'] = $accid;
        $data['faccid'] = $faccid;
        $data['alias'] = $alias;
        $data['ex'] = $ex;
        $this->http_request->set_url(NEConstants::update_friends);
        $this->http_request->set_data($data);
        return new NetEaseImResponse(function(){
            return $this->http_request->https_post();
        });
    }
    
    public function delete_friends(
            string $accid, string $faccid):NetEaseImResponse
    {
        $this->checkSumBuilder();
        $data['accid'] = $accid;
        $data['faccid'] = $faccid;
        $this->http_request->set_url(NEConstants::delete_friends);
        $this->http_request->set_data($data);
        return new NetEaseImResponse(function(){
            return $this->http_request->https_post();
        });
    }
    
    public function get_friends_relations(
            string $accid, int $updatetime, int $createtime):NeResponse\FriendsInfosResponse
    {
        $this->checkSumBuilder();
        $data['accid'] = $accid;
        $data['updatetime'] = $updatetime;
        $data['createtime'] = $createtime;
        $this->http_request->set_url(NEConstants::get_friends);
        $this->http_request->set_data($data);
        return new NeResponse\FriendsInfosResponse(function(){
            return $this->http_request->https_post();
        });
    }
    
    protected function quiet_black_sb(
            string $accid, string $targetAcc, int $relationType, int $value): NetEaseImResponse
    {
        $this->checkSumBuilder();
        $data['accid'] = $accid;
        $data['targetAcc'] = $targetAcc;
        $data['relationType'] = $relationType;
        $data['value'] = $value;
        $this->http_request->set_url(NEConstants::quiet_black_friends);
        $this->http_request->set_data($data);
        return new NetEaseImResponse(function(){
            return $this->http_request->https_post();
        });
    }
    
    public function p2p_mute_user(string $accid, string $targetAcc): NetEaseImResponse
    {
        return $this->quiet_black_sb($accid, $targetAcc, self::OP_P2P_MUTE, self::OP_SET);
    }
    
    public function p2p_unmute_user(string $accid, string $targetAcc):NetEaseImResponse
    {
        return $this->quiet_black_sb($accid, $targetAcc, self::OP_P2P_MUTE, self::OP_UNSET);
    }
    
    public function p2p_block_user(string $accid, string $targetAcc):NetEaseImResponse
    {
        return $this->quiet_black_sb($accid, $targetAcc, self::OP_P2P_BLACK, self::OP_SET);
    }
    
    public function p2p_unblock_user(string $accid, string $targetAcc):NetEaseImResponse
    {
        return $this->quiet_black_sb($accid, $targetAcc, self::OP_P2P_BLACK, self::OP_UNSET);
    }
    
    public function lisk_black_and_mute_list(string $accid):NetEaseImResponse
    {
        $this->checkSumBuilder();
        $data['accid'] = $accid;
        $this->http_request->set_url(NEConstants::quiet_black_friends_list);
        $this->http_request->set_data($data);
        return new NeResponse\AccidBlockMuteListResponse(function(){
            return $this->http_request->https_post();
        });
    }
    ##############################################message 
    /**
     * 0 表示文本消息,
     * 1 表示图片，
     * 2 表示语音，
     * 3 表示视频，
     * 4 表示地理位置信息，
     * 6 表示文件，
     * 100 自定义消息类型
     * 
     * @param AbstractNeMessage $message
     * @param string $body
     * @param bool $antispam
     * @param string $antispamCustom
     * @param array $option
     * @param array $pushcontent
     * @param array $payload
     * @param array $ext
     * @param array $forcepushlist
     * @param string $forcepushcontent
     * @param bool $forcepushall
     * @param string $bid
     * @param int $useYidun
     * @return NetEaseImResponse
     */
    public function message_send(
            AbstractNeMessage $message, bool $antispam =false,
            array $antispamCustom = [], array $option = [], array $pushcontent = [],
            array $payload = [], array $ext = [], array $forcepushlist = [], 
            string $forcepushcontent = '', bool $forcepushall = false,
            string $bid = '', int $useYidun = 0):NetEaseImResponse
    {
        $this->checkSumBuilder();
        $data['from'] = $message->from;
        $data['ope'] = $message->ope;
        $data['to'] = $message->to;
        $data['type'] = $message->getType();
        $data['body'] = $message->toString();
        if (!empty($antispam)) $data['antispam'] = 'true';
        if (!empty($antispamCustom)) $data['antispamCustom'] = json_encode($antispamCustom);
        if (!empty($option)) $data['option'] = $message->get_options();
        if (!empty($pushcontent)) $data['pushcontent'] = json_encode($pushcontent);
        if (!empty($payload)) $data['payload'] = json_encode($payload);
        if (!empty($ext)) $data['ext'] = json_encode($ext);
        if (!empty($forcepushlist)) $data['forcepushlist'] = json_encode($forcepushlist);
        if (!empty($forcepushcontent)) $data['forcepushcontent'] = $forcepushcontent;
        if (!empty($forcepushall)) $data['forcepushall'] = 'true';
        if (!empty($bid)) $data['bid'] = $bid;
        if (!empty($useYidun)) $data['useYidun'] = $useYidun;
        $this->http_request->set_url(NEConstants::send_msg);
        $this->http_request->set_data($data);
        return new NetEaseImResponse(function(){
            return $this->http_request->https_post();
        });
    }
    
    /**
     * 批量发送点对点普通消息
     * 
     * @param \NetEaseSdk\NEMessage\BatchP2PMessage $messages
     * @param array $pushcontent
     * @param array $payload
     * @param array $ext
     * @param string $bid
     * @param int $useYidun
     * @return NetEaseImResponse
     */
    public function send_batch_attach_msg(
        NEMessage\BatchP2PMessage $messages, array $pushcontent = [], 
            array $payload = [], array $ext = [], string $bid = '', 
            int $useYidun = 0): NetEaseImResponse
    {
        $this->checkSumBuilder();
        $data['fromAccid'] = $messages->from;
        $data['toAccids'] = $messages->get_tos();
        $data['type'] = $messages->get_type();
        $data['body'] = $messages->get_body();
        $data['option'] = $messages->get_options();
        if (!empty($pushcontent)) $data['pushcontent'] = json_encode($pushcontent);
        if (!empty($payload)) $data['payload'] = json_encode($payload);
        if (!empty($ext)) $data['ext'] = json_encode($ext);
        if (!empty($bid)) $data['bid'] = $bid;
        if (!empty($useYidun)) $data['useYidun'] = $useYidun;
        $this->http_request->set_url(NEConstants::batch_send_p2p_msg);
        $this->http_request->set_data($data);
        return new NetEaseImResponse(function(){
            return $this->http_request->https_post();
        });
    }
    
    /**
     * 发送自定义系统通知
     * 
     * @param \NetEaseSdk\NEMessage\NeSelfDefineMessage $message
     * @param int $msgtype
     * @param array $pushcontent
     * @param array $payload
     * @param string $sound
     * @param int $save
     * @return NetEaseImResponse
     */
    public function send_attach_message(
            NEMessage\NeSelfDefineMessage $message, int $msgtype = 0,array $pushcontent = [],
            array $payload = [], string $sound = '', int $save = 2): NetEaseImResponse
    {
        $this->checkSumBuilder();
        $data['from'] = $message->from;
        $data['msgtype'] = $msgtype;
        $data['to'] = $message->to;
        $data['attach'] = $message->toString();
        if (!empty($pushcontent)) $data['pushcontent'] = json_encode ($pushcontent);
        if (!empty($payload)) $data['payload'] = json_encode ($payload);
        if (!empty($sound)) $data['sound'] = $sound;
        $data['save'] = $save;
        $data['option'] = $message->get_options();
        $this->http_request->set_url(NEConstants::self_define_sys_notify);
        $this->http_request->set_data($data);
        return new NetEaseImResponse(function(){
            return $this->http_request->https_post();
        });
    }
    
    /**
     * 
     * 文件上传 ，字符流需要base64编码，最大15M。
     * @param string $path
     * @param string $type
     * @param bool $ishttps
     * @return NetEaseImResponse
     * @throws NEException\NEUploadFileNotFoundException
     */
    public function upload_single_file(
            string $path, string $type, bool $ishttps = false) :NetEaseImResponse
    {
        $this->checkSumBuilder();
        if (!file_exists($path)) {
            throw new NEException\NEUploadFileNotFoundException("File '{$path}' Not found!");
        }
        $content = base64_encode(file_get_contents($path));
        $data['content'] = $content;
        if (!empty($type)) $data['type'] = $type;
        $data['ishttps'] = $ishttps;
        $this->http_request->set_url(NEConstants::file_upload);
        $this->http_request->set_data($data);
        return new NeResponse\SingleFileResponse(function(){
            return $this->http_request->https_post();
        });
    }
    
    /**
     * 文件上传（multipart方式）最大15M
     * 
     * @param string $path
     * @param string $type
     * @param bool $ishttps
     * @return NetEaseImResponse
     * @throws NEException\NEUploadFileNotFoundException
     */
    public function upload_single_file_multipart(
            string $path, string $type, bool $ishttps = false) :NetEaseImResponse
    {
        $this->checkSumBuilder();
        if (!file_exists($path)) {
            throw new NEException\NEUploadFileNotFoundException("File '{$path}' Not found!");
        }
        $this->http_request->add_header("Content-Type", "Content-Type:multipart/form-data;charset=utf-8");
        $content = file_get_contents($path);
        $data['content'] = $content;
        if (!empty($type)) $data['type'] = $type;
        $data['ishttps'] = $ishttps;
        $this->http_request->set_url(NEConstants::file_upload_multi);
        $this->http_request->set_data($data);
        return new NeResponse\SingleFileResponse(function(){
            return $this->http_request->https_post();
        });
    }
    
    /**
     * 消息撤回接口，可以撤回一定时间内的点对点与群消息
     * 
     * @param string $deleteMsgId 要撤回消息的msgid
     * @param int $timetag 要撤回消息的创建时间
     * @param int $type 7:表示点对点消息撤回，8:表示群消息撤回，其它为参数错误
     * @param string $from 发消息的accid
     * @param string $to 如果点对点消息，为接收消息的accid,如果群消息，为对应群的tid
     * @param string $msg 可以带上对应的描述 1表示忽略撤回时间检测，其它为非法参数，如果需要撤回时间检测，不填即可
     * @param string $ignoreTime
     */
    public function recall_message(
            string $deleteMsgId, int $timetag, int $type, 
            string $from, string $to, string $msg = '', string $ignoreTime = '') :NetEaseImResponse
    {
        $this->checkSumBuilder();
        $data['deleteMsgId'] = $deleteMsgId;
        $data['timetag'] = $timetag;
        $data['type'] = $type;
        $data['from'] = $from;
        $data['to'] = $to;
        if (!empty($msg)) $data['msg'] = $msg;
        if (!empty($ignoreTime)) $data['ignoreTime'] = $ignoreTime;
        $this->http_request->set_url(NEConstants::recall);
        $this->http_request->set_data($data);
        return new NetEaseImResponse(function(){
            return $this->http_request->https_post();
        });
    }
    
    /**
     * 发送广播消息
     * 
     * 1、广播消息，可以对应用内的所有用户发送广播消息，广播消息目前暂不支持第三方推送（APNS、小米、华为等）；
     * 2、广播消息支持离线存储，并可以自定义设置离线存储的有效期，最多保留最近100条离线广播消息；
     * 3、此接口受频率控制，一个应用一分钟最多调用10次，一天最多调用1000次，超过会返回416状态码；
     * 4、该功能目前需申请开通，详情可咨询您的客户经理。
     * 
     * body 	 String 	是	广播消息内容，最大4096字符
     * from 	 String	否	发送者accid, 用户帐号，最大长度32字符，必须保证一个APP内唯一
     * isOffline String	否	是否存离线，true或false，默认false
     * ttl 	 int	否	存离线状态下的有效期，单位小时，默认7天
     * targetOs 	String	否	目标客户端，默认所有客户端，jsonArray，格式：["ios","aos","pc","web","mac"]
     * @param \NetEaseSdk\NEMessage\BroadcastMessage $message
     * @return \NetEaseSdk\NeResponse\BroadcastResponse
     */
    public function broadcast_message(NEMessage\BroadcastMessage $message): NeResponse\BroadcastResponse
    {
        $this->checkSumBuilder();
        $data['body'] = $message->toString();
        $data['from'] = $message->from;
        $data['isOffline'] = $message->isOffline;
        $data['ttl'] = $message->ttl;
        $data['targetOs'] = $message->targetOs;
        $this->http_request->set_url(NEConstants::broadcast);
        $this->http_request->set_data($data);
        return new NeResponse\BroadcastResponse(function(){
            return $this->http_request->https_post();
        });
    }
}