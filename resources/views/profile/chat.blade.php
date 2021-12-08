@extends('layouts.app')

@section('content')
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
        <title>Document</title>
        <style>
            .main {
                display: flex;
            }

            #message {
                width: 100%;
            }

            .card {
                background-color: rgb(204, 202, 219);
            }

            .mainmessage {
                padding: 0px;
                overflow-y: scroll;
                margin-top: 10px;


            }

            .sendmessage {
                margin-top: 5px;
                height: 20%;
                padding: 0px;
            }

            .col-lg-1 {
                margin-left: 90%;
            }

            .itemlistchat {
                background-color: white;
                margin-top: 10px;
                padding-left: 10px;
                border-radius: 10px;

            }
            .itemlistchat:hover{
                background: rgb(222, 135, 225);
              

            }

            .list {
                list-style-type: none;
                padding: 0px;


            }

            .side {
                overflow-y: scroll;
                height: 600px;
                
                 
            }

            .submassage_send {
               
                
                margin-right: 5px;
                list-style-type: none;
                background-color: rgb(90, 155, 90);
                margin-top: 5px;
                border-radius: 10px;
                padding-right: 10px;
                width: 30%;
               padding: 10px;
                margin-left: 68%;

            }

            .submassage_receive {
                padding: 10px;
                margin-left: 2%;
                margin-right: 50%;
                list-style-type: none;
                background-color: rgb(88, 88, 169);

                margin-top: 5px;
                width: 30%;
                border-radius: 10px;
                padding-right: 10px;

            }

            .message {
                padding: 0px;
            }
            .namelist{
                margin-top: 5px;
                margin-bottom: 0px;
            }

        </style>
    </head>

    <body>
        <div class="card" style="background: rgb(46, 196, 148)">
            <h5 style="text-align: center">ผู้ดูแลuser:admin01</h5>
        </div>

        <div class="container"  style="margin-bottom:60px">
            <div class="row" style="margin-top: 20px;margin-bottom:20px;">
                <div class="card col-lg-2 col-sm-4 side">
                    
                    <h5 class="namelist">รายชื่อผู้ติดต่อ</h5>
                    <ul class="list">

                    </ul>
                </div>
                <div class="card col-lg-8 col-sm-8 " style="height: 600px">
                    <label for="sendto">Send To:userที่ต้องการติดต่อ</label>
                    <input type="text" name="sendto" id="sendto" value="" class="form-control" >
                    <div class="card col-lg-12 col-sm-12 bg-white mainmessage" style="height: 65%;">
                        <ul class="message" width="100%" >

                        </ul>


                    </div>
                    <div class="card col-lg-12 col-sm-12 bg-white sendmessage">

                        <textarea name="message" id="message" cols="30" rows="10"></textarea>
                        <div class="btn btn-primary col-sm-1 col-lg-1" style="margin-left:91%;padding:0px" title="ส่ง"
                            id="sendmessage" style="">
                            <i data-feather="send" style="height: 60%;padding:0px;margin:0px"></i>
                        </div>

                    </div>


                </div>


            </div>


        </div>
        @csrf
        <script>
            var sizemessage = 0;
            var id_receive = " ";

            $(document).ready(function() {
                clicklist();
                $('.itemlistchat').click(function() {
                    console.log(this.id);
                    console.log('click');

                });

                $('#sendmessage').click(function() {
                    console.log("click");
                    var user_id = {{ auth()->user()->id }};
                    var message = $('#message').val();
                    var sendto = $('#sendto').val();
                    sendmessage(user_id, sendto, message);
                });


            });

            function sendmessage(user_id, sendto, message) {
                var _token = $('input[name="_token"]').val();

                $.ajax({
                    url: "{{ route('sendto') }}",
                    method: "POST",
                    data: {
                        data: {
                            "user_id": user_id,
                            "sendto": sendto,
                            "message": message
                        },
                        _token: _token
                    },
                    success: function(result) {
                        $('#message').val("");
                    }


                })


            }

            setInterval(function() {


               listchat();
                clicklist();
               newmessage();
                console.log(sizemessage);

            }, 1000);

            var countlist = 0 //นับจำนวนlistครั้งแรก=0
            function listchat() {
                var id = {{ auth()->user()->id }};
                var _token = $('input[name="_token"]').val();
                $.ajax({
                    url: "{{ route('getlist') }}",
                    method: "POST",
                    data: {
                        data: {
                            "user_id": id,

                        },
                        _token: _token
                    },
                    success: function(result) {

                        var listchat = JSON.parse(result)
                        var len_list = Object.keys(listchat).length;
                      
                        if (countlist == 0) { //check list ครั้งแรก
                          
                            for (let i in listchat) {
                                li1 = '<li class="itemlistchat" value="' + listchat[i][0]['name'] + '" id="' +
                                    listchat[i][0]['id'] + '">';
                                li2 = '</li>'
                                name = listchat[i][0]['name'];
                                str = li1.concat(name).concat(li2);
                                countlist++;

                                $('.list').append(str);

                            }
                        }

                        if (countlist < len_list) {
                            while (countlist < len_list) {
                                li1 = '<li class="itemlistchat" value="' + listchat[countlist][0]['name'] +
                                    '" id="' + listchat[countlist][0]['id'] + '">';
                                li2 = '</li>'
                                name = listchat[countlist][0]['name'];
                                str = li1.concat(name).concat(li2);
                                countlist++;
                                console.log()
                                $('.list').append(str);
                            }

                        }


                    }


                })


            }

            function clicklist() {


                $('.itemlistchat').off("click").click(function() {
                    $('.itemlistchat').css({'background':'white'})
                    $(this).css({'background':'#de87e1'})
                    $('.message').empty();
                    var name = $(this).attr("value");
                    var user_receive = this.id;
                    id_receive = user_receive;
                    console.log(this.id);
                    var id = {{ auth()->user()->id }};
                    var _token = $('input[name="_token"]').val();
                    console.log(name);
                    $.ajax({
                        url: "{{ route('getmessage') }}",
                        method: "POST",
                        data: {
                            data: {
                                "user_send": id,
                                "user_receive": user_receive

                            },
                            _token: _token
                        },
                        success: function(result) {
                            $('#sendto').val(name);
                            var count = result.length;
                            sizemessage = count;

                            for (let i in result) {
                                if (result[i]['user_send'] == {{ auth()->user()->id }}) {
                                    console.log('arr');
                                    msg = '<li class="submassage_send" title="'+ result[i]['created_at'] +'">' + result[i]['chat_msg'] +
                                        '</li>';
                                    $('.message').append(msg);

                                } else {
                                    msg = '<li class="submassage_receive"  title="'+ result[i]['created_at'] +'">' + result[i][
                                            'chat_msg'
                                        ] +
                                        '</li>';
                                    $('.message').append(msg);
                                }


                            }



                            //   for(let i in listmessage){
                            //     str = '<li class="submessage">'+listmessage+'</li>'
                            //}

                        }
                    })


                });
            }

            function newmessage() {
                if (id_receive != " ") {
                    let id = {{ auth()->user()->id }};
                    var _token = $('input[name="_token"]').val();
                    $.ajax({
                        url: "{{ route('getmessage') }}",
                        method: "POST",
                        data: {
                            data: {
                                "user_send": id,
                                "user_receive": id_receive

                            },
                            _token: _token
                        },
                        success: function(result) {
                            var le = result.length;
                            if (le > sizemessage) {
                                while (sizemessage < le) {
                                    if (result[sizemessage]['user_send'] == id) {

                                        msg = '<li class="submassage_send"  title="'+ result[sizemessage]['created_at'] +'">' + result[sizemessage]['chat_msg'] +
                                            '</li>';
                                        $('.message').append(msg);

                                    } else {
                                        msg = '<li class="submassage_receive"  title="'+ result[sizemessage]['created_at'] +'">' + result[sizemessage][
                                                'chat_msg'
                                            ] +
                                            '</li>';
                                        $('.message').append(msg);
                                    }

                                    sizemessage++;
                                }
                            }
                        }
                    })

                }
            }
        </script>

        <script>
            feather.replace()
        </script>
    </body>

    </html>
@endsection
