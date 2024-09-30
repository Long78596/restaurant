<?php

namespace App\Http\Controllers;

use App\Models\Supplier;
use Illuminate\Http\Request;

class SupplierController extends Controller
{
    public function index()
    {
        return view('admin.page.suppliers.index');
    }
    public function getdata()
    {
        $list = Supplier::orderBy("id")->get();
        return response()->json([
            "data" => $list
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        $data = $request->all();
        //dd($data);
        $request->validate([
            'tax_code' => 'required|max:255',
            'company_name' => 'required|max:255|min:5',
            'phone_number' => 'required',
            'email' => 'required',
            'address' => 'required',
            'status' => 'required',

        ]);

        Supplier::create($data);
        return response()->json([
            "status" => true,
            "message" => "Đã thêm thành công",
        ]);
    }

    public function changeStatus(Request $request)
    {
        $check = Supplier::where("id", $request->id)->first();
        if ($check) {
            $check->status = !$check->status;
            return response()->json([
                "status" => true,
                "message" => "Đã đổi trạng thái thành công",
            ]);
        } else {
            return response()->json([
                "status" => false,
                "message" => "Đã đổi  trạng thái ko thành công",
            ]);
        }
    }
    public function checkSlug(Request $request)
    {
        if (isset($request->id)) {
            $check = Supplier::where("company_name", $request->company_name)
                ->where("id", "<>", $request->id)->first();
        } else {
            $check = Supplier::where("company_name", $request->company_name)
                ->first();
        }
        if ($check) {
            return response()->json([
                "status" => true,
                "message" => "có thể sử dụng",
            ]);
        } else {
            return response()->json([
                "status" => false,
                "message" => "đã tồn tại",
            ]);
        }
    }

    /**
     * Store a newly created resource in storage.
     */


    /**
     * Show the form for editing the specified resource.
     */


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        $request->validate([
            'tax_code' => 'required|max:255',
            'company_name' => 'required|max:255|min:5',
            'phone_number' => 'required',
            'email' => 'required',
            'address' => 'required',
            'status' => 'required',

        ]);
        $check = Supplier::where("id", $request->id)->first();
        $data = $request->all();
        $check->update($data);
        return response()->json([
            "status" => true,
            "message" => "Đã cập nhật  thành công",
        ]);
    }


    /**
     * Remove the specified resource from storage.
     */
    public function delete(Request $request)
    {
        $supplier = Supplier::find($request->id);
        $supplier->delete();
        return response()->json([
            "status" => true,
            "message" => "Đã xóa  thành công",
        ]);
    }

}
