<?php namespace App\Presenters\Admin;

class AdminUser
{
    /**
     * 显示菜单表格数据
     */
    public static function showTableData($list)
    {
        $html = '';
        foreach ($list as $k=>$v)
        {

            $html .= '<tr>
                        <td>
                            <input class="form-control" name="username" type="text" value="'.$v['username'].'" />
                        </td>
                        <td><input class="form-control" name="password" type="password" placeholder="输入后视为要修改密码"/></td>
                        <td class="hidden-480">'.(empty($v['last_time'])?'-':date('Y-m-d H:i:s',$v['last_time'])).'</td>
                        <td class="hidden-480">'.(empty($v['last_ip'])?'-':$v['last_ip']).'</td>
                        <td class="hidden-480">
                            <div class="visible-md visible-lg hidden-sm hidden-xs btn-group">

                                <button name="edit" class="btn btn-xs btn-info" value="'.$v['_id'].'">
                                    <i class="icon-edit bigger-120" title="编辑"></i>
                                </button>

                                <button name="del" class="btn btn-xs btn-danger" value="'.$v['_id'].'">
                                    <i class="icon-trash bigger-120" title="删除"></i>
                                </button>

                            </div>
                        </td>
                    </tr>';
        }
        return $html;
    }
}