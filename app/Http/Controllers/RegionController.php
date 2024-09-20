<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateRegionRequest;
use App\Http\Requests\UpdateRegionRequest;
use App\Models\Region;
use Illuminate\Http\Request;

class RegionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.page.region.index');
    }
    public function getdata()
    {
        $data = Region::get();
        return response()->json([
            "list" => $data

        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(CreateRegionRequest $request)
    {
        //dd($request->all());
        $data = $request->all();
        $check = Region::Where("region_slug", $request->region_slug)->first();
        if (!$check) {
            Region::create($data);
            return response()->json([
                "status" => true,
                "message" => "đã tạo mới thành công",

            ]);
        }
    }
    public function changeStatus(Request $request)
    {
        $region = Region::find($request->id);
        if ($region) {
            $region->status = !$region->status;
            $region->save();
            return response()->json([
                'status'    => true,
                'message'   => 'Đã đổi trạng thái thành công!'
            ]);
        } else {
            return response()->json([
                'status'    => false,
                'message'   => 'Đã đổi trạng thái không thành công!'
            ]);
        }
    }


    /**
     * Store a newly created resource in storage.
     */


    /**
     * Display the specified resource.
     */


    /**
     * Show the form for editing the specified resource.
     */
    public function Edit(Request $request)
    {
        $region = Region::find($request->id);
        if ($region) {
            return response()->json([
                'status'    => true,
                'message'   => 'Đã lấy được dữ liệu!',
                'region'    => $region,
            ]);
        } else {
            return response()->json([
                'status'    => false,
                'message'   => 'dữ liệu không tồn tại!'
            ]);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateRegionRequest $request)
    {
        $region = Region::where("id", $request->id)->first();
        $data = $request->all();
        $region->update($data);
        return response()->json([
            'status'    => true,
            'message'   => 'Đã cập nhật được thông tin!',
        ]);
    }
    public function Delete(Request $request)
    {
        $region = Region::find($request->id);
        $region->delete();
        return response()->json([
            'status'    => true,
            'message'   => 'Đã xóa khu vực thành công!'
        ]);
    }
    public function destroyall(Request $request)
    {
        // dd($request->all());
        $data = $request->all();
        $str = "";
        foreach ($data as $key => $value) {
            if (isset($value["check"])) {
                $str .= $value["id"] . ",";
            }
            $data_id = explode(",", rtrim($str, ","));

            foreach ($data_id as $k => $v) {
                $region = Region::where("id", $v);
                if ($region) {
                    $region->delete();

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
    public function checkSlug(Request $request){
        if (isset($request->id)) {
            $check = Region::where('region_slug', $request->region_slug)
                ->where('id', '<>', $request->id)
                ->first();
        } else {
            $check = Region::where('region_slug', $request->region_slug)->first();
        }

        if ($check) {
            return response()->json([
                'status'    => false,
                'message'   => 'Tên khu đã tồn tại!',
            ]);
        } else {
            return response()->json([
                'status'    => true,
                'message'   => 'Tên khu có thể sử dụng!',
            ]);
        }
    }
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Region $region)
    {
        //
    }
}
