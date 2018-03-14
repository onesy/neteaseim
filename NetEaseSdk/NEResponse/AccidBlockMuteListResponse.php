<?php
namespace NetEaseSdk\NeResponse;

final class AccidBlockMuteListResponse extends \NetEaseSdk\NetEaseImResponse
{
    
    private $mutelist = [];
    
    private $blacklist = [];
    
    private $size = 0;
    
    public function __construct(callable $reqeust) {
        parent::__construct($reqeust);
        if (!empty($this->response_array['mutelist'])) $this->mutelist = $this->response_array['mutelist'];
        if (!empty($this->response_array['blacklist'])) $this->blacklist = $this->response_array['blacklist'];
    }
    
    /**
     * @override
     * @return type
     */
    public function get_data():array {
        return [
            'mutelist' => $this->mutelist,
            'blacklist' => $this->blacklist
        ];
    }
    
    public function get_mutelist():array{
        return $this->mutelist;
    }
    
    public function get_blacklist():array
    {
        return $this->blacklist;
    }
    
}