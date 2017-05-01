<?php namespace App\Repositories;

use App\Common\Helper;
use App\Exceptions\JsonException;

class ArctypeRepo extends BaseRepo
{

    /**
     * 获取所有分类
     * @return collection
     */
    public function getAll($columns = ['*'])
    {
        $list = app('ArctypeModel')->select($columns)->orderBy('sort','asc')->orderBy('num','desc')->get();
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
        return $this->getCommonData(app('ArctypeModel'),$condition);
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

        $model = app('ArctypeModel')->select($columns)->find($id);
        if (empty($model->_id)) {
            throw new JsonException(104000);
        }

        return $model;
    }

    /**
     * 根据分类名查找单个数据
     * @param string $typename
     * @return mixed
     * @throws JsonException
     */
    public function findByName($typename = '')
    {
        if(empty($typename)){
            throw new JsonException(10000);
        }

        $model = app('ArctypeModel')->where('typename','=',$typename)->first();
        if (empty($model->_id)) {
            throw new JsonException(104000);
        }

        return $model;
    }

    /**
     * 根据分类路径查找单个数据
     * @param string $typedir
     * @return mixed
     * @throws JsonException
     */
    public function findByDir($typedir = '')
    {
        if(empty($typedir)){
            throw new JsonException(10000);
        }

        $model = app('ArctypeModel')->where('typedir','=',$typedir)->first();
        if (empty($model->_id)) {
            throw new JsonException(104000);
        }

        return $model;
    }

    /**
     * 新增分类
     * @return boolean
     */
    public function store($data = null)
    {
        $rules = [
            'typename' => ['required','string'],
            'typedir' => ['required','string'],
            'reid' => ['required','integer'],
            'topid' => ['required','integer'],
            'num' => ['required','integer'],
            'seotitle' => ['sometimes','required','string'],
            'keywords' => ['sometimes','required','string'],
            'description' => ['sometimes','required','string'],
            'enable' => ['required','in:0,1'],
            'sort' => ['required','integer'],
        ];
        Helper::throwParamError($data,$rules);

        $arctype_model = app('ArctypeModel');
        foreach ($rules as $key=>$value)
        {
            if(isset($data[$key]) && $key!='_id'){
                if($key=='sort'){
                    $data[$key] = (int)$data[$key];
                }
                $arctype_model->$key = $data[$key];
            }
            if(($key=='description' || $key=='keywords' || $key=='seotitle') && !isset($data[$key])){
                $arctype_model->$key = '';
            }
        }

        try {
            $arctype_model->save();
            return $arctype_model;
        } catch (JsonException $e) {
            throw new JsonException(104040);
        }
    }

    /**
     * 修改分类
     * @return boolean
     */
    public function update($data = null)
    {
        $rules = [
            '_id' => ['required','string'],
            'typename' => ['required','string'],
            'typedir' => ['required','string'],
            'seotitle' => ['sometimes','required','string'],
            'keywords' => ['sometimes','required','string'],
            'description' => ['sometimes','required','string'],
            'enable' => ['required','in:0,1'],
            'sort' => ['required','integer'],
        ];
        Helper::throwParamError($data,$rules);

        $info = $this->find($data['_id']);

        foreach ($rules as $key=>$value)
        {
            if(isset($data[$key]) && $key!='_id'){
                if($key=='sort'){
                    $data[$key] = (int)$data[$key];
                }
                $info->$key = $data[$key];
            }
            if(($key=='description' || $key=='keywords' || $key=='seotitle') && !isset($data[$key])){
                $info->$key = '';
            }
        }

        try {
            $info->save();
            return $info;
        } catch (JsonException $e) {
            throw new JsonException(104020);
        }
    }

    /**
     * 删除分类
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
            throw new JsonException(104010);
        }
    }
}