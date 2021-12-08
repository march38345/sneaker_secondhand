<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.6.0/chart.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous">
    </script>
    <script src="https://unpkg.com/feather-icons"></script>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.0/font/bootstrap-icons.css">
    <link rel="stylesheet" href="/css/sidebar.css">
    <style>
        h1{
            text-align: center;
        }
        .tb{
           
        }
        th{
            text-align: center;
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
                        <li class="nav-item">
                            <a href="/" class="nav-link">
                                <i data-feather="home"></i>
                                <span class="">home</span>
                            </a>

                        </li>
                        <li class="nav-item">
                            <a href="{{ route('admin.home') }}" class="nav-link" >
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
                            <a href="{{ route('getorder') }}" class="nav-link" style="background: white">
                                <i data-feather="layout"></i>
                                <span class="">order</span>
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
        <div class="col-lg-8 col-sm-8">
            <h1 class="text-light bg-dark col-lg-4 mx-auto">TABLE ORDERS</h1>
            <br>
            <div class="col-8 tb" >
            <table class="table table-hover table-dark">
                <thead>
                    <tr>
                        <th>id</th>
                        <th>user_id</th>
                        <th>brand</th>
                        
                        <th>size</th>
                        <th>price</th>
                       
                        <th>province</th>
                        <th>created_at</th>
                        <th>setting</th>
                       

                        
                    </tr>
                </thead>
                <tbody>
                    @foreach ($product as $item)
                        <tr>
                        <td>{{$item->id}}</td>
                        <td>{{$item->user_id}}</td>
                        <td>{{$item->brand_name}}</td>
                        
                        <td>{{$item->size}}</td>
                        <td>{{$item->price}}</td>
                        <td>{{$item->province}}</td>
                        <td>{{$item->created_at}}</td>
                        <td>
                            <a href="/detail_product/{{$item->id}}" class="btn btn-success">detail</a>
                          
                            <a href="/profile/deleteproduct/{{$item->id}}" class="btn btn-danger">delete</a>
                        </td>
                        
                    </tr>
                    @endforeach
                    
                </tbody>
            </table>
            </div>
        </div>
</body>
<script>
    feather.replace()
</script>

</html>
