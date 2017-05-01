<?php namespace App\Exceptions;

/**
 * 跳转错误提示
 */
class ScriptException extends JsonException
{
    protected $url = '';

    public function __construct($code, $url, $data=[])
    {
        parent::__construct($code, $data);

        $this->url = $url;
    }

    /**
     * 获取错误信息
     */
    public function getErrorMsg()
    {
        if (empty($this->url)) {
            parent::getErrorMsg();
        }

        if (strpos($this->url, 'http') === false) {
            $this->url = 'http://' . $this->url;
        }

        $return = [
            'code' => 10000,
            'msg'  => '参数错误',
            'url'  => $this->url,
        ];

        if (empty($this->code_list[$this->code])) {
            return response()->view('errors.redirect', $return);
        }

        $return['code'] = $this->code;
        $return['msg'] = $this->code_list[$this->code]['msg'];

        return response()->view('admin.errors.redirect', $return);
    }

}