<?php
namespace NetEaseSdk;

use GuzzleHttp\Client;

class HttpRequest {
    
    private $timeout = 60;
    
    private $header = [];
    
    private $url = '';
    
    private $data = [];
    
    public function set_url(string $url)
    {
        $this->url = $url;
    }

    public function set_data(array $data)
    {
        $this->data = $data;
    }

    public function generate_sending_header()
    {
        $headers = [];
        foreach($this->header as $k => $h) {
            $headers[] = $k . ":" . $h;
        }
        return $headers;
    }
    
    public function add_header($key, $value)
    {
        $this->header[$key] = $value;
    }
    
    public function set_timeout(int $timeout = 60) {
        $this->timeout = $timeout;
    }
    
    public function https_post()
    {
        $headers = $this->generate_sending_header();
        $url = $this->url;
        $data = http_build_query($this->data);
        ###guzzle
        $client = new Client();
        $res = $client->request("POST", $url,[
            'headers' => $this->header,
            'form_params' => $this->data,
            'connect_timeout' => $this->timeout,
            'verify' => false,
        ]);
        $status_code = $res->getStatusCode();
        if ($status_code != 200) {
            $status_rtn = $res->getStatusCode();
        } else {
            $status_rtn = json_decode($res->getBody()->getContents(), true);
        }
        return $status_rtn;
        #####################################
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        curl_setopt($ch, CURLOPT_HEADER, false);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false); //处理http证书问题  
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, $this->timeout);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

        $result = curl_exec($ch);
        if (false === $result) {
            $result = curl_errno($ch);
        }
        curl_close($ch);
        return json_decode($result,true);
    }
}