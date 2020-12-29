<?php

namespace App\Http\Controllers\Admin;


use App\Models\User;
use Illuminate\Http\Request;

class AdminHomeController extends AdminBaseController
{
    public function index(){
        $user = User::find(1);
//        dd($user->hasRole('web-developer')); //вернёт true
//        dd($user->hasRole('project-manager')); //вернёт false
//        dd($user->givePermissionsTo('manage-users')); //выдаём разрешение
//        dd($user->hasPermission('manage-users')); //вернёт true

        return view('admin.index');
    }
}
