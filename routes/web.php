<?php

use App\Http\Controllers\RegionController;
use App\Http\Controllers\statisticalController;
use App\Http\Controllers\TableController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\FoodController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\OrderDetailController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\SupplierController;
use App\Http\Controllers\PurchaseInvoicesController;
use App\Http\Controllers\RoleController;
use App\Models\OrderDetail;
use App\Models\Region;
use Illuminate\Support\Facades\Route;

Route::get('/',[statisticalController::class, "index"]);
Route::get("/admin/login", [AdminController::class, "login"])->name("login");
Route::post("/admin/actionlogin", [AdminController::class, "actionlogin"])->name("login");
Route::group(
    ['prefix' => '/admin', "middleware" => "CheckAdminLogin"],
    function () {
        Route::get("/logout", [AdminController::class, "logout"])->name("logout");


        Route::group(["prefix" => "/region"], function () {
            Route::get("/index", [RegionController::class, "index"])->name("index");
            Route::get("/data", [RegionController::class, "getdata"])->name("data");
            Route::post("/create", [RegionController::class, "create"])->name("create");
            Route::post("/changeStatus", [RegionController::class, "changeStatus"])->name("changeStatus");
            Route::get("/Edit", [RegionController::class, "Edit"])->name("Edit");
            Route::post("/Update", [RegionController::class, "Update"])->name("Update");
            Route::post("/delete", [RegionController::class, "Delete"])->name("delete");
            Route::post("/deleteAll", [RegionController::class, "destroyall"])->name("deleteAll");
            Route::post("/checkSlug", [RegionController::class, "checkSlug"])->name("checkSlug");
        });
        Route::group(["prefix" => "/table"], function () {
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
        Route::group(["prefix" => "/category"], function () {
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
        Route::group(["prefix" => "/food"], function () {
            Route::get("/index", [FoodController::class, "index"])->name("index");
            Route::get("/data", [FoodController::class, "getdata"])->name("data");
            Route::post("/create", [FoodController::class, "create"])->name("create");
            Route::post("/changeStatus", [FoodController::class, "changeStatus"])->name("changeStatus");
            Route::get("/Edit", [FoodController::class, "Edit"])->name("Edit");
            Route::post("/Update", [FoodController::class, "update"])->name("Update");
            Route::post("/delete", [FoodController::class, "delete"])->name("delete");
            Route::post("/deleteAll", [FoodController::class, "destroyAll"])->name("deleteAll");
            Route::post("/checkSlug", [FoodController::class, "checkSlug"])->name("checkSlug");
            Route::post("/Search", [FoodController::class, "search"])->name("search");
        });
        Route::group(["prefix" => "/customer"], function () {
            Route::get("/index", [CustomerController::class, "index"])->name("index");
            Route::get("/data", [CustomerController::class, "getdata"])->name("data");
            Route::post("/create", [CustomerController::class, "create"])->name("create");
            Route::post("/changeStatus", [CustomerController::class, "changeStatus"])->name("changeStatus");
            Route::post("/Update", [CustomerController::class, "update"])->name("Update");
            Route::post("/delete", [CustomerController::class, "delete"])->name("delete");
            Route::post("/deleteAll", [CustomerController::class, "destroyAll"])->name("deleteAll");
            Route::post("/checkSlug", [CustomerController::class, "checkSlug"])->name("checkSlug");
        });
        Route::group(["prefix" => "/supplier"], function () {
            Route::get("/index", [SupplierController::class, "index"])->name("index");
            Route::get("/data", [SupplierController::class, "getdata"])->name("data");
            Route::post("/create", [SupplierController::class, "create"])->name("create");
            Route::post("/changeStatus", [SupplierController::class, "changeStatus"])->name("changeStatus");
            Route::post("/Update", [SupplierController::class, "update"])->name("Update");
            Route::post("/delete", [SupplierController::class, "delete"])->name("delete");
            Route::post("/deleteAll", [SupplierController::class, "destroyAll"])->name("deleteAll");
            Route::post("/checkSlug", [SupplierController::class, "checkSlug"])->name("checkSlug");
        });
        Route::group(["prefix" => "/order"], function () {
            Route::get("/index", [OrderController::class, "index"])->name("index");
            Route::post("/opentable", [OrderController::class, "opentable"])->name("opentable");
            Route::post("/findByIdTable", [OrderController::class, "FindByIdTable"])->name("ByIdBan");
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
            Route::get("/get-real", [OrderDetailController::class, "indexreal"])->name("index");
            Route::get("/get-menu-real", [OrderDetailController::class, "GetMenuReal"])->name("GetMenuserve");
            Route::post("/update-real", [OrderDetailController::class, "UpdateReal"]);
            Route::post("/update-real-all", [OrderDetailController::class, "Updatealldelete"]);
            Route::post("/list-of-items-by-table-id", [OrderDetailController::class, "listtable"])->name("2");
            Route::post("/transfer-food", [OrderDetailController::class, "transfer"])->name("3");
            Route::post("/check-out", [OrderDetailController::class, "checkout"])->name("4");
            Route::get("/in-bill/{id}", [OrderDetailController::class, "InBill"])->name("5");
        });
        Route::group(["prefix" => "/import"], function () {
            Route::get("/index", [PurchaseInvoicesController::class, "index"])->name("index");
            Route::post("/addproductimport", [PurchaseInvoicesController::class, "addProduct"]);
            Route::post("/deleteproductimport", [PurchaseInvoicesController::class, "deleteProduct"]);
            Route::post("/updateproductimport", [PurchaseInvoicesController::class, "updateProduct"]);
            Route::post("/importproduct", [PurchaseInvoicesController::class, "importproduct"]);
            Route::get("/data", [PurchaseInvoicesController::class, "data"]);
        });
        Route::group(["prefix"=> "/admin"], function(){
            Route::get('/index', [AdminController::class, 'index']);

            Route::post('/create', [AdminController::class, 'store']);
            Route::get('/data', [AdminController::class, 'getData']);
            Route::post('/delete', [AdminController::class, 'destroy']);
            Route::post('/update', [AdminController::class, 'update']);
            Route::post('/change-password', [AdminController::class, 'changePassword']);
        });
        Route::group(['prefix' => '/role'], function () {
            Route::get('/index', [RoleController::class, 'index']);
            Route::get('/data', [RoleController::class, 'getData']);
            Route::get('/data-role', [RoleController::class, 'getDataRole']);
            Route::post('/delete', [RoleController::class, 'destroy']);
            Route::post('/create', [RoleController::class, 'store']);
            Route::post('/update', [RoleController::class, 'update']);
            Route::post('/search', [RoleController::class, 'search']);
            Route::post('/delete-all', [RoleController::class, 'deleteCheckbox']);
            Route::post('/role', [RoleController::class, 'role']);
        });
        Route::group(["prefix"=> "/staticis"], function(){
            Route::get("/index",[statisticalController::class, "Index"]);
            Route::get("/total", [statisticalController::class, "Total"]);

        });
    }
);
