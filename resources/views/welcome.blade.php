@extends('layouts.UserLayout')

@section('homecontent')

  <!--header section start -->
      <div class="header_section">
         <div class="header_bg">
            <div class="container">
               <nav class="navbar navbar-expand-lg navbar-light bg-light">
                  <a class="logo" href="index.html"><img src="{{ asset('images/user/logo.png') }}"></a>
                  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                  <span class="navbar-toggler-icon"></span>
                  </button>
                  <div class="collapse navbar-collapse" id="navbarSupportedContent">
                     <ul class="navbar-nav mr-auto">
                        <li class="nav-item active">
                           <a class="nav-link" href="index.html">Home</a>
                        </li>
                        <li class="nav-item">
                           <a class="nav-link" href="about.html">About</a>
                        </li>
                        <li class="nav-item">
                           <a class="nav-link" href="services.html">Services</a>
                        </li>
                        <li class="nav-item">
                           <a class="nav-link" href="blog.html">Blog</a>
                        </li>
                        <li class="nav-item">
                           <a class="nav-link" href="contact.html">Contact Us</a>
                        </li>
                         @if (Route::has('login'))
                            @auth
                             <li class="nav-item">
                               <a class="nav-link" href="{{ url('/user') }}">Deshbord</a>
                            </li>
                            @else
                            <li class="nav-item">
                               <a class="nav-link" href="{{ route('login') }}"><i class="fa fa-sign-in" aria-hidden="true"> Login</i></a>
                            </li>
                             @endauth
                         @endif

                       

                     </ul>
                  <!--    <div class="call_section">
                        <ul>
                           <li><a href="#"><img src="{{ asset('images/user/fb-icon.png') }}"></a></li>
                           <li><a href="#"><img src="{{ asset('images/user/twitter-icon.png') }}"></a></li>
                           <li><a href="#"><img src="{{ asset('images/user/linkedin-icon.png') }}"></a></li>
                           <li><a href="#"><img src="{{ asset('images/user/instagram-icon.png') }}"></a></li>
                           <div class="donate_bt"><a href="#"><img src="{{ asset('images/user/search-icon.png') }}"></a></div>
                        </ul>
                     </div> -->
                  </div>
               </nav>
            </div>
         </div>
      <!--banner section start -->
      <div class="banner_section layout_padding">
         <div id="my_slider" class="carousel slide" data-ride="carousel">
            <div class="carousel-inner">
               <div class="carousel-item active">
                  <div class="container">
                     <div class="banner_taital_main">
                        <div class="row">
                           <div class="col-md-6">
                              <h1 class="banner_taital">Casinal Educations Coachings</h1>
                              <p class="banner_text">Eiusmod tempor incididunt ut labore et dolore magna aliqua</p>
                              <div class="btn_main">
                                 <div class="about_bt active"><a href="#">About Us</a></div>
                                 <div class="quote_bt"><a href="#">Get A Quote</a></div>
                              </div>
                           </div>
                           <div class="col-md-6">
                              <div class="image_1"><img src="{{ asset('images/user/img-1.png') }}"></div>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
               <div class="carousel-item">
                  <div class="container">
                     <div class="banner_taital_main">
                        <div class="row">
                           <div class="col-md-6">
                              <h1 class="banner_taital">Casinal Educations Coachings</h1>
                              <p class="banner_text">Eiusmod tempor incididunt ut labore et dolore magna aliqua</p>
                              <div class="btn_main">
                                 <div class="about_bt active"><a href="#">About Us</a></div>
                                 <div class="quote_bt"><a href="#">Get A Quote</a></div>
                              </div>
                           </div>
                           <div class="col-md-6">
                              <div class="image_1"><img src="{{ asset('images/user/img-1.png') }}"></div>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
               <div class="carousel-item">
                  <div class="container">
                     <div class="banner_taital_main">
                        <div class="row">
                           <div class="col-md-6">
                              <h1 class="banner_taital">Casinal Educations Coachings</h1>
                              <p class="banner_text">Eiusmod tempor incididunt ut labore et dolore magna aliqua</p>
                              <div class="btn_main">
                                 <div class="about_bt active"><a href="#">About Us</a></div>
                                 <div class="quote_bt"><a href="#">Get A Quote</a></div>
                              </div>
                           </div>
                           <div class="col-md-6">
                              <div class="image_1"><img src="{{ asset('images/user/img-1.png') }}"></div>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
            <a class="carousel-control-prev" href="#my_slider" role="button" data-slide="prev">
            <i class="fa fa-arrow-left" style="font-size:24px"></i>
            </a>
            <a class="carousel-control-next" href="#my_slider" role="button" data-slide="next">
            <i class="fa fa-arrow-right" style="font-size:24px"></i>
            </a>
         </div>
      </div>
      <!--banner section end -->
      </div>
      <!--header section end -->

@endsection