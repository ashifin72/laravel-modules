<?php


namespace App\Repositories\Admin;


use App\Models\User;
use App\Models\User as Model;
use App\Repositories\CoreRepository;


class UserRepository extends CoreRepository
{
    public function __construct()
    {
        parent::__construct();

    }

    /**
     * @return mixed
     */
    protected function getModelClass()
    {
        return Model::class;
    }
    /** All Users */
    public function getAllUsers($perpage= null)
    {
        $users = $this->startConditions()
            ->join('users_roles','users_roles.user_id', '=', 'users.id')
            ->join('roles','users_roles.role_id', '=', 'roles.id')
            ->select('users.id', 'users.name','users.email','users.img','roles.name as role')
            ->orderBy('id')
            ->toBase()
            ->paginate($perpage);

        return $users;
    }
    // все пользователи без пагинации тольк id  role
    public function  getAllClobalUser()
    {
        return $this->startConditions()
            ->join('users_roles','users_roles.user_id', '=', 'users.id')
            ->join('roles','users_roles.role_id', '=', 'roles.id')
            ->select('users.id', 'roles.name as role')
            ->orderBy('id')
            ->toBase()
            ->get();
    }
    // Роль пользователя по id
    public function getRoleUser($id)
    {
        foreach ($this->getAllClobalUser() as $item) {
            if ($item->id == $id) {
                return $item->role;
            }
        }
    }






}
