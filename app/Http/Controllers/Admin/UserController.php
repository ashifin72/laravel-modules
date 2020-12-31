<?php

namespace App\Http\Controllers\Admin;
use App\Http\Requests\AdminUserCreateRequest;
use App\Http\Requests\AdminUserUpdateRequest;
use App\Http\Requests\InfoUploadImgRequest;
use App\Models\Role;
use App\Models\User;
use App\Models\UserRole;
use App\Traits\HasRolesAndPermissions;
use App\Http\Controllers\Controller;
use App\Repositories\Admin\MainRepository;
use App\Repositories\Admin\RoleRepository;
use App\Repositories\Admin\UserRepository;
use Illuminate\Http\Request;

use MetaTag;

class UserController extends AdminBaseController
{
    private $userRepository, $roleRepository;
    public function __construct()
    {
        parent::__construct();
        $this->userRepository= app(UserRepository::class);
        $this->roleRepository = app(RoleRepository::class);
    }

    public function index()
    {
        $perpage = env('DISPLAY_ITEMS_SHOW', 3);

        MetaTag::setTags(['title'=> "Список пользовтелей"]);
        $items = $this->userRepository->getAllUsers($perpage);
        return view('admin.user.index', compact('items'));
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $item = User::make();
        MetaTag::setTags(['title' => 'Добавление пользователя']);
        $listRole = $this->roleRepository->getForComboBox();

        return view('admin.user.create', compact('item', 'listRole'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(AdminUserCreateRequest $request)
    {
        if (($request['img'])){
            $folder = 'users'. (int)$request['role'];

            $img = $request->file('img')->store('upload/'. $folder, 'public');

        }
        $data = [
            'name' => $request['name'],
            'email' => $request['email'],
            'password' => bcrypt($request['password']),
            'img'=> $img ?? null,
        ];

        $item = User::create($data);

        $user = $item->save();

        if (!$user) {
            return back()
                ->withErrors(['msg' => "Ошибка создания"])
                ->withInput();
        } else {
            $role = UserRole::create([
                'user_id' => $item->id,
                'role_id' => (int)$request['role'],
            ]);
            if (!$role) {
                return back()
                    ->withErrors(['msg' => "Ошибка создания Роли пользователя"])
                    ->withInput();
            } else {
                return redirect()
                    ->route('admin.users.edit', $item->id)
                    ->with(['success' => 'Успешно создан']);
            }
        }
    }



    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

        $item = $this->userRepository->getEditId($id);
        if (empty($item)) {
            abort(404);
        }

        $listRole = $this->roleRepository->getForComboBox();
        $role = $this->userRepository->getRoleUser($item->id);

        MetaTag::setTags(['title' => "Редактирование профиля пользователя № {$item->id}"]);
        return view('admin.user.edit',
            compact('item', 'listRole', 'role'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(AdminUserUpdateRequest $request, User $user, UserRole $role)
    {
        $colums = ['name', 'email', 'img', 'site','viber', 'phone', 'facebook', 'telegram', 'whatsapp', 'skype'];




        foreach ($colums as $colum){
            $user->$colum = $request[$colum];
        }
        if (($request['img'])){
            $folder = 'users'. (int)$request['role'];

            $img = $request->file('img')->store('upload/'. $folder, 'public');
            $user['img'] = $img;
        }

        $request['password'] == null ?: $user->password = bcrypt($request['password']);

        $save = $user->save();
        if (!$save) {
            return back()
                ->withErrors(['msg' => "Ошибка сохранения"])
                ->withInput();
        } else {
            $role->where('user_id', $user->id)->update(['role_id' => (int)$request['role']]);
            return redirect()
                ->route('admin.users.edit', $user->id)
                ->with(['success' => 'Успешно сохранено']);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        $result = $user->forceDelete();
        if($result){
            return redirect()
                ->route('admin.users.index')
                ->with(['success' => "Пользователь " . ucfirst($user->name) . " удален"]);
        } else {
            return back()->withErrors(['msg' => 'Ошибка удаления']);
        }
    }

    /** Delete Image */
    public function deleteImage($filename)
    {
        File::delete('upload/users/' . $filename);
    }

    /** Upload Single Image from my.js
     * @param Request $request
     * @return array|\Illuminate\Contracts\View\Factory|\Illuminate\View\View|string
     */
    public function ajaxImage(InfoUploadImgRequest $request)
    {
        if ($request->isMethod('get')) {
            return view('admin.user.include.image_single_edit');
        } else {

            $extension = $request->file('img')->getClientOriginalExtension();
            $dir = 'upload/users/';
            $filename = uniqid() . '_' . time() . '.' . $extension;
            $request->file('img')->move($dir, $filename);
            $wmax = 500;
            $hmax = 500;
            $this->userRepository->uploadImg($filename, $wmax, $hmax);
            return $filename;
        }
    }
}
