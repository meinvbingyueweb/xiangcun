<?php

namespace App\Http\Controllers\Front;

use App\Services\CategoryFrontService;
use App\Services\NovelFrontService;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CategoryController extends Controller
{
    public function index(Request $request, NovelFrontService $novelFrontService, CategoryFrontService $categoryFrontService)
    {
        $catPath = $request->cat_path;
        $page = is_numeric($request->page) ? $request->page : 1;

        // 获取分类信息
        $categoryInfo = $categoryFrontService->getCategoryByPath($catPath);
        if (empty($categoryInfo)) {
            return redirect('/');
        }

        // 获取分类小说数据
        $list = $novelFrontService->getListByCid($categoryInfo['id'], $page);

        return view('mobile.list', compact('categoryInfo', 'list', 'page'));
    }
}
