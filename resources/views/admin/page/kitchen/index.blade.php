@extends("share.master")
@section("noi_dung")


<div class="row" id="app">
    <div class="col-7 col-md-6 col-sm-12"  >
        <div class="card-header text-center">
            <h3>Menu bếp</h3>

        </div>
        <div class="card-body">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th class="text-center align-middle">
                                    <button class="btn btn-primary" v-on:click="Remove()" >Hủy</button>
                                </th>
                                <th class="text-center align-middle">Tên Món Ăn</th>
                                <th class="text-center align-middle">Số Lượng</th>
                                <th class="text-center align-middle">Tên Bàn</th>
                                <th class="text-center align-middle">Ghi Chú</th>
                                <th class="text-center align-middle">Thời Gian</th>
                                <th class="text-center align-middle">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <template v-for="(value, key) in list">
                                <tr>
                                    <th class="text-center align-middle">
                                        <input type="checkbox" v-model="value.check">
                                    </th>
                                    <td class="align-middle">@{{value.food_name}}</td>
                                    <td class="text-center align-middle">@{{value.sale_price}}</td>
                                    <td class="text-center align-middle">@{{value.table_name}}</td>
                                    <td class="align-middle">@{{value.note}}</td>
                                    <td class="text-center align-middle">@{{date_format(value.created_at)}}</td>
                                    <td class="text-center align-middle">
                                        <button v-on:click="UpdateKitchen(value)"  class="btn btn-primary">Xong</button>
                                    </td>
                                </tr>
                            </template>
                        </tbody>
                    </table>
                </div>
            </div>

        </div>

    </div>
    <div class="col-5">

    </div>
</div>
@endsection
@section("js")
 <script>
    $(document).ready(function(){
         new Vue({
             el:"#app",
             data:{
                list:[],
             },
             created(){
                setInterval(() => {
                    this.LoadData();
                }, 3000);

             },
             methods: {
                LoadData(){
                  axios
                  .get("/admin/order/get-menu-in-serverd")
                  .then((res)=>{
                    this.list=res.data.list;

                  });
                },
                UpdateKitchen(value){

                    axios
                        .post('/admin/order/update-kitchen', value)
                        .then((res) => {
                            if (res.data.status) {
                                toastr.success(res.data.message, "Success");
                                this.LoadData();
                            } else if (res.data.status == 0) {
                                toastr.error(res.data.message, "Error");
                            }
                        })
                        .catch((res) => {
                            $.each(res.response.data.errors, function(k, v) {
                                toastr.error(v[0]);
                            })
                        });
                },
                  Remove() {
                    axios
                        .post('/admin/order/update-all', this.list)
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
                   date_format(now) {
                    return moment(now).format('HH:mm:ss');
                },
             },

         });

    });
 </script>
@endsection
