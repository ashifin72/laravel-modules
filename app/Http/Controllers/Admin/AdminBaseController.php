<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\BaseController as MainBaseController;

use Illuminate\Http\Request;

class AdminBaseController extends MainBaseController
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('role:admin');
    }
}
