<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
//        $user = App\Models\User::find(1);
//        dd($user->hasRole('web-developer')); //вернёт true
//        dd($user->hasRole('project-manager')); //вернёт false
//        dd($user->givePermissionsTo('manage-users')); //выдаём разрешение
//        dd($user->hasPermission('manage-users')); //вернёт true
        return view('home');
    }
}
