<?php namespace App\Presenters\Admin;

use App\Services\Admin\MenuService;
use Cache;

class Menu
{
    /**
     * 显示后台左侧菜单
     * @return string
     */
    public static function showLeftMenu()
    {
        $menu_tree = Cache::store(config('admin.menu.cache_driver'))->remember(config('admin.menu.cache_key'), config('admin.menu.cache_lifetime'), function () {
            return app(MenuService::class)->getMenuTree();
        });

        $html = '';
        foreach ($menu_tree as $key => $value) {
            if (!empty($value) && $value['level'] == 1) {
                if(isset($value['son']) && is_array($value['son']) && count($value['son'])>0)
                    $submenu = self::getSubMenu($value['son']);

                $html .= '<li>'.self::getNoteItem($value).$submenu.'</li>';
            }
        }

        return $html;
    }

    /**
     * 获取后台左侧第一级以后的所有菜单
     * @param $list
     * @return string
     */
    public static function getSubMenu($list)
    {
        $html = '<ul class="submenu">';
        foreach ($list as $sub_key=>$sub_value) {

            $submenu = '';
            if(isset($sub_value['son']) && is_array($sub_value['son']) && count($sub_value['son'])>0){
                $submenu = self::getSubMenu($sub_value['son']);
            }

            $class_active = '';
            if($sub_value['link']!='#' && request()->fullUrlIs(action($sub_value['link']).'*')){
                $class_active = ' class="active"';
            }
            $html .= '<li'.$class_active.'>'.self::getNoteItem($sub_value).$submenu.'</li>';
        }
        $html .= '</ul>';
        return $html;
    }

    /**
     * 获取后台菜单子项
     * @param $item
     * @return string
     */
    public static function getNoteItem($item)
    {
        if($item['link']!='#'){
            $item['link'] = action($item['link']);
        }

        $class_icon = !empty($item['icon']) && isset($item['icon']) && !is_null($item['icon'])
            ? '  class="icon-'.$item['icon'].'"'
            : ' class="icon-double-angle-right"';

        if(isset($item['son']) && count($item['son'])>0){
            return '<a href="'.$item['link'].'" class="dropdown-toggle"><i'.$class_icon.'></i><span class="menu-text"> '.$item['name'].' </span><b class="arrow icon-angle-down"></b></a>';
        }else{
            return '<a href="'.$item['link'].'"><i'.$class_icon.'></i>'.$item['name'].'</a>';
        }
    }

    /*****************************************************************************/
    /**
     * 显示菜单图标
     */
    public static function showIconSelect($cursor = null)
    {
        $html = '';
        $list = config('admin.menu.icon');

        if (empty($list) || count($list)==0) {
            return $html;
        }

        foreach ($list as $k=>$v) {
            $style = !is_null($cursor) && $v==$cursor ? ' selected' : '';
            $html .= '<option value="'.$v.'"'.$style.'>'.$v.'</option>';
        }
        return $html;
    }

    /**
     * 显示菜单下拉层级
     */
    public static function showSelectLevel($menu_list)
    {
        $html = '';
        foreach ($menu_list as $k=>$v)
        {
            $rid = $v['pid']==0 ? $v['_id'] : $v['rid'];
            $dept = str_repeat('--',$v['level']);

            $style = $v['level']==1 ? ' style="font-weight:bold;font-size:15px;"' : '';
            $html .= '<option value="'.$v['_id'].'" rid="'.$rid.'" level="'.$v['level'].'"'.$style.'>'.$dept.$v['name'].'</option>';
            if(isset($v['son']) && count($v['son'])>0){
                $html .= self::showSelectLevel($v['son']);
            }
        }
        return $html;
    }

    /**
     * 显示菜单表格数据
     */
    public static function showTableData($menu_list)
    {
        $html = '';
        foreach ($menu_list as $k=>$v)
        {

            $dept = str_repeat('--',$v['level']);

            $style = $v['level']==1 ? ' style="background-color:#c3dde0;"' : '';

            $html .= '<tr'.$style.'>
                        <td'.$style.'>
                            '.$dept.' <input name="name" type="text" value="'.$v['name'].'" />
                        </td>
                        <td'.$style.'><input name="link" class="form-control" type="text" value="'.$v['link'].'" /></td>
                        <td class="hidden-480"'.$style.'>
                            <input name="sort" type="text" value="'.$v['sort'].'" />
                        </td>
                        <td class="hidden-480"'.$style.'>
                            <select id="icon" name="icon">
                                <option value="">--选择--</option>
                                '.self::showIconSelect($v['icon']).'
                            </select>
                        </td>
                        <td class="hidden-480"'.$style.'>
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

            if(isset($v['son']) && count($v['son'])>0){
                $html .= self::showTableData($v['son']);
            }
        }
        return $html;
    }

}