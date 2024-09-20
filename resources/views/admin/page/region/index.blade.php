@extends('share.master')
@section('noi_dung')
    <div class="row" id="app">
        <div class=" col-sm-2  col-4">
            <div class="card border-primary border-bottom border-3 border-0">
                <div class="card-header">
                    <h3>Thêm mới khu vực</h3>
                </div>
                <div class="card">
                    <div class="card-body">
                        <div class="mb-3">
                            <label class="from-label">
                                Tên khu vực
                            </label>
                            <input v-model="add_region.region_name" v-on:keyup="createSlug() " v-on:blur="checkSlug()"
                                type="text" class="form-control">
                        </div>
                        <div class="mb-3">
                            <label class="from-label">
                                Slug khu vực
                            </label>
                            <input v-model="add_region.region_slug" type="text" class="form-control">
                        </div>
                        <div class="mb-3">
                            <label class="from-label">
                                Tình trạng
                            </label>
                            <select v-model="add_region.status" class="form-control">
                                <option>--Vui lòng nhấn chọn</option>
                                <option value="1">Hiển thị</option>
                                <option value="0">ẩn</option>
                            </select>
                        </div>
                    </div>

                </div>
                <div class="card-footer text-end">
                    <button id="add" type="submit" class="btn btn-primary" v-on:click="AddRegion()">Xác nhận</button>
                </div>
            </div>
        </div>
        <div class="col-8">
            <div class="card border-primary border-bottom border-3 border-0">
                <div class="card-hedaer">
                    Danh sách khu vực
                </div>
                <div class="card-body">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th class="text-center">
                                    <button class="btn btn-danger" v-on:click="Clear()">Xóa</button>
                                </th>
                                <th class="text-center">Tên Khu Vực</th>
                                <th class="text-center">Tình Trạng</th>
                                <th class="text-center">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <template v-for="(value, key) in list">
                                <tr>
                                    <th class="text-center align-middle">
                                        <input type="checkbox" v-model="value.check">
                                    </th>
                                    <td class="align-middle">@{{ value.region_name }}</td>
                                    <td class="align-middle text-center">
                                        <button v-on:click="changeStatus(value)" v-if="value.status == 1"
                                            class="btn btn-primary">Hiển Thị</button>
                                        <button v-on:click="changeStatus(value)" v-else="value.status == 0"
                                            class="btn btn-danger">Tạm
                                            Tắt</button>
                                    </td>
                                    <td class="align-middle text-center">
                                        <button v-on:click="edit_region = Object.assign({}, value)" data-bs-toggle="modal"
                                            data-bs-target="#updateModal" class="btn btn-info">Cập Nhật</button>
                                        <button v-on:click="del_region = Object.assign({}, value)"
                                            class="btn btn-danger ml-1" data-bs-toggle="modal"
                                            data-bs-target="#deleteModal">Xóa Bỏ</button>
                                    </td>
                                </tr>
                            </template>
                        </tbody>
                    </table>
                    <div class="modal fade" id="updateModal" tabindex="-1" aria-labelledby="exampleModalLabel"
                        aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h1 class="modal-title fs-5" id="exampleModalLabel">Cập Nhật Khu Vực</h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <div class="mb-3">
                                        <label class="form-label">Tên Khu Vực</label>
                                        <input v-model="edit_region.region_name" v-on:keyup="updateSlug()" type="text"
                                            class="form-control">
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">Slug Khu Vực</label>
                                        <input v-model="edit_region.region_slug" type="text" class="form-control">
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">Tình Trạng</label>
                                        <select v-model="edit_region.status" class="form-control">
                                            <option value="1">Hiển Thị</option>
                                            <option value="0">Tạm Tắt</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                    <button v-on:click="accpectUpdate()" type="button" class="btn btn-warning">Xác
                                        Nhận</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="exampleModalLabel"
                        aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h1 class="modal-title fs-5" id="exampleModalLabel">Xóa Khu Vục</h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <div class="alert alert-primary" role="alert">
                                        Bạn có chắc chắn muốn xóa khu vực: <b
                                            class="text-danger text-uppercase">@{{ del_region.region_name }}</b> này không?
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary"
                                        data-bs-dismiss="modal">Close</button>
                                    <button type="button" class="btn btn-danger" v-on:click="accpectDel()"
                                        data-bs-dismiss="modal">Xác Nhận</button>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>

            </div>
        </div>
    </div>
@endsection
@section('js')
    <script>
        new Vue({
            el: "#app",
            data: {
                list: [],
                add_region: {
                    'region_name': '',
                    'region_slug': '',
                    'status': 1
                },
                edit_region: {
                    'region_name': '',
                    'region_slug': '',
                    'status': 1
                },
                del_region: {},
            },
            created() {
                this.LoadData();
            },
            methods: {
                LoadData() {
                    axios
                        .get("/admin/region/data")
                        .then((res) => {
                            // console.log(res.data.list);

                            this.list = res.data.list;
                        });
                },
                AddRegion() {
                    axios
                        .post("/admin/region/create", this.add_region)
                        .then((res) => {

                            if (res.data.status == 1) {
                            toastr.success(res.data.message, "Success");
                            this.LoadData();
                            this.add_ban = {};
                            $("#add").removeAttr("disabled");
                        } else if (res.data.status == 0) {
                            toastr.error(res.data.message, "Error");
                        } else if (res.data.status == 2) {
                            toastr.warning(res.data.message, "Warning");
                        }



                        })
                        .catch((res) => {
                            $.each(res.response.data.errors, function(k, v) {
                                toastr.error(v[0]);
                            })

                        });;

                },
                changeStatus(payload) {

                    axios
                        .post("/admin/region/changeStatus", payload)
                        .then((res) => {
                            alert("Đã đổi trạng thái thành công");
                            this.LoadData();
                        });
                },
                DataEdit() {
                    axios
                        .get("/admin/region/Edit", this.edit_region)
                        .then((res) => {
                            alert("Lấy dữ liệu thành công");
                            this.edit_region = {
                                    'region_name': '',
                                    'region_slug': '',
                                    'status': 1
                                },
                                this.LoadData();


                        });
                },
                accpectUpdate() {
                    axios
                        .post("/admin/region/Update", this.edit_region)
                        .then((res) => {
                            alert("đã cập nhật thành công");
                            this.LoadData();
                            $('#updateModal').modal('hide');

                        })
                        .catch((res) => {
                            $.each(res.response.data.errors, function(k, v) {
                                toastr.error(v[0]);
                            })

                        });;
                },
                accpectDel() {
                    axios
                        .post("/admin/region/delete", this.del_region)
                        .then((res) => {

                            alert("Đã xóa thành công");
                            this.LoadData();
                        });
                },
                Clear() {
                    // console.log(123);


                    axios
                        .post("/admin/region/deleteAll", this.list)
                        .then((res) => {
                            alert("Thành công");
                            this.LoadData();
                        });
                },
                checkSlug() {
                    var payload = {
                        'region_slug': this.add_region.region_slug,
                    };
                    axios
                        .post('/admin/region/checkSlug', payload)
                        .then((res) => {
                            if (res.data.status == 1) {
                                toastr.success(res.data.message, "Success");
                                $("#add").removeAttr("disabled");
                            } else if (res.data.status == 0) {
                                toastr.error(res.data.message, "Error");
                                $("#add").prop('disabled', true);
                            } else if (res.data.status == 2) {
                                toastr.warning(res.data.message, "Warning");
                            }
                        });
                },
                updateSlug() {
                    var slug = this.toSlug(this.edit_region.region_name);
                    this.edit_region.region_slug = slug;
                },
                createSlug() {
                    var slug = this.toSlug(this.add_region.region_name);
                    this.add_region.region_slug = slug;
                },
                toSlug(str) {
                    str = str.toLowerCase();
                    str = str
                        .normalize('NFD') // chuyển chuỗi sang unicode tổ hợp
                        .replace(/[\u0300-\u036f]/g, ''); // xóa các ký tự dấu sau khi tách tổ hợp
                    str = str.replace(/[đĐ]/g, 'd');
                    str = str.replace(/([^0-9a-z-\s])/g, '');
                    str = str.replace(/(\s+)/g, '-');
                    str = str.replace(/-+/g, '-');
                    str = str.replace(/^-+|-+$/g, '');
                    return str;
                },

            },
        });
    </script>
@endsection
