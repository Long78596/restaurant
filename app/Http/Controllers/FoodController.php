<?php

namespace App\Http\Controllers;

use App\Models\Food;
use App\Models\Category;
use Illuminate\Http\Request;

class FoodController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $cate = Category::all();
        return view('admin.page.food.index', compact("cate"));
    }
    public function getdata()
    {
        $list = Food::join("categories", "foods.category_id", "categories.id")
            ->select("foods.*", "categories.category_name")
            ->orderBy("foods.id")
            ->get();

        return response()->json([
            "list" => $list
        ]);
    }
    /**
     * Show the form for creating a new resource.
     */
    public function search(Request $request)
    {
        $list = Food::
        join("categories", "foods.category_id", "=", "categories.id")
        ->select("foods.*", "categories.category_name")
        ->where("title", "like", "%" . $request->key_search . "%")
            ->get();
            //dd($list);

        return response()->json([
            'list' => $list
        ]);
    }

    public function create(Request $request)
    {
        $data = $request->all();
        $request->validate([
            'title' => 'required|string|max:255',
            'price' => 'required|numeric',
            'status' => 'required|boolean',
            'category_id' => 'required|integer',
            'image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);
        // dd($data);
        $foods = new Food();
        $foods->title = $data["title"];
        $foods->price = $data["price"];
        $foods->status = $data["status"];
        $foods->category_id = $data["category_id"];

        $get_image = $request->image;
        $path = "public/image/food";
        $get_image_name = $get_image->getClientOriginalName();
        $name_image = current(explode(".", $get_image_name));
        $new_image = $name_image . rand(0, 999) . "." . $get_image->getClientOriginalExtension();
        $get_image->move($path, $new_image);
        $foods->image = $new_image;

        $foods->save();
        //dd($foods->save());

        return response()->json([
            "status" => true,
            "message" => "đã tạo mới thành công",

        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function changeStatus(Request $request)
    {
        $foods = Food::find($request->id);
        if ($foods) {
            $foods->status = !$foods->status;
            $foods->save();
            return response()->json([
                "status" => true,
                "message" => "đã đổi trạng thái thành công",

            ]);
        } else {
            return response()->json([
                "status" => false,
                "message" => "đã đổi trạng thái không thành công",

            ]);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Food $food)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function update(Request $request)
    {
        // Tìm món ăn theo ID
        $foods = Food::find($request->id);

        // Lấy toàn bộ dữ liệu từ request
        $data = $request->all();

        // Validate dữ liệu đầu vào
        $request->validate([
            'title' => 'required|max:255',
            'price' => 'required|numeric',
            'status' => 'required|boolean',
            'category_id' => 'required|integer',
             'image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $foods->title = $data["title"];
        $foods->price = $data["price"];
        $foods->status = $data["status"];
        $foods->category_id = $data["category_id"];

        // Xử lý ảnh
        if ($request->hasFile('image')) {
            $get_image = $request->file('image');
            $path = "public/image/food";
            $get_image_name = $get_image->getClientOriginalName();
            $name_image = current(explode(".", $get_image_name));
            $new_image = $name_image . rand(0, 999) . "." . $get_image->getClientOriginalExtension();
            $get_image->move($path, $new_image);

            $foods->image = $new_image;
        } else {
            $foods->image = $foods->getOriginal('image');
        }

        $foods->save();

        return response()->json([
            "status" => true,
            "message" => "Cập nhật thành công",
        ]);
    }
    public function checkSlug(Request $request)
    {
        if (isset($request->id)) {
            $check = Food::where("id", "<>", $request->id)
                ->where("title", $request->title)
                ->first();
        }  else {
            $check = Food::where("title", $request->title)
                ->first();
            return response()->json([
                "status" => true,
                "message" => "có thể sử dụng",
            ]);
        }
    }
    public function deleteAll(Request $request){
        $data=$request->all();
        $str= "";
        foreach($data as $key => $value){
            if(isset($data["check"])){
                $str .=$value["id"] . ",";
            }
            $data_id=explode(",",rtrim($str, ","));
            foreach($data_id as $key => $v){
                $foods=Food::where("id",$v);
                if($foods){
                    $foods->delete();
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
            'message'   => 'Thành công!',
        ]);
}


    /**
     * Update the specified resource in storage.
     */


    /**
     * Remove the specified resource from storage.
     */
    public function delete(Request $request)
    {
        $foods = Food::find($request->id);
        $foods->delete();
        return response()->json([
            "status" => true,
            "message" => "đã xóa thành công",

        ]);
    }
}
