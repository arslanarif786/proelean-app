@extends('layouts.app')
@section('content')
      <!-- Inner Header -->
      <section class="section-padding  py-5 inner-header super-bg">
         <div class="container">
            <div class="row">
               <div class="col-md-12 text-left">
                  <h1 class="mt-0 mb-3 text-white">Contact Us</h1>
                  <div class="breadcrumbs">
                     <p class="mb-0 text-white"><a class="text-white" href="#">Home</a>  /  <span class="text-white">Contact Us</span></p>
                  </div>
               </div>
            </div>         
         </div>
      </section>
      <!-- End Inner Header -->
      <!-- Contact Us -->
      <section class="py-5 bg-white">
         <div class="container">
            <div class="row">
               <div class="col-lg-4 col-md-4">
                  <h3 class="mt-1 mb-4">Get In Touch</h3>
                  <h6 class="text-dark"><i class="mdi mdi-home-map-marker"></i> Address :</h6>
                  <p>Kansankatu 4
96100 Rovaniemi, Lapland, Finland</p>
                  <!-- <h6 class="text-dark"><i class="mdi mdi-phone"></i> Phone :</h6>
                  <p>+91 12345-67890, (+91) 123 456 7890</p> -->
                  <h6 class="text-dark"><i class="mdi mdi-whatsapp"></i> Mobile :</h6>
                  <p>+358 40 560 3140</p>
                  <h6 class="text-dark"><i class="mdi mdi-email"></i> Email :</h6>
                  <p>info@proelean.fi</p>
                  <h6 class="text-dark"><i class="mdi mdi-link"></i> Website :</h6>
                  <p>www.proelean.com</p>
                  <p>www.proelean.fi</p>
                  <div class="footer-social mb-4"><span>Follow : </span>
                     <a href="https://www.facebook.com/proelean"><i class="mdi mdi-facebook"></i></a>
                     <!-- <a href="#"><i class="mdi mdi-twitter"></i></a> -->
                     <a href="https://www.instagram.com/proelean/"><i class="mdi mdi-instagram"></i></a>
                     <a href="#"><i class="mdi mdi-google-play"></i></a>
                  </div>
               </div>
               <div class="col-lg-8 col-md-8">
                  <div class="card">
                     <div class="card-body">
                     <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d1591.0579655869835!2d25.720950715884197!3d66.49809542393422!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x442b4bed47c079ab%3A0x2a8a77bf6be10bfb!2sKansankatu%204%2C%2096100%20Rovaniemi%2C%20Finland!5e0!3m2!1sen!2s!4v1637845124872!5m2!1sen!2s" width="100%" height="450" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </section>
      <!-- End Contact Us -->
      <!-- Contact Me -->
      <section class="py-5 bg-white">
         <div class="container">
            <div class="row">
               <div class="col-lg-12 col-md-12 section-title text-left mb-4">
                  <h2>Contact Us</h2>
               </div>
               <form name="sentMessage" class="col-lg-12 col-md-12" id="contactForm" novalidate>
                  <div class="control-group form-group">
                     <div class="controls">
                        <label>Full Name <small class="text-danger">*</small></label>
                        <input type="text" placeholder="Full Name" class="form-control" id="name" required data-validation-required-message="Please enter your name.">
                        <p class="help-block"></p>
                     </div>
                  </div>
                  <div class="form-row">
                     <div class="control-group col form-group">
                        <div class="controls">
                           <label>Phone Number <small class="text-danger">*</small></label>
                           <input type="tel" placeholder="1-800-643-4500" class="form-control" id="phone" required data-validation-required-message="Please enter your phone number.">
                        </div>
                     </div>
                     <div class="control-group col form-group">
                        <div class="controls">
                           <label>Email Address <small class="text-danger">*</small></label>
                           <input type="email" placeholder="youremail@gmail.com" class="form-control" id="email" required data-validation-required-message="Please enter your email address.">
                        </div>
                     </div>
                  </div>
                  <div class="control-group form-group">
                     <div class="controls">
                        <label>Message <small class="text-danger">*</small></label>
                        <textarea placeholder="Hi there, I would like to ..." rows="4" cols="100" class="form-control" id="message" required data-validation-required-message="Please enter your message" maxlength="999" style="resize:none"></textarea>
                     </div>
                  </div>
                  <div id="success"></div>
                  <!-- For success/fail messages -->
                  <div class="text-right">
                     <button type="submit" class="btn btn-success" id="sendMessageButton">Send Message</button>
                  </div>
               </form>
               
            </div>
         </div>
      </section>
      <!-- End Contact Me -->
    @endsection