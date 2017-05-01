<?php

namespace App\Http\Controllers\Front;

use App\Common\Helper;
use App\Services\CategoryFrontService;
use App\Services\NovelFrontService;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class NovelController extends Controller
{
    /**
     * 小说详情页
     * 
     * @param Request $request
     * @param NovelFrontService $novelFrontService
     * @param CategoryFrontService $categoryFrontService
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function novelCont(Request $request, NovelFrontService $novelFrontService, CategoryFrontService $categoryFrontService)
    {
        $catPath = $request->cat_path;
        $filename = $request->filename;

        // 获取分类信息
        $categoryInfo = $categoryFrontService->getCategoryByPath($catPath);
        if (empty($categoryInfo)) {
            return redirect('/');
        }

        // 获取小说信息
        $novelInfo = $novelFrontService->getNovelByFilename($filename);
        if (empty($novelInfo)) {
            return redirect('/');
        }

        // 获取章节列表
        $chaptList = $novelFrontService->getChaptList($novelInfo['id']);
        $chaptListTop = array_slice($chaptList,0,10);

        return view('mobile.novel_cont', compact('categoryInfo', 'novelInfo', 'chaptList', 'chaptListTop'));
    }

    /**
     * 小说介绍页
     */
    /**
     * @param array $middleware
     */
    public function novelIntro(Request $request, NovelFrontService $novelFrontService, CategoryFrontService $categoryFrontService) {
        $catPath = $request->cat_path;
        $filename = $request->filename;

        // 获取分类信息
        $categoryInfo = $categoryFrontService->getCategoryByPath($catPath);
        if (empty($categoryInfo)) {
            return redirect('/');
        }
        dd($categoryInfo);
        // 获取小说信息
        $novelInfo = $novelFrontService->getNovelByFilename($filename);
        if (empty($novelInfo)) {
            return redirect('/');
        }

        return view('mobile.novel_intro', compact('categoryInfo', 'novelInfo'));
    }

    /**
     * 小说章节页
     */
    public function chaptCont(Request $request, NovelFrontService $novelFrontService, CategoryFrontService $categoryFrontService)
    {
        $catPath = $request->cat_path;
        $filename = $request->filename;
        $num = $request->num;

        // 获取分类信息
        $categoryInfo = $categoryFrontService->getCategoryByPath($catPath);
        if (empty($categoryInfo)) {
            return redirect('/');
        }

        // 获取小说信息
        $novelInfo = $novelFrontService->getNovelByFilename($filename);
        if (empty($novelInfo)) {
            return redirect('/');
        }

        // 获取章节列表
        $chaptList = $novelFrontService->getChaptList($novelInfo['id']);

        // 章节信息
        if (!isset($chaptList[$num])) {
            return redirect('/');
        }
        $chaptInfo = $chaptList[$num];

        // 获取章节内容链接
        $chaptInfo['chaptContLink'] = Helper::getChaptContLink($novelInfo['id'], $num);

        // 上一章、下一章
        $chaptPreNext = $novelFrontService->getPreNextChapt($num, $chaptList);

        return view('mobile.chapt_cont', compact('categoryInfo', 'novelInfo', 'chaptList', 'chaptInfo', 'chaptPreNext'));
    }
}
