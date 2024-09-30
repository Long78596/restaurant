<!doctype html>
<html lang="en">

<head>
    <title>Title</title>
    <!-- Required meta tags -->
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <!-- Bootstrap CSS v5.2.1 -->

</head>

<body style="background-color:blue;">
    <section>
        <div class="container mt-5 pt-5">
            <div class="row">
                <div class="col-12 col-sm-8 col-md-6 mx-auto">
                    <div class="card border-2 shadow">
                        <div class="card-body text-center">
                            <svg class="mx-auto my-3" xmlns="http://www.w3.org/2000/svg" width="50" height="50"
                                fill="currentColor" class="bi bi-person-circle" viewBox="0 0 16 16">
                                <path d="M11 6a3 3 0 1 1-6 0 3 3 0 0 1 6 0" />
                                <path fill-rule="evenodd"
                                    d="M0 8a8 8 0 1 1 16 0A8 8 0 0 1 0 8m8-7a7 7 0 0 0-5.468 11.37C3.242 11.226 4.805 10 8 10s4.757 1.225 5.468 2.37A7 7 0 0 0 8 1" />
                            </svg>
                            <form action="/admin/actionlogin" method="post">
                                @csrf
                                <input type="text" name="username" class="form-control my-4 py-2"
                                    placeholder="Username">
                                @error('username')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                                <input type="text" name="password" class="form-control my-4 py-2"
                                    placeholder="Password">
                                @error('password')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                                <div class="text-center mt-3">
                                    <button type="submit" class="btn btn-primary">
                                        Đăng nhập
                                    </button>
                                    <p>
                                    <div>
                                        <a href="#" class="nay-link text-decoration-none">Quên mật khẩu</a>
                                    </div>
                                    </p>

                                </div>

                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>
</body>

</html>
