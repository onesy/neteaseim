<?php
namespace NetEaseSdk;

use NetEaseSdk\NEException\NEResponseFormatException;

class NetEaseImResponse {
    
    private $code;
    
    private $info;
    
    private $desc;
    
    protected $response_array;
    
    public function __construct(callable $reqeust) {
        if (empty($response_array = $reqeust()))
                throw new NEResponseFormatException("Response Format is Invalid!callback return format false");
        if (empty($response_array['code'])) {
            throw new NEResponseFormatException("Response Format is Invalid!Code is neccesary");
        }
        $this->code = intval($response_array['code']);
        if (!empty($response_array['info'])) $this->info = $response_array['info'];
        if (!empty($response_array['desc'])) $this->desc = $response_array['desc'];
        $this->response_array = $response_array;
    }
    
    public function is_success():bool
    {
        return $this->code == 200 ? true: false;
    }
    
    public function get_error_desc():string
    {
        return $this->desc;
    }
    
    public function get_data():array
    {
        return $this->info;
    }
}