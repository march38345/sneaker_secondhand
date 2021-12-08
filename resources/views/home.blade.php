@extends('layouts.app')

@section('content')
    <!DOCTYPE html>
    <html lang="en">
    <link rel="stylesheet" href="/css/home.css">

    <head>
        <!-- CSS only -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
            integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">


        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css">
       
       
       
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous">
       </script>
       <style>


        </style>


    </head>

    <body>

        <div class="head">
            <div class="row">
                <section class="col-lg-6  col-sm-6 a">
                    <h3>เว็บไซต์ขายรองเท้าออนไลน์</h3>
                    <h5>Second_Hand ยอดนิยม</h5>

                    <p>เว็บไซต์ของเราเป็นเว็บไซต์ที่สามารถให้คุณนำรองเท้าที่คุณต้องการจะขาย
                        ทั้งที่ผ่านการใช้งานมาแล้วหรือยังไม่เคยผ่านการใช้งานสามารถนำขายตั้งขายได้ที่เว็บไซต์ของเราได้เลยตั้งขายคลิ๊กที่นี่
                        <a href="{{route('set_for_sale')}}">Learn More</a>
                    </p>


                </section>
                <section class="col-lg-5 col-sm-6 content">
                    <div class="slideshow-container">
                        @php
                            $arrimg = ['item1.jpg', 'item2.jpg', 'item3.jpg'];
                            $lenimg = count($arrimg);
                        @endphp


                        @for ($i = 0; $i < $lenimg; $i++)

                            <div class="mySlides">

                                <img src="/image/home/{{ $arrimg[$i] }}" width="100%" height="100%">

                            </div>


                        @endfor

                        <div style="text-align:center" class="dotblock">
                            @for ($i = 0; $i < $lenimg; $i++)
                                <span class="dot" onclick="currentSlide($i)"></span>
                            @endfor
                        </div>






                        <a class="prev" onclick="plusSlides(-1)">&#10094;</a>
                        <a class="next" onclick="plusSlides(1)">&#10095;</a>

                    </div>

                </section>
            </div>

        </div>

        <div class="col-12 bodysection">
            <h3>วิธีการใช้งานเว็บไซต์</h3>
            <div class="container">
                <div class="row">
                    <div class="col-lg-5 col-sm-6 loginimg">
                        <img src="/image/home/discrip.png" alt="" width="100%">
                    </div>
                    <div class="col-lg-4 col-sm-4 logindis">
                        <p>เริ่มต้นการใช้ใช้งานระบบผู้ใช้ต้องทำการ <a href="">Login</a>
                            เข้าสู่ระบบหากผู้ใช้ไม่มีรหัสให้ทำการ <a href="">Register</a> เพื่อใช้งนฟังก์ชันในระบบเช่น
                            การตั้งขายสินค้า หรือติดต่อผู้ซื้อและผู้ขาย
                        </p>
                    </div>
                </div>
                <div class="row">

                    <div class="col-lg-4 col-sm-4 logindis">
                        <p>
                            หน้าหลักสำหรับแนะนำรายละเอียดการใช้งานของเว็บไซต์และฟังก์ชันต่างๆ
                        </p>
                    </div>
                    <div class="col-lg-5 col-sm-5 loginimg2">
                        <img src="/image/home/discrip2.png" alt="" width="100%">
                    </div>
                </div>
            </div>
 <h3>ฟังก์ชันหลักของเว็บไซต์</h3>
            <div class="container">
               
                <div class="container col-lg-10 col-sm-10 blockmainfunction" style="width: 70%">
                  
                    <img src="/image/home/main_dis01.png" alt="" width="100%" height="600px">
                    <h5 style="color: black" class="headmain">market</h5>
                    <p class="container submainfun">
                        หน้า market มีไว้สำหรับดูรายการโพสขายรองเท้าต่างๆภายในเว็บไซต์ให้ผู้ซื้อสามารถเลือกซื้อรองเท้าที่ต้องการซื้อ และฟังก์การเลือกเฉพาะแบรนที่สนใจ
                    </p>
                </div>
                <div class="container col-lg-10 col-sm-10 blockmainfunction" style="width: 70%">
                  
                   
                    <img src="/image/home/main_dis02.png" alt="" width="100%" height="600px">
                     <h5 style="color: black" class="headmain">sale</h5>
                    <p class="container submainfun"> 
                       หน้า sale มีไว้สำหรับผู้ที่ต้องการจะขายโพสขายสินค้า โดยผู้ขายต้องทำการกรอกข้อมูลของสินค้าให้ครบถ้วน
                    </p>
                </div>
                <div class="container col-lg-10 col-sm-10 blockmainfunction" style="width: 70%">
                   
                    <img src="/image/home/main_dis03.png" alt="" width="100%" height="600px">
                     <h5 style="color: black" class="headmain">chat</h5>
                    <p class="container submainfun">
                       หน้า chat มีไว้สำหรับติดต่อระหว่าผู้ซื้อและผู้ขาย วิธีใช้งานทำการกรอก username ที่เราจะทำการติดต่อ หรือเลือกผู้ที่จะต้องการติดจากแทบทางด้านซ้าย 
                    </p>
                </div>
            </div>






        </div>




    </body>
  
    <script>
        var countblockmain = 1;
        var blockmain = document.getElementsByClassName('blockmainfunction');
        var blocklen = blockmain.length;
        for (i = 0; i < blocklen; i++) {
            blockmain[i].style.display = "none";
        }
        blockmain[countblockmain - 1].style.display = "block";
       

        setInterval(function() {
            setblockmain();
        }, 10000);

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
