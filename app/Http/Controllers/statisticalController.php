<?php

namespace App\Http\Controllers;

use App\Models\OrderDetail;
use Illuminate\Http\Request;

class statisticalController extends Controller
{

     public function index(){
        return view("admin.page.thong-ke.index");
     }
    public function Total()
    {
        $data = OrderDetail::where("is_prepared", 1)
            ->where("is_printed_to_kitchen", 1)
            ->where("is_served", 1)
            ->join("orders", "order_details.order_id", "orders.id")
            ->selectRaw("sum(order_details.total_amount) as total_sale, Sum(order_details.quantity_sold) as total_quantity")
            ->first();

        $customer = OrderDetail::where("is_prepared", 1)
            ->where("is_printed_to_kitchen", 1)
            ->where("is_served", 1)
            ->join("orders", "order_details.order_id", "orders.id")
            ->join("foods", "order_details.food_id", "foods.id")
            ->selectRaw("foods.title,Sum(order_details.total_amount) as total_sale , Sum(order_details.quantity_sold) as total_quantity")
            ->groupBy("foods.title")
            ->get();


        $totalProfit
            = OrderDetail::selectRaw('SUM(total_amount - discount_amount) as total_profit')
            ->where('is_prepared', 1)
            ->where('is_printed_to_kitchen', 1)
            ->where('is_served', 1)
            ->first();






        return   response()->json([
            "total_sale" => $data->total_sale,
            "total_quantity" => $data->total_quantity,
            "customer" => $customer,
            "total_profit" => $totalProfit->total_profit
        ]);
    }
}
