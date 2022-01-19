<!DOCTYPE html>
<html>

<head>
    <!-- Basic -->
    <meta charset="utf-8"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
    <!-- Mobile Metas -->
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no"/>
    <link rel="icon" type="image/x-icon" href="{{ asset('frontend/images/favicon.jpg') }}">

    <!-- Site Metas -->
    <meta name="keywords" content=""/>
    <meta name="description" content=""/>
    <meta name="author" content=""/>

    <title>Take Care</title>


    <!-- bootstrap core css -->
    <link rel="stylesheet" type="text/css" href="{{ asset('frontend/css/bootstrap.css')}}"/>

    <!-- fonts style -->
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700;900&display=swap" rel="stylesheet">

    <!--owl slider stylesheet -->
    <link rel="stylesheet" type="text/css"
          href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css"/>

    <!-- font awesome style -->
    <link href="{{ asset('frontend/css/font-awesome.min.css')}}" rel="stylesheet"/>
    <!-- nice select -->
    <link rel="stylesheet"
          href="https://cdnjs.cloudflare.com/ajax/libs/jquery-nice-select/1.1.0/css/nice-select.min.css"
    "/>
    <!-- datepicker -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.3.0/css/datepicker.css">
    <!-- Custom styles for this template -->
    <link href="{{ asset('frontend/css/style.css')}}" rel="stylesheet"/>
    <!-- responsive style -->
    <link href="{{ asset('frontend/css/responsive.css')}}" rel="stylesheet"/>

</head>

<body>

<div class="hero_area">
    <!-- header section strats -->
    <header class="header_section">
        <div class="header_top">
            <div class="container">
                <div class="contact_nav">
                    <a href="tel:+8801827370397">
                        <i class="fa fa-phone" aria-hidden="true"></i>
                        <span>
           +8801827370397
              </span>
                    </a>
                    <a href="mailto:hello@takecare.ltd">
                        <i class="fa fa-envelope" aria-hidden="true"></i>
                        <span>
               hello@takecare.ltd
              </span>
                    </a>
                    <a href="">
                        <i class="fa fa-map-marker" aria-hidden="true"></i>
                        <span>
                House:13, Road:21, Block:C Mirpur-12, Dhaka, 1216
              </span>
                    </a>
                </div>
            </div>
        </div>
        <div class="header_bottom">
            <div class="container-fluid">
                <nav class="navbar navbar-expand-lg custom_nav-container ">
                    <a class="navbar-brand" href="{{ url('/') }}">
                        <img src="{{ asset('frontend/images/logo.jpg')}}" alt="">
                    </a>


                    <button class="navbar-toggler" type="button" data-toggle="collapse"
                            data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                            aria-expanded="false" aria-label="Toggle navigation">
                        <span class=""> </span>
                    </button>

                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <div class="d-flex mr-auto flex-column flex-lg-row align-items-center">
                            <ul class="navbar-nav  ">
                                <li class="nav-item active">
                                    <a class="nav-link" href="{{ url('/') }}">Home <span
                                            class="sr-only">(current)</span></a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="#"> About</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="#">Contact Us</a>
                                </li>
                            </ul>
                        </div>
                        <!--                        <div class="quote_btn-container">
                                                    <a href="">
                                                        <i class="fa fa-user" aria-hidden="true"></i>
                                                        <span>
                                            Login
                                          </span>
                                                    </a>
                                                    <a href="">
                                                        <i class="fa fa-user" aria-hidden="true"></i>
                                                        <span>
                                            Sign Up
                                          </span>
                                                    </a>
                                                    <form class="form-inline">
                                                        <button class="btn  my-2 my-sm-0 nav_search-btn" type="submit">
                                                            <i class="fa fa-search" aria-hidden="true"></i>
                                                        </button>
                                                    </form>
                                                </div>-->
                    </div>
                </nav>
            </div>
        </div>
    </header>
    <!-- end header section -->
    <!-- slider section -->
    <section class="slider_section d-none">
        <div class="dot_design">
            <img src="{{ asset('frontend/images/dots.png')}}" alt="">
        </div>
        <div id="customCarousel1" class="carousel slide" data-ride="carousel">
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <div class="container ">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="detail-box">
                                    <div class="play_btn">
                                        <button>
                                            <i class="fa fa-play" aria-hidden="true"></i>
                                        </button>
                                    </div>
                                    <h1>
                                        Mico <br>
                                        <span>
                        Hospital
                      </span>
                                    </h1>
                                    <p>
                                        when looking at its layout. The point of using Lorem Ipsum is that it has a
                                        more-or-less normal distribution of letters, as opposed to
                                    </p>
                                    <a href="">
                                        Contact Us
                                    </a>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="img-box">
                                    <img src="{{ asset('frontend/images/slider-img.jpg')}}" alt="">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="carousel-item">
                    <div class="container ">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="detail-box">
                                    <div class="play_btn">
                                        <button>
                                            <i class="fa fa-play" aria-hidden="true"></i>
                                        </button>
                                    </div>
                                    <h1>
                                        Mico <br>
                                        <span>
                        Hospital
                      </span>
                                    </h1>
                                    <p>
                                        when looking at its layout. The point of using Lorem Ipsum is that it has a
                                        more-or-less normal distribution of letters, as opposed to
                                    </p>
                                    <a href="">
                                        Contact Us
                                    </a>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="img-box">
                                    <img src="{{ asset('frontend/images/slider-img.jpg')}}" alt="">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="carousel-item">
                    <div class="container ">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="detail-box">
                                    <div class="play_btn">
                                        <button>
                                            <i class="fa fa-play" aria-hidden="true"></i>
                                        </button>
                                    </div>
                                    <h1>
                                        Mico <br>
                                        <span>
                        Hospital
                      </span>
                                    </h1>
                                    <p>
                                        when looking at its layout. The point of using Lorem Ipsum is that it has a
                                        more-or-less normal distribution of letters, as opposed to
                                    </p>
                                    <a href="">
                                        Contact Us
                                    </a>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="img-box">
                                    <img src="{{ asset('frontend/images/slider-img.jpg')}}" alt="">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="carousel_btn-box">
                <a class="carousel-control-prev" href="#customCarousel1" role="button" data-slide="prev">
                    <img src="{{ asset('frontend/images/prev.png')}}" alt="">
                    <span class="sr-only">Previous</span>
                </a>
                <a class="carousel-control-next" href="#customCarousel1" role="button" data-slide="next">
                    <img src="{{ asset('frontend/images/next.png')}}" alt="">
                    <span class="sr-only">Next</span>
                </a>
            </div>
        </div>

    </section>
    <!-- end slider section -->
</div>


<!-- about section -->

<section class="about_section">
    <div class="container  ">
        <div class="row">
            <div class="col-md-6 ">
                <div class="img-box">
                    <img src="{{ asset('frontend/images/about-img.jpg')}}" alt="">
                </div>
            </div>
            <div class="col-md-6">
                <div class="detail-box">
                    <div class="heading_container">
                        <h2>
                            About <span>Takecare</span>
                        </h2>
                    </div>
                    <p>
                        <strong>TakeCare</strong> is a registered & government approved Home Based Healthcare Platform.
                        We are
                        providing necessary healthcare at doorstep to our patient as their requirements.
                    </p>
                    <a href="">
                        Read More
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- end about section -->

<!-- book section -->

<section class="book_section layout_padding')}}">
    <div class="container">
        <div class="row">
            <div class="col">
                <form>
                    <h4>
                        BOOK <span>APPOINTMENT</span>
                    </h4>
                    <div class="form-row ">
                        <div class="form-group col-lg-4">
                            <label for="inputPatientName">Patient Name </label>
                            <input type="text" class="form-control" id="inputPatientName" placeholder="">
                        </div>
                        <div class="form-group col-lg-4">
                            <label for="inputDoctorName">Doctor's Name</label>
                            <select name="" class="form-control wide" id="inputDoctorName">
                                <option value="Normal distribution ">Normal distribution</option>
                                <option value="Normal distribution ">Normal distribution</option>
                                <option value="Normal distribution ">Normal distribution</option>
                            </select>
                        </div>
                        <div class="form-group col-lg-4">
                            <label for="inputDepartmentName">Department's Name</label>
                            <select name="" class="form-control wide" id="inputDepartmentName">
                                <option value="Normal distribution ">Normal distribution</option>
                                <option value="Normal distribution ">Normal distribution</option>
                                <option value="Normal distribution ">Normal distribution</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-row ">
                        <div class="form-group col-lg-4">
                            <label for="inputPhone">Phone Number</label>
                            <input type="number" class="form-control" id="inputPhone" placeholder="XXXXXXXXXX">
                        </div>
                        <div class="form-group col-lg-4">
                            <label for="inputSymptoms">Symptoms</label>
                            <input type="text" class="form-control" id="inputSymptoms" placeholder="">
                        </div>
                        <div class="form-group col-lg-4">
                            <label for="inputDate">Choose Date </label>
                            <div class="input-group date" id="inputDate" data-date-format="mm-dd-yyyy">
                                <input type="text" class="form-control" readonly>
                                <span class="input-group-addon date_icon">
                    <i class="fa fa-calendar" aria-hidden="true"></i>
                  </span>
                            </div>
                        </div>
                    </div>
                    <div class="btn-box">
                        <button type="submit" class="btn ">Submit Now</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>


<!-- end book section -->

<!-- team section -->

<section class="team_section layout_padding')}}">
    <div class="container">
        <div class="heading_container heading_center">
            <h2>
                Our <span>Doctors</span>
            </h2>
        </div>
        <div class="carousel-wrap ">
            <div class="owl-carousel team_carousel">
                <div class="item">
                    <div class="box">
                        <div class="img-box">
                            <img src="{{ asset('frontend/images/team1.jpg')}}" alt=""/>
                        </div>
                        <div class="detail-box">
                            <h5>
                                Hennry
                            </h5>
                            <h6>
                                MBBS
                            </h6>
                            <div class="social_box">
                                <a href="https://facebook.com/takecare.ltd">
                                    <i class="fa fa-facebook" aria-hidden="true"></i>
                                </a>

                                <a href="https://wa.me/01733499574?text=hey,how we can we call you?">
                                    <i class="fa fa-whatsapp" aria-hidden="true"></i> test
                                </a>


                                <!--                                <a href="">
                                                                    <i class="fa fa-twitter" aria-hidden="true"></i>
                                                                </a>
                                                                <a href="">
                                                                    <i class="fa fa-linkedin" aria-hidden="true"></i>
                                                                </a>
                                                                <a href="">
                                                                    <i class="fa fa-instagram" aria-hidden="true"></i>
                                                                </a>-->
                            </div>
                        </div>
                    </div>
                </div>
                <div class="item">
                    <div class="box">
                        <div class="img-box">
                            <img src="{{ asset('frontend/images/team2.jpg')}}" alt=""/>
                        </div>
                        <div class="detail-box">
                            <h5>
                                Jenni
                            </h5>
                            <h6>
                                MBBS
                            </h6>
                            <div class="social_box">
                                <a href="">
                                    <i class="fa fa-facebook" aria-hidden="true"></i>
                                </a>
                                <a href="https://wa.me/01733499574?text=hey,how we can we call you?">
                                    <i class="fa fa-whatsapp" aria-hidden="true"></i> test
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="item">
                    <div class="box">
                        <div class="img-box">
                            <img src="{{ asset('frontend/images/team3.jpg')}}" alt=""/>
                        </div>
                        <div class="detail-box">
                            <h5>
                                Morco
                            </h5>
                            <h6>
                                MBBS
                            </h6>
                            <div class="social_box">
                                <a href="">
                                    <i class="fa fa-facebook" aria-hidden="true"></i>
                                </a>
                                <a href="https://wa.me/+8801827370397?text=hey,how we can we call you?">
                                    <i class="fa fa-whatsapp" aria-hidden="true"></i>
                                </a>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- end team section -->


<!-- client section -->
<section class="client_section layout_padding')}}">
    <div class="container">
        <div class="heading_container">
            <h2 class="text-center" style="width: 100%">
                <span>Testimonial</span>
            </h2>
        </div>
    </div>
    <div class="container px-0">
        <div id="customCarousel2" class="carousel  carousel-fade" data-ride="carousel">
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <div class="box">
                        <div class="client_info">
                            <div class="client_name">
                                <h5>
                                    Morijorch
                                </h5>
                                <h6>
                                    Default model text
                                </h6>
                            </div>
                            <i class="fa fa-quote-left" aria-hidden="true"></i>
                        </div>
                        <p>
                            editors now use Lorem Ipsum as their default model text, and a search for 'lorem ipsum' will
                            uncover many web sites still in their infancy. Variouseditors now use Lorem Ipsum as their
                            default model text, and a search for 'lorem ipsum' will uncover many web sites still in
                            their infancy. Variouseditors now use Lorem Ipsum as their default model text, and a search
                            for 'lorem ipsum' will uncover many web sites still in their infancy. Various
                        </p>
                    </div>
                </div>
                <div class="carousel-item">
                    <div class="box">
                        <div class="client_info">
                            <div class="client_name">
                                <h5>
                                    Rochak
                                </h5>
                                <h6>
                                    Default model text
                                </h6>
                            </div>
                            <i class="fa fa-quote-left" aria-hidden="true"></i>
                        </div>
                        <p>
                            Variouseditors now use Lorem Ipsum as their default model text, and a search for 'lorem
                            ipsum' will uncover many web sites still in their infancy. Variouseditors now use Lorem
                            Ipsum as their default model text, and a search for 'lorem ipsum' will uncover many web
                            sites still in their infancy. editors now use Lorem Ipsum as their default model text, and a
                            search for 'lorem ipsum' will uncover many web sites still in their infancy.
                        </p>
                    </div>
                </div>
                <div class="carousel-item">
                    <div class="box">
                        <div class="client_info">
                            <div class="client_name">
                                <h5>
                                    Brad Johns
                                </h5>
                                <h6>
                                    Default model text
                                </h6>
                            </div>
                            <i class="fa fa-quote-left" aria-hidden="true"></i>
                        </div>
                        <p>
                            Variouseditors now use Lorem Ipsum as their default model text, and a search for 'lorem
                            ipsum' will uncover many web sites still in their infancy, editors now use Lorem Ipsum as
                            their default model text, and a search for 'lorem ipsum' will uncover many web sites still
                            in their infancy. Variouseditors now use Lorem Ipsum as their default model text, and a
                            search for 'lorem ipsum' will uncover many web sites still in their infancy. Various
                        </p>
                    </div>
                </div>
            </div>
            <div class="carousel_btn-box">
                <a class="carousel-control-prev" href="#customCarousel2" role="button" data-slide="prev">
                    <i class="fa fa-angle-left" aria-hidden="true"></i>
                    <span class="sr-only">Previous</span>
                </a>
                <a class="carousel-control-next" href="#customCarousel2" role="button" data-slide="next">
                    <i class="fa fa-angle-right" aria-hidden="true"></i>
                    <span class="sr-only">Next</span>
                </a>
            </div>
        </div>
    </div>
</section>
<!-- end client section -->

<!-- contact section -->
<section class="contact_section layout_padding-bottom">
    <div class="container">
        <div class="heading_container">
            <h2>
                Get In Touch
            </h2>
        </div>
        <div class="row">
            <div class="col-md-7">
                <div class="form_container">
                    <form action="">
                        <div>
                            <input type="text" placeholder="Full Name"/>
                        </div>
                        <div>
                            <input type="email" placeholder="Email"/>
                        </div>
                        <div>
                            <input type="text" placeholder="Phone Number"/>
                        </div>
                        <div>
                            <input type="text" class="message-box" placeholder="Message"/>
                        </div>
                        <div class="btn_box">
                            <button>
                                SEND
                            </button>
                        </div>
                    </form>
                </div>
            </div>
            <div class="col-md-5">
                <div class="img-box">
                    <img src="{{ asset('frontend/images/contact-img.jpg')}}" alt="">
                </div>
            </div>
        </div>
    </div>
</section>
<!-- end contact section -->

<!-- info section -->
<section class="info_section ">
    <div class="container">

        <div class="info_bottom layout_padding2">
            <div class="row info_main_row">
                <div class="col-md-6 col-lg-3">
                    <h5>
                        Address
                    </h5>
                    <div class="info_contact">
                        <a href="">
                            <i class="fa fa-map-marker" aria-hidden="true"></i>
                            <span>
                  House:13, Road:21, Block:C Mirpur-12, Dhaka, 1216
                </span>
                        </a>
                        <a href="tel:+8801827370397">
                            <i class="fa fa-phone" aria-hidden="true"></i>
                            <span>
                  +8801827370397
                </span>
                        </a>
                        <a href="mailto:hello@takecare.ltd">
                            <i class="fa fa-envelope"></i>
                            <span>
               hello@takecare.ltd
                </span>
                        </a>
                    </div>
                    <div class="social_box">
                        <a href="https://facebook.com/takecare.ltd">
                            <i class="fa fa-facebook" aria-hidden="true"></i>
                        </a>
                        <a href="https://wa.me/+8801827370397&text=hey">
                            <i class="fa fa-whatsapp" aria-hidden="true"></i>
                        </a>

                    </div>
                </div>
                <div class="col-md-6 col-lg-3">
                    <div class="info_links">
                        <h5>
                            Useful link
                        </h5>
                        <div class="info_links_menu">
                            <a class="active" href="{{ url('/') }}">
                                Home
                            </a>
                            <a href="about.html">
                                Facebook
                            </a>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-3">
                    <div class="info_post">
                        <h5>
                            Upcoming
                        </h5>
                        <div class="post_box d-none">
                            <div class="img-box">
                                <img src="{{ asset('frontend/images/post1.jpg')}}" alt="">
                            </div>
                            <p>
                                Normal
                                distribution
                            </p>
                        </div>
                        <div class="post_box d-none">
                            <div class="img-box">
                                <img src="{{ asset('frontend/images/post2.jpg')}}" alt="">
                            </div>
                            <p>
                                Normal
                                distribution
                            </p>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-3">
                    <div class="info_post">
                        <h5>
                            Upcoming
                        </h5>
                        <div class="post_box d-none">
                            <div class="img-box">
                                <img src="{{ asset('frontend/images/post3.jpg')}}" alt="">
                            </div>
                            <p>
                                Normal
                                distribution
                            </p>
                        </div>
                        <div class="post_box d-none">
                            <div class="img-box">
                                <img src="{{ asset('frontend/images/post4.png')}}" alt="">
                            </div>
                            <p>
                                Normal
                                distribution
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- end info_section -->


<!-- footer section -->
<footer class="footer_section">
    <div class="container">
        <p>

            <a href="{{ url('/')  }}">&copy;&nbsp;TakeCare Health Services Ltd. </a> | {{ date('Y') }}
        </p>
    </div>
</footer>
<!-- footer section -->

<!-- jQery -->
<script src="{{asset('frontend/js/jquery-3.4.1.min.js')}}"></script>
<!-- bootstrap js -->
<script src="{{asset('frontend/js/bootstrap.js')}}"></script>
<!-- nice select -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-nice-select/1.1.0/js/jquery.nice-select.min.js"
        integrity="sha256-Zr3vByTlMGQhvMfgkQ5BtWRSKBGa2QlspKYJnkjZTmo=" crossorigin="anonymous"></script>
<!-- owl slider -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"></script>
<!-- datepicker -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.3.0/js/bootstrap-datepicker.js"></script>
<!-- custom js -->
<script src="{{asset('frontend/js/custom.js')}}"></script>


</body>

</html>
