<?php

namespace App\Http\Controllers;

use App\Models\OrderDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class OrderDetailController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view("admin.page.kitchen.index");
    }
    public function GetMenu()
    {
        $data = OrderDetail::where("is_prepared", 0)
            ->where("is_served", 1)
            ->join("orders", "order_details.order_id", "orders.id")
            ->join("tables", "orders.table_id", "tables.id")
            ->select("order_details.*", "tables.table_name",)
            ->orderBy("order_details.id")
            ->get();

        // dd($data);
        return response()->json([
            "list" => $data,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function Updatekitchen(Request $request)
    {
        $orderdetail = OrderDetail::find($request->id);
        //dd($orderdetail );
        if ($orderdetail && $orderdetail->is_prepared == 0) {
            $orderdetail->is_prepared = 1;
            //$orderdetail->preparation_time=strtotime(Carbon::now()- strtotime($orderdetail->created_at));
            $orderdetail->save();
            return response()->json([
                "status" => true,
                "message" => "đã hoàn thành món ăn!",
            ]);
        } else {
            return response()->json([
                "status" => false,
                "message" => "Hệ thống đã gặp sự cố!",
            ]);
        }
    }

    public function updateall(Request $request)
    {
        $data = $request->all();
        $str = "";
        foreach ($data as $key => $value) {
            if (isset($value["check"])) {
                $str .= $value["id"] . ",";
            }
            $data_id = explode(",", rtrim($str, ","));
            foreach ($data_id  as $k => $v) {
                $kitchen = OrderDetail::where("id", $v)->first();
                if ($kitchen) {
                    $kitchen->delete();
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
