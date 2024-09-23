<?php

namespace App\Http\Controllers;

use App\Models\Food;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\Table;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.page.order.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function opentable(Request $request)
    {
        $table = Table::find($request->table_id);
        if (!$table) {
            return response()->json([
                "status" => false,
                "message" => "Không tìm thấy bàn"
            ]);
        }
        if ($table && $table->status == 1 && $table->state == 0) {
            $table->state = 1;
            $table->save();

            $order = Order::create([
                "sales_invoice_code" => Str::uuid(),
                "table_id" => $request->table_id
            ]);


            return response()->json([
                "status" => true,
                "message" => "bàn đã mở thành công",
            ]);
        } else {
            return response()->json([
                "status" => false,
                "message" => "Không thể mở bàn"
            ]);
        }
    }
    public function FindByIdTable(Request $request)
    {
        $order = Order::where("table_id", $request->table_id)
            ->where("status", 0)
            ->first();
        if ($order) {

            return response()->json([
                "status" => true,
                "order_id" => $order->id,
                "order"   => $order

            ]);
        } else {
            return response()->json([
                "status" => false,
                "order_id" => 0,
            ]);
        }
    }
    public function AddMonbyorder(Request $request)
    {
        $order = Order::find($request->order_id);

        if ($order->status) {
            return response()->json([
                "status" => false,
                "message" => "Hóa đơn đã tính tiền"
            ]);
        } else {
            $food = Food::find($request->food_id);

            $order_id = $request->order_id;
            $food_id = $request->food_id;

            $check = OrderDetail::where("order_id",  $request->order_id)
                ->where("food_id", $food_id)
                ->first();

            if ($check) {
                $check->quantity_sold += 1;
                $check->total_amount = $check->quantity_sold * $check->sale_price - $check->discount_amount;
                $check->save();
            } else {
                OrderDetail::create([
                    "order_id" => $order_id,
                    "food_id" => $food_id,
                    "food_name" => $food->title,
                    "quantity_sold" => 1,
                    "sale_price" => $food->price,
                    "discount_amount" => 0,
                    "total_amount" => $food->price,
                ]);
            }

            return response()->json([
                'status' => 1,
                'message' => 'Đã thêm món thành công!',
            ]);
        }
    }

    public function LoadFoodBeOrder(Request $request)
    {
        $order = Order::find($request->order_id);

        if (!$order) {
            return response()->json([
                'status' => 0,
                'message' => 'Hóa đơn không tồn tại!',
            ]);
        }

        if ($order->status == 1) {
            return response()->json([
                'status' => 0,
                'message' => 'Hóa đơn này đã tính tiền!',
            ]);
        } else {
            $foods = OrderDetail::where('order_id', $request->order_id)->get();

            return response()->json([
                'status' => true,
                'list' => $foods,
            ]);
        }
    }

}
