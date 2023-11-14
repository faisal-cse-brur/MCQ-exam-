<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>EDU HUB</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
        <!-- owl carousel style -->
        <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.0.0-beta.2.4/assets/owl.carousel.min.css" />
        <!-- bootstrap css -->
        <link rel="stylesheet" type="text/css" href="{{ asset('css/user/bootstrap.min.css') }}">
        <!-- style css -->
        <link rel="stylesheet" type="text/css" href="{{ asset('css/user/style.css') }}">
        <!-- Responsive-->
        <link rel="stylesheet" href="{{ asset('css/user/responsive.css') }}">
        <!-- fevicon -->
        <link rel="icon" href="{{ asset('images/user/fevicon.png') }}" type="image/gif" />
        <!-- Scrollbar Custom CSS -->
        <link rel="stylesheet" href="{{ asset('css/user/jquery.mCustomScrollbar.min.css') }}">
        <!-- Tweaks for older IEs-->
        <link rel="stylesheet" href="https://netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.css">
        <!-- fonts -->
        <link href="https://fonts.googleapis.com/css?family=Open+Sans:400,700|Poppins:400,700&display=swap" r="stylesheet">
        <!-- owl stylesheets --> 
        <link rel="stylesheet" href="{{ asset('css/user/owl.carousel.min.css') }}">
        <link rel="stylesheet" href="{{ asset('css/user/owl.theme.default.min.css') }}">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fancybox/2.1.5/jquery.fancybox.min.css" media="screen">
    </head>
    
    <body>
    @yield('homecontent')
      <!-- services section start -->
      <div class="services_section layout_padding">
         <div class="container">
            <h1 class="services_taital"><span style="color: #fcce2d">Our</span> Courses</h1>
            <div class="services_section_2">
               <div class="row">
                  <div class="col-md-6">
                     <div class="image_main">
                        <img src="{{ asset('images/user/img-2.png') }}" class="image_8" style="width:100%">
                        <div class="text_main">
                           <div class="seemore_text">Art And Design</div>
                        </div>
                     </div>
                  </div>
                  <div class="col-md-6">
                     <div class="image_main">
                        <img src="{{ asset('images/user/img-3.png') }}" class="image_8" style="width:100%">
                        <div class="text_main">
                           <div class="seemore_text">Science</div>
                        </div>
                     </div>
                  </div>
               </div>
               <div class="row">
                  <div class="col-md-6">
                     <div class="image_main">
                        <img src="{{ asset('images/user/img-4.png') }}" class="image_8" style="width:100%">
                        <div class="text_main">
                           <div class="seemore_text">Business Stady</div>
                        </div>
                     </div>
                  </div>
                  <div class="col-md-6">
                     <div class="image_main">
                        <img src="{{ asset('images/user/img-5.png') }}" class="image_8" style="width:100%">
                        <div class="text_main">
                           <div class="seemore_text">English Speaking</div>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </div>            
      </div>
      <!-- services section end -->
      <!-- about section start -->
      <div class="news_section layout_padding">
         <div class="container">
            <h1 class="news_taital">Our About</h1>
            <p class="news_text">Do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam</p>
            <div class="news_section_2">
               <div class="row">
                  <div class="col-md-6">
                     <div class="news_taital_box">
                        <p class="date_text">01 Jan 2020</p>
                        <h4 class="make_text">Make it Simple</h4>
                        <p class="lorem_text">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation</p>
                        <p class="post_text">Post By : Casinal</p>
                     </div>
                  </div>
                  <div class="col-md-6">
                     <img src="{{ asset('images/user/img-6.png') }}" class="image_6" style="width:100%">
                     <h6 class="plus_text">+</h6>
                  </div>
               </div>
            </div>
         </div>
      </div>
      <!-- about section end -->
      <!-- blog section start -->
      <div class="blog_section layout_padding">
         <div class="container">
            <h1 class="news_taital">Our Bolg</h1>
            <p class="news_text">do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam</p>
            <div class="blog_section_2">
               <div class="row">
                  <div class="col-md-6">
                     <img src="{{ asset('images/user/img-7.png') }}" class="image_7" style="width:100%">
                  </div>
                  <div class="col-md-6">
                     <h4 class="classes_text">Best Classes and study</h4>
                     <p class="ipsum_text">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris </p>
                  </div>
               </div>
            </div>
            <div class="read_bt"><a href="#">Read More</a></div>
         </div>
      </div>
      <!-- blog section end -->
      <!-- client section start -->
      <div class="client_section layout_padding">
         <div id="main_slider" class="carousel slide" data-ride="carousel">
            <div class="carousel-inner">
               <div class="carousel-item active">
                  <div class="container">
                     <h1 class="client_taital">Testimonial</h1>
                     <div class="client_section_2">
                        <div class="client_left">
                           <div><img src="{{ asset('images/user/client-img.png') }}" class="client_img"></div>
                        </div>
                        <div class="client_right">
                           <h3 class="client_name">Faisal Ahmad</h3>
                           <p class="client_text">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip </p>
                        </div>
                     </div>
                  </div>
               </div>
               <div class="carousel-item">
                  <div class="container">
                     <h1 class="client_taital">Testimonial</h1>
                     <div class="client_section_2">
                        <div class="client_left">
                           <div><img src="{{ asset('images/user/client-img.png') }}" class="client_img"></div>
                        </div>
                        <div class="client_right">
                           <h3 class="client_name">Faisal Ahmad</h3>
                           <p class="client_text">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip </p>
                        </div>
                     </div>
                  </div>
               </div>
               <div class="carousel-item">
                  <div class="container">
                     <h1 class="client_taital">Testimonial</h1>
                     <div class="client_section_2">
                        <div class="client_left">
                           <div><img src="{{ asset('images/user/client-img.png') }}" class="client_img"></div>
                        </div>
                        <div class="client_right">
                           <h3 class="client_name">Faisal Ahmad</h3>
                           <p class="client_text">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip </p>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
            <a class="carousel-control-prev" href="#main_slider" role="button" data-slide="prev">
             <i class="fa fa-angle-left"></i>
            </a>
            <a class="carousel-control-next" href="#main_slider" role="button" data-slide="next">
             <i class="fa fa-angle-right" style="font-size:24px"></i>
            </a>
         </div>
      </div>
      <!-- client section end -->
      <!-- newsletter section start -->
      <div class="newsletter_section layout_padding">
         <div class="container">
            <div class="newsletter_main">
               <h1 class="newsletter_taital">Get<br> Your free consuting </h1>
               <div class="get_quote_bt"><a href="#">Get A Quote</a></div>
            </div>
            <p class="dolor_text">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip </p>
         </div>
      </div>
      <!-- newsletter section end -->

      <!-- contact section start -->
      <div class="contact_section layout_padding">
         <div class="container-fluid">
            <div class="row">
               <div class="col-md-6 padding_left0">
                  <div class="mail_section">
                     <div class="contact_img">
                        <h1 class="contact_taital">Best Educations In World Here</h1>
                     </div>
                  </div>
               </div>
               <div class="col-md-6">
                  <div class="map_main"><img src="{{ asset('images/user/map-img.png') }}"></div>
               </div>
            </div>
         </div>
      </div>
      <!-- contact section end -->
      <!-- footer section start -->
      <div class="footer_section">
         <div class="container">
            <div class="footer_section_2">
               <div class="row">
                  <div class="col-lg-3 margin_top">
                     <div class="call_text"><a href="#"><img src="{{ asset('images/user/call-icon1.png') }}"><span class="padding_left_15">Call Now +088 xxxxxxxx</span></a></div>
                     <div class="call_text"><a href="#"><img src="{{ asset('images/user/mail-icon1.png') }}"><span class="padding_left_15">eduhub@gmail.com</span></a></div>
                  </div>
                  <div class="col-lg-3">
                     <div class="information_main">
                        <h4 class="information_text">Information</h4>
                        <p class="many_text">There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration</p>
                     </div>
                  </div>
                  <div class="col-lg-3 col-md-6">
                     <div class="information_main">
                        <h4 class="information_text">Helpful Links</h4>
                        <div class="footer_menu">
                           <ul>
                              <li><a href="index.html">Home</a></li>
                              <li><a href="about.html">About</a></li>
                              <li><a href="services.html">Services</a></li>
                              <li><a href="blog.html">Blog</a></li>
                              <li><a href="news.html">News</a></li>
                           </ul>
                        </div>
                     </div>
                  </div>
                  <div class="col-lg-3">
                     <div class="information_main">
                        <div class="footer_logo"><a href="index.html"><img src="{{ asset('images/user/footer-logo.png') }}"></a></div>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
      <!-- footer section end -->
      <!-- copyright section start -->
      <div class="copyright_section">
         <div class="container">
            <p class="copyright_text">© <?php $date = date("Y"); echo $date;?> All Rights Reserved by <a href="#">EduHub</a></p>
         </div>
      </div>

  <!-- copyright section end -->
      <!-- Javascript files-->
      <script src="{{ asset('js/user/jquery.min.js') }}"></script>
      <script src="{{ asset('js/user/popper.min.js') }}"></script>
      <script src="{{ asset('js/user/bootstrap.bundle.min.js') }}"></script>
      <script src="{{ asset('js/user/jquery-3.0.0.min.js') }}"></script>
      <script src="{{ asset('js/user/plugin.js') }}"></script>
      <!-- sidebar -->
      <script src="{{ asset('js/user/jquery.mCustomScrollbar.concat.min.js') }}"></script>
      <script src="{{ asset('js/user/custom.js') }}"></script>
      <!-- javascript --> 
      <script src="{{ asset('js/user/owl.carousel.js') }}"></script>
      <script src="https:cdnjs.cloudflare.com/ajax/libs/fancybox/2.1.5/jquery.fancybox.min.js"></script>

    </body>
</html>
