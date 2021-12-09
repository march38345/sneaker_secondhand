@extends('layouts.app')

@section('content')
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>set_for_sale</title>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
                integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous">
        </script>
<script src="https://unpkg.com/feather-icons"></script>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
            integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
        <style>
            .file {
                margin-left: 0em;
            }

            .center {

                width: 50%;
                margin-left: auto;
                margin-right: auto;


            }

            .btn.btn-warning {
                width: 100%;
                margin-left: auto;
                margin-right: auto;
            }
.input_id_produt{
    display: none;
}
        </style>

    </head>

    <body>

        @if (session('success'))

            <div class="alert alert-uioptn nsuccess" role="alert">
                {{ session('success') }}
            </div>

        @elseif(session('error'))

            <div class="alert alert-danger" role="alert">
                {{ session('error') }}
            </div>
        @endif
        <div class="container">

            <div class="row">
                <div class="col-9" style="border:solid">
                    <div class="card-head">
                        <h3>แก้ไขข้อมูลการขาย</h3>
                    </div>
                    <div class="card-body">
                   
                    <form action="{{ route('upstate') }}" method="POST" enctype="multipart/form-data">
                       @foreach ($info as $item) 
                        @csrf
                        <input type="text" class="input_id_produt" value="{{$item->id}}" name="id">
                        <label for="brand_name">ชื่อแบรนด์รองเท้า</label>
                        <select name="brand_name" id="" class="form-select" aria-label="Default select example">
                            <option value="{{$item->brand_name}}">{{$item->brand_name}}</option>
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
                        <br>
@php
    $district = $item->district
@endphp
                        <label for="description" >คำอธิบายสินค้า</label>
                        <br>
                        <textarea class="form-control" id="exampleFormControlTextarea1" name="description"
                            rows="3" >{{$item->discription}}</textarea>
                        <br>
                        <label for="size">ไซต์</label>
                        <input type="text" name="size" class="form-control" value="{{$item->size}}">
                        <br>
                        <label for="price">ราคาTHB</label> 
                        <input type="text" name="price" class="form-control" value="{{$item->price}}">
                        <br>

                        <label for="phone" >เบอร์ติดต่อผู้ขาย</label>
                        <input type="text" name="phone" class="form-control"  value="{{$item->phone}}">
                        <br>
                        
                        <div class="addressblock">
                            <div class="provinceblock">
                                <label for="province">กรุณาเลือกจังหวัด</label>
                                <select name="province" id="province" class="form-select">
                                    <option value="{{$item->province}}">{{$item->province}}</option>
                                    @foreach ($province as $item)
                                        <option value="{{ $item->id }}">{{ $item->name_in_thai }}</option>
                                    @endforeach
                                </select>
                            </div>
                            
                            <br>
                            <div class="districtblock">
                                <label for="district">กรุณาเลือกอำเภอ</label>
                                <select name="district" id="district" class="form-select"> 
                                    <option value="{{$district}}">{{$district}}</option>

                                </select>
                            </div>
                            

                        </div>
                        <br>
                        <label for="file">อัปโหลดรูปภาพสินค้า</label>
                        <input class="file" type="file" name="img[]" id="file" multiple
                            onchange="javascript:updateList()" />
                        <br />Selected files:
                        <div id="fileList"></div>
                        
                        <br>
                        <div class="center">
                            <input type="submit" class="btn btn-warning" value="แก้ไขข้อมูล">

                        </div>

                        <div class="addressblock">


                        </div>





                   


                    @endforeach
                     </form>    
                    </div>

                </div>
            </div>
        </div>

    </body>
    
    <script type="text/javascript">
        updateList = function() {
            var input = document.getElementById('file');
            var output = document.getElementById('fileList');

            output.innerHTML = '<ul>';
            for (var i = 0; i < input.files.length; ++i) {
                output.innerHTML += '<li>' + input.files.item(i).name + '</li>';
            }
            output.innerHTML += '</ul>';
        };


        $('#province').change(function() {

            if ($(this).val() != '') {
                var select = $(this).val();
                var _token = $('input[name="_token"]').val();

                $.ajax({
                    url: "{{ route('dropdowndistrict') }}",
                    method: "POST",
                    data: {
                        select: select,
                        _token: _token
                    },
                    success: function(result) {
                        console.log(result);
                        $('#district').html(result);
                    }
                })

            }

        });
    </script>

    </html>


@endsection
