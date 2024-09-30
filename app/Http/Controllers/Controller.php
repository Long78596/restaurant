<?php

namespace App\Http\Controllers;

use App\Models\Role;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Auth;
class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;
    public function checkRule($id_fun)
    {
        $login      = Auth::guard('aloxinh')->user();
        $list_role = Role::find($login->role_id)->list_id_role;
        $arr_role  = explode(",", $list_role);
        if (!in_array($id_fun, $arr_role)) {
            return true;
        } else {
            return false;
        }
    }
}
