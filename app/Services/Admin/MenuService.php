<?php namespace App\Services\Admin;

use App\Exceptions\JsonException;
use App\Repositories\Admin\MenuRepo;
use Cache;

class MenuService
{
    protected $menu_repo = null;

    public function __construct(MenuRepo $menu_repo)
    {
        $this->menu_repo = $menu_repo;
    }

    /**
     * 获取菜单树
     * @return array
     */
    public function getMenuTree()
    {
        $menu_list = $this->menu_repo->getAll();
        $menu_list = $menu_list->toArray();
        $menu_list = array_column($menu_list, null, 'id');
        foreach ($menu_list as $item)
            $menu_list[$item['pid']]['son'][$item['id']] = &$menu_list[$item['id']];
        return isset($menu_list[0]['son']) ? $menu_list[0]['son'] : array();
    }

    /**
     * 新增菜单
     * @param array $data
     * @throws JsonException
     */
    public function store($data = [])
    {
        //查看菜单是否已经存在
        $check_menu = $this->checkByName($data['name']);
        if($check_menu){
            throw new JsonException(101050);
        }

        //处理level数据
        if($data['level']!='' && is_numeric($data['level'])) {
            $data['level'] = (int)$data['level'] + 1;
        }
        $flag = $this->menu_repo->store($data);
        if ($flag === false || !$flag) {
            throw new JsonException(101000);
        }
        return $flag;
    }

    /**
     * 根据菜单名检查数据是否存在
     * @param string $name
     * @return bool
     * @throws JsonException
     */
    public function checkByName($name = '')
    {
        if(empty($name)){
            throw new JsonException(10000);
        }

        try{
            $model = $this->menu_repo->findByName($name);
            if($model->id){
                $boolean = true;
            }else{
                $boolean = false;
            }
        }catch(JsonException $e){
            if($e->getCode()==101020){
                $boolean = false;
            }else{
                throw new JsonException($e->getCode());
            }
        }
        return $boolean;
    }

    /**
     * 修改菜单
     * @param array $data
     * @return bool
     * @throws JsonException
     */
    public function update($data = [])
    {
        $flag = $this->menu_repo->update($data);
        if ($flag === false || !$flag) {
            throw new JsonException(101040);
        }
        return $flag;
    }

    /**
     * 清空缓存
     * @return bool
     * @throws JsonException
     */
    public function clearCache()
    {
        $key = config('admin.menu.cache_key');
        if (Cache::has($key)) {
            if(!Cache::forget($key)){
                throw new JsonException(101010);
            }
        }
        return true;
    }

    /**
     * 删除菜单
     * @param $id
     * @return mixed
     * @throws JsonException
     */
    public function destroy($id)
    {
        $data = [
            'id' => $id
        ];

        $flag = $this->menu_repo->destroy($data);
        if(!$flag || $flag == false){
            throw new JsonException(101030);
        } else {
            $this->clearCache();
        }
        return $flag;
    }
}