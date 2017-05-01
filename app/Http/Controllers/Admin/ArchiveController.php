<?php namespace App\Http\Controllers\Admin;

use App\Exceptions\JsonException;
use App\Exceptions\ScriptException;
use App\Http\Requests\Admin\Archive\UpdateRequest;
use App\Services\Admin\ArchiveService;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ArchiveController extends Controller
{
    protected $archive_service = null;

    public function __construct(ArchiveService $archiveService)
    {
        $this->archive_service = $archiveService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $page = request()->get('page') ?: 1;
        $title = urldecode(request()->get('title',''));
        $archive_list = $this->archive_service->getDataByPage($page,$title);
        if(!empty($title)){
            $archive_list->appends('title',$title);
        }

        return view('admin.archive.index', compact('archive_list'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
            $info = $this->archive_service->find($id);
            return view('admin.archive.edit',compact('info'));
        }catch (JsonException $e) {
            throw new ScriptException($e->getCode(),action('Admin\ArchiveController@index'));
        }
    }

    /**
     * Update the specified resource in storage.
     * @param UpdateRequest $request
     * @param $id
     */
    public function update(UpdateRequest $request)
    {
        $data = $request->all();
        $flag = $this->archive_service->update($data);
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
    public function destroy($id)
    {
        $_id = $request->get('_id');
        $flag = $this->admin_user_service->destroy($_id);
        if ($flag) {
            return $this->success();
        }
    }
}
