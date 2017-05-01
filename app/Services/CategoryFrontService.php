<?php

namespace App\Services;

/**
 * 前台分类服务
 *
 * Class CategoryFrontService
 * @package App\Services
 */
class CategoryFrontService
{

    /**
     * 根据分类路径获取分类信息
     *
     * @param string $name
     * @return array
     */
    public function getCategoryByPath($path = '')
    {
        if (empty($path)) {
            return [];
        }

        $list = config('filter.category');
        $list = array_column($list, null, 'dir');

        if (isset($list[$path])) {
            return $this->handleCategoryData($list[$path]);
        } else {
            return [];
        }
    }

    /**
     * 格式化数据（单个）
     *
     * @param array $data
     * @return array
     */
    public function handleCategoryData(array $data = [])
    {
        if(empty($data)){
            return $data;
        }

        $arr = $data;
        if ($arr['dir']) {
            $arr['link'] = '/'.$arr['dir'].'/';
        }

        return $arr;
    }
}