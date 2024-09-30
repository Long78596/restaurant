<!doctype html>
<html lang="en">

<head>
    <title>Title</title>
    <!-- Required meta tags -->
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />

    <!-- Bootstrap CSS v5.2.1 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous" />
</head>

<body>

    <main>
        <div class="card">
            <div class="card-body mx-4">
                <div class="container">
                    <p class="my-5 mx-5" style="font-size: 30px;">Thank for your purchase</p>
                    <div class="row">
                        <ul class="list-unstyled">
                            <li class="text-black">John Doe</li>
                            <li class="text-muted mt-1"><span class="text-black">Invoice</span> {{$order->id}}</li>
                            <li class="text-black mt-1">April 17 2021</li>
                        </ul>
                       @foreach($orderdetail as $key=>$value)
                               <hr>
                        <div class="col-xl-10">
                            <p>{{$value->food_name}}</p>
                        </div>
                        <div class="col-xl-2">
                            <p class="float-end">
                                {{ number_format($value->sale_price, 0) }}
                            </p>
                        </div>
                        <hr>
                       @endforeach
                    </div>

                    <div class="row text-black">

                        <div class="col-xl-12">
                            <p class="float-end fw-bold">{{ number_format($total_amount, 0) }} đ
                            </p>
                        </div>
                        <hr style="border: 2px solid black;">
                    </div>
                    <div class="text-center" style="margin-top: 90px;">
                        <a><u class="text-info">View in browser</u></a>
                        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. </p>
                    </div>

                </div>
            </div>
        </div>
    </main>
    <footer>
        <!-- place footer here -->
    </footer>
    <!-- Bootstrap JavaScript Libraries -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
        integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous">
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js"
        integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+" crossorigin="anonymous">
    </script>
</body>

</html>
