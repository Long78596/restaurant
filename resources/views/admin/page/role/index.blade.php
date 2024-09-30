@extends('share.master')
@section('noi_dung')
<div class="row" id="app">
    <div class="col-3">
        <div class="card border-primary border-bottom border-3 border-0">
            <div class="card-header text-center bg-gradient-bloody text-white">
                <i><b>TẠO QUYỀN</b></i>
            </div>
            <div class="card-body">
                <div class="mb-3">
                    <label class="form-label">Tên Quyền</label>
                    <input v-model='add_role.role_name' type="text" class="form-control">
                </div>
            </div>
            <div class="card-footer text-end">
                <button id="add" v-on:click="addRole()" class="btn btn-inverse-primary">Tạo Mới</button>
            </div>
        </div>
    </div>
    <div class="col-5">
        <div class="card border-primary border-bottom border-3 border-0">
            <div class="card-header text-center bg-gradient-bloody text-white">
                <b>DANH SÁCH QUYỀN</b>
            </div>
            <div class="card-body">
                <table class="table table-bordered">
                    <thead>
                        {{-- <tr>
                            <th class="align-middle text-center">Tìm kiếm</th>
                            <th colspan="2">
                                <input v-model="key_search" v-on:keyup.enter="search()" type="text" class="form-control">
                            </th>
                            <th class="text-center text-white">
                                <button class="btn btn-inverse-info" v-on:click="search()">Tìm Kiếm</button>
                            </th> --}}
                        </tr>
                        <tr>
                            <th class="text-center">
                                <button class="btn btn-inverse-danger" v-on:click="Clear()">Xóa</button>
                            </th>
                            <th class="text-center">Tên Quyền</th>
                            <th class="text-center">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <template v-for="(value, key) in list">
                            <tr>
                                <th class="text-center align-middle">
                                    <input type="checkbox" v-model="value.check">
                                </th>
                                <td class="align-middle text-nowrap">@{{ value.role_name }}</td>
                                <td class="align-middle text-center text-nowrap">
                                    <button v-on:click="edit_role = Object.assign({}, value), getPhanQuyenDetail(value.list_id_role)" class="btn btn-inverse-success">Cấp Quyền</button>
                                    <button v-on:click="edit_role = Object.assign({}, value)" class="btn btn-inverse-info" data-bs-toggle="modal" data-bs-target="#updateModal">Cập Nhật</button>
                                    <button v-on:click="del_role = value" class="btn btn-inverse-danger ml-1" data-bs-toggle="modal" data-bs-target="#deleteModal">Xóa Bỏ</button>
                                </td>
                            </tr>
                        </template>
                    </tbody>
                </table>
                <div class="modal fade" id="updateModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="exampleModalLabel">Cập Nhật Quyền</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="mb-3">
                                <label class="form-label">Tên Quyền</label>
                                <input v-model="edit_role.role_name" type="text" class="form-control">
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-inverse-secondary" data-bs-dismiss="modal">Đóng</button>
                            <button v-on:click="accpectUpdate()" type="button" class="btn btn-inverse-warning">Xác Nhận</button>
                        </div>
                        </div>
                    </div>
                </div>
                <div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="exampleModalLabel">Xóa Quyền</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="alert alert-primary" role="alert">
                                Bạn có chắc chắn muốn xóa quyền: <b class="text-danger text-uppercase">@{{ del_role.role_name }}</b> này không?
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-inverse-secondary" data-bs-dismiss="modal">Đóng</button>
                            <button type="button" class="btn btn-inverse-danger" v-on:click="accpectDel()" data-bs-dismiss="modal">Xác Nhận</button>
                        </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card border-primary border-bottom border-3 border-0">
            <div class="card-header text-center bg-gradient-bloody text-white">
                <b>PHÂN QUYỀN @{{edit_role.role_name}}</b>
            </div>
            <div class="card-body">
                <div class="row">
                    <template v-for="(value, key) in list_phan_quyen">
                        <div class="col-md-6">
                            <div class="form-check">
                                <input class="form-check-input" v-model="array_role" type="checkbox" v-bind:value="value.id" v-bind:id="'role_' + value.id">
                                <label class="form-check-label" v-bind:for="'role_' +  value.id">@{{ value.list_name }}</label>
                            </div>
                        </div>
                    </template>
                </div>
            </div>
            <div class="card-footer">
                <div class="text-center">
                    <button class="btn btn-inverse-primary" v-on:click="Role()" style="width: 95%">Cập Nhập Phân Quyền</button>
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
            el      :       '#app',
            data    :       {
                list                :   [],
                list_phan_quyen     :   [],
                add_role           :   {},
                del_role           :   {},
                edit_role          :   {},
                key_search          :   '',
                search_role       :   '',
                array_role         :   [],

            },
            created()   {
                this.loadData();
                this.loadDataQuyen();

            },
            methods :   {
                Clear() {
                    axios
                        .post('/admin/role/delete-all', this.list)
                        .then((res) => {
                            if(res.data.status) {
                                toastr.success(res.data.message);
                                this.loadData();
                            } else {
                                toastr.error(res.data.message);
                                this.loadData();
                            }
                        })
                        .catch((res) => {
                            $.each(res.response.data.errors, function(k, v) {
                                toastr.error(v[0]);
                            });
                        });
                },
                Role() {
                    var payload = {
                        'role_id'          : this.edit_role.id,
                        'list_id_role'   : this.array_role,
                    };
                   // console.log(payload);

                    axios
                        .post('/admin/role/role', payload)
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

                getPhanQuyenDetail(list_rule) {
                    //console.log(list_rule);

                    if (list_rule) {
                        if ( list_rule.indexOf(","))
                            this.array_role = list_rule.split(",");
                        else {
                            this.array_role.push(list_rule);
                        }
                    } else {
                        this.array_role = [];
                    }
                },

                addRole() {
                    $("#add").prop('disabled', true);
                    var payload = {
                        'role_name'    :   this.add_role.role_name,
                        'list_id_role'    :   this.add_role.list_id_role,
                    };
                    axios
                        .post('/admin/role/create', payload)
                        .then((res) => {
                            if (res.data.status == 1) {
                                toastr.success(res.data.message, "Success");
                                this.loadData();
                                this.add_quyen = {};
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

                accpectUpdate() {
                    axios
                        .post('/admin/role/update', this.edit_role)
                        .then((res) => {
                            if (res.data.status) {
                                toastr.success(res.data.message, "Success");
                                this.loadData();
                                $('#updateModal').modal('hide');
                            } else if (res.data.status == 0) {
                                toastr.error(res.data.message, "Error");
                            }
                        })
                        .catch((res) => {
                            $.each(res.response.data.errors, function(k, v) {
                                toastr.error(v[0]);
                            })
                            $("#add").removeAttr("disabled");
                        });
                },
                accpectDel() {
                    axios
                        .post('/admin/role/delete', this.del_role)
                        .then((res) => {
                            if (res.data.status == 1) {
                                toastr.success(res.data.message, "Success");
                                this.loadData();
                            } else if (res.data.status == 0) {
                                toastr.error(res.data.message, "Error");
                            } else if (res.data.status == 2) {
                                toastr.warning(res.data.message, "Warning");
                            }
                        });
                },

                loadData() {
                    axios
                        .get('/admin/role/data')
                        .then((res) => {
                            this.list  =  res.data.list;
                        });
                },

                loadDataQuyen() {
                    axios
                        .get('/admin/role/data-role')
                        .then((res) => {
                            this.list_phan_quyen  =  res.data.data;
                        });
                },

                search() {
                    var payload = {
                        'key_search'    :   this.key_search
                    }
                    axios
                        .post('/admin/role/search', payload)
                        .then((res) => {
                            this.list = res.data.list;
                        })
                        .catch((res) => {
                            $.each(res.response.data.errors, function(k, v) {
                                toastr.error(v[0]);
                            });
                        });
                },
                number_format(number) {
                    return new Intl.NumberFormat('vi-VI', { style: 'currency', currency: 'VND' }).format(number);
                },
            },
        });
    });
</script>
@endsection
