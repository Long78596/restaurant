@extends("share.master")
@section("noi_dung")
<div class="row" id="app">
    <div class="col-5">
        <div class="card">
            <div class="card-header">
                Thêm hóa đơn nhập hàng
            </div>
        </div>
        <div class="card-body">
            <div class="mb-3">
                <div class="table-responsive" style="max-height:450px">
                    <table class="table table-bordered">
                     <thead>
                        <tr>
                            <th class="align-middle text-center">#</th>
                            <th class="align-middle text-center">Tên sản phẩm</th>
                            <th class="align-middle text-center">Action</th>
                        </tr>
                     </thead>
                     <tbody>
                        <tr v-for="(value, key) in  list_food ">
                            <th class="text-center align-middle">@{{key+1}}</th>
                            <th class="text-center align-middle">@{{value.title}}</th>
                            <th class="text-center align-middle">
                                <button class="btn btn-primary" v-on:click="addProduct(value)">Nhập</button>
                            </th>
                        </tr>
                     </tbody>
                    </table>

                </div>
            </div>
        </div>
    </div>
    <div class="col-7">
         <div class="card">
            <div class="card-header">
                Danh Sách Nhập Hàng
            </div>
            <div class="card-body">

                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th class="align-middle" colspan="2">
                                <select class="form-control mb-3" v-model="supplier_id">
                                    <option >Chọn Nhà Cung Cấp</option>
                                     <template v-for="(value, key) in list_supplier">
                                        <option v-bind:value="value.id">@{{ value.company_name}}</option>
                                    </template>
                                </select>
                            </th>
                            <th class="text-center align-middle">Tổng Tiền</th>
                            <td class="align-middle">
                              @{{ number_format(grandtotal) }}
                            </td>
                            <td class="align-middle" colspan="3">
                                <i class="text-capitalize">@{{tien_chu}}</i>
                            </td>
                        </tr>
                        <tr>
                            <th class="text-center">#</th>
                            <th class="text-center">Tên Sản Phẩm</th>
                            <th class="text-center">Số Lượng</th>
                            <th class="text-center">Đơn Giá</th>
                            <th class="text-center">Thành Tiền</th>
                            <th class="text-center">Ghi Chú</th>
                            <th class="text-center">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <template v-for="(value, key) in list_data">
                            <tr>
                                <th class="text-center align-middle">@{{key+1}}</th>
                                <td class="align-middle text-nowrap">@{{value.food_name}}</td>
                                <td class="align-middle text-center text-nowrap">
                                    <input class="form-control" type="number" v-model="value.input_quantity" v-on:change="OnchangeProduct(value)" >
                                </td>
                                <td class="align-middle text-center text-nowrap">
                                    <input class="form-control" type="number" v-model="value.import_price" v-on:change="OnchangeProduct(value)" >
                                </td>
                                <td class="align-middle">@{{ number_format(value.total_amount) }}</td>
                                <td class="align-middle text-center text-nowrap">
                                    <input class="form-control" v-on:change="OnchangeProduct(value)" v-model="value.note" type="text"  >
                                </td>
                                <td class="align-middle text-center text-nowrap">
                                    <button class="btn btn-danger ml-1" data-bs-toggle="modal" data-bs-target="#deleteModal" v-on:click="del = value">Xóa Bỏ</button>
                                </td>
                            </tr>
                        </template>
                    </tbody>
                </table>
                <div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="exampleModalLabel">Xóa Loại sản phẩm đẵ đặt</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="alert alert-primary" role="alert">
                                Bạn có chắc chắn muốn xóa loại khách hàng: <b class="text-danger text-uppercase">@{{del.food_name}}</b> này không?
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Đóng</button>
                            <button type="button" class="btn btn-danger" v-on:click=" deleteProduct()" data-bs-dismiss="modal">Xác Nhận</button>
                        </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-footer bg-white">
                <div class="row">
                    <div class="col-md-12">
                        <button class="btn btn-primary w-100" v-on:click=" ImportProduct()">Nhập Hàng</button>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>
@endsection()
@section("js")
 <script>
    new Vue({
        el:"#app",
        data:{
         list_supplier:[],
         list_food:[],
         list_data:[],
         grandtotal:0,
         tien_chu:"",
         del:"",
         import:0,
         supplier_id:0,

        },
        created(){
        this.loadSupplier()
        this.loadFood()
        this.loadData()
        },
         methods: {
             number_format(number) {
                    return new Intl.NumberFormat('vi-VI', { style: 'currency', currency: 'VND' }).format(number);
                },
            loadData(){
                  axios
                    .get('/admin/import/data')
                    .then((res) => {
                        this.list_data = res.data.data;
                        this.grandtotal=res.data.grandtotal;
                        this.tt_chu=res.data.tien_chu;
                        //console.log(this.list);

                    });
            },
            loadSupplier(){
                 axios
                    .get('/admin/supplier/data')
                    .then((res) => {
                        this.list_supplier = res.data.data;
                        //console.log(this.list);

                    });
            },
            loadFood(){
                 axios
                    .get('/admin/food/data')
                    .then((res) => {
                        this.list_food = res.data.list;
                        //console.log(this.list);

                    });
            },
             addProduct(value){
                axios
                .post('/admin/import/addproductimport', value)
                        .then((res) => {
                            if(res.data.status) {
                                toastr.success(res.data.message);
                                this.loadData();
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
             deleteProduct(){
                axios
                .post('/admin/import/deleteproductimport', this.del)
                        .then((res) => {
                            if(res.data.status) {
                                toastr.success(res.data.message);
                               this.loadData();
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
             OnchangeProduct(value){
                axios
                .post('/admin/import/updateproductimport', value)
                        .then((res) => {
                            if(res.data.status) {
                                toastr.success(res.data.message);
                               this.loadData();
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
            ImportProduct(){
                var payload={
                      'supplier_id' : this.supplier_id,
                        'total_purchase_amount'  : this.grandtotal,
                }
                axios
                .post('/admin/import/importproduct', payload)
                        .then((res) => {
                            if(res.data.status) {
                                toastr.success(res.data.message);
                                 this.import = res.data.import.id;
                               this.loadData();
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

         },

    });
 </script>
@endsection
