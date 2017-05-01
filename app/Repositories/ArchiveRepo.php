<?php namespace App\Repositories;

use App\Common\Helper;
use App\Exceptions\JsonException;

class ArchiveRepo extends BaseRepo
{
    /**
     * 获取所有文章
     * @return collection
     */
    public function getAll()
    {
        $list = app('ArchiveModel')->all();
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
        return $this->getCommonData(app('ArchiveModel'),$condition);
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

        $model = app('ArchiveModel')->select($columns)->find($id);
        if (empty($model->_id)) {
            throw new JsonException(103000);
        }

        return $model;
    }

    /**
     * 根据标题查找单个数据
     * @param string $title
     * @return mixed
     * @throws JsonException
     */
    public function findByTitle($title = '')
    {
        if(empty($title)){
            throw new JsonException(10000);
        }

        $model = app('ArchiveModel')->where('title','=',$title)->first();
        if (empty($model->_id)) {
            throw new JsonException(103000);
        }

        return $model;
    }

    /**
     * 修改文章
     * @return boolean
     */
    public function update($data = null)
    {
        $rules = [
            '_id' => ['required','string'],
            'title' => ['sometimes','string'],
            'keywords' => ['sometimes','string'],
            'description' => ['string'],
            'content' => ['string'],
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
            throw new JsonException(103010);
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

        $info = $this->find($data['_id']);

        try {
            $info->delete();
            return $info;
        } catch (JsonException $e) {
            throw new JsonException(103020);
        }
    }
}