<?php
namespace App\Exceptions;

use Exception;

/**
 * Json错误提示
 */
class JsonException extends Exception 
{
    /**
     * 错误码列表
     */
    protected $code = 1000;
    protected $msg = '非法请求';
    protected $data = '';
    protected $code_list = [];

    public function __construct($code, $data = [], $msg = '')
    {
        $this->code = $code;
        $this->data = $data;
        $this->msg = $msg;
        $this->code_list = config('errorcode');
    }


    /**
     * 获取错误信息
     */
    public function getErrorMsg()
    {
        $re = [
            'code' => 1000,
            'msg'  => '非法请求',
        ];
        if (empty($this->code_list[$this->code])) {
            return $re;
        }

        $re['code'] = $this->code;
        $re['msg']  = !empty($this->msg) ? $this->msg : $this->code_list[$this->code]['msg'];
        $re['data'] = $this->data;

        return $re;
    }
}
