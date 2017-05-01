<?php

namespace App\Services;

use App\Common\Helper;
use App\Exceptions\JsonException;
use App\Repositories\NovelRepo;

class NovelService
{
    protected $novelRepo = null;

    public function __construct(NovelRepo $novelRepo) {
        $this->novelRepo = $novelRepo;
    }

    /**
     * 获取格式化后的数据
     *
     * @param array $condition 查询条件
     * @return array
     */
    public function getFormatData($condition = [])
    {
        $result = [];
        if (!empty($condition) && count($condition)>0) {

            if (!isset($condition['columns'])) {
                $condition['columns'] = $this->getNormalColumns();
            }

            try {
                $collection = $this->novelRepo->getData($condition);
                $arr = $collection->toArray();
                $data = isset($arr['data']) ? $arr['data'] : $arr;
                $list = array_map(function ($v) {
                    return $this->handleNovelData($v);
                }, $data);

                if (isset($arr['data'])) {
                    $arr['data'] = $list;
                    $result['format'] = $arr;
                } else {
                    $result['format'] = $list;
                }
                $result['origin'] = $collection;
            } catch (JsonException $e) {

            }
        }
        return $result;
    }

    /**
     * 格式化数据（单个）
     *
     * @param array $data
     * @return array
     */
    public function handleNovelData(array $data = [])
    {
        if(empty($data)){
            return $data;
        }

        // 分类列表
        $catArr = array_column(config('filter.category'), null, 'id');

        // 获取所有数据
        $arr = $data;

        // 分类名
        $arr['typename'] = $catArr[$data['cid']]['name'];
        $arr['typenameShort'] = $catArr[$data['cid']]['shortname'];
        // 小说链接
        $arr['link'] = '/'.$catArr[$data['cid']]['dir'].'/'.$arr['filename'].'/';
        // 最新章节链接
        $arr['chaptLink'] = $arr['link'].$arr['newChaptId'].".html";
        // 下载链接
        $arr['downLink'] = $arr['link']."down.html";
        // 缩略图链接
        $arr['thumbLink'] = '';
        if (isset($arr['id']) && isset($arr['flagThumb']) && $arr['flagThumb'] != 0) {
            $arr['thumbLink'] = Helper::getImagesThumbLink($arr['id']);
        }
        if(empty($arr['thumbLink'])){
            $arr['thumbLink'] = Helper::getNovelDefaultThumbLink();
        }

        return $arr;
    }
    
    /**
     * 获取常用的小说字段
     *
     * @return array
     */
    public function getNormalColumns()
    {
        return ['id', 'cid', 'title', 'filename', 'author', 'letter', 'status', 'atime', 'click', 'words', 'totalNum', 'newChaptTitle', 'newChaptId', 'content', 'flagThumb'];
    }
}