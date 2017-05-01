<?php namespace App\Repositories\Admin;

use App\Common\Helper;
use App\Exceptions\JsonException;
use App\Repositories\BaseRepo;

class AdminUserRepo extends BaseRepo
{
    /**
     * 获取所有后台用户
     * @return collection
     */
    public function getAll($condition = [])
    {
        $columns = isset($condition['columns']) ? $condition['columns'] : ['*'];
        $list = app('AdminUserModel')->select($columns)->get();
        return $list;
    }

    /**
     * 据查询条件获取数据
     * @param int $page
     * @param int $pagesize
     * @param array $where
     * @param array $order ['num','desc']
     * @param string $group
     * @param array $columns
     * @return mixed
     *
     * $condition['page'] = 1;
     * $condition['page_size'] = 1;
     * $condition['order'] = ['num','desc'];
     */
    public function getData($condition)
    {
        return $this->getCommonData(app('AdminUserModel'),$condition);
    }

    /**
     * 查找单个数据
     * @param string $id
     * @return mixed
     * @throws JsonException
     */
    public function find($id = '',$columns = ['*'])
    {
        if(empty($id)){
            throw new JsonException(10000);
        }

        $model = app('AdminUserModel')->select($columns)->find($id);
        if (empty($model->username)) {
            throw new JsonException(102010);
        }

        return $model;
    }

    /**
     * 根据用户名查找单个数据
     * @param string $name
     * @return mixed
     * @throws JsonException
     */
    public function findByName($name = '')
    {
        if(empty($name)){
            throw new JsonException(10000);
        }

        $model = app('AdminUserModel')->where('username','=',$name)->first();
        if (empty($model->_id)) {
            throw new JsonException(102010);
        }

        return $model;
    }

    /**
     * 新增后台用户
     * @return boolean
     */
    public function store($data = null)
    {
        $rules = [
            'username' => ['required','string'],
            'password' => ['required','string'],
            'salt' => ['required','string'],
        ];
        Helper::throwParamError($data,$rules);

        $model = app('AdminUserModel');
        foreach ($rules as $key=>$value)
        {
            if(isset($data[$key])){
                $model->$key = $data[$key];
            }
        }
        $model->create_time = Helper::getTimestamp();
        $model->create_ip = Helper::getClientIp();

        try {
            $model->save();
            return $model;
        } catch (JsonException $e) {
            throw new JsonException(102000);
        }
    }

    /**
     * 修改后台用户
     * @return boolean
     */
    public function update($data = null)
    {
        $rules = [
            '_id' => ['required','string'],
            'username' => ['sometimes','string'],
            'password' => ['sometimes','string'],
            'salt' => ['string'],
            'last_ip' => ['ipv4'],
            'last_time' => ['integer'],
        ];
        Helper::throwParamError($data,$rules);

        $info = $this->find($data['_id']);

        foreach ($rules as $key=>$value)
        {
            if(isset($data[$key]) && $key!='_id'){
                $info->$key = $data[$key];
            }
        }

        try {
            $info->save();
            return $info;
        } catch (JsonException $e) {
            throw new JsonException(102030);
        }
    }

    /**
     * 删除后台用户
     * @param $data
     * @return mixed
     * @throws JsonException
     */
    public function destroy($data)
    {
        $rules = [
            '_id' => ['required','string'],
        ];
        Helper::throwParamError($data,$rules);

        $info = $this->find($data['_id'],['_id']);

        try {
            $info->delete();
            return $info;
        } catch (JsonException $e) {
            throw new JsonException(102020);
        }
    }
}