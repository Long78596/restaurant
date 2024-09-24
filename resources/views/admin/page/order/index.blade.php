@extends('share.master')
@section('noi_dung')
    <div id="app" class="row">
        <template v-for="(value, key) in list" v-if="value.status==1">


            <div class="col-md-2">
                <div class="card">
                    <div class="card-body text-center">
                        <p v-if="value.state ==0" class="text-uppercase"><b>Bàn @{{ value.table_name }}</b></p>
                        <p v-else-if="value.state ==1" class="text-uppercase text-primary"><b>Bàn @{{ value.table_name }}</b>
                        </p>
                        <p v-else-if="value.state ==2" class="text-uppercase text-danger"><b>Bàn @{{ value.table_name }}</b>
                        </p>
                        <i data-bs-toggle="modal" data-bs-target="#chiTietModal" v-if="value.state ==0"
                            v-on:click="OpenTable(value.id);FindByIdTable(value.id)"
                            class="fa-solid fa-square-xmark fa-5x"></i>
                        <i data-bs-toggle="modal" data-bs-target="#chiTietModal" v-else-if="value.state ==1"
                            v-on:click="FindByIdTable(value.id)" class="fa-solid fa-bowl-food fa-5x text-primary"
                            v-on:click="FindByIdTable(value.id)"></i>
                        <i data-bs-toggle="modal" data-bs-target="#chiTietModal" v-else-if="value.state ==2"
                            class="fa-solid fa-money-bill-wheat fa-5x text-warning"></i>
                    </div>
                    <div class="card-footer text-end">
                        <div role="group" aria-label="Basic example" class="btn-group">
                            <div v-if ="value.state > 0" class="btn-group"><button type="button"
                                    class="btn btn-outline-primary" fdprocessedid="5wv6j">Đã mở bàn</button>

                            </div>
                            <div v-else class="btn-group">
                                <button v-on:click="OpenTable(value.id)" type="button" class="btn btn-outline-secondary">Mở
                                    bàn !</button>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </template>





        <div id="chiTietModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" class="modal fade">
            <div class="modal-dialog" style="max-width: 100%;">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 id="exampleModalLabel" class="modal-title fs-5">Chi Tiết Bán Hàng </h1> <button type="button"
                            data-bs-dismiss="modal" aria-label="Close" class="btn-close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-5">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="table-responsive" style="max-height: 700px;">
                                            <table class="table table-bordered">
                                                <thead>
                                                    <tr>
                                                        <th class="align-middle">Tìm kiếm</th>
                                                        <th colspan="4"><input type="text" class="form-control">
                                                        </th>
                                                        <th class="text-center text-white"><button class="btn btn-info">Tìm
                                                                Kiếm</button></th>
                                                    </tr>
                                                    <tr>
                                                        <th class="align-middle text-center">#</th>
                                                        <th class="align-middle text-center">Tên Món</th>
                                                        <th class="align-middle text-center">
                                                            Đơn Giá
                                                            <i class="text-success fa-solid fa-spinner fa-pulse"></i>
                                                        </th>
                                                        <th class="align-middle text-center">ĐVT</th>
                                                        <th class="align-middle text-center">Tên Danh Mục</th>
                                                        <th class="align-middle text-center">Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <template v-for="(value, key) in list_food">
                                                        <tr>
                                                            <th class="text-center align-middle">@{{ key + 1 }}</th>
                                                            <td class="align-middle">@{{ value.title }}</td>
                                                            <td class="align-middle">@{{ number_format(value.price) }}</td>
                                                            <td class="align-middle">kg</td>
                                                            <td class="align-middle">@{{ value.category_name }}</td>
                                                            <td class="text-center"><button class="btn btn-primary"
                                                                    v-on:click="AddMonByorderdetail(value.id)">Order</button>
                                                            </td>
                                                        </tr>
                                                    </template>


                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-7">
                                <div class="table-responsive">
                                    <table class="table table-bordered">
                                        <thead>
                                            <tr>
                                                <th colspan="3" class="align-middle">

                                                <select v-if="order.is_confirmed == 0" class="form-control" v-model="order.order_id">
                                                        <template v-for="(value, key) in list_customer">
                                                            <option v:bind:value="value.id">@{{ value.full_name }}</option>
                                                        </template>

                                                    </select>
                                                    <select v-else disabled="disabled" class="form-control" v-model="order.order_id">
                                                        <template v-for="(value, key) in list_customer">
                                                            <option v:bind:value="value.id">@{{ value.full_name }}</option>
                                                        </template>

                                                    </select>
                                                </th>
                                                <th class="align-middle text-nowrap text-center"><button
                                                        class="btn btn-primary" v-if="order.is_confirmed == 1" disabled>Xác Nhận</button>
                                                         <button v-else class="btn btn-primary" v-on:click="ComfiredCustomer()">Xác Nhận</button>
                                                         <a href="/admin/customer/index" class="btn btn-info" target="_blank">Thêm khách hàng mới</a>
                                                    </th>
                                                <th class="text-center align-middle">Tổng Tiền</th>
                                                <td class="align-middle"><b>@{{ number_format(total_amount) }}</b></td>
                                                <td class="align-middle"><i
                                                        class="text-capitalize">@{{ wrttien_money }}</i></td>
                                            </tr>
                                            <tr>
                                                <th class="text-center">#</th>
                                                <th class="text-center">Tên Món</th>
                                                <th class="text-center">Số Lượng</th>
                                                <th class="text-center">Đơn Giá</th>
                                                <th class="text-center">Chiết Khấu</th>
                                                <th class="text-center">Thành Tiền</th>
                                                <th class="text-center">Ghi Chú</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <template v-for="(value, key) in  list_food_by_order">
                                                <tr>
                                                    <template v-if="value.is_served">
                                                        <td class="align-middle">@{{ key + 1 }}
                                                        </td>
                                                    </template>
                                                    <template v-else>
                                                        <i class="fa-solid fa-trash-can text-danger"
                                                            v-on:click="deleteOrderDetail(value)"></i>
                                                    </template>
                                                    <td class="align-middle">@{{ value.food_name }}
                                                    </td>
                                                    <td class="align-middle text-center" style="width: 15%;">
                                                        <input v-on:change="update(value)" v-model="value.quantity_sold"
                                                            type="number" class="form-control text-center"
                                                            step="0.1" min="0.1">
                                                    </td>

                                                    <td class="align-middle text-center" style="width: 15%;">
                                                        <input v-on:change="update(value)" v-model="value.sale_price"
                                                            type="number" class="form-control text-center"
                                                            step="0.1" min="0.1">
                                                    </td>
                                                    <td>
                                                        <input v-on:change="update(value)" v-model="value.discount_amount"
                                                            type="number" class="form-control" min="0">
                                                    </td>

                                                    <td class="align-middle text-end">@{{ number_format(value.total_amount) }}</td>
                                                    <td class="align-middle" style="width: 25%;">
                                                        <input v-on:change="update(value)" v-model="value.note"
                                                            type="text" class="form-control">
                                                    </td>

                                                </tr>
                                            </template>
                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <th colspan="2" class="text-center">Giảm giá</th>
                                                <td colspan="2"><input type="text" v-on:change="updateDiscount()"
                                                        v-model="discount" class="form-control"></td>
                                                <th class="text-center">Thực trả</th>
                                                <th class="text-danger">
                                                    @{{ real_amount }}
                                                </th>
                                                <td><i></i></td>
                                            </tr>
                                        </tfoot>
                                    </table>
                                </div>
                            </div>
                        </div> <!---->
                    </div>
                    <div class="modal-footer"><button type="button" class="btn btn-danger">Chuyển Bàn</button> <!---->
                        <button type="button" v-on:click="InKitChen(add_order.order_id)" class="btn btn-primary">In Bếp</button> <a target="_blank"
                            href="/admin/ban-hang/in-bill/0" class="btn btn-warning">In Bill</a> <button type="button"
                            class="btn btn-success">Thanh Toán</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('js')
    <script>
        $(document).ready(function() {
            new Vue({
                el: "#app",
                data: {
                    list: [],
                    order: {},
                    list_food: [],
                    list_food_by_order: [],
                    list_customer: [],
                    add_order: {
                        "order_id": 0,
                        "table_id": 0
                    },
                    grandtotal: 0,
                    total_amount: 0,
                    wrttien_money: "",
                    real_amount: "",
                    discount: 0,
                    order:{},
                },
                created() {
                    this.loadBan();
                    this.loadFood();
                    this.LoadFoodBeorder();
                    this.loadCustomer();
                },
                methods: {
                    loadBan() {
                        axios
                            .get('/admin/table/data')
                            .then((res) => {
                                this.list = res.data.list;
                            });
                    },
                    loadFood() {
                        axios
                            .get('/admin/food/data')
                            .then((res) => {
                                this.list_food = res.data.list;
                            });
                    },
                    OpenTable(table_id) {
                        var payload = {
                            "table_id": table_id
                        };
                        console.log(payload);

                        axios
                            .post("/admin/order/opentable", payload)
                            .then((res) => {
                                if (res.data.status) {
                                    toastr.success(res.data.message, "Success");
                                    this.loadBan();
                                } else if (res.data.status == 0) {
                                    toastr.error(res.data.message, "Error");
                                    this.loadBan();
                                }

                            });

                    },
                    FindByIdTable(table_id) {
                        var payload = {
                            "table_id": table_id
                        };
                        axios
                            .post('/admin/order/findByIdTable', payload)
                            .then((res) => {
                                if (res.data.status) {
                                    this.add_order.order_id = res.data.order_id;
                                    this.add_order.table_id = table_id;
                                    this.order = res.data.order;
                                    this.LoadFoodBeorder(this.add_order.order_id)
                                    //console.log( )
                                } else {
                                    toastr.error("Hệ thống đang bị sự cố!");
                                    this.loadBan();
                                    $('#chiTietModal').modal('toggle');
                                }
                            });
                    },
                    AddMonByorderdetail(food_id) {
                        var payload = {
                            'food_id': food_id,
                            'order_id': this.add_order.order_id,
                        };


                        axios
                            .post('/admin/order/AddMonByorder', payload)
                            .then((res) => {
                                if (res.data.status) {
                                    toastr.success(res.data.message);
                                    this.LoadFoodBeorder(this.add_order.order_id)
                                } else {
                                    toastr.error(res.data.message);
                                }
                            })
                            .catch((res) => {
                                $.each(res.response.data.errors, function(k, v) {
                                    toastr.error(v[0]);
                                });
                            });
                    },
                    LoadFoodBeorder(order_id) {
                        var payload = {
                            'order_id': order_id
                        };

                        //console.log("Payload gửi đi:", payload);

                        axios
                            .post('/admin/order/LoadFoodBeOrder', payload)
                            .then((res) => {
                                console.log("Danh sách món ăn:", res.data.list);
                                this.list_food_by_order = res.data.list;
                                this.grandtotal = res.data.grandtotal;
                                this.total_amount = res.data.total_amount;
                                this.wrttien_money = res.data.wrttien_money;
                                this.real_amount = res.data.real_amount;
                            });
                    },
                    update(v) {



                        axios
                            .post('/admin/order/update', v)
                            .then((res) => {
                                if (res.data.status) {
                                    toastr.success(res.data.message);

                                } else {
                                    toastr.error(res.data.message);
                                }
                                this.LoadFoodBeorder(v.order_id)
                            })
                            .catch((res) => {
                                $.each(res.response.data.errors, function(k, v) {
                                    toastr.error(v[0]);
                                });
                            });
                    },
                    deleteOrderDetail(v) {
                        axios
                            .post('/admin/order/deletedetailorder', v)
                            .then((res) => {
                                if (res.data.status) {
                                    toastr.success(res.data.message);

                                } else {
                                    toastr.error(res.data.message);
                                }
                                this.LoadFoodBeorder(v.order_id)
                            })
                            .catch((res) => {
                                $.each(res.response.data.errors, function(k, v) {
                                    toastr.error(v[0]);
                                });
                            });
                    },
                    updateDiscount() {
                        var payload = {
                            'id': this.add_order.order_id,
                            'discount': this.discount,
                        }
                        //console.log(payload);
                        axios
                            .post('/admin/order/updatediscount', payload)
                            .then((res) => {
                                if (res.data.status) {
                                    toastr.success(res.data.message);
                                    this.LoadFoodBeorder(this.add_order.order_id)
                                } else {
                                    toastr.error(res.data.message);
                                }

                            });


                    },
                    loadCustomer() {
                        axios
                            .get('{{ Route('data') }}')
                            .then((res) => {
                                this.list_customer = res.data.data;
                            });
                    },
                    ComfiredCustomer() {
                        axios
                        .post('{{ Route("Confirmcustomer") }}', this.order)
                        .then((res) => {
                            if(res.data.status) {
                                toastr.success(res.data.message);
                                this.order = res.data.data;
                            } else {
                                toastr.error(res.data.message);
                            }
                        })
                        .catch((res) => {
                            $.each(res.response.data.errors, function(k, v) {
                                toastr.error(v[0]);
                            });
                        });

                    },
                    InKitChen(order_id){
                         var payload = {
                            'order_id': order_id,

                        }
                        //console.log(payload);
                        axios
                            .post('/admin/order/In-Kitchen', payload)
                            .then((res) => {
                                if (res.data.status) {
                                    toastr.success(res.data.message);
                                    this.LoadFoodBeorder(payload.order_id)
                                } else {
                                    toastr.error(res.data.message);
                                }

                            });

                    },



                    number_format(number) {
                        return new Intl.NumberFormat('vi-VI', {
                            style: 'currency',
                            currency: 'VND'
                        }).format(number);
                    },

                },
            })

        });
    </script>
@endsection
