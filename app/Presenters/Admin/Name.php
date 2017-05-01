<?php namespace App\Presenters\Admin;

use App\Common\Helper;

class Name
{
    /**
     * 显示表格数据
     */
    public static function showTableData($list,$admin_list)
    {
        $html = '';
        foreach ($list as $k=>$v)
        {
            $html .= '<tr>
                        <td><a href="'.action('Admin\NameController@edit',['id'=>$v['_id']]).'">'.$v['name'].'</a></td>
                        <td>'.$v['good'].'/'.$v['fav'].'</td>
                        <td class="hidden-480">'.$admin_list[$v['admin_id']].'</td>
                        <td class="hidden-480">'.Helper::getDateByTimestamp($v['addtime']).'</td>
                        <td class="hidden-480">
                            <div class="visible-md visible-lg hidden-sm hidden-xs btn-group">

                                <a href="'.action('Admin\NameController@edit',['id'=>$v['_id']]).'"><button class="btn btn-xs btn-info">
                                    <i class="icon-edit bigger-120" title="修改"></i>
                                </button></a>

                            </div>
                        </td>
                    </tr>';
        }
        return $html;
    }

    /**
     * 显示网名分类列表
     * @param array $list 分类列表
     * @param array $cur 当前网名所拥有的分类数组
     */
    public static  function showTypeList($list=[],$cur=[])
    {
        $html = '';
        if(!empty($list) && count($list)>0){
            foreach ($list as $key=>$value) {
                $checked = in_array($value['_id'],$cur) && count($cur)>0 ? ' checked' : '';
                $html .= '<label>
                            <input name="typeid[]" type="checkbox" class="ace" value="'.$value['_id'].'" '.$checked.'/>
                            <span class="lbl"> '.$value['typename'].'</span>
                        </label>';
            }
        }
        return $html;
    }
}