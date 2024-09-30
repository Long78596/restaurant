<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\list_function;
use Illuminate\Http\Request;

class RoleController extends Controller
{
    public function index()
    {
        // $x          = $this->checkRule(7);
        // if ($x) {
        //     toastr()->error("Bạn không đủ quyền truy cập!");
        //     return redirect('/');
        // }
        return view('admin.page.role.index');
    }

    public function getData()
    {
        $list = Role::get();

        $chucNang = List_function::get();

        return response()->json([
            'list'      => $list,
            'chuc_nang' => $chucNang
        ]);
    }

    public function getDataRole()
    {
        $chucNang = list_function::get();

        return response()->json([
            'data' => $chucNang
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'role_name' => 'required|max:255|min:5',
            'list_id_role' => 'required',

        ]);
        $data = $request->all();
        Role::create($data);

        return response()->json([
            'status'    => true,
            'message'   => 'Đã tạo mới thành công!',
        ]);
    }

    public function update(Request $request)
    {
        $request->validate([
            'role_name' => 'required|max:255|min:5',
            'list_id_role' => 'required',

        ]);
        $quyen = Role::where('id', $request->id)->first();

        $data = $request->all();


        $quyen->update($data);

        return response()->json([
            'status'    => true,
            'message'   => 'Đã cập nhật được thông tin!',
        ]);
    }

    public function destroy(Request $request)
    {
        if ($request->id == 1) {
            return response()->json([
                'status'    => false,
                'message'   => 'Không thể xóa quyền ADMIN!'
            ]);
        }
        Role::find($request->id)->delete();

        return response()->json([
            'status'    => true,
            'message'   => 'Đã xóa quyền thành công!'
        ]);
    }

    public function search(Request $request)
    {
        $list = Role::select('quyens.*')
        ->where('ten_quyen', 'like', '%' . $request->key_search . '%')
            ->get();

        return response()->json([
            'list'  => $list
        ]);
    }

    public function deleteCheckbox(Request $request)
    {
        $x          = $this->checkRule(11);
        if ($x) {
            return response()->json([
                'status'    => 0,
                'message'   => 'Bạn không đủ quyền',
            ]);
        }
        $data = $request->all();
        $str = "";
        foreach ($data as $key => $value) {
            if (isset($value['check'])) {
                if ($value['id'] == 1 && $value['check'] == true) {
                    return response()->json([
                        'status'    => false,
                        'message'   => 'Vui lòng không chọn ADMIN để xóa thành công!',
                    ]);
                }
            }
            if (isset($value['check'])) {
                $str .= $value['id'] . ",";
            }

            $data_id = explode(",", rtrim($str, ","));

            foreach ($data_id as $k => $v) {
                $quyen = Role::where('id', $v);

                if ($quyen) {
                    $quyen->delete();
                } else {
                    return response()->json([
                        'status'    => false,
                        'message'   => 'Đã có lỗi sự cố!',
                    ]);
                }
            }
        }

        return response()->json([
            'status'    => true,
            'message'   => 'Đã xóa thành công!',
        ]);
    }

    public function Role(Request $request)
    {
        $quyen      =  Role::find($request->role_id);
        $list_id_role =  implode(",", $request->list_id_role);
         //dd($list_id_role);
        $quyen->update([
            'list_id_role' => $list_id_role
        ]);

        return response()->json([
            'status'  => true,
            'message' => "Cập nhập phân quyền cho Quyền " . $quyen->role_name . " thành công!",
        ]);
    }
}
