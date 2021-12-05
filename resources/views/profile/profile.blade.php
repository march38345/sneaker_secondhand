@extends('layouts.app')

@section('content')
    <!DOCTYPE html>
    <html lang="en">

    <head>

        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">


    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css">
   
   
   
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous">
   </script>
        <style>
            .titlename {
                font-size: 28px;
               margin-top: 20px;
               font-weight: 1000;
            }

            .col.text-center {
                padding-bottom: 10px;
            }

            .btn.btn-success {}

            .col-2.list {
                margin-left: 10px;
            }

            .nameblock {
                text-align: center;
               
                height: 25px;

            }

            .nameitem {}

            .img_item {
                width: 100%;
                height: 130px;
            }
            .service{
             display: flex;
            }
            table{
                min-height: 200px
                
            }
            .btndetail{
                font-size: 5px;
            }
            img{
                border-radius: 50%;
            }
            h5{
                font-weight: 800;
            }

        </style>
    </head>

    <body>
        <p class="titlename" style="text-align: center">{{ $user[0]->name }}</p>
        <div class="container">
            <div class="row">
                <div class="col-6" style="border:solid 2px rgba(74, 72, 72, 0.3)">
                    <h5>แก้ไขข้อมูลส่วนตัว</h5>
                    <form action="{{ route('updateprofile') }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <label for="name">ชื่อ</label>
                        <input type="text" name="name" class="form-control" value="{{ $user[0]->name }}">
                        <br>
                        <label for="email">อีเมล</label>
                        <input type="text" name="email" class="form-control" value="{{ $user[0]->email }}">
                        <br>
                        <label for="img">รูปภาพโปรไฟล์</label>
                        <input type="file" name="img">
                        <br>
                        <br>
                        <div class="col text-center">
                            <input type="submit" class="btn btn-success " value="ส่งข้อมูล">

                        </div>

                    </form>
                </div>
                <div  class="col-lg-3 col-sm-6 container" >
                    <h5 style="text-align: center">รูปโปรไฟล์ของคุณ</h5>
                    <img src="/image/img_profile/{{auth()->user()->img_profile}}" alt="" width="100%px" height="200px">
                </div>
            </div>
        </div>
        <br>
        
        @php
            $count = 0;
            $len = count($info);
        @endphp

        <h3 style="text-align: center">จำนวนการตั้งขายของคุณ:{{$len}}</h3>
        <br>
        <div class="col-9 container">
            <table class="table ">
                <tr>

                    <th>id</th>

                    <th>brand</th>
                    <th>discription</th>
                    <th>size</th>
                    <th>price</th>
                    <th>phone</th>
                    <th>province</th>

                    <th>created_at</th>
                    <th>service</th>


                </tr>
                @foreach ($info as $item)
                    @php
                        $count++;
                    @endphp
                    <tr>
                        <th>{{$count}}</th>
                        <th>{{$item->brand_name}}</th>
                        <th>{{$item->description}}</th>
                        <th>{{$item->size}}</th>
                        <th>{{$item->price}}</th>
                        <th>{{$item->phone}}</th>
                        <th>{{$item->province}}</th>
                        <th>{{$item->created_at}}</th>
                        <th class="service">
                            <a href="/detail_product/{{$item->id}}" class="btn btn-success">detail</a>
                            <a href="/modifyproduct/{{$item->id}}" class="btn btn-warning" style="margin-left: 5px">modify</a>
                            <a href="/profile/deleteproduct/{{$item->id}}" class="btn btn-danger" style="margin-left: 5px">delete</a>
                        </th>
                    </tr>
                @endforeach


            </table>
        </div>

        


    </body>


    </html>
@endsection
