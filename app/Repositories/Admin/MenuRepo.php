<?php namespace App\Repositories\Admin;

use App\Common\Helper;
use App\Exceptions\JsonException;
use App\Repositories\BaseRepo;

class MenuRepo extends BaseRepo
{
    /**
     * 获取所有菜单集合
     * @return collection
     */
    public function getAll()
    {
        $menu_list = app('AdminMenuModel')->orderBy('sort','ASC')->get();
        return $menu_list;
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

        $menu_model = app('AdminMenuModel')->select($columns)->find($id);
        if (empty($menu_model->name)) {
            throw new JsonException(101020);
        }

        return $menu_model;
    }

    /**
     * 根据菜单名查找单个数据
     * @param string $name
     * @return mixed
     * @throws JsonException
     */
    public function findByName($name = '')
    {
        if(empty($name)){
            throw new JsonException(10000);
        }

        $model = app('AdminMenuModel')->where('name','=',$name)->first();
        if (empty($model->_id)) {
            throw new JsonException(101020);
        }

        return $model;
    }

    /**
     * 新增菜单
     * @return boolean
     */
    public function store($data = null)
    {
        $rules = [
            'name' => ['required','string'],
            'link' => ['required','string'],
            'sort' => ['required','integer'],
            'rid' => ['required'],
            'pid' => ['required'],
            'level' => ['required','integer'],
            'icon' => []
        ];
        Helper::throwParamError($data,$rules);

        $menu_model = app('AdminMenuModel');
        foreach ($rules as $key=>$value)
        {
            if(isset($data[$key])){
                $menu_model->$key = $data[$key];
            }
        }

        try {
            $menu_model->save();
            return $menu_model;
        } catch (JsonException $e) {
            throw new JsonException(101000);
        }
    }

    /**
     * 修改菜单
     * @return boolean
     */
    public function update($data = null)
    {
        $rules = [
            '_id' => ['required','string'],
            'name' => ['string'],
            'link' => ['string'],
            'sort' => ['integer'],
            'icon' => [],
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
            throw new JsonException(101040);
        }
    }

    /**
     * 删除菜单
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

        $info = $this->find($data['_id']);

        try {
            $info->delete();
            return $info;
        } catch (JsonException $e) {
            throw new JsonException(101030);
        }
    }
}