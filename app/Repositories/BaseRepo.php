<?php namespace App\Repositories;

class BaseRepo {
    /**
     * 据查询条件获取数据（Mysql）
     * @param int $condition['first']       true（传递了则说明要获取第一个数据）
     * @param int $condition['page']
     * @param int $condition['pagesize']
     * @param int $condition['limit']
     * @param array $condition['where']
     * @param array $condition['order']
     * @param string $condition['group']
     * @param array $condition['columns']
     * @param array $condition['relation']
     * @return mixed
     *
     * $condition['page'] = 1;
     * $condition['page_size'] = 1;
     * $condition['limit'] = 1;
     * $condition['first'] = true;
     * $condition['where'] = [['status', '=', '1']];
     * $condition['order'] = [['num','desc']];
     * $condition['group'] = ['name','num'];
     */
    public function getCommonData($model, $condition) {
        $page = isset($condition['page']) && is_numeric($condition['page']) ? $condition['page'] : 1;
        $page_size = isset($condition['page_size']) && is_numeric($condition['page_size']) ? $condition['page_size'] : 15;
        $where = isset($condition['where']) && is_array($condition['where']) ? $condition['where'] : [];
        $order = isset($condition['order']) ? $condition['order'] : [];
        $group = isset($condition['group']) ? $condition['group'] : '';
        $columns = isset($condition['columns']) ? $condition['columns'] : ['*'];
        $relation = isset($condition['relation']) ? $condition['relation'] : [];

        // 字段
        $model = $model->select($columns);
        // 条件
        if (!empty($where) && count($where) > 0) {
            $model->where($where);
        }

        // 排序
        if (!empty($order)) {
            foreach ($order as $v_order) {
                if (count($v_order) == 2 && in_array(strtolower($v_order[1]), ['asc', 'desc'])) {
                    $model->orderBy($v_order[0], $v_order[1]);
                }
            }
        }
        
        // 分组
        if (!empty($group)) {
            $model->groupBy($group);
        }

        // 获取数据
        if (isset($condition['first']) && $condition['first']==true) {
            // 第一个
            $collection = $model->first();
        } elseif (isset($condition['limit']) && $condition['limit'] > 0) {
            // 若干数据
            $collection = $model->limit($condition['limit'])->get();
        } elseif (isset($condition['page']) && $condition['page'] > 0) {
            // 分页
            $collection = $model->paginate($page_size, $columns, 'page', $page);
        } elseif (isset($condition['count']) && $condition['count'] == true) {
            // 统计
            return $model->count('id');
        } else {
            // 全部数据
            $collection = $model->get();
        }

        // 加载关系
        if (!empty($relation)) {
            $collection->load($relation);
        }

        return $collection;
    }

    /**
     * 据查询条件获取数据（MongoDB）
     * @param int $page
     * @param int $pagesize
     * @param array $where
     * @param array $order ['num','desc']
     * @param string $group
     * @param array $columns
     * @param array $relation
     * @return mixed
     *
     * $condition['page'] = 1;
     * $condition['page_size'] = 1;
     * $condition['order'] = ['num','desc'];
     */
    public function getCommonDataByMongo($model, $condition) {
        $page = isset($condition['page']) && is_numeric($condition['page']) ? $condition['page'] : 1;
        $page_size = isset($condition['page_size']) && is_numeric($condition['page_size']) ? $condition['page_size'] : 15;
        $where = isset($condition['where']) ? $condition['where'] : [];
        $order = isset($condition['order']) ? $condition['order'] : [];
        $group = isset($condition['group']) ? $condition['group'] : '';
        $columns = isset($condition['columns']) ? $condition['columns'] : ['*'];
        $relation = isset($condition['relation']) ? $condition['relation'] : [];

        $model = $model->select($columns);
        if (!empty($where) && count($where) > 0) {
            $_where = [];
            foreach ($where as $w) {
                if (count($w) == 2) {
                    $_where[] = [$w[0], $w[1]];
                }
                if (count($w) == 3) {
                    $_where[] = [$w[0], $w[1], $w[2]];
                }
            }
            $model->where($_where);
        }
        if (!empty($order)) {
            if (count($order) == 2 && in_array(strtolower($order[1]), ['asc', 'desc'])) {
                $model->orderBy($order[0], $order[1]);
            }
        }
        if (!empty($group)) {
            $model->groupBy($group);
        }
        if (isset($condition['page']) && $condition['page'] > 0) {
            $collection = $model->paginate($page_size, $columns, 'page', $page);
        } elseif (isset($condition['count']) && $condition['count'] == true) {
            return $model->count('_id');
        } else {
            $collection = $model->get();
        }

        if (!empty($relation)) {
            $collection->load($relation);
        }

        return $collection;
    }
}