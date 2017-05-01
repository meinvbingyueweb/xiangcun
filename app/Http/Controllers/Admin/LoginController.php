<?php namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\LoginRequest;
use App\Services\Admin\LoginService;

class LoginController extends Controller
{
    protected $loginService = null;

    public function __construct(LoginService $loginService)
    {
        $this->loginService = $loginService;
    }

    /**
     * 登录页
     */
    public function index()
    {
        if($this->loginService->checkIsLogin()){
            return redirect()->action('Admin\IndexController@index');
        }
        return view('admin.login',compact('list'));
    }

    /**
     * 登录验证
     */
    public function auth(LoginRequest $request)
    {
        $data = $request->all();
        if($this->loginService->loginAuth($data)){
            return $this->success();
        }
    }

    /**
     * 登出
     */
    public function logout()
    {
        $this->loginService->logout();
        return redirect()->action('Admin\LoginController@index');
    }
}
