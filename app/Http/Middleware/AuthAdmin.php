<?php namespace App\Http\Middleware;

use App\Services\Admin\LoginService;
use Closure;

class AuthAdmin
{
    protected $loginService = null;
    public function __construct(LoginService $loginService)
    {
        $this->loginService = $loginService;
    }

    /**
     * Check Admin Auth
     *
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (!$this->loginService->checkIsLogin()) {
            return response()->redirectToRoute('admin.login');
        }

        view()->share('admin_info',$this->loginService->getAdminInfo());

        return $next($request);
    }
}
