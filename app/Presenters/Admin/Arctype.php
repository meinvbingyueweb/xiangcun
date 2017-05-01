<?php namespace App\Presenters\Admin;

class Arctype
{
    /**
     * 显示表格数据
     */
    public static function showTableData($list,$level = 1)
    {
        $html = '';
        foreach ($list as $k=>$v)
        {
            $style = $v['reid']==0 ? ' style="background-color:#c3dde0;"' : '';
            $dept = str_repeat('--',$level);

            $enable = $v['enable'] && $v['enable'] == 1 ? 'checked' : '';
            $html .= '<tr'.$style.'>
                        <td'.$style.'>'.$v['num'].' '.$dept.'<input name="typename" type="text" value="'.$v['typename'].'" /></td>
                        <td'.$style.'><input class="form-control" name="typedir" type="text" value="'.$v['typedir'].'" /></td>
                        <td'.$style.' class="hidden-480"><input class="form-control" name="seotitle" type="text" value="'.$v['seotitle'].'" /></td>
                        <td'.$style.' class="hidden-480"><input class="form-control" name="sort" type="text" value="'.$v['sort'].'" /></td>
                        <td'.$style.' class="hidden-480">
                            <input name="enable" class="ace ace-switch" type="checkbox" '.$enable.'/>
                            <span class="lbl"></span>
                        </td>
                        <td'.$style.' class="hidden-480">
                            <div class="visible-md visible-lg hidden-sm hidden-xs btn-group">

                                <a href="#"><button name="edit" class="btn btn-xs btn-pink" value="'.$v['_id'].'">
                                    <i class="icon-inbox bigger-120" title="编辑"></i>
                                </button></a>
                                
                                <a href="'.action('Admin\ArctypeController@edit',['id'=>$v['_id']]).'"><button class="btn btn-xs btn-info">
                                    <i class="icon-edit bigger-120" title="修改"></i>
                                </button></a>
                                
                            </div>
                        </td>
                    </tr>';

            if(isset($v['son']) && count($v['son'])>0){
                $html .= self::showTableData($v['son'],($level+1));
            }
        }
        return $html;
    }

    /**
     * 显示下拉数据
     */
    public static function showSelect($list,$level = 1)
    {
        $html = '';
        foreach ($list as $k=>$v)
        {
            $topid = $v['reid']==0 ? $v['reid'] : $v['topid'];
            $dept = str_repeat('--',$level);

            $style = $level == 1 ? ' style="font-weight:bold;font-size:15px;color:#6fb3e0"' : '';
            $html .= '<option value="'.$v['num'].'" topid="'.$topid.'" '.$style.'>'.$dept.$v['typename'].'</option>';
            if(isset($v['son']) && count($v['son'])>0){
                $html .= self::showSelect($v['son'],($level+1));
            }
        }
        return $html;
    }
}