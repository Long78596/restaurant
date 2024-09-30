<?php

namespace App\Http\Controllers;

use App\Http\Requests\AdminRequest;
use App\Models\admin;
use App\Models\role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function login()
    {
          $check =Auth::guard('aloxinh')->check();
          if($check){
            return redirect('/');
          }else{
            return view("admin.page.admin.login");
          }

    }
     public function logout(Request $request ){
         $check =  Auth::guard('aloxinh')->logout();
        toastr()->error("Đăng xuất thành công!");
        return redirect('/admin/login');
     }
    /**
     * Show the form for creating a new resource.
     */
    public function actionLogin(AdminRequest $request)
    {
        // $request->email, $request->password
        $check =  Auth::guard('aloxinh')->attempt([
            'username'     =>$request->username,
            'password'  => $request->password
        ]);
        //dd($check);
        if ($check) {
            toastr()->success("Đã đăng nhập thành công!");
            return redirect('/admin/login');
        } else {
            toastr()->error("Tài khoản hoặc mật khẩu không đúng!");
            return redirect('/admin/login');
        }
    }

    public function index()
    {
        // $x          = $this->checkRule(6);
        // if ($x) {
        //     toastr()->error("Bạn không đủ quyền truy cập!");
        //     return redirect('/');
        // }
       $quyen = Role::get();
        return view('admin.page.account.index',compact("quyen"));
    }

    public function store(Request $request)
    {
        $x          = $this->checkRule(1);
        if ($x) {
            return response()->json([
                'status'    => 0,
                'message'   => 'Bạn không đủ quyền',
            ]);
        }
        $request->validate([
            'username' => 'required|max:255|min:5',
            'password' => 'required',
            'email' => 'required',
            'role_id' => 'required',

        ]);

        $data = $request->all();
        $data['password'] =  bcrypt($request->password);
        Admin::create($data);

        return response()->json([
            'status'    => true,
            'message'   => 'Đã tạo tài khoản thành công!'
        ]);
    }

    public function getData()
    {
        $list = Admin::leftjoin('roles', 'admins.role_id', 'roles.id')
        ->select('admins.*', 'roles.role_name')
        ->get();
        return response()->json([
            'list'  => $list
        ]);
    }

    public function destroy(Request $request)
    {
        // $x          = $this->checkRule(5);
        // if($x)  {
        //     return response()->json([
        //         'status'    => 0,
        //         'message'   => 'Bạn không đủ quyền',
        //     ]);
        // }

        $admin = Admin::where('id', $request->id)->first();
        $admin->delete();
        return response()->json([
            'status'    => true,
            'message'   => 'Đã xóa thành công!',
        ]);
    }

    public function update(Request $request)
    {
        // $x          = $this->checkRule(4);
        // if($x)  {
        //     return response()->json([
        //         'status'    => 0,
        //         'message'   => 'Bạn không đủ quyền',
        //     ]);
        // }
       $request->validate([
            'username' => 'required|max:255|min:5',
            'password' => 'required',
            'email' => 'required',
            'role_id' => 'required',

        ]);
        $data    = $request->all();
        $admin = Admin::find($request->id);
        $admin->update($data);

        return response()->json([
            'status'    => true,
            'message'   => 'Đã cập nhật thành công!',
        ]);
    }

    public function changePassword(Request $request)
    {
        // $x          = $this->checkRule(3);
        // if($x)  {
        //     return response()->json([
        //         'status'    => 0,
        //         'message'   => 'Bạn không đủ quyền',
        //     ]);
        // }
        $request->validate([

            'password' => 'required',
            'password_new' => 'required',

        ]);
        $data = $request->all();
        if (isset($request->password)) {
            $admin = Admin::find($request->id);
            $data['password'] = bcrypt($data['password_new']);
            $admin->password  = $data['password'];
            $admin->save();
        }
        return response()->json([
            'status'    => 1,
            'message'   => 'Đã cập nhật mật khẩu thành công!',
        ]);
    }





}
