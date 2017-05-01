<?php

namespace App\Services;

use App\Common\Helper;
use App\Exceptions\JsonException;

class NovelFrontService extends NovelService
{
    /**
     * 获取首页推荐数据
     *
     * @return array|mixed
     */
    public function getIndexRecommend()
    {
        $condition = [];
        $condition['where'] = [
            ['aud', 1]
        ];
        $condition['limit'] = 3;
        $list = $this->getFormatData($condition);

        return $list;
    }

    /**
     * 获取首页最新数据
     *
     * @return array|mixed
     */
    public function getIndexNewUpdate()
    {
        $condition = [];
        $condition['where'] = [
            ['aud', 1]
        ];
        $condition['order'] = [['ctime','desc']];
        $condition['limit'] = 20;
        $list = $this->getFormatData($condition);

        return $list;
    }

    /**
     * 获取首页最新入库
     *
     * @return array|mixed
     */
    public function getIndexNewInsert()
    {
        $condition = [];
        $condition['where'] = [
            ['aud', 1]
        ];
        $condition['order'] = [['atime','desc']];
        $condition['limit'] = 15;
        $list = $this->getFormatData($condition);

        return $list;
    }

    /**
     * 获取首页分类数据
     *
     * @param int $cid
     * @return array
     * @throws JsonException
     */
    public function getIndexCategoryList($cid = 0)
    {
        // 验证数据
        $data = [];
        $data['cid'] = $cid;
        $rules = [
            'cid' => ['required', 'integer', 'min:1'],
        ];
        Helper::throwParamError($data,$rules);

        $condition = [];
        $condition['where'] = [
            ['cid', $cid],
            ['aud', 1]
        ];
        $condition['order'] = [['ctime','desc']];
        $condition['limit'] = 10;
        $list = $this->getFormatData($condition);

        return $list;
    }

    /**
     * 根据CID获取小说数据
     *
     * @param $cid
     * @param $page
     * @return array|mixed
     */
    public function getListByCid($cid, $page)
    {
        // 验证数据
        $data = [];
        $data['cid'] = $cid;
        $data['page'] = $page;
        $rules = [
            'cid' => ['required', 'integer', 'min:1'],
            'page' => ['required', 'integer', 'min:1'],
        ];
        Helper::throwParamError($data,$rules);

        $condition = [];
        $condition['page'] = $data['page'];
        $condition['page_size'] = 20;
        $condition['where'] = [
            ['aud', '=', '1'],
            ['cid', '=', $data['cid']],
        ];
        $condition['order'] = [['ctime','desc']];
        try {
            $list = $this->getFormatData($condition);
        } catch (JsonException $e) {
            $list = [];
        }
        return $list;
    }

    /**
     * 根据文件名获取小说详情（缓存）
     *
     * @param string $filename
     * @return array
     * @throws JsonException
     */
    public function getNovelByFilename($filename = '')
    {
        // 验证数据
        $data['filename'] = $filename;
        $rules = [
            'filename' => ['required','string'],
        ];
        Helper::throwParamError($data,$rules);

        try {
            $path = Helper::getNovelDataPath($filename);
            $info = include_once ($path);
            $info = $this->handleNovelData($info);
        } catch (JsonException $e) {
            $info = [];
        }

        return $info;
    }

    /**
     * 获取小说章节列表
     *
     * @param int $novelId
     * @return array|string
     */
    public function getChaptList($novelId = 0)
    {
        if (empty($novelId)) {
            return [];
        }

        try {
            $path = Helper::getNovelChaptDataPath($novelId);
            $list = include_once ($path);
            $list = array_column($list, null, 'num');
            return $list;
        } catch (\Exception $e) {
            return [];
        }
    }

    /**
     *  获取某个章节的上一章、下一章信息
     *
     * @param $chaptId
     * @param array $chaptList
     * @return array
     */
    public function getPreNextChapt($chaptId, array $chaptList = [])
    {
        if (empty($chaptId)) {
            return [];
        }

        if (empty($chaptList)) {
            $chaptList = $this->getChaptList($chaptId);
        }

        $data = [];
        $data['preChapt'] = $data['nextChapt'] = [];
        if (($chaptId-1)>0 && isset($chaptList[($chaptId-1)])) {
            $data['preChapt'] = $chaptList[($chaptId-1)];
        }
        if (($chaptId+1)<count($chaptList) && isset($chaptList[($chaptId+1)])) {
            $data['nextChapt'] = $chaptList[($chaptId+1)];
        }

        return $data;
    }

}