<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\Admin\Name\StoreRequest;
use App\Services\Admin\AdminUserService;
use App\Services\Admin\ArctypeService;
use App\Services\Admin\NameService;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class NameController extends Controller
{
    protected $name_service = null;
    public function __construct(NameService $nameService)
    {
        $this->name_service = $nameService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(AdminUserService $adminUserService)
    {
        $page = request()->page;
        $name = request()->name;

        //网名列表
        $list = $this->name_service->getDataByPage($page,$name);

        //获取所有管理员列表
        $condition['columns'] = ['username'];
        $admin_list = $adminUserService->getAll($condition)->toArray();
        $admin_list = array_column($admin_list,'username','_id');

        return view('admin.name.index',compact('list','admin_list'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(ArctypeService $arctypeService)
    {
        //获取网名分类
        $typelist = $arctypeService->getDataByName();
        return view('admin.name.create',compact('typelist'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreRequest $request)
    {
        $data = $request->all();
        $flag = $this->name_service->store($data);
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
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
