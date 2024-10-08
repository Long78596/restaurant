@extends('share.master')
@section('noi_dung')
    <div class="row" id="app">
        <div class="col-4">
            <div class="card">
                <div class="card-header">
                    <b>Thêm Mới Khách Hàng</b>
                </div>
                <div class="card-body">
                    <div class="mb-3">
                        <label class="form-label">Tên Khách</label>
                        <input v-model="add_cus.full_name" type="text" class="form-control">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Tên lót</label>
                        <input v-model="add_cus.middle_name" type="text" class="form-control">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Họ </label>
                        <input v-model="add_cus.first_name" type="text" class="form-control">
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Số Điện Thoại</label>
                        <input v-model="add_cus.phone_number" type="number" class="form-control">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Email</label>
                        <input v-model="add_cus.email" type="email" class="form-control">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Ghi chú</label>
                        <input v-model="add_cus.note" type="text" class="form-control">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Ngày Sinh</label>
                        <input v-model="add_cus.birth_date" type="date" class="form-control">
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Mã số thuế</label>
                        <input v-model="add_cus.taxt_code" type="text" class="form-control">
                    </div>
                </div>
                <div class="card-footer text-end">
                    <button id="add" v-on:click="addCustomer()" class="btn btn-primary">Thêm Mới</button>
                </div>
            </div>
        </div>
        <div class="col-8">
            <div class="card">
                <div class="card-header">
                    Danh Sách Khách Hàng
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th class="align-middle text-center">Tìm kiếm</th>
                                    <th colspan="2">
                                        <input v-model="key_search" v-on:keyup.enter="search()" type="text"
                                            class="form-control">
                                    </th>
                                    <th class="text-center text-white">
                                        <button class="btn btn-info" v-on:click="search()">Tìm Kiếm</button>
                                    </th>
                                </tr>
                                <tr>
                                    <th class="text-center">
                                        <button class="btn btn-danger" v-on:click="Clear()">Xóa</button>
                                    </th>
                                    <th class="text-center align-middle text-nowrap">Họ Và Tên</th>
                                    <th class="text-center align-middle text-nowrap">Số Điện Thoại</th>
                                    <th class="text-center align-middle text-nowrap">Email</th>
                                    <th class="text-center align-middle text-nowrap">Ghi Chú</th>
                                    <th class="text-center align-middle text-nowrap">Ngày Sinh</th>
                                    <th class="text-center align-middle text-nowrap">Loại Khách</th>
                                    <th class="text-center align-middle text-nowrap">Mã Số Thuế</th>
                                    <th class="text-center align-middle text-nowrap">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <template v-for="(value, key) in list_customer">
                                    <tr>
                                        <th class="text-center align-middle">
                                            <input type="checkbox" v-model="value.check">
                                        </th>
                                        <td class="align-middle">@{{ value.full_name }} @{{ value.middle_name }}  @{{ value.first_name }}</td>
                                        <td class="align-middle">@{{ value.phone_number }}</td>
                                        <td class="align-middle">@{{ value.email == null ? 'Chưa có' : value.email }}</td>
                                        <td class="align-middle">@{{ value.note == null ? 'Chưa có' : value.note }}</td>
                                        <td class="align-middle">@{{ value.birth_date == null ? 'Chưa có' : value.birth_date }}</td>
                                        <td class="align-middle">@{{ value.tax_code == null ? 'Chưa có' : value.tax_code }}</td>
                                        <td class="align-middle text-center">
                                            <button class="btn btn-primary" data-bs-toggle="modal"
                                                data-bs-target="#updateModal"
                                                v-on:click="edit_cus = Object.assign({}, value)">Cập Nhật</button>
                                            <button class="btn btn-danger" data-bs-toggle="modal"
                                                data-bs-target="#deleteModal"
                                                v-on:click="delete_cus = Object.assign({}, value)">Xóa</button>
                                        </td>
                                    </tr>
                                </template>
                            </tbody>
                        </table>
                    </div>
                    <!-- Modal -->
                    <div class="modal fade" id="updateModal" data-bs-backdrop="static" data-bs-keyboard="false"
                        tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="staticBackdropLabel">Modal title</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <div class="mb-3">
                                        <label class="form-label">Tên Khách</label>
                                        <input v-model="edit_cus.full_name" type="text" class="form-control">
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">Tên Lót</label>
                                        <input v-model="edit_cus.middle_name" type="text" class="form-control">
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">Họ </label>
                                        <input v-model="edit_cus.first_name" type="text" class="form-control">
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label">Số Điện Thoại</label>
                                        <input v-model="edit_cus.phone_number" type="number" class="form-control">
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">Email</label>
                                        <input v-model="edit_cus.email" type="email" class="form-control">
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">Ghi chú</label>
                                        <input v-model="edit_cus.note" type="text" class="form-control">
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">Ngày Sinh</label>
                                        <input v-model="edit_cus.birth_date" type="date" class="form-control">
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label">Mã số thuế</label>
                                        <input v-model="edit_cus.taxt_code" type="text" class="form-control">
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary"
                                        data-bs-dismiss="modal">Đóng</button>
                                    <button type="button" class="btn btn-primary" data-bs-dismiss="modal"
                                        v-on:click="updateCustomer">Cập Nhật</button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="modal fade" id="deleteModal" data-bs-backdrop="static" data-bs-keyboard="false"
                        tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="staticBackdropLabel">Xóa Khách Hàng</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <h6>Bạn có chắc chắn muốn xóa khách hàng - <b
                                            class="text-danger">@{{ delete_cus.full_name }} @{{ delete_cus.middle_name }}  @{{ delete_cus.first_name }}</b></h6>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary"
                                        data-bs-dismiss="modal">Đóng</button>
                                    <button type="button" class="btn btn-primary" data-bs-dismiss="modal"
                                        v-on:click="DelCustomer()">Xóa</button>
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
        $(document).ready(function() {
            new Vue({
                el: '#app',
                data: {
                    add_cus: {},
                    edit_cus: {},
                    delete_cus: {},
                    list_customer: [],
                    key_search: '',
                },
                created() {
                    this.loadData();
                },
                methods: {
                    Clear() {
                        axios
                            .post('/admin/customer/deleteAll', this.list_customer)
                            .then((res) => {
                                if (res.data.status) {
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
                    addCustomer() {
                        $("#add").prop('disabled', true);
                        axios
                            .post('/admin/customer/create', this.add_cus)
                            .then((res) => {
                                if (res.data.status == 1) {
                                    toastr.success(res.data.message, "Success");
                                    this.loadData();
                                    this.add_cus = {
                                        'ho_lot': '',
                                        'ten_khach': '',
                                        'id_loai_khach': 0,
                                        'so_dien_thoai': '',
                                        'email': '',
                                        'note': '',
                                        'ngay_sinh': '',
                                        'ma_so_thue': ''
                                    };
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
                                $("#add").removeAttr("disabled");
                            });
                    },

                    updateCustomer() {
                        axios
                            .post('/admin/customer/Update', this.edit_cus)
                            .then((res) => {
                                if (res.data.status == 1) {
                                    toastr.success(res.data.message, "Success");
                                    this.loadData();
                                    $("updateModal").modal('hide');
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
                                $("#add").removeAttr("disabled");
                            });
                    },

                    DelCustomer() {
                        axios
                            .post('/admin/customer/delete', this.delete_cus)
                            .then((res) => {
                                if (res.data.status == 1) {
                                    toastr.success(res.data.message, "Success");
                                    this.loadData();
                                    $("deleteModal").modal('hide');
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
                                $("#add").removeAttr("disabled");
                            });
                    },

                    loadData() {
                        axios
                            .get('/admin/customer/data')
                            .then((res) => {
                                this.list_customer = res.data.data;
                            });
                    },

                    search() {
                        var payload = {
                            'key_search': this.key_search
                        }
                        axios
                            .post('/admin/customer/search', payload)
                            .then((res) => {
                                this.list_customer = res.data.data;
                            })
                            .catch((res) => {
                                $.each(res.response.data.errors, function(k, v) {
                                    toastr.error(v[0]);
                                });
                            });
                    },

                }
            });
        });
    </script>
@endsection
