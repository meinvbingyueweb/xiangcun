<?php

namespace App\Http\Controllers\Front;

use App\Services\NovelFrontService;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class IndexController extends Controller
{

    public function index(Request $request, NovelFrontService $novelFrontService)
    {
        // 获取推荐
        $recommend = $novelFrontService->getIndexRecommend();
        // 最新更新
        $newUpdate = $novelFrontService->getIndexNewUpdate();
        // 最新入库
        $newInsert = $novelFrontService->getIndexNewInsert();
        // 都市言情
        $dushi = $novelFrontService->getIndexCategoryList(1);
        // 古代言情
        $gudai = $novelFrontService->getIndexCategoryList(16);
        // 玄幻魔法
        $xuanhuan = $novelFrontService->getIndexCategoryList(9);
        // 武侠修真
        $xiuzhen = $novelFrontService->getIndexCategoryList(10);

        return view('mobile.index', compact('recommend' , 'newUpdate', 'newInsert', 'dushi', 'gudai', 'xuanhuan', 'xiuzhen'));
    }
}
