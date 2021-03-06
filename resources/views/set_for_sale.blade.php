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

        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
            integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
        <style>
            .file {
                margin-left: 0em
            }

            .center {

                width: 50%;
                margin-left: auto;
                margin-right: auto;


            }

            .btn.btn-success.btn-lg {
                width: 100%;
                margin-left: auto;
                margin-right: auto;
            }
            .card{
                background-color: rgb(226, 226, 226)
            }

        </style>
     
    </head>

    <body >
        @error('description')
    <div class="alert alert-danger">{{ $message }}</div>
@enderror
        @error('price')
    <div class="alert alert-danger">{{ $message }}</div>
@enderror
        @error('phone')
    <div class="alert alert-danger">{{ $message }}</div>
@enderror
        @error('size')
    <div class="alert alert-danger">{{ $message }}</div>
@enderror
        @error('img')
    <div class="alert alert-danger">{{ $message }}</div>
@enderror

        @if (session('success'))

            <div class="alert alert-success" role="alert">
                {{ session('success') }}
            </div>

        @elseif(session('error'))

            <div class="alert alert-danger" role="alert">
                {{ session('error') }}
            </div>
        @endif
        <div class="container" style="margin-bottom:20px;margin-top:20px">

            <div class="row col-12">
                <div class="col-9 container card" style="border:solid rgba(0,0,0,0.3)">
                    <div class="card-head" style="text-align: center">
                        <h3>?????????????????????????????????????????????????????????????????????????????????????????????????????????</h3>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('confirmsale') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <label for="brand_name">???????????????????????????????????????????????????</label>
                            <select name="brand_name" id="" class="form-select" aria-label="Default select example">
                                <option value="other">???????????????</option>
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

                            <label for="description">??????????????????????????????????????????</label>
                            <br>
                            <textarea class="form-control" id="exampleFormControlTextarea1" name="description"
                                rows="3"></textarea>
                            <br>
                            <label for="size">????????????</label>
                            <input type="text" name="size" class="form-control">
                            <br>
                            <label for="price">????????????THB</label>
                            <input type="text" name="price" class="form-control">
                            <br>

                            <label for="phone" >???????????????????????????????????????????????????</label>
                            <input type="text" name="phone" class="form-control">
                            <br>
                            <br>
                            <div class="addressblock">
                                <div class="provinceblock">
                                    <label for="province">???????????????????????????????????????????????????</label>
                                    <select name="province" id="province" class="form-select">
                                        <option value="">???????????????????????????????????????????????????</option>
                                        @foreach ($province as $item)
                                            <option value="{{ $item->id }}">{{ $item->name_in_thai }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <br>
                                <div class="districtblock">
                                    <label for="district">?????????????????????????????????????????????</label>
                                    <select name="district" id="district" class="form-select"> 
                                        <option value="">?????????????????????????????????????????????</option>

                                    </select>
                                </div>
                                

                            </div>
                            <label for="file">?????????????????????????????????????????????????????????</label>
                            <input class="file" type="file" name="img[]" id="file" multiple
                                onchange="javascript:updateList()" />
                            <br />Selected files:
                            <div id="fileList"></div>
                            <br>
                            <div class="center">
                                <input type="submit" class="btn btn-success btn-lg" value="??????????????????????????????">

                            </div>

                            <div class="addressblock">


                            </div>





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
                        $('#district').html(result);
                    }
                })

            }

        });
        $('#title').val('sale')
    </script>

    </html>


@endsection
