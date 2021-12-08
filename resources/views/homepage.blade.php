@extends('layouts.app')



@section('content')
    <!DOCTYPE html>
    <html lang="en">


    <head>

        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>homepage_shop</title>
        <!-- CSS only -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
            integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
        <link rel="stylesheet" type="text/css" href="css/homepage.css">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css">
        <!-- JavaScript Bundle with Popper -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
                integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous">
        </script>
        <script src="https://unpkg.com/feather-icons"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    </head>
    @php($count = 0)


    <body style="background-color: rgb(235, 235, 235)">



        <div class="container  titlehead"  >
            <img src="/image/market1.png" alt="" width="50%" height="200px" class="container mainlogo">

        </div>
        <div class="container  titlehead"  >
            <img src="https://images.pexels.com/photos/8059385/pexels-photo-8059385.jpeg?auto=compress&cs=tinysrgb&dpr=1&w=500" alt="" width="50%" height="200px" class="container mainlogo">

        </div>
        <div class="container  titlehead"  >
            <img src="https://images.pexels.com/photos/6776564/pexels-photo-6776564.jpeg?auto=compress&cs=tinysrgb&dpr=1&w=500" alt="" width="50%" height="200px" class="container mainlogo">

        </div>

        <div class="select">
            <form action="">
                <label for="select" style="font-weight: 1000">แบรนรองเท้า</label>
                <select name="select" id="brand_name" class="form-control">
                    <option value="all">ทั้งหมด</option>
                    <option value="other">อื่นๆ</option>
                    <option value="Nike">Nike</option>
                    <option value="Adidas">Adidas</option>
                    <option value="Converse">Converse</option>
                    <option value="Onitsuka_Tiger">Onitsuka Tiger</option>
                    <option value="Keds">Keds</option>
                    <option value="Reebok">Reebok</option>
                    <option value="Lacoste">Lacoste</option>
                    <option value="Puma">Puma</option>
                    <option value="Vans">Vans</option>

                </select>
            </form>
        </div>





        <!--body -->

        <div class="container"  style="padding-left:5%">


            <div class="row product col-12 ">

                @foreach ($state_infosale as $item)


                    <div class="col-lg-3 col-md-4 col-sm-8 main " id="main">

                        <div class="card" style="width:80%">
                            <p class="head">{{ $item->brand_name }}</p>
                            <div class="blockimg">

                                <img class="img" src="/image/store/{{ $item->path_img[0] }}" alt="">
                            </div>


                            <!--body -->
                            <div class="body_content">
                                <p class="brand">{{ $item->brand_name }}</p>
                                <p class="size">size: {{ $item->size }}</p>
                                <p class="date">
                                    <i data-feather="calendar" class="feather-10"></i> {{ $item->created_at }}
                                </p>

                                <p class="description" style="text-align: center">{{ $item->discription }}

                                </p>




                            </div>

                            <div class="detail">
                                <a href="/detail_product/{{ $item->id }}" class="btn btn-dark detaillink">รายละเอียด</a>
                            </div>
                            <div class="block_price">

                                <p class="price"><i class="bi bi-tag">price </i>{{ $item->price }} </p>
                            </div>




                            <!--footter -->
                            <div class="gri">


                                <div class="info_left">
                                    <div>
                                        <img class="img_profile"
                                            src="/image/img_profile/{{ $item->user->img_profile }}" alt="">
                                    </div>


                                    <div class="name">
                                        <a href="" class="l_name">
                                            <p class="l_s_name" style="text-align: center">{{ $item->name }}</p>

                                        </a>
                                    </div>
                                </div>
                                <div class="info_right">
                                    <a class="" href="{{route('viewchat')}}">
                                        <i data-feather="message-square"></i>

                                    </a>


                                </div>



                            </div>

                        </div>

                    </div>


                    @php($count++)

                @endforeach

            </div>

        </div>


    </body>
 
    <script>
        var countblockmain = 1;
        var blockmain = document.getElementsByClassName('titlehead');
        var blocklen = blockmain.length;
        for (i = 0; i < blocklen; i++) {
            blockmain[i].style.display = "none";
        }
        blockmain[countblockmain - 1].style.display = "block";
       

        setInterval(function() {
            setblockmain();
        }, 5000);

        function setblockmain() {
            countblockmain++;
            console.log(countblockmain);
            for (i = 0; i < blocklen; i++) {
                blockmain[i].style.display = "none";
            }
            blockmain[countblockmain - 1].style.display = "block";
            if (countblockmain >=blocklen) {
                countblockmain = 0;
            }

        }
        $('#brand_name').change(function() {
            $('.product').empty();
            var _token = $('input[name="_token"]').val();
            brand_name = $(this).val();
            console.log(brand_name);
            $.ajax({
                url: "{{ route('getproduct') }}",
                method: "POST",
                data: {
                    data: {
                        "brand_name": brand_name
                    },
                    _token: _token
                },
                success: function(result) {

                    var count = Object.keys(result).length;
                    console.log(result[0]);

                    i = 0;
                    for (let i in result) {
                        const arrayimg = result[i]['path_img'].split(",");
                        str =
                            '<div class="col-lg-3 col-md-4  main"  id="main">  <div class="card" style="width: 18rem;"> <p class="head">' +
                            result[i]['brand_name'] +
                            '</p> <div class="blockimg">  <img class="img" src="/image/store/' + arrayimg[0]+
                            '" alt=""> </div> <div class="body_content"> <p class="brand">' + result[i][
                                'brand_name'
                            ] + '</p><p class="size">size: ' + result[i]['size'] +
                            '</p> <p class="date"> <i data-feather="calendar" class="feather-10"></i> ' +
                            result[i]['created_at'] +
                            '</p><p class="description" style="text-align: center">' + result[i][
                                'description'
                            ] + '</p></div><div class="detail"><a href="/detail_product/' + result[i][
                                'id'
                            ] +
                            '" class="btn btn-dark detaillink">รายละเอียด</a> </div>  <div class="block_price"> <p class="price"><i class="bi bi-tag">price </i>' +
                            result[i]['price'] +
                            ' </p> </div><div class="gri"> <div class="info_left"><div> <img class="img_profile" src="/image/img_profile/' +
                            result[i]['img_profile'] +
                            '"alt=""></div><div class="name"> <a href="" class="l_name"> <p class="l_s_name" style="text-align: center">'+result[i]['name']+'</p></a></div></div><div class="info_right"><a class="" href="/chat"><i data-feather="message-square"></i> </a> </div></div></div></div>  ';
                            $('.product').append(str);
                            feather.replace()

                        


                    }

                }


            });


        });
        
        feather.replace()
    </script>

    
    

    </html>
@endsection
