<?php namespace App\Repositories;

use App\Common\Helper;
use App\Exceptions\JsonException;

class NameRepo extends BaseRepo
{

    /**
     * 获取所有数据
     * @return collection
     */
    public function getAll()
    {
        $list = app('NameModel')->all();
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
        return $this->getCommonData(app('NameModel'),$condition);
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

        $model = app('NameModel')->select($columns)->find($id);
        if (empty($model->_id)) {
            throw new JsonException(105000);
        }

        return $model;
    }

    /**
     * 根据网名查找单个数据
     * @param string $name
     * @return mixed
     * @throws JsonException
     */
    public function findByName($name = '')
    {
        if(empty($name)){
            throw new JsonException(10000);
        }

        $model = app('NameModel')->where('name','=',$name)->first();
        if (empty($model->_id)) {
            throw new JsonException(105000);
        }

        return $model;
    }

    /**
     * 新增网名
     * @return boolean
     */
    public function store($data = null)
    {
        $rules = [
            'name' => ['required','string'],
            'typeid' => ['required','array'],
            'admin_id' => ['required','string'],
        ];
        Helper::throwParamError($data,$rules);

        $name_model = app('NameModel');
        foreach ($rules as $key=>$value)
        {
            if(isset($data[$key])){
                $name_model->$key = $data[$key];
            }
        }
        $name_model->addtime = Helper::getTimestamp();
        $name_model->good = 0;
        $name_model->fav = 0;

        try {
            $name_model->save();
            return $name_model;
        } catch (JsonException $e) {
            throw new JsonException(105040);
        }
    }

    /**
     * 修改网名
     * @return boolean
     */
    public function update($data = null)
    {
        $rules = [
            '_id' => ['required','string'],
            'name' => ['required','string'],
            'typeid' => ['sometimes','array'],
            'adminid' => ['sometimes','string'],
            'addtime' => ['sometimes','integer'],
        ];
        Helper::throwParamError($data,$rules);

        $info = $this->find($data['_id']);

        foreach ($rules as $key=>$value)
        {
            if(isset($data[$key]) && $key!='_id'){
                $info->$key = $data[$key];
            }
        }

        try{
            $info->save();
            return $info;
        }catch (JsonException $e){
            throw new JsonException(105020);
        }
    }

    /**
     * 删除文章
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
            throw new JsonException(105010);
        }
    }
}