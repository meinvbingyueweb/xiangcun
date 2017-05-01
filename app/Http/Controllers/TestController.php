<?php

namespace App\Http\Controllers;

use App\Common\Helper;
use Illuminate\Support\Facades\DB;

class TestController extends Controller
{
    public function index()
    {
        /*$list = DB::table('as_novel')->select(['id'])->get();
        foreach ($list as $k=>$v) {
            //获取章节内容存放文件夹
            $dir = Helper::getChaptContDir($v->id);
            //创建文件夹
            Helper::makeDir($dir);
        }
        exit;*/

        /*
        //将扩展表数据整合到主表
        $list = DB::table('ds_vvs_novel_extend')->select(['aid','thiefSource','thiefRemoteLink','thiefRemoteThumbLink','content'])->orderBy('aid','asc')->get();
        foreach ($list as $k=>$v) {
            $affected = DB::update('update as_novel set content = :content, thiefSource = :thiefSource, thiefRemoteLink = :thiefRemoteLink, thiefRemoteThumbLink = :thiefRemoteThumbLink where id = :id',
                ['id' => $v->aid ,'content' => $v->content , 'thiefRemoteThumbLink' => $v->thiefRemoteThumbLink , 'thiefSource' => $v->thiefSource , 'thiefRemoteLink' => $v->thiefRemoteLink]);
        }*/

        /*
        导入章节表，并将章节内容写入缓存文件
        $table = 'ds_vvs_novel_zchapt'.request()->id;
        $limit = 50;
        $list = DB::table($table)->select(['id','aid','title','thiefRemoteLink','num','content','sortrand'])
            ->where('flag',0)
            ->orderBy('id','asc')
            ->limit($limit)
            ->get();

        if(request()->id>449){
            exit('done');
        }

        if (count($list)<=0) {
            $next_id = intval(request()->id) + 1;
            return redirect(url('/test').'?id='.$next_id);
        }

        foreach ($list as $k=>$v) {
            DB::insert('insert as_novel_chapt(aid,title,thiefRemoteLink,num,sortrand) values(:aid,:title,:thiefRemoteLink,:num,:sortrand)',[
                'aid'=>$v->aid,
                'title'=>$v->title,
                'thiefRemoteLink'=>$v->thiefRemoteLink,
                'num'=>$v->num,
                'sortrand'=>$v->sortrand,
            ]);
            
            //将章节内容写入缓存文件
            $path = Helper::getChaptContPath($v->aid,$v->num);
            $content = $v->content;
            if (!empty($content)) {
                $content = trim($content);
                $content = str_replace('&nbsp;&nbsp;&nbsp;&nbsp;','%k%',$content);
                file_put_contents($path,$content);
            }
        }

        $plucked = $list->pluck('id');
        $arr = $plucked->all();
        $str_id = implode(',',$arr);
        DB::update('update '.$table.' set flag=1 where id in ('.$str_id.') ');

        return view('test');
        //return redirect(url('/test').'?rand='.rand(100000,999999));*/

        $limit = 110;
        $list = DB::table('as_novel_chapt')->select(['id','aid','num'])
            ->where('flag',0)
            ->where('aid', '<', 1124)
            ->orderBy('id','asc')
            ->limit($limit)
            ->get();

        if(count($list)==0){
            dd('done');
        }
        foreach ($list as $k=>$v) {
            $path = dirname(dirname(dirname(dirname(dirname(__FILE__))))).'/vvs5_data/'.floor(intval($v->aid)/200).'/'.$v->aid.'/'.$v->num.'.cache';

            if(!file_exists($path))
            {
                $newContent = '';
            } elseif(filesize($path) > 100025) {
                $newContent = '';
            } else {

                $content = file_get_contents($path);

                $content = trim($content);
                $content = str_replace(PHP_EOL, '', $content);
                $content = trim($content);

                if (!empty($content)) {
                    $content = str_replace('%k%', '', $content);
                    $content = str_replace(['<br>','<br />','<br/>','<br/ >','< br>','< br/>','< br />'], '<br>', $content);
                    $_arr = explode('<br>',$content);
                    
                    $new_arr = [];
                    foreach ($_arr as $k=>$v) {
                        $v = str_replace(PHP_EOL, '', $v);
                        $v = trim($v);
                        if (!empty($v)) {
                            $new_arr[] = $v;
                        }
                    }
                    $new_arr = array_filter($new_arr);

                    $newContent = implode('</p><p>', $new_arr);
                    $newContent = '<p>'.$newContent.'</p>';
                    $newContent = addslashes($newContent);
                } else {
                    $newContent = '';
                }
            }

            $newContent = 'document.writeln("'.$newContent.'");';

            file_put_contents($path, $newContent);
        }

        $plucked = $list->pluck('id');
        $arr = $plucked->all();
        $str_id = implode(',',$arr);
        $affect = DB::update('update as_novel_chapt set flag=1 where id in ('.$str_id.') ');                
        echo date("Y-m-d H:i:s")."<br>".$affect."<br>";

        return view('test');
    }

    /**
     * 创建小说数据缓存
     */
    /*public function cacheNovelData()
    {
        $list = DB::table('as_novel')->select(['*'])
            ->where('aud',1)
            ->get();

        foreach ($list as $k=>$v) {

            $dir = Helper::getChaptContDir($v->id);
            Helper::makeDir($dir);

            $path = Helper::getNovelDataPath($v->id);

            $str='<?php '.PHP_EOL.'$info =' . var_export((array)$v,true) . '; '.PHP_EOL.'?>';
            $affect = file_put_contents($path, $str,LOCK_EX);
            echo $affect.PHP_EOL;
        }
    }*/
    public function cacheNovelData()
    {
        exit;
        $list = DB::table('as_novel')->select(['*'])
            ->where('aud',1)
            ->get();

        foreach ($list as $k=>$v) {

            $path = Helper::getNovelDataPath($v->filename);

            $str='<?php '.PHP_EOL.'return ' . var_export((array)$v,true) . '; '.PHP_EOL.'?>';
            $affect = file_put_contents($path, $str,LOCK_EX);
            echo $affect.PHP_EOL;
        }
    }

    /**
     * 创建小说章节数据缓存
     */
    public function cacheNovelChaptData()
    {
        $novel = DB::table('as_novel')->select(['id'])
            ->where('flag',0)
            ->where('aud',1)
            ->orderBy('id','asc')
            ->first();

        if(count($novel)==0){
            dd('done');
        }

        $list = DB::table('as_novel_chapt')->select(['title','num','thiefRemoteLink'])
            ->where('aid',$novel->id)
            ->orderBy('sortrand','asc')
            ->get();

        $path = Helper::getNovelChaptDataPath($novel->id);

        $arr = [];
        foreach ($list as $k=>$v) {
            $temp = [];
            $temp['title'] = $v->title;
            $temp['num'] = $v->num;
            $temp['thiefRemoteLink'] = $v->thiefRemoteLink;
            $arr[$k] = $temp;
        }

        $str='<?php '.PHP_EOL.'return ' . var_export($arr,true) . '; '.PHP_EOL.'?>';
        $affect = file_put_contents($path, $str,LOCK_EX);
        echo $path.' - '.$affect.PHP_EOL;

        DB::update('update as_novel set flag=1 where id='.$novel->id.' ');

        return view('test');
    }
}
