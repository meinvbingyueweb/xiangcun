<?php namespace App\Services\Admin;

use App\Common\Helper;
use App\Exceptions\JsonException;
use App\Repositories\Admin\AdminUserRepo;

class AdminUserService
{
    protected $admin_user_repo = null;

    public function __construct(AdminUserRepo $admin_user_repo)
    {
        $this->admin_user_repo = $admin_user_repo;
    }

    /**
     * 获取所有的后台用户数据
     * @return \App\Repositories\Admin\collection
     */
    public function getAll($condition = [])
    {
        return $this->admin_user_repo->getAll($condition);
    }

    /**
     * 获取分页数据
     * @param int $page
     * @return mixed
     */
    public function getDataByPage($page = 1)
    {
        $condition['page'] = $page;
        $condition['page_size'] = 15;
        return $this->admin_user_repo->getData($condition);
    }

    /**
     * 根据用户名获取数据
     * @param string $username
     * @return mixed
     * @throws JsonException
     */
    public function getByName($username = '')
    {
        if(empty($username)){
            throw new JsonException(10000);
        }
        return $this->admin_user_repo->findByName($username);
    }

    /**
     * 根据用户名检查数据是否存在
     * @param string $username
     * @return bool
     * @throws JsonException
     */
    public function checkByName($username = '', $operate = 'store', $id = '')
    {
        if(empty($username)){
            throw new JsonException(10000);
        }

        try{
            $admin_user_model = $this->getByName($username);
            if($admin_user_model->id){
                if ($operate == 'update' && $id == $admin_user_model->id) {
                    $boolean = false;
                } else {
                    $boolean = true;
                }
            }else{
                $boolean = false;
            }
        }catch(JsonException $e){
            if($e->getCode()==102010){
                $boolean = false;
            }else{
                throw new JsonException($e->getCode());
            }
        }
        return $boolean;
    }

    /**
     * 新增后台用户
     * @param array $data
     * @throws JsonException
     */
    public function store($data = [])
    {
        //查看用户是否已经存在
        $check_user = $this->checkByName($data['username']);
        if($check_user){
            throw new JsonException(102040);
        }

        $data['salt'] = Helper::getRandomString();
        $data['password'] = Helper::getEncryPwd($data['password'],$data['salt']);
        $flag = $this->admin_user_repo->store($data);
        if ($flag === false || !$flag) {
            throw new JsonException(102000);
        }
        return $flag;
    }

    /**
     * 修改后台用户数据
     * @param array $data
     * @return bool
     * @throws JsonException
     */
    public function update($data = [])
    {
        //查看用户是否已经存在
        $check_user = $this->checkByName($data['username'],'update',$data['id']);
        if($check_user){
            throw new JsonException(102040);
        }

        //如果密码不为空，则获取密码盐和加密后的密码
        if(!empty($data['password'])){
            $data['salt'] = Helper::getRandomString();
            $data['password'] = Helper::getEncryPwd($data['password'],$data['salt']);
        }
        $flag = $this->admin_user_repo->update($data);
        if ($flag === false || !$flag) {
            throw new JsonException(102030);
        }
        return $flag;
    }

    /**
     * 删除后台用户
     * @param $id
     * @return mixed
     * @throws JsonException
     */
    public function destroy($id)
    {
        $data = [
            'id' => $id
        ];

        $flag = $this->admin_user_repo->destroy($data);
        if(!$flag || $flag == false){
            throw new JsonException(102020);
        }
        return $flag;
    }
}