<?php namespace App\Common;

use App\Exceptions\JsonException;
use Carbon\Carbon;

class Helper
{
    /**
     * 获取章节内容存放文件夹
     * @param int $novelId
     * @return string
     */
    public static function getChaptContDir($novelId = 0)
    {
        $basePath = dirname(base_path());
        return $basePath.'/data/'.floor(intval($novelId)/200).'/'.$novelId;
    }

    /**
     * 获取章节内容存放路径
     * @param int $novelId
     * @param int $chaptId
     * @return string
     */
    public static function getChaptContPath($novelId = 0,$chaptId = 0)
    {
        return Helper::getChaptContDir($novelId).'/'.$chaptId.'.cache';
    }

    /**
     * 获取小说内容基础数据存放路径
     * @param int $novelId
     * @return string
     */
    public static function getNovelDataPath($filename = '')
    {
        $basePath = dirname(base_path());
        $firstLetter = substr($filename,0,1);
        return $basePath.'/data/novel/'.$firstLetter.'/'.$filename.'.php';
    }

    /**
     * 获取小说章节列表数据存放路径
     * @param int $novelId
     * @return string
     */
    public static function getNovelChaptDataPath($novelId = 0)
    {
        return Helper::getChaptContDir($novelId).'/chapt.php';
    }

    /**
     * 获取图片数据存放路径
     * @param int $num
     * @return string
     */
    function getImagesDir($num){
        $basePath = dirname(base_path());
        return $basePath.'/images/'.floor(intval($num)/1000);
    }

    /**
     * 获取图片资源链接
     * 
     * @param int $novelId
     * @return string
     */
    public static function getImagesThumbLink($novelId = 0)
    {
        if (empty($novelId) || !is_numeric($novelId)) {
            return '';
        }

        return config('domain.images').'/'.floor(intval($novelId)/1000).'/'.$novelId.'/thumb.jpg';
    }

    /**
     * 获取小说默认缩略图链接
     *
     * @return string
     */
    public static function getNovelDefaultThumbLink()
    {
        return config('domain.images').'/nothumb.jpg';
    }

    /**
     * 获取章节内容资源链接
     *
     * @param int $novelId
     * @param int $chaptId
     * @return string
     */
    public static function getChaptContLink($novelId = 0, $chaptId = 0)
    {
        if (empty($novelId) || empty($chaptId)) {
            return '';
        }

        return config('domain.data').'/'.floor(intval($novelId)/200).'/'.$novelId.'/'.$chaptId.'.cache';
    }

    /**
     * 循环创建目录
     * @param $folder /text/text1/text2
     * @return bool
     */
    public static function makeDir($folder) {
        $reval = false;

        if (!file_exists($folder)) {
            /** 如果目录不存在则尝试创建该目录 */
            @ umask(0);

            /** 将目录路径拆分成数组 */
            preg_match_all('/([^\/]*)\/?/i', $folder, $atmp);

            /** 如果第一个字符为/则当作物理路径处理 */
            $base = ($atmp[0][0] == '/') ? '/' : '';

            /** 遍历包含路径信息的数组 */
            foreach ($atmp[1] AS $val) {
                if ('' != $val) {
                    $base .= $val;

                    if ('..' == $val || '.' == $val) {
                        /** 如果目录为.或者..则直接补/继续下一个循环 */
                        $base .= '/';

                        continue;
                    }
                } else {
                    continue;
                }

                $base .= '/';

                if (!file_exists($base)) {
                    /** 尝试创建目录，如果创建失败则继续循环 */
                    if (@ mkdir(rtrim($base, '/'), 0777)) {
                        @ chmod($base, 0777);
                        $reval = true;
                    }
                }
            }
        } else {
            /** 路径已经存在。返回该路径是不是一个目录 */
            $reval = is_dir($folder);
        }

        clearstatcache();

        return $reval;
    }

    /**
     * 获取后台登录用户信息
     * @return mixed
     */
    public static function getAdminInfo()
    {
        $session_key = config('admin.login.session_key');
        $admin_info = request()->session()->get($session_key);
        return $admin_info;
    }

    /**
     * 获取当前时间戳
     * @return int
     */
    public static function getTimestamp()
    {
        return Carbon::now()->timestamp;
    }

    /**
     * 根据时间戳获取日期
     * @param string $timestamp
     * @return bool|string
     */
    public static function getDateByTimestamp($timestamp = '')
    {
        $_timestamp = !empty($timestamp) ? $timestamp : self::getTimestamp();
        return date('Y-m-d H:i',$_timestamp);
    }

    /**
     * 获取客户端 IP
     */
    public static function getClientIp()
    {
        if (getenv("HTTP_CLIENT_IP") && strcasecmp(getenv("HTTP_CLIENT_IP"), "unknown"))
            $ip = getenv("HTTP_CLIENT_IP");
        else
            if (getenv("HTTP_X_FORWARDED_FOR") && strcasecmp(getenv("HTTP_X_FORWARDED_FOR"), "unknown"))
                $ip = getenv("HTTP_X_FORWARDED_FOR");
            else
                if (getenv("REMOTE_ADDR") && strcasecmp(getenv("REMOTE_ADDR"), "unknown"))
                    $ip = getenv("REMOTE_ADDR");
                else
                    if (isset ($_SERVER['REMOTE_ADDR']) && $_SERVER['REMOTE_ADDR'] && strcasecmp($_SERVER['REMOTE_ADDR'], "unknown"))
                        $ip = $_SERVER['REMOTE_ADDR'];
                    else
                        $ip = "null";
        return ($ip);
    }

    /**
     * 返回随机码
     * @param   $length   int      随机码长度
     */
    public static function getRandomString($length = 10)
    {
        $pool = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        return substr(str_shuffle(str_repeat($pool, ceil($length / strlen($pool)))), 0, $length);
    }

    /**
     * 返回加密后的密码
     * @param $password string 要加密的密码
     * @param $salt string 随机盐
     */
    public static function getEncryPwd($password, $salt)
    {
        return substr(md5($password), 7, 12) . substr(md5($password . $salt), 8, 12) . substr(md5($salt), 10, 12);
    }

    /**
     * 返回一个成功操作的数组
     * @param string $msg
     * @param array $data
     * @return array
     */
    public static function success($msg = 'success', $data = [])
    {
        return [
            'code'=>0,
            'msg'=>$msg,
            'data'=>$data,
        ];
    }

    /**
     * 过滤值为Null的字段
     * @param array $fields
     * @return array
     */
    public static function filterNullFields($fields = []){
        if (is_array($fields) && count($fields)>0) {
            foreach ($fields as $k=>$v) {
                if(is_null($v)){
                    unset($fields[$k]);
                }
            }
        }
        return $fields;
    }

    /**
     * 抛出参数错误的异常
     * @param array $data
     * @param array $rule
     * @throws JsonException
     */
    public static function throwParamError($data = [], $rule = [])
    {
        if(count($data)==0 || count($rule)==0){
            throw new JsonException(10000);
        }

        $validator = validator($data,$rule);
        if($validator->fails()) {
            throw new JsonException(10000, $validator->getMessageBag());
        }
    }

    /**
     * curl_get提交方式
     * @param string $url 请求链接
     * @oaram int $req_number 失败请求次数
     * @param int $timeout 请求时间
     *
     */
    public static function curlGet($url, $req_number = 2, $timeout = 30)
    {

        //防止因网络原因而高层无法获取
        $cnt = 0;
        $result = FALSE;
        while ($cnt < $req_number && $result === FALSE) {
            $cnt++;
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $url);
            //禁止直接显示获取的内容 重要
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            //在发起连接前等待的时间，如果设置为0，则无限等待。
            curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, $timeout);
            //不验证证书下同
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
            //SSL验证
            curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
            $result = curl_exec($ch); //获取
            curl_close($ch);
        }//end func curl_get

        //获取数据
        $data = $result ? $result : null;

        return $data;
    }//end func curlGet

    /**
     * curl_get提交方式
     * @param string $url 请求链接
     * @param array $post_data 请求数据
     * @param string $post_type 请求类型(json)
     *
     */
    public static function curlPost($url, $post_data = '', $post_type = '', $curl_params = [])
    {
        //初始化curl
        $ch = curl_init();
        //设置请求地址
        curl_setopt($ch, CURLOPT_URL, $url);
        //设置curl参数，要求结果是否输出到屏幕上，为true的时候是不返回到网页中
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

        //https ssl 验证
        if (!empty($curl_params['ssl'])) {
            $ssl = $curl_params['ssl'];
            curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 2); //验证站点名
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 1); // 只信任CA颁布的证书
            if (!empty($ssl['sslca'])) {
                curl_setopt($ch, CURLOPT_CAINFO, $ssl['sslca']);
            }
            if (!empty($ssl['sslcert'])) {
                curl_setopt($ch, CURLOPT_SSLCERT, $ssl['sslcert']);
            }
            if ($ssl['sslkey']) {
                curl_setopt($ch, CURLOPT_SSLKEY, $ssl['sslkey']);
            }
        } else {
            //验证站点名
            curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
            //是否验证https(当请求链接为https时自动验证，强制为false)
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false); // 只信任CA颁布的证书
        }

        //设置post提交方式
        curl_setopt($ch, CURLOPT_POST, 1);
        //设置post字段
        curl_setopt($ch, CURLOPT_POSTFIELDS, $post_data);

        //判断是否json提交
        if ('json' == $post_type) {
            curl_setopt($ch, CURLOPT_HTTPHEADER, array(
                    'Expect:',
                    'Content-Type: application/json; charset=utf-8',
                    'Content-Length: ' . strlen($post_data))
            );
        }

        //运行curl
        $output = curl_exec($ch);
        //关闭curl
        curl_close($ch);
        //返回结果
        return $output;
    }//end func curlPost
}