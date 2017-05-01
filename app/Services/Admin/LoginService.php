<?php namespace App\Services\Admin;

use App\Common\Helper;
use App\Exceptions\JsonException;
use App\Repositories\Admin\AdminUserRepo;
use Carbon\Carbon;

class LoginService
{
    protected $adminUserRepo = null;

    public function __construct(AdminUserRepo $adminUserRepo)
    {
        $this->adminUserRepo = $adminUserRepo;
    }

    /**
     * 后台用户登录
     */
    public function loginAuth($data)
    {
        if(empty($data['username'])){
            throw new JsonException(10000);
        }

        //查看用户是否存在
        try {
            $admin_user = $this->adminUserRepo->findByName($data['username']);
        } catch (JsonException $e) {
            if ($e->getCode() == 102010) {
                throw new JsonException(100001);
            } else {
                throw new JsonException($e->getCode());
            }
        }

        //检查密码是否正确
        $check_password = Helper::getEncryPwd($data['password'], $admin_user['salt']);
        if ($check_password != $admin_user['password']) {
            throw new JsonException(100002);
        }

        //验证检查通过，保存登录数据到session
        $session_key = config('admin.login.session_key');
        $data = [
            $session_key => [
                'id' => $admin_user['id'],
                'username' => $admin_user['username'],
                'login_date' => Carbon::now(),
                'login_timestamp' => Carbon::now()->timestamp,
                'login_ip' => Helper::getClientIp(),
            ]
        ];
        session($data);

        //更新登录数据
        $data_update['id'] = $admin_user['id'];
        $data_update['last_time'] = Carbon::now()->timestamp;
        $data_update['last_ip'] = Helper::getClientIp();

        $flag = $this->adminUserRepo->update($data_update);
        if ($flag === false || !$flag) {
            throw new JsonException(102030);
        }

        return true;
    }

    /**
     * 获取登录用户信息
     * @return mixed
     */
    public function getAdminInfo()
    {
        return Helper::getAdminInfo();
    }

    /**
     * 检查是否登录
     * @return bool
     */
    public function checkIsLogin()
    {
        $admin_info = $this->getAdminInfo();
        if (is_null($admin_info) || empty($admin_info)) {
            return false;
        }else{
            return true;
        }
    }

    /**
     * 登出
     */
    public function logout()
    {
        $session_key = config('admin.login.session_key');
        request()->session()->forget($session_key);
    }
}