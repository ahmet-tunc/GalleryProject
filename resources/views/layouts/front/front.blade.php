<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{asset('assets/front-assets/bootstrap/dist/css/bootstrap.min.css')}}">


    <!-- Font -->
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link
        href="https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,300;0,400;0,600;0,700;0,800;1,300;1,400;1,600;1,700;1,800&display=swap"
        rel="stylesheet">

    <!--CAROUSEL-->
    <link rel="stylesheet" href="{{asset('assets/front-assets/css/style.css')}}">

    <link rel="stylesheet" href="{{asset('assets/front-assets/css/glider.css')}}">
    <link rel="stylesheet" href="{{asset('assets/front-assets/css/jquery.fancybox.css')}}">


    <!--Icon-->
    <script src="https://use.fontawesome.com/fee7aa9173.js"></script>

    <title>Doğa Çiftlik</title>
</head>
<body>

<!--NAVBAR START-->
<nav>
    <div class="navbar navbar-expand-sm navbar-light pt-0 pb-0 nav-header">
        <div class="container">

            <div class="col-12 d-none d-md-block">
                <div class="row">
                    <div class="col-4 pr-0 pl-0">
                        <div class="row">
                            <div class="col-6">
                                <a href="#"><i class="fa fa-phone"> 0532 674 83 69</i></a>
                            </div>
                            <div class="col-6">
                                <a href="#"><i class="fa fa-envelope"> info@dogaciftlik.com</i></a>
                            </div>
                        </div>
                    </div>
                    <div class="col-8">
                        <div class="row">
                            <div class="col-10 text-right">
                                <a href="#"><i class="fa fa-facebook social-icon"></i></a>
                                <a href="#"><i class="fa fa-twitter social-icon"></i></a>
                                <a href="#"><i class="fa fa-instagram social-icon"></i></a>
                                <a href="#"><i class="fa fa-youtube social-icon"></i></a>
                                <a href="#"><i class="fa fa-whatsapp social-icon"></i></a>
                            </div>
                            <div class="col-2 text-right">
                                <a href="#"><i class="fa fa-search"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>


    </div>
    <div class="navbar navbar-expand-lg navbar-light">
        <div class="container">
            <a class="navbar-brand" href="#">
                <img src="{{asset('assets/front-assets/img/logo.png')}}" width="250" height="auto" alt="">
            </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
                    aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item active">
                        <a class="nav-link" href="#">Anasayfa<span class="sr-only">(current)</span></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link deneme" href="#">Hakkımızda</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Hizmetlerimiz</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Şara Butik Otel</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Referanslarımız</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">İletişim</a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</nav>
<!--NAVBAR END-->

<div class="content">

    <!--CAROUSEL START-->
    <section>
        <div id="contentCarousel" class="carousel slide" data-ride="carousel">
            <div class="carousel-inner">
                @if(sizeof($slider)>0)
                    @foreach($slider as $item)

                        <div class="carousel-item active">
                            <img class="d-block w-100" src="{{asset('storage/'.$item['path'])}}" alt="First slide">
                        </div>

                    @endforeach
                @else
                    <div class="carousel-item active">
                        <img class="d-block w-100" src="{{asset('assets/front-assets/img/firstSlider.png')}}"
                             alt="First slide">
                    </div>
                @endif

            </div>

            <div class="carousel-caption d-block d-md-block">
                <h1 class="carousel-text mb-md-4">TABİATIN BAHARDAKİ CANLANIŞI</h1>
                <button class="btn btn-outline-light carousel-button">REZERVASYON YAP</button>
            </div>


            <div class="green-description">
                <div class="contenedor">
                    <form>
                        <input type="radio" id="Slide1" name="slider" autofocus="autofocus"
                               checked="checked"/>
                        <input type="radio" id="Slide2" name="slider"/>
                        <input type="radio" id="Slide3" name="slider"/>

                        <div class="labels">
                            <label for="Slide1" id="Slide1" class="Slide">
                                <div class="content">
                                    <div class="block">
                                      <span>
                                        Alta velocidade nas implantações, mudanças e ampliações
                                      </span>
                                    </div>
                                </div>
                            </label>
                            <label for="Slide2" id="Slide2" class="Slide">
                                <div class="content">
                                    <div class="block">
                                      <span>
                                        Alta velocidade nas implantações, mudanças e ampliações
                                      </span>
                                    </div>
                                </div>
                            </label>
                            <label for="Slide3" id="Slide3" class="Slide">
                                <div class="content">
                                    <div class="block">
                                     <span>
                                       Alta velocidade nas implantações, mudanças e ampliações
                                     </span>
                                    </div>
                                </div>
                            </label>
                        </div>
                    </form>
                </div>
            </div>


        </div>
    </section>
    <!--CAROUSEL END-->


    <section class="carousel-back">
        <div class="container slider">
            <div class="slider-text text-center gray">
                <h3 class="mb-md-4">DOĞA ÇİFTLİKTE NELER BULABİLİRSİNİZ ?</h3>
                <p class="">Egestas dignissim a enim lorem a mus egestas risus porta? Sed. Scelerisque, in nec velit
                    augue aenean a, vut velit nec! Phasellus aliquam odio. </p>
            </div>
            <div class="glider-contain">
                <div class="glider">

                    @if(sizeof($subSlider)>0)
                        @foreach($subSlider as $item)

                            <div class="card" style="width: 18rem;">
                                <img class="card-img-top" src="{{asset('storage/'.$item['path'])}}"
                                     alt="Card image cap">
                                <div class="carousel-caption">
                                    <h5 class="card-title">{{$item['title']}}</h5>
                                </div>
                            </div>
                        @endforeach
                    @else
                        @for($i=0; $i<6; $i++)
                            <div class="card" style="width: 18rem;">
                                <img class="card-img-top" src="{{asset('assets/front-assets/img/altSliderFirst.png')}}"
                                     alt="Card image cap">
                                <div class="carousel-caption">
                                    <h5 class="card-title">266x266</h5>
                                </div>
                            </div>
                        @endfor
                    @endif

                </div>

                <button aria-label="Previous" class="glider-prev"><span class="fa fa-chevron-left"></span></button>
                <button aria-label="Next" class="glider-next"><span class="fa fa-chevron-right"></span></button>
                <div role="tablist" class="dots"></div>
            </div>
        </div>
    </section>

    <section class="image-gallery">
        <div class="gallery-caption text-center mb-5">
            <h3 class="gray">GALERİ</h3>
        </div>

        <div class="imglist">
            <div class="col-md-12 m-0 p-0">
                <div class="col-md-12">
                    <div class="row">
                        @if(sizeof($gallery)>0)
                            @foreach($gallery as $item)
                                @if($item['parent']==0)
                                <div class="gallery_product col-sm-6 col-md-6 col-lg-4 p-0"
                                     style="background-image: url('{{asset('storage/'.$item['path'])}}'); background-size: cover; background-repeat: no-repeat; width: 100%; height: 400px">
                                    <div class="shadow">
                                        <div class="inner-text" id="inner{{$item['id']}}">
                                            <div style="width: 100%; height: 400px">
                                                <div class="carousel-caption">
                                                    <h3>{{$item['name']}}</h3>
                                                    <h6>{{$item['description']}}</h6>
                                                    <a data-id="{{$item['id']}}"
                                                       href="{{asset('storage/'.$item['path'])}}"
                                                       class="btn light-green text-white mt-4 d-none btn-detail chooseImage">
                                                        DETAYLI
                                                        GÖR
                                                    </a>
                                                </div>
                                            </div>
                                            <div class="innerImages"></div>
                                        </div>
                                    </div>
                                </div>
                                @endif
                            @endforeach
                        @else
                            @for($i=0; $i<6; $i++)
                                <div class="gallery_product col-sm-6 col-md-6 col-lg-4 p-0"
                                     style="background-image: url('{{asset('assets/front-assets/img/galleryFirst.jpg')}}'); background-size: cover; background-repeat: no-repeat; width: 100%; height: 400px">
                                    <div class="shadow">
                                        <div class="inner-text">
                                            <div style="width: 100%; height: 400px">
                                                <div class="carousel-caption">
                                                    <h3>2000 x 1450</h3>
                                                </div>
                                            </div>
                                            <div class="innerImages"></div>
                                        </div>
                                    </div>
                                </div>
                            @endfor
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="sec-comment">
        <div class="container slider">
            <div class="comment-caption text-center mb-5">
                <h3 class="dark-gray">MÜŞTERİLERİMİZİN YORUMLARI</h3>
            </div>

            <div class="glider-contain dark-gray">
                <div class="comment-slider">
                    <div class="text-center">
                        <h5>AHMET TUNÇ</h5>
                        <p>Şehir stresinden uzak harika bir mekan. Kahvaltı için gittik, ailece keyif aldık.</p>
                    </div>
                    <div class="text-center">
                        <h5>SAFA TUNÇ</h5>
                        <p>Şehir stresinden uzak harika bir mekan. Kahvaltı için gittik, ailece keyif aldık.</p>
                    </div>
                    <div class="text-center">
                        <h5>MERVE TUNÇ</h5>
                        <p>Şehir stresinden uzak harika bir mekan. Kahvaltı için gittik, ailece keyif aldık.</p>
                    </div>
                    <div class="text-center">
                        <h5>ELİF TUNÇ</h5>
                        <p>Şehir stresinden uzak harika bir mekan. Kahvaltı için gittik, ailece keyif aldık.</p>
                    </div>
                    <div class="text-center">
                        <h5>YASİN TUNÇ</h5>
                        <p>Şehir stresinden uzak harika bir mekan. Kahvaltı için gittik, ailece keyif aldık.</p>
                    </div>
                    <div class="text-center">
                        <h5>YÜKSEL TUNÇ</h5>
                        <p>Şehir stresinden uzak harika bir mekan. Kahvaltı için gittik, ailece keyif aldık.</p>
                    </div>
                </div>
                <div role="tablist" class="change-comment" id="change-comment"></div>
            </div>

        </div>


    </section>


    <section class="sec-map mt-5">
        <div class="map-back" style="background-image: url('{{asset('assets/front-assets/img/footer-bg.jpg')}}')">
            <div class="shadow"></div>
            <div class="map-inner carousel-caption">
                <h1 class="map-title">DOĞA ÇİFTLİK</h1>
                <button class="btn btn-success btn-circle mt-5 light-green">HARİTA</button>
            </div>
        </div>
    </section>


    <footer class="pt-4 pt-md-5">
        <div class="container">
            <div class="row">
                <div class="col-12 col-md-3">
                    <h5 class="gray">DOĞA ÇİFTLİK</h5>
                    <ul class="list-unstyled text-small mt-4">
                        <li><a class="text-muted" href="#">İstanbul Cad. No:35 Mollafenari Koyu
                                Girişi Akviran Agil Korusu Mevkii, 41400 Mollafeneri/Gebze/Kocaeli</a></li>
                        <li class="mt-3"><a class="text-muted" href="#">(0262) 727 3668</a></li>
                        <li class="mt-3"><a class="text-muted" href="#">Rezervasyon : 0532 674 83 69</a></li>
                    </ul>
                </div>
                <div class="col-12 col-sm-6 col-md-3">
                    <h5 class="gray">SİTE HARİTASI</h5>
                    <ul class="list-unstyled text-small mt-4">
                        <li><a class="text-muted" href="#">HAKKIMIZDA</a></li>
                        <li><a class="text-muted" href="#">HİZMETLERİMİZ</a></li>
                        <li><a class="text-muted" href="#">ŞARA BUTİK OTEL</a></li>
                        <li><a class="text-muted" href="#">REFERANSLARIMIZ</a></li>
                    </ul>
                </div>
                <div class="col-12 col-sm-6 col-md-3">
                    <h5 class="gray">SOSYAL MEDYA</h5>
                    <ul class="list-unstyled text-small d-inline-flex mt-4">
                        <li><a class="footer-icon light-green" href="#"><i class="fa fa-facebook"></i></a></li>
                        <li><a class="footer-icon light-green" href="#"><i class="fa fa-twitter"></i></a></li>
                        <li><a class="footer-icon light-green" href="#"><i class="fa fa-instagram"></i></a></li>
                        <li><a class="footer-icon light-green" href="#"><i class="fa fa-youtube"></i></a></li>
                    </ul>
                </div>
                <div class="col-12 col-md-3">
                    <h5 class="gray">E-BÜLTEN</h5>
                    <form class="mt-4">
                        <div class="form-group">
                            <input type="email" class="form-control" placeholder=" E-mail adresinizi giriniz">
                            <input type="submit" value="GÖNDER" class="btn btn-block mt-1 light-green text-white">
                        </div>
                    </form>
                </div>
            </div>
            <div class="row border-top pt-4 pb-4">
                <div class="col-md-10">
                    <span class="text-muted">Tüm hakları saklıdır 2017 | Doğa Çiftlik</span>
                </div>
                <div class="col-md-2">
                    <img src="{{asset('assets/front-assets/img/footer-logo.png')}}" alt="logo">
                </div>
            </div>
        </div>
    </footer>
</div>
<script src="{{asset('assets/front-assets/js/jquery-3.5.1.js')}}"></script>
<script src="{{asset('assets/front-assets/js/glider.js')}}"></script>
<script src="{{asset('assets/front-assets/bootstrap/dist/js/bootstrap.min.js')}}"></script>
<script src="{{asset('assets/front-assets/bootstrap/dist/js/bootstrap.bundle.js')}}"></script>
<script src="{{asset('assets/front-assets/js/script.js')}}"></script>
<script src="{{asset('assets/front-assets/js/jquery.fancybox.js')}}"></script>
<script>
    window.addEventListener('load', function ()
    {


// Simple filter
        $('#filter').on('change', function ()
        {
            var $visible, val = this.value;

            if (val)
            {
                $visible = $('.imglist a').hide().filter('.' + val);

            }
            else
            {
                $visible = $('.imglist a');
            }

            $visible.show();
        })


        $('.chooseImage').click(function ()
        {
            let dataID = $(this).data('id');
            $.ajax({
                url: '{{route('front.getGallery')}}',
                method: 'POST',
                data: {
                    '_token': '{{csrf_token()}}',
                    'id': dataID
                },
                async: false,
                success: function (response)
                {
                    $('.temp-image').remove();
                    for (let i = 0; i < response.data.length; i++)
                    {
                        var inner = document.querySelector('#inner' + response.data[i].parent + ' .innerImages');
                        let image = document.createElement('a');
                        image.style.background = "url('storage/" + response.data[i].path + "') center center";
                        image.style.width = "1000px";
                        image.style.objectFit = "cover";
                        image.className = "temp-image";
                        image.style.height = "750px";
                        image.style.padding = "0";
                        image.style.margin = "0";
                        $(inner).append(image);
                    }
                    $(inner).fancybox({
                        selector: '.imglist a:visible',
                        thumbs: {
                            autoStart: true
                        }
                    });

                },
                error: function (error)
                {

                }
            });
        });


        new Glider(document.querySelector('.glider'), {
            slidesToShow: 4,
            draggable: true,
            slidesToScroll: 1,
            scrollLock: true,
            arrows: {
                prev: '.glider-prev',
                next: '.glider-next'
            },
            responsive: [
                {
                    breakpoint: 200,
                    settings: {
                        slidesToShow: 1,
                        slidesToScroll: 'auto',
                        itemWidth: 150,
                        duration: 1
                    }
                },
                {
                    breakpoint: 400,
                    settings: {
                        slidesToShow: 2,
                        slidesToScroll: 'auto',
                        itemWidth: 150,
                        duration: 1
                    }
                },
                {
                    breakpoint: 600,
                    settings: {
                        slidesToShow: 3,
                        slidesToScroll: 'auto',
                        itemWidth: 150,
                        duration: 1
                    }
                }, {
                    breakpoint: 900,
                    settings: {
                        slidesToShow: 4,
                        slidesToScroll: 1,
                        itemWidth: 150,
                        duration: 1
                    }
                }
            ]
        });

        new Glider(document.querySelector('.comment-slider'), {
            slidesToShow: 1,
            dots: '#change-comment'
        });

    });
</script>
</body>
</html>
