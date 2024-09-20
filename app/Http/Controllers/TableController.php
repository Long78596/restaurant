<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateRegionRequest;
use App\Http\Requests\createTablerequest;
use App\Http\Requests\UpdateTableRequest;
use App\Models\Table;
use App\Models\Region;
use Illuminate\Http\Request;

class TableController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $region=Region::all();
        return view('admin.page.table.index',compact("region"));
    }
    public function getdata()
    {
        $data = Table::join("regions", "tables.region_id", "regions.id")
                       ->select("tables.*", "regions.region_name")
                       ->orderBy("tables.id")
                       ->get();
        return response()->json([
            "list" => $data,
        ]);
    }
    /**
     * Show the form for creating a new resource.
     */
    public function create(createTablerequest $request)
    {
        $data = $request->all();

        $check = Table::where("table_name", $request->table_name)->first();

        if (!$check) {
            Table::create($data);
            return response()->json([
                "status" => true,
                "message" => "đã tạo mới thành công",

            ]);
        } else {
            return response()->json([
                "status" => false,
                "message" => "không thành công",

            ]);
        }
    }
    public function changeStatus(Request $request)
    {
        $table = Table::where("id", $request->id)->first();
        if ($table) {
            $table->status = !$table->status;
            $table->save();
            return response()->json([
                "status" => true,
                "message" => "đã tạo đổi trạng thái thành công",

            ]);
        } else {
            return response()->json([
                "status" => false,
                "message" => "đã tạo đổi không trạng thái thành công",

            ]);
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Table $table)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Table $table)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateTableRequest $request)
    {
        $table = Table::where("id", $request->id)->first();
        $data = $request->all();
        $table->update($data);
        return response()->json([
            "status" => true,
            "message" => "đã cập nhật  thành công",

        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function delete(Request $request)
    {
        $table = Table::find($request->id);
        $table->delete();
        return response()->json([
            'status'    => true,
            'message'   => 'Đã xóa  thành công!'
        ]);
    }
    public function checkSlug(Request $request)
    {
        if (isset($request->id)) {
            $table = Table::where("id", "<>", $request->id)
                ->where("table_slug", $request->table_slug)->first();
        } else {
            $table = Table::where("table_slug", $request->table_slug)->first();
        }
        if ($table) {
            return response()->json([
                'status'    => false,
                'message'   => 'Tên bàn  đã tồn tại!'
            ]);
        } else {
            return response()->json([
                'status'    => true,
                'message'   => 'Tên bàn có thể  sử dụng!'
            ]);
        }
    }
    public function destroyAll(Request $request)
    {
        $data = $request->all();
        $str = "";
        foreach ($data as $key => $value) {
            if (isset($value["check"])) {
                $str .= $value["id"] . ",";
            }
            $data_id = explode(",", rtrim($str, ","));
            foreach ($data_id as $k => $v) {
                $table = Table::where("id", $v);
                if ($table) {
                    $table->delete();
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
}
