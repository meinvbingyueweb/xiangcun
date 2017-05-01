<?php namespace App\Repositories;

use App\Common\Helper;
use App\Exceptions\JsonException;

class NovelRepo extends BaseRepo {
    /**
     * 获取所有数据
     * @return collection
     */
    public function getAll() {
        $list = app('NovelModel')->all();
        return $list;
    }

    /**
     * 据查询条件获取数据
     */
    public function getData($condition) {
        return $this->getCommonData(app('NovelModel'), $condition);
    }

    /**
     * 查找单个数据
     * @param string $id
     * @return mixed
     * @throws JsonException
     */
    public function find($id = '', $columns = ['*']) {
        
        // 验证数据
        $data['id'] = $id;
        $rules = [
            'id' => ['required', 'integer', 'min:1'],
        ];
        Helper::throwParamError($data, $rules);

        $model = app('NovelModel')->select($columns)->find($id);
        if (empty($model->id)) {
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
    public function findByTitle($title = '') {
        // 验证数据
        $data['title'] = $title;
        $rules = [
            'title' => ['required', 'string', 'min:1'],
        ];
        Helper::throwParamError($data, $rules);

        $model = app('NovelModel')->where('title', '=', $title)->first();
        if (empty($model->id)) {
            throw new JsonException(103000);
        }

        return $model;
    }

    /**
     * 根据文件名查找单个数据
     *
     * @param string $filename
     * @return mixed
     * @throws JsonException
     */
    public function findByFileName($filename = '') {
        // 验证数据
        $data['filename'] = $filename;
        $rules = [
            'filename' => ['required', 'string', 'min:1'],
        ];
        Helper::throwParamError($data, $rules);

        $model = app('NovelModel')->where('filename', '=', $filename)->first();
        if (empty($model->id)) {
            throw new JsonException(103000);
        }

        return $model;
    }

    /**
     * 修改
     * @return boolean
     */
    public function update($data = null) {
        $rules = [
            'id' => ['required', 'integer', 'min:1'],
            'title' => ['sometimes', 'string', 'min:1'],
            'keywords' => ['sometimes', 'string', 'min:1'],
            'description' => ['string', 'min:1'],
            'content' => ['string'],
        ];
        Helper::throwParamError($data, $rules);

        $info = $this->find($data['id']);

        foreach ($rules as $key => $value) {
            if (isset($data[$key]) && $key != 'id') {
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
     * 删除
     * @param $data
     * @return mixed
     * @throws JsonException
     */
    public function destroy($data) {
        $rules = [
            'id' => ['required', 'integer', 'min:1'],
        ];
        Helper::throwParamError($data, $rules);

        $info = $this->find($data['id']);

        try {
            $info->delete();
            return $info;
        } catch (JsonException $e) {
            throw new JsonException(103020);
        }
    }
}