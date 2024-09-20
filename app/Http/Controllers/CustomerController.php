<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.page.customer.index');
    }
    public function getdata(){
        $list=Customer::orderBy("id")->get();
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

            Customer::create($data);
            return response()->json([
                "status" => true,
                "message" => "Đã thêm thành công",
            ]);
        }

    public function changeStatus(Request $request)
    {
        $check = Customer::where("id", $request->id)->first();
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
            $check = Customer::where("customer_name", $request->customer_name)
                ->where("id", "<>", $request->id)->first();
        } else {
            $check = Customer::where("customer_name", $request->customer_name)
                ->first();
        }
        if($check){
            return response()->json([
                "status" => true,
                "message" => "có thể sử dụng",
            ]);
        }else{
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
        $check = Customer::where("id", $request->id)->first();
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
        $customer = Customer::find($request->id);
        $customer->delete();
        return response()->json([
            "status" => true,
            "message" => "Đã xóa  thành công",
        ]);
    }
    public function deleteAll(Request $request){
        $data=$request->all();
        $str= "";
        foreach($data as $key => $value){
             if(isset($data["check"])){
                $str .= $value[""] + ",";
             }
             $data_id =explode( ",", rtrim($str , ","));
             foreach($data_id as $k => $v){
                $customer = Customer::where("id", $v);
                if($customer){
                    $customer->delete();
                    return response()->json([
                        "status" => false,
                        "message" => "có lỗi đã xã ray",
                    ]);
                }

             }

        }
        return response()->json([
            "status" => true,
            "message" => "Đã xóa  thành công",
        ]);

    }
}
