<?php

use App\Http\Controllers\RegionController;
use App\Http\Controllers\TableController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\FoodController;
use App\Http\Controllers\CustomerController;
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
