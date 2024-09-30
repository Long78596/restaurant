<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Food;
use App\Models\OrderDetail;
use App\Models\Table;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use PHPViet\NumberToWords\Transformer;

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
            foreach ($data_id  as $v => $k) {
                $kitchen = OrderDetail::where("id", $k)->first();
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
    public function indexreal()
    {
        return view("admin.page.real.index");
    }
    public function GetMenuReal()
    {
        $list = OrderDetail::where("is_prepared", 1)
            ->where("is_served", 1)
            ->where("is_printed_to_kitchen", 0)
            ->join("orders", "order_details.order_id", "orders.id")
            ->join("tables", "orders.table_id", "tables.id")
            ->select("order_details.*", "tables.table_name",)
            ->orderBy("order_details.id")
            ->get();
            return response()->json([
            'status'    => 1,
            'list'   => $list,
            ]);
    }
    public function UpdateReal(Request $request){
        $orderdetail=OrderDetail::find($request->id);
        if($orderdetail && $orderdetail->is_prepared ==1 && $orderdetail->is_printed_to_kitchen==0){
            $orderdetail->is_printed_to_kitchen=1;
            $orderdetail->save();
            return response()->json([
                'status'    => true,
                'message'   => 'Đã tiếp thực món ăn',
            ]);
        }else{
            return response()->json([
                'status'    => false,
                'message'   => 'Hệ thống đã có sự cố',
            ]);
        }

    }
    public function Updatealldelete(Request $request){
        $data=$request->all();
       // dd($data);
        $str = "";
        foreach($data as $key =>$value){
            if(isset($value["check"])){
                $str .= $value["id"]  . ",";
            }
           // dd($str);
            $data_id=explode(",",rtrim($str , ","));
            //dd($data_id);
            foreach($data_id as $v =>$k){
                $isset_id=OrderDetail::where("id", $k)->first();
              // dd($isset_id);
                if($isset_id){
                    $isset_id->delete();
                }else{
                    return response()->json([
                        'status'    => true,
                        'message'   => 'Đã xóa  món thành công!',
                    ]);
                }
            }
        }
        return response()->json([
            'status'    => true,
            'message'   => 'Đã xóa  món thành công!',
        ]);

    }
    public function listtable(Request $request){
        $order=Order::where("table_id",$request->id_table)->where("status", 0)->first();
        //dd($order);
      if($order){
        $orderdetail=OrderDetail::where("order_id",$order->id)->get();
        //dd($orderdetail);

            return response()->json([
                'status'    => 1,
                'data'      => $orderdetail,
                'id_order'     => $order->id,
            ]);
        } else {
            return response()->json([
                'status'    => 0,
                'message'   => 'Hóa đơn này đã tính tiền!',
            ]);
        }
    }
    public function transfer(Request $request){
         $number_transfer=$request->number_transfer;
         $id_order=$request->id_order;
         //dd($number_transfer);
         //dd($id_order);
         $order=Order::find($request->order_id);
         //dd($order);
         if($order && $order->status==0){
            //dd($order && $order->status==0);
           //dd($number_transfer > 0 && $number_transfer == $request->quantity_sold);
            if($number_transfer>0 && $number_transfer == $request->quantity_sold){
           $orderdetail=OrderDetail::find($request->id);
           $orderdetail->order_id=$id_order;
           $space=$orderdetail->note ?  ":" : '';
           $orderdetail->note = 'Chuyển món từ hóa đơn ' . $orderdetail->order_id . ' sang' . $space .  $orderdetail->ghi_chu;
           $orderdetail->save();
          // dd($orderdetail->save());
                return response()->json([
                    'status'    => 1,
                    'message'   => 'Đã chuyển món thành công!',
                ]);

            } else
            //dd($number_transfer > 0 && $number_transfer < $request->quantity_sold);

            if($number_transfer > 0 && $number_transfer < $request->quantity_sold){
                $orderdetail = OrderDetail::find($request->id);
               $price =$orderdetail->sale_price;
               $part_1_discount=$orderdetail->discount_amount / $orderdetail->quantity_sold;
               $orderdetail->quantity_sold=$number_transfer;
               $discount_amount=$part_1_discount * $orderdetail->quantity_sold;
               $total_amount= $orderdetail->quantity_sold * $price - $discount_amount;
               $orderdetail->discount_amount=$discount_amount;
               //dd($orderdetail->save());
               $orderdetail->save();
                $space      =  $orderdetail->note ? ": " : '';

            OrderDetail::create([
                    'order_id'       =>  $id_order,
                    'food_id'                 =>  $orderdetail->food_id,
                    'food_name'                =>  $orderdetail->food_name,
                    'quantity_sold'              =>  $number_transfer,
                    'sale_price'               =>  $orderdetail->sale_price,
                    'discount_amount'           =>  $part_1_discount * $number_transfer,
                    'total_amount'                =>  $number_transfer * $orderdetail->price - $part_1_discount * $number_transfer,
                    'note'                   =>  'Chuyển món từ hóa đơn ' . $orderdetail->order_id . ' sang' . $space .  $orderdetail->note,
                    'is_served'               =>  $orderdetail->is_served,
                    'is_prepared'              =>  $orderdetail->is_prepared,
                    'is_printed_to_kitchen'                 =>  $orderdetail->is_printed_to_kitchen,
                ]);

                return response()->json([
                    'status'    => 1,
                    'message'   => 'Đã chuyển món thành công!',
                ]);

            }

         }else{
            return response()->json([
                'status'    => 0,
                'message'   => 'Hóa đơn này đã tính tiền!',
            ]);
         }
    }
    public function TotalSellByIdFood($food_id){
        $total_sell=OrderDetail::join("orders", "order_details.order_id", "orders.id")
                                 ->where("food_id", $food_id)
                                 ->where("status",1)
                                 ->sum("quantity_sold");
        $food=Food::find($food_id);
        $food->tong_output=$total_sell;
        $food->save();
    }
    public function checkout(Request $request ){
      $order=Order::find($request->order_id);
     //dd($order);
     if($order && $order->status ==0){
       // dd($order && $order->status == 0);
       $data=OrderDetail::where("order_id",$request->order_id)->get();
       //dd($data);
       $total=0;
       foreach($data as $key=>$value){
         $total +=$value->total_amount;
         //dd($total);
         //dd($value->food_id);
         $this->TotalSellByIdFood($value->food_id);
         //dd( $this->TotalSellByIdFood($value->food_id));
       }
       OrderDetail::where("order_id",$request->order_id)->update([
                'is_prepared'   =>  1,
                'is_printed_to_kitchen'      =>  1,
                'is_served'      =>  1,
       ]);
            $order->status = 0;
       //dd( $order->total_amount=$total-$order->discount);
        $order->total_amount=$total-$order->discount;
        $order->save();

            $table = Table::find($request->id_table);
            if ($table) {
                $table->status = 0;
                $table->state = 0;  // Set table status to 1 after checkout
                $table->save();
            }
        //dd( $table->save());



      return response()->json([
                'status'    => 1,
                'message'   => 'Đã thanh toán thành công!',
            ]);
        } else {
            return response()->json([
                'status'    => 0,
                'message'   => 'Hóa đơn này đã tính tiền!',
            ]);
        }
    }
    public function InBill($id){
        $orderdetail=Orderdetail::where("order_id",$id)->get();
        $total=0;
        foreach($orderdetail as $key => $value){
            $total +=$value->toatl_amount;
        }
        $transformer = new Transformer();
        $order=Order::find($id);
        $discount=$order->discount;
        $total_amount=$total -$discount;
        $written      = $transformer->toCurrency($total_amount);


        return view("admin.page.admin.checkout",compact("orderdetail", "total", "total_amount", "discount", "order"));
    }
}
