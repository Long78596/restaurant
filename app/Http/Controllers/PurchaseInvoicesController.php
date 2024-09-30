<?php

namespace App\Http\Controllers;

use App\Models\Purchase_Invoices;
use App\Models\Purchase_Invoice_Detail;
use App\Models\Food;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use PHPViet\NumberToWords\Transformer;
use Illuminate\Support\Str;

class PurchaseInvoicesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view("admin.page.import.index");
    }



    public function data()
    {
        $data = Purchase_Invoice_Detail::where('purchase_invoice_id', 0)
            ->where('status', 0)
            ->select('purchase__invoice__details.*')
            ->get();
        $grandtotal = 0;
        foreach ($data as $key => $value) {
            $grandtotal = $grandtotal + $value->total_amount;
        }
        $transformer = new Transformer();

        return response()->json([
            'data'      => $data,
            'grandtotal' => $grandtotal,
            'tien_chu'  => $transformer->toCurrency($grandtotal),
        ]);
    }
    public function addProduct(Request $request)
    {
        $food = Food::find($request->id);
        //dd($food);
        $importdetail = Purchase_Invoice_Detail::where("food_id", $food->id)
            ->where("status", 0)
            ->where("purchase_invoice_id", 0)
            ->first();
        //dd($importdetail);
        if ($importdetail) {
            $importdetail->input_quantity  = $importdetail->input_quantity + 1;
            $importdetail->total_amount   = $importdetail->input_quantity * $importdetail->import_price;
            $importdetail->save();
        } else {
            // dd($importdetail);
            Purchase_Invoice_Detail::create([
                "food_id" => $food->id,
                "food_name" => $food->title,
                "input_quantity" => 1,
                "import_price" => $food->price,
                "total_amount" => $food->price * $food->quantity,
                "purchase_invoice_id" => 0,
            ]);
        }



        return response()->json([
            'status' => true,
            'message' => "Thêm mới món ăn vào hóa đơn nhập hàng thành công!"
        ]);
    }

    public function deleteProduct(Request $request)
    {
        $importdetail = Purchase_Invoice_Detail::find($request->id);
        $importdetail->delete();
        return response()->json([
            'status' => true,
            'message' => "Xóa món ăn khỏi hóa đơn nhập thành công!"
        ]);
    }
    public function updateProduct(Request $request)
    {
        $importdetail = Purchase_Invoice_Detail::find($request->id);
        if ($importdetail && $importdetail->status == 0) {
            $importdetail->update([
                'input_quantity' => $request->input_quantity,
                'import_price'  => $request->import_price,
                'total_amount'    => $request->import_price * $request->input_quantity,
                'note'       => $request->note
            ]);
            return response()->json([
                'status'    => 1,
                'message'   => 'Đã cập nhật món ăn thành công!',
            ]);
        } else {
            return response()->json([
                'status'    => 0,
                'message'   => 'Có lỗi không mong muốn xảy ra!',
            ]);
        }
    }
    public function importproduct(Request $request)
    {
        $data = $request->all();
        $data["purchase_invoice_code"] = Str::uuid();
        $data["purchase_date"] = Carbon::now();
        $chiTietNhapHang = Purchase_Invoice_Detail::where('purchase_invoice_id', 0)
            ->where('status', 0)
            ->get();
        if (count($chiTietNhapHang) > 0) {
            $import = Purchase_Invoices::create($data);

            if ($import) {
                foreach ($chiTietNhapHang as $key => $value) {
                    $value->purchase_invoice_id = $import->id;
                    $value->status = 1;
                    $value->save();
                }
                return response()->json([
                    'status'    => 1,
                    'import'  => $import,
                    'message'   => 'Đã nhập hàng thành công!',
                ]);
            } else {
                return response()->json([
                    'status'    => 0,
                    'message'   => 'Đã có lỗi hệ thống!',
                ]);
            }
        } else {
            return response()->json([
                'status'    => 0,
                'message'   => 'Hóa đơn hàng này đã được người khác nhập!',
            ]);
        }
    }
}
