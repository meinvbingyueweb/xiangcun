<?php namespace App\Http\Controllers\Admin;

use App\Http\Requests\Admin\AdminUser\StoreRequest;
use App\Http\Requests\Admin\AdminUser\UpdateRequest;
use App\Http\Requests\Admin\DestroyRequest;
use App\Services\Admin\AdminUserService;
use App\Http\Controllers\Controller;

class AdminUserController extends Controller
{
    protected $admin_user_service = null;

    public function __construct(AdminUserService $admin_user_service)
    {
        $this->admin_user_service = $admin_user_service;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $page = request()->get('page') ?: 1;
        $admin_users = $this->admin_user_service->getDataByPage($page);
        return view('admin.admin_user.index', compact('admin_users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.admin_user.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRequest $request)
    {
        $data = $request->all();
        $flag = $this->admin_user_service->store($data);
        if ($flag) {
            return $this->success();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateRequest $request
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     * @throws \App\Exceptions\JsonException
     */
    public function update(UpdateRequest $request, $id)
    {
        $data = $request->all();
        $flag = $this->admin_user_service->update($data);
        if ($flag) {
            return $this->success();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(DestroyRequest $request)
    {
        $_id = $request->get('_id');
        $flag = $this->admin_user_service->destroy($_id);
        if ($flag) {
            return $this->success();
        }
    }
}
