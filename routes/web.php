<?php

use App\Http\Controllers\RegionController;
use App\Http\Controllers\TableController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\FoodController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\OrderDetailController;
use App\Models\OrderDetail;
use App\Models\Region;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return "Trang chủ đang hoạt động!";
});

Route::group(["prefix"=> "admin/region"], function(){
     Route::get("/index", [RegionController::class, "index"])->name("index");
    Route::get("/data", [RegionController::class, "getdata"])->name("data");
    Route::post("/create", [RegionController::class, "create"])-> name("create");
    Route::post("/changeStatus", [RegionController::class, "changeStatus"])->name("changeStatus");
    Route::get("/Edit", [RegionController::class, "Edit"])->name("Edit");
    Route::post("/Update", [RegionController::class, "Update"])->name("Update");
    Route::post("/delete", [RegionController::class, "Delete"])->name("delete");
    Route::post("/deleteAll", [RegionController::class, "destroyall"])->name("deleteAll");
    Route::post("/checkSlug", [RegionController::class, "checkSlug"])->name("checkSlug");
});
Route::group(["prefix" => "admin/table"], function(){
    Route::get("/index", [TableController::class, "index"])->name("index");
    Route::get("/data", [TableController::class, "getdata"])->name("data");
    Route::post("/create", [TableController::class, "create"])->name("create");
    Route::post("/changeStatus", [TableController::class, "changeStatus"])->name("changeStatus");
    Route::get("/Edit", [TableController::class, "Edit"])->name("Edit");
    Route::post("/Update", [TableController::class, "Update"])->name("Update");
    Route::post("/delete", [TableController::class, "Delete"])->name("delete");
    Route::post("/deleteAll", [TableController::class, "destroyAll"])->name("deleteAll");
    Route::post("/checkSlug", [TableController::class, "checkSlug"])->name("checkSlug");
});
Route::group(["prefix" => "admin/category"], function () {
    Route::get("/index", [CategoryController::class, "index"])->name("index");
    Route::get("/data", [CategoryController::class, "getdata"])->name("data");
    Route::post("/create", [CategoryController::class, "create"])->name("create");
    Route::post("/changeStatus", [CategoryController::class, "changeStatus"])->name("changeStatus");
    Route::get("/Edit", [CategoryController::class, "Edit"])->name("Edit");
    Route::post("/Update", [CategoryController::class, "update"])->name("Update");
    Route::post("/delete", [CategoryController::class, "delete"])->name("delete");
    Route::post("/deleteAll", [CategoryController::class, "destroyAll"])->name("deleteAll");
    Route::post("/checkSlug", [CategoryController::class, "checkSlug"])->name("checkSlug");
});
Route::group(["prefix" => "admin/food"], function () {
    Route::get("/index", [FoodController::class, "index"])->name("index");
    Route::get("/data", [FoodController::class, "getdata"])->name("data");
    Route::post("/create", [FoodController::class, "create"])->name("create");
    Route::post("/changeStatus", [FoodController::class, "changeStatus"])->name("changeStatus");
    Route::get("/Edit", [FoodController::class, "Edit"])->name("Edit");
    Route::post("/Update", [FoodController::class, "update"])->name("Update");
    Route::post("/delete", [FoodController::class, "delete"])->name("delete");
    Route::post("/deleteAll", [FoodController::class, "destroyAll"])->name("deleteAll");
    Route::post("/checkSlug", [FoodController::class, "checkSlug"])->name("checkSlug");
});
Route::group(["prefix" => "admin/customer"], function () {
    Route::get("/index", [CustomerController::class, "index"])->name("index");
    Route::get("/data", [CustomerController::class, "getdata"])->name("data");
    Route::post("/create", [CustomerController::class, "create"])->name("create");
    Route::post("/changeStatus", [CustomerController::class, "changeStatus"])->name("changeStatus");
    Route::post("/Update", [CustomerController::class, "update"])->name("Update");
    Route::post("/delete", [CustomerController::class, "delete"])->name("delete");
    Route::post("/deleteAll", [CustomerController::class, "destroyAll"])->name("deleteAll");
    Route::post("/checkSlug", [CustomerController::class, "checkSlug"])->name("checkSlug");
});
Route::group(["prefix"=> "admin/order"], function() {
    Route::get("/index", [OrderController::class, "index"])->name("index");
    Route::post("/opentable", [OrderController::class, "opentable"])->name("opentable");
    Route::post("/findByIdTable", [OrderController::class, "FindByIdTable" ])->name("ByIdBan");
    Route::post("/AddMonByorder", [OrderController::class, "AddMonByorder"])->name("AddMonByorder");
    Route::post("/LoadFoodBeOrder", [OrderController::class, "LoadFoodBeOrder"])->name("LoadMonByorder");
    Route::post("/update", [OrderController::class, "update"])->name("update");
    Route::post("/deletedetailorder", [OrderController::class, "deleteorder"])->name("delete");
    Route::post("/updatediscount", [OrderController::class, "updatedetail"])->name("updatedetail");
    Route::post("/Confirmcustomer", [OrderController::class, "Confirmcustomer"])->name("Confirmcustomer");
    Route::post("/In-Kitchen", [OrderController::class, "InKitChen"])->name("InKitChen");
    Route::get("/get-menu", [OrderDetailController::class, "index"])->name("index");
    Route::get("/get-menu-in-serverd", [OrderDetailController::class, "GetMenu"])->name("GetMenuserve");
    Route::post("/update-kitchen", [OrderDetailController::class, "Updatekitchen"]);
    Route::post("/update-all", [OrderDetailController::class, "Updateall"]);

});
