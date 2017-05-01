<?php namespace App\Http\Controllers\Admin;

use App\Http\Requests\Admin\DestroyRequest;
use App\Http\Requests\Admin\Menu\StoreRequest;
use App\Http\Requests\Admin\Menu\UpdateRequest;
use App\Http\Controllers\Controller;
use App\Services\Admin\MenuService;

class MenuController extends Controller
{
    protected $menu_service = null;

    public function __construct(MenuService $menu_service)
    {
        $this->menu_service = $menu_service;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //获取菜单树
        $menu_tree = $this->menu_service->getMenuTree();

        return view('admin.admin_menu.index', compact('menu_tree'));
    }

    /**
     * 添加菜单界面
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //获取菜单树
        $menu_tree = $this->menu_service->getMenuTree();

        return view('admin.admin_menu.create', compact('menu_tree'));
    }

    /**
     * 新增菜单
     */
    public function store(StoreRequest $request)
    {
        $data = $request->all();
        $flag = $this->menu_service->store($data);
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
    public function update(UpdateRequest $request, $id)
    {
        $data = $request->all();
        $flag = $this->menu_service->update($data);
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
        $flag = $this->menu_service->destroy($_id);
        if ($flag) {
            return $this->success();
        }
    }

    /**
     * 清空缓存
     */
    public function clearCache()
    {
        $flag = $this->menu_service->clearCache();
        if ($flag) {
            return $this->success();
        }
    }
}