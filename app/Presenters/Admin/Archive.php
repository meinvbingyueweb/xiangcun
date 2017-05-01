<?php namespace App\Presenters\Admin;

class Archive
{
    /**
     * 显示表格数据
     */
    public static function showTableData($list)
    {
        $html = '';
        foreach ($list as $k=>$v)
        {

            $html .= '<tr>
                        <td><a href="'.action('Admin\ArchiveController@edit',['id'=>$v['_id']]).'">'.$v['num'].'</a></td>
                        <td>'.$v['typeid'].'</td>
                        <td>'.$v['title'].'</td>
                        <td class="hidden-480">'.$v['goodpost'].'</td>
                        <td class="hidden-480">'.$v['click'].'</td>
                        <td class="hidden-480">'.(empty($v['pubdate'])?'-':date('Y-m-d H:i:s',$v['pubdate'])).'</td>
                        <td class="hidden-480">
                            <div class="visible-md visible-lg hidden-sm hidden-xs btn-group">

                                <a href="'.action('Admin\ArchiveController@edit',['id'=>$v['_id']]).'"><button class="btn btn-xs btn-info">
                                    <i class="icon-edit bigger-120" title="修改"></i>
                                </button></a>

                            </div>
                        </td>
                    </tr>';
        }
        return $html;
    }
}