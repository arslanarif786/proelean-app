@extends('layouts.app')

@section('content')
      <!-- Login -->
      <div class="bg-white">
         <div class="container">
            <div class="row justify-content-center align-items-center d-flex vh-100">
               <div class="col-lg-4 mx-auto">
                  <div class="osahan-login py-4">
                     <div class="text-center mb-4">
                        <a href="/"><img src="{{asset('assets/images/Pro-eLean-.png')}}" alt=""></a>
                        <h5 class="font-weight-bold mt-3">Welcome Back</h5>
                        <p class="text-muted">Don't miss your next opportunity. Sign in to stay updated on your professional world.</p>
                     </div>
                     <form action="index">
                        <div class="form-group">
                           <label class="mb-1">Email or Phone</label>
                           <div class="position-relative icon-form-control">
                              <i class="mdi mdi-account position-absolute"></i>
                              <input type="email" class="form-control">
                           </div>
                        </div>
                        <div class="form-group">
                           <label class="mb-1">Password</label>
                           <div class="position-relative icon-form-control">
                              <i class="mdi mdi-key-variant position-absolute"></i>
                              <input type="password" class="form-control">
                           </div>
                        </div>
                        <div class="custom-control custom-checkbox mb-3">
                           <input type="checkbox" class="custom-control-input" id="customCheck1">
                           <label class="custom-control-label" for="customCheck1">Remember password</label>
                        </div>
                        <button class="btn btn-success btn-block text-uppercase" type="submit"> Sign in </button>
                        <div class="text-center mt-3 border-bottom pb-3">
                           <p class="small text-muted">Or login with</p>
                           <div class="row">
                              <div class="col-6">
                                 <button type="button" class="btn btn-outline-instagram btn-block"><i class="mdi mdi-instagram"></i> Instagram</button>
                              </div>
                              <div class="col-6">
                                 <button type="button" class="btn btn-outline-facebook btn-block"><i class="mdi mdi-facebook"></i> Facebook</button>
                              </div>
                           </div>
                        </div>
                        <div class="py-3 d-flex align-item-center">
                           <a href="forgot-password">Forgot password?</a>
                           <span class="ml-auto"> New to Proelean? <a href="register">Join now</a></span>
                        </div>
                     </form>
                  </div>
               </div>
            </div>
         </div>
      </div>

@endsection
