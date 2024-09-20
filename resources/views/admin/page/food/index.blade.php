@extends('share.master')
@section('noi_dung')
    <div class="row" id="app">
        <div class="col-5">
            <div class="card border-primary border-bottom border-3 border-0">
                <div class="card-header">
                    Thêm Mới món ăn
                </div>
                <div class="card-body">
                    <div class="mb-3">
                        <label class="form-label">Tên món ăn</label>
                        <input v-model="add_food.title" v-on:blur="checkSlug()"  type="text" class="form-control">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Gía bán</label>
                        <input v-model="add_food.price" type="text" class="form-control">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Hình ảnh</label>
                        <input type="file" v-on:change="onFileChange" ref="files" accept="image/png, image/jpeg"
                            class="form-control">

                    </div>
                    <div class="mb-3">
                        <label class="form-label">Danh mục</label>
                        <select v-model="add_food.category_id" class="form-control">
                            <option value="0">Vui lòng chọn danh mục</option>
                            @foreach ($cate as $key => $value)
                                <option value="{{ $value->id }}">{{ $value->category_name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Tình Trạng</label>
                        <select v-model="add_food.status" class="form-control">
                            <option value="1">Hiển Thị</option>
                            <option value="0">Tạm Tắt</option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="card-footer text-end">
                <button id="add" v-on:click="addFood()" class="btn btn-primary">Thêm Mới</button>
            </div>
        </div>
        <div class="col-7">
            <div class="card border-primary border-bottom border-3 border-0">
                <div class="card-header">
                    Danh Sách Món ăn
                </div>
                <div class="card-body">
                    <table class="table table-bordered" id="listKhuVuc">
                        <thead>
                            <tr>
                                <th class="text-center">
                                    <button class="btn btn-danger" v-on:click="Clear()">Xóa</button>
                                </th>
                                <th class="text-center">Tên món ăn</th>
                                <th class="text-center">Gía bán</th>
                                <th class="text-center">Danh mục</th>
                                <th class="text-center">Hình ảnh</th>
                                <th class="text-center">Tình Trạng</th>
                                <th class="text-center">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                        <tbody>
                            <tr v-for="(value, key) in list" :key="value.id">
                                <!-- Thêm key để tránh lỗi duplicate keys -->
                                <th class="text-center align-middle">
                                    <input type="checkbox" v-model="value.check">
                                </th>
                                <td class="align-middle">@{{ value.title }}</td>
                                <td class="align-middle text-end">@{{ number_format(value.price) }}</td>
                                <td class="align-middle text-end">@{{ value.category_name }}</td>
                                <td class="align-middle text-end">
                                    <img v-bind:src="'/public/image/food/' + value.image" class="img-thumbnail"
                                        style="height:80px;">
                                </td>
                                <td class="align-middle text-center">
                                    <button v-on:click="changeStatus(value)" v-if="value.status == 1"
                                        class="btn btn-primary">Hiển Thị</button>
                                    <button v-on:click="changeStatus(value)" v-else class="btn btn-danger">Tạm Tắt</button>
                                </td>
                                <td class="align-middle text-center">
                                    <button v-on:click="edit_food = Object.assign({}, value)" data-bs-toggle="modal"
                                        data-bs-target="#updateModal" class="btn btn-info">Cập Nhật</button>
                                    <button v-on:click="del_food = value" class="btn btn-danger ml-1" data-bs-toggle="modal"
                                        data-bs-target="#deleteModal">Xóa Bỏ</button>
                                </td>
                            </tr>

                        </tbody>


                        </tbody>
                    </table>
                    <div class="modal fade" id="updateModal" tabindex="-1" aria-labelledby="exampleModalLabel"
                        aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h1 class="modal-title fs-5" id="exampleModalLabel">Cập Nhật Bàn</h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <div class="mb-3">
                                        <label class="form-label">Tên món ăn</label>
                                        <input v-model="edit_food.title" v-on:blur="checkSlug()"  type="text"
                                            class="form-control">
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">Gía bán</label>
                                        <input v-model="edit_food.price" type="text" class="form-control">
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">Hình ảnh</label>
                                        <input type="file" v-on:change="onFileChange1" ref="files"
                                            accept="image/png, image/jpeg" class="form-control">

                                        <img v-bind:src="'/public/image/food/' + edit_food.image" class="img-thumbnail"
                                            style="height:80px;">

                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">Danh mục</label>
                                        <select v-model="edit_food.category_id" class="form-control">
                                            <option value="0">Vui lòng chọn danh mục</option>
                                            @foreach ($cate as $key => $value)
                                                <option value="{{ $value->id }}">{{ $value->category_name }}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label">Tình Trạng</label>
                                        <select v-model="edit_food.status" class="form-control">
                                            <option value="1">Hiển Thị</option>
                                            <option value="0">Tạm Tắt</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary"
                                        data-bs-dismiss="modal">Close</button>
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
                                    <h1 class="modal-title fs-5" id="exampleModalLabel">Xóa Bàn</h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <div class="alert alert-primary" role="alert">
                                        Bạn có chắc chắn muốn xóa bàn: <b
                                            class="text-danger text-uppercase">@{{ del_food.title }}</b> này không?
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
    </div>
@endsection
@section('js')
    <script>
        new Vue({
            el: "#app",
            data: {
                list: [],
                add_food: {},
                del_food: {},
                edit_food: {},
            },
            created() {
                this.loadData();
            },
            methods: {
                loadData() {
                    axios
                        .get('/admin/food/data')
                        .then((res) => {
                            this.list = res.data.list;
                            //console.log(res.data.list);

                        });
                },
                Clear() {
                    axios
                        .post('/admin/food/deleteAll', this.list)
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
                checkSlug() {
                    var payload = {
                        'title': this.add_food.title,
                    };
                    axios
                        .post('/admin/food/checkSlug', payload)
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
                accpectUpdate() {
                     let formData = new FormData();
                    formData.append('id', this.edit_food.id);
                    formData.append('title', this.edit_food.title);
                    formData.append('price', this.edit_food.price);
                    formData.append('status', this.edit_food.status);
                    formData.append('category_id', this.edit_food.category_id);

                    // Thêm file vào FormData nếu có
                    if (this.edit_food.image) {
                        formData.append('image', this.edit_food.image); // Sử dụng thuộc tính image từ add_food
                    }

                    axios.post('/admin/food/Update', formData, {
                            headers: {
                                'Content-Type': 'multipart/form-data'
                            }
                        })
                        .then((res) => {
                            if (res.data.status == 1) {
                                toastr.success(res.data.message, "Success");
                                this.loadData();
                                this.edit_food = {};
                            } else if (res.data.status == 0) {
                                toastr.error(res.data.message, "Error");
                            } else if (res.data.status == 2) {
                                toastr.warning(res.data.message, "Warning");
                            }
                        })
                        .catch((err) => {
                            if (err.response && err.response.data && err.response.data.errors) {
                                $.each(err.response.data.errors, function(k, v) {
                                    toastr.error(v[0]);
                                });
                            } else {
                                toastr.error("An unexpected error occurred.", "Error");
                            }
                            $("#add").removeAttr("disabled"); // Kích hoạt lại nút thêm
                        });
                },
                accpectDel() {
                    axios
                        .post('/admin/food/delete', this.del_food)
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

                onFileChange(event) {
                    this.add_food.image = event.target.files[0]; // Lưu file vào thuộc tính image của add_food
                },
                  onFileChange1(event) {
                    this.edit_food.image = event.target.files[0]; // Lưu file vào thuộc tính image của add_food
                },

                // Hàm thêm món ăn
                addFood() {
                    $("#add").prop('disabled', true); // Vô hiệu hóa nút thêm

                    let formData = new FormData();
                    formData.append('title', this.add_food.title);
                    formData.append('price', this.add_food.price);
                    formData.append('status', this.add_food.status);
                    formData.append('category_id', this.add_food.category_id);

                    // Thêm file vào FormData nếu có
                    if (this.add_food.image) {
                        formData.append('image', this.add_food.image); // Sử dụng thuộc tính image từ add_food
                    }

                    axios.post('/admin/food/create', formData, {
                            headers: {
                                'Content-Type': 'multipart/form-data'
                            }
                        })
                        .then((res) => {
                            if (res.data.status == 1) {
                                toastr.success(res.data.message, "Success");
                                this.loadData();
                                this.addFood = {};
                            } else if (res.data.status == 0) {
                                toastr.error(res.data.message, "Error");
                            } else if (res.data.status == 2) {
                                toastr.warning(res.data.message, "Warning");
                            }
                        })
                        .catch((err) => {
                            if (err.response && err.response.data && err.response.data.errors) {
                                $.each(err.response.data.errors, function(k, v) {
                                    toastr.error(v[0]);
                                });
                            } else {
                                toastr.error("An unexpected error occurred.", "Error");
                            }
                            $("#add").removeAttr("disabled"); // Kích hoạt lại nút thêm
                        });
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

                changeStatus(payload) {
                    axios
                        .post('/admin/food/changeStatus', payload)
                        .then((res) => {
                            if (res.data.status) {
                                toastr.success(res.data.message, "Success");
                                this.loadData();
                            } else if (res.data.status == 0) {
                                toastr.error(res.data.message, "Error");
                            }
                        });
                },
                number_format(number) {
                    return new Intl.NumberFormat('vi-VI', {
                        style: 'currency',
                        currency: 'VND'
                    }).format(number);
                },
            }

        });
    </script>
@endsection
