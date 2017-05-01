<?php namespace App\Http\Controllers\Admin;

use App\Http\Requests\Admin\Arctype\StroeRequest;
use App\Http\Requests\Admin\Arctype\UpdateRequest;
use App\Http\Requests\Admin\DestroyRequest;
use App\Services\Admin\ArctypeService;
use App\Http\Controllers\Controller;

class ArctypeController extends Controller
{
    protected $arctype_service = null;

    public function __construct(ArctypeService $arctypeService)
    {
        $this->arctype_service = $arctypeService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        /*$page = request()->get('page') ?: 1;
        $typename = urldecode(request()->get('typename',''));
        $arctype_list = $this->arctype_service->getDataByPage($page,$typename);
        if(!empty($typename)){
            $arctype_list->appends('typename',$typename);
        }*/

        $arctype_list = $this->arctype_service->getTree();

        return view('admin.arctype.index', compact('arctype_list'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $list = $this->arctype_service->getTree();
        return view('admin.arctype.create',compact('list'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StroeRequest $request)
    {
        $data = $request->all();
        $flag = $this->arctype_service->store($data);
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
        try{
            $info = $this->arctype_service->find($id);
            return view('admin.arctype.edit',compact('info'));
        }catch (JsonException $e) {
            throw new ScriptException($e->getCode(),action('Admin\ArctypeController@index'));
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateRequest $request)
    {
        $data = $request->all();
        $flag = $this->arctype_service->update($data);
        if($flag){
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
        $flag = $this->arctype_service->destroy($_id);
        if ($flag) {
            return $this->success();
        }
    }

    /**
     * 生成缓存
     */
    public function makeCache()
    {
        $flag = $this->arctype_service->makeCache();
        if ($flag) {
            return $this->success();
        }
    }

    /**
     * 清空缓存
     */
    public function clearCache()
    {
        $flag = $this->arctype_service->clearCache();
        if ($flag) {
            return $this->success();
        }
    }
}
