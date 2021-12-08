@extends('layouts.app')

@section('content')
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css">

        <style>
            * {
                box-sizing: border-box
            }

            body {
                font-family: Verdana, sans-serif;
                margin: 0
            }

            .mySlides {
                display: none;
                width: 100%;
                height: 100%;

            }

            img {}

            /* Slideshow container */
            .slideshow-container {

                position: relative;
                height: ;
                margin-left: 10%;
                margin-right: 5%
            }

            /* Next & previous buttons */
            .prev,
            .next {
                cursor: pointer;
                position: absolute;
                top: 50%;
                width: auto;
                padding: 16px;
                margin-top: -22px;
                color: black;
                font-weight: bold;
                font-size: 18px;
                transition: 0.6s ease;
                border-radius: 0 3px 3px 0;
                user-select: none;
            }

            /* Position the "next button" to the right */
            .next {
                right: 0;
                border-radius: 3px 0 0 3px;
            }

            .prev {
                left: 0;
                border-radius: 3px 0 0 3px;
            }

            /* On hover, add a black background color with a little bit see-through */
            .prev:hover,
            .next:hover {
                background-color: rgba(0, 0, 0, 0.8);
            }

            /* Caption text */
            .text {
                color: #f2f2f2;
                font-size: 15px;
                padding: 8px 12px;
                position: absolute;
                bottom: 8px;
                width: 100%;
                text-align: center;
            }

            /* Number text (1/3 etc) */
            .numbertext {
                color: #f2f2f2;
                font-size: 12px;
                padding: 8px 12px;
                position: absolute;
                top: 0;
            }

            /* The dots/bullets/indicators */
            .dot {
                cursor: pointer;
                height: 15px;
                width: 15px;
                margin: 0.2px;
                background-color: #bbb;
                border-radius: 50%;
                display: inline-block;
                transition: background-color 0.6s ease;
            }

            .active,
            .dot:hover {
                background-color: #717171;
            }

            /* Fading animation */
            .fade {
                -webkit-animation-name: fade;
                -webkit-animation-duration: 1.5s;
                animation-name: fade;
                animation-duration: 1.5s;
            }

            @-webkit-keyframes fade {
                from {
                    opacity: .4
                }

                to {
                    opacity: 1
                }
            }

            @keyframes fade {
                from {
                    opacity: .4
                }

                to {
                    opacity: 1
                }
            }

            /* On smaller screens, decrease text size */
            @media only screen and (max-width: 300px) {

                .prev,
                .next,
                .text {
                    font-size: 11px
                }
            }

            .content {

                min-height: 600px;

            }

            .info {
                margin-left: 5%;
                margin-top: 2%;
                margin-right: 5%;
               
              
            }

            .brand {
                
                font-size: 20px;
            }

            .descriptionblock {
                overflow-y:scroll;
                height: 200px;
                border:solid rgba(66, 63, 63, 0.3);
            }

            .dotblock {
                display: block;
            }

            .emailblock {
                background: #bfc1c2;

            }

            h1 {
                text-align: center;
            }

            h5 {
                font-weight: 1000;
            }

            h1 {
                padding-top: 20px;
            }

        </style>
    </head>

    <body>

        <h1>รายละเอียดสินค้า</h1>
        @php
            $count = 0;
        @endphp
        <div class="content  col-12">
            <div class="row" >


                <div class="col-lg-4 col-sm-10 col-md-10 slideshow-container">
                    @foreach ($product as $item)
                        @php
                            $len = sizeof($item->path_img);
                        @endphp
                        @for ($i = 0; $i < $len; $i++)

                            <div class="mySlides">
                                <div class="numbertext">{{ $i + 1 }}/ {{ $len }}</div>
                                <img src="/image/store/{{ $item->path_img[$i] }}" style="width:100%" height="500px">

                            </div>


                        @endfor

                        <div style="text-align:center" class="dotblock">
                            @for ($i = 0; $i < $len; $i++)
                                <span class="dot" onclick="currentSlide($i)"></span>
                            @endfor
                        </div>


                    @endforeach



                    <a class="prev" onclick="plusSlides(-1)">&#10094;</a>
                    <a class="next" onclick="plusSlides(1)">&#10095;</a>

                </div>
                <br>
                <div class="container col-lg-4 col-sm-10 info" >
                    @foreach ($product as $item)
                        <div class="branblock">
                            <h5 class="brand">ยี่ห่อ: {{ $item->brand_name }} </h5>
                            <h5>id_prouct:{{ $item->id }}</h5>
                        </div>
                        <div>
                            <p>size:{{ $item->size }}</p>
                            
                        </div>
                        <div class="descriptionblock" width="80%">
                            <h5>คำอธิบายสินค้า</h5>
                            <p class="description" width="100%"> {{ $item->discription }}</p>

                        </div>
                        <div class="emailblock">
                            <h5>ข้อมูลผู้ขาย</h5>
                            <p>usernameผู้ขาย:{{ $item->user->name}}</p>
                            <p>emailติดต่อผู้ขาย:{{ $item->user->email }}</p>
                            <p>เบอร์โทรศัพท์ติดต่อผู้ขาย:{{ $item->phone }}</p>
                            <p>ที่อยู่:{{ $item->province }} {{ $item->district }} </p>
                        </div>

                    @endforeach

                </div>
            </div>
        </div>


    </body>
    <script>
        var slideIndex = 1;
        showSlides(slideIndex);

        function plusSlides(n) {
            showSlides(slideIndex += n);
        }

        function currentSlide(n) {
            showSlides(slideIndex = n);
        }

        function showSlides(n) {
            var i;
            var slides = document.getElementsByClassName("mySlides");
            var dots = document.getElementsByClassName("dot");
            if (n > slides.length) {
                slideIndex = 1
            }
            if (n < 1) {
                slideIndex = slides.length
            }
            for (i = 0; i < slides.length; i++) {
                slides[i].style.display = "none";
            }
            for (i = 0; i < dots.length; i++) {
                dots[i].className = dots[i].className.replace(" active", "");
            }
            slides[slideIndex - 1].style.display = "block";
            dots[slideIndex - 1].className += " active";

        }
    </script>

    </html>

@endsection
