@php
$size = sizeof($state);
$product = ['Nike' => 0, 'Adidas' => 0, 'Converse' => 0, 'Onitsuka_Tiger' => 0, 'Keds' => 0, 'Reebok' => 0, 'Lacoste' => 0, 'Puma' => 0, 'Vans' => 0, 'other' => 0];
$monts = [];
foreach ($state as $item) {
    $product[$item->brand_name] += 1;

    $d = $item->created_at;
    array_push($monts, date('m', strtotime($d)));

    #dd(date('Y-m-d H:i:s', $d));
    #array_push($monts,date('m',strtotime($item->created_at));
}
$max_name = ' ';
foreach ($product as $key => $val) {
    if ($val == max($product)) {
        $max_name = $key;
    }
}

$dataPoints = [['label' => 'NIke', 'y' => ($product['Nike'] / $size) * 100], ['label' => 'Adidas', 'y' => ($product['Adidas'] / $size) * 100], ['label' => 'Converse', 'y' => ($product['Converse'] / $size) * 100], ['label' => 'Onitsuka_Tiger', 'y' => ($product['Onitsuka_Tiger'] / $size) * 100], ['label' => 'Keds', 'y' => ($product['Keds'] / $size) * 100], ['label' => 'Reebok', 'y' => ($product['Reebok'] / $size) * 100], ['label' => 'Lacoste', 'y' => ($product['Lacoste'] / $size) * 100], ['label' => 'Puma', 'y' => ($product['Puma'] / $size) * 100], ['label' => 'Vans', 'y' => ($product['Vans'] / $size) * 100], ['label' => 'other', 'y' => ($product['other'] / $size) * 100]];
@endphp
<!DOCTYPE html>
<html>

<head>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.6.0/chart.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous">
    </script>
    <script src="https://unpkg.com/feather-icons"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.0/font/bootstrap-icons.css">
    <link rel="stylesheet" href="/css/sidebar.css">
    <style>
        .grahp {
            margin: 1%;
            justify-content: space-around;

            display: flex;


        }

        .mygraph {
            width: 50%;


        }



        html {
            height: 100%;
        }

        body {
            margin: 0;
            height: 100%;

            padding: 0;
        }




        .content {
            text-align: center;

            padding: 0;
            margin: 0;

        }

        .info {
            height: 100px;
            background-color: aliceblue;
            margin-left: 3%;

        }

        .info.product {


            background-size: 60%
        }

        .data {
            display: flex;

            justify-content: space-around;
        }

        h6 {
            padding-top: 15px;
        }

        .sidebg {

            padding: 0px
        }

    </style>
</head>

<body>



    <div class="row side col-12" style="background-color:white">
        <div class="col-lg-2  col-sm-4  bg-dark sidebg">
            <nav id="sidebar" class="col-md-2 col-lg-2 col-sm-4 bg-dark sidebar"
                style=" width:100%;margin-right:0px;padding-right:0px;height:100%">
                <div class="position-sticky" style="width:100%;height:100%">
                    <ul class="nav flex-column" style="margin-left:5px ">
                        <li class="nav-item">
                            <a href="/" class="nav-link" style="margin-top: -10px">

                                <img src="/image/logo.png" alt="">
                            </a>

                        </li>
                        <li class="nav-item" >
                            <a href="/" class="nav-link">
                                <i data-feather="home"></i>
                                <span class="">Home</span>
                            </a>

                        </li>
                        <li class="nav-item"width="30px">
                            <a href="{{ route('admin.home') }}" class="nav-link" style="background: white">
                                <i class="bi bi-speedometer2" style="font-size: 23px;"></i>
                                <span class="">Dashboard</span>
                            </a>

                        </li>
                        <li class="nav-item">
                            <a href="{{ route('getcustomer') }}" class="nav-link">
                                <i data-feather="list"></i>
                                <span class="">Customers_user</span>
                            </a>

                        </li>

                        <li class="nav-item">
                            <a href="{{ route('getorder') }}" class="nav-link">
                                <i data-feather="layout"></i>
                                <span class="">Order</span>
                            </a>

                        </li>

                        <li class="nav-item" style="display: flex;margin-top:120%;">

                            <img src="/image/img_profile/{{ auth()->user()->img_profile }}" alt=""
                                class="img_pro">
                            <p class="namepro">{{ auth()->user()->name }}</p>




                        </li>..


                        <li class="nav-item" style="width: 98%;margin-left:0px;padding-left:0px;">
                            <a class="btn btn-danger" href="{{ route('logout') }}" onclick="event.preventDefault();
                                                                 document.getElementById('logout-form').submit();" style="width: 98%">
                                        {{ __('Logout') }}
                                    </a>


                                    <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                        class="d-none">
                                        @csrf
                                    </form>

                        </li>

                    </ul>

                </div>
            </nav>
        </div>

        <!-- content -->


        <div class="col-lg-10 col-sm-8 content">
            <h1 class="text-light bg-dark col-lg-4 mx-auto">WELCOM TO ADMIN </h1>
            <br>
            <div class="data">
                <div class="card col-2 col-sm-3 info product">
                    <div class="">
                        <h6>products</h6>

                        <h1>{{ sizeof($state) }}</h1>

                    </div>

                </div>
                <div class="card col-2 col-sm-3 info">
                    <h6>users</h6>
                    <h1>{{ sizeof($user) }}</h1>
                </div>
                <div class="card col-2 col-sm-3 info">
                    <h6>{{ $max_name }}</h6>
                    <h1>{{ max($product) }}</h1>
                </div>
            </div>
            <br>
            <div class="row grahp col-lg-12">
                <div class="col-lg-5 ">
                    <canvas class="mygraph" id="myChart"></canvas>
                </div>
                <div class="col-lg-5 ">
                    <canvas class="dategrahp" id="dategrahp"></canvas>
                </div>

            </div>
            



        </div>



    </div>

    </div>



</body>


@csrf
<script>
    $(document).ready(function() {
        showGraphproduct();
        showGraph_date_product();
    });

    function showGraph_date_product() {
        var _token = $('input[name="_token"]').val();
        $.ajax({
            url: "{{ route('dataproductdate') }}",
            method: "POST",
            data: {

                _token: _token
            },
            success: function(result) {


                var data = [];
                const obj = JSON.parse(result);
                var datamonts = [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0];
                for (let i in obj) {
                    data.push(obj[i]);
                    datamonts[obj[i]] += 1

                }
                const labels = ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August',
                    'September', 'October', 'November', 'December'
                ];
                console.log(datamonts);


                const date_grahp = document.getElementById('dategrahp').getContext('2d');
                const datechart = new Chart(date_grahp, {
                        type: 'line',

                        data: {
                            labels: labels,
                            datasets: [{
                                label: 'จำนวนการตั้งขายสินค้า',
                                data: datamonts,
                                fill: false,
                                borderColor: 'rgb(75, 192, 192)',
                                tension: 0.1
                            }]
                        },
                    }

                );
            }

        })

    }


    function showGraphproduct() {

        var _token = $('input[name="_token"]').val();

        $.ajax({



            url: "{{ route('dataadmin') }}",
            method: "POST",
            data: {

                _token: _token
            },
            success: function(result) {

                var select = ['Nike', 'Adidas', 'Converse', 'Onitsuka_Tiger', 'Keds', 'Reebok', 'Lacoste',
                    'Puma', 'Vans',
                    'other'
                ];
                var data = [];
                const obj = JSON.parse(result);
                console.log(obj.Nike);
                for (let i in obj) {
                    data.push(obj[i]);

                }
                const ctx = document.getElementById('myChart').getContext('2d');
                const myChart = new Chart(ctx, {
                    type: 'bar',
                    data: {
                        labels: select,
                        datasets: [{
                            label: 'จำนวนแบรนสินค้า',
                            data: data,
                            backgroundColor: [
                                'rgba(255, 99, 132, 1)',
                                'rgba(54, 162, 235, 1)',
                                'rgba(255, 206, 86, 1)',
                                'rgba(75, 192, 192, 1)',
                                'rgba(153, 102, 255, 1)',
                                'rgba(153, 50, 255, 1)',
                                'rgba(153, 126, 65, 1)',
                                'rgba(13, 102, 255,1)',
                                'rgba(83, 182, 255, 1)',
                                'rgba(255, 159, 64, 1)'
                            ],
                            borderColor: [
                                'rgba(255, 99, 132, 1)',
                                'rgba(54, 162, 235, 1)',
                                'rgba(255, 206, 86, 1)',
                                'rgba(75, 192, 192, 1)',
                                'rgba(153, 102, 255, 1)',
                                'rgba(153, 102, 255, 1)',
                                'rgba(153, 102, 255, 1)',
                                'rgba(153, 102, 255, 1)',
                                'rgba(153, 102, 255, 1)',
                                'rgba(255, 159, 64, 1)'
                            ],
                            borderWidth: 1
                        }]
                    },

                });


            }
        })
     

    }
</script>
<script>
    feather.replace()
</script>

</html>
