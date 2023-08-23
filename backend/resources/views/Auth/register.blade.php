@extends('layouts.app')
@section('content')
      <!-- Register -->
      <div class="bg-white pb-5">
         <div class="container">
            <div class="row justify-content-center align-items-center d-flex ">
               <div class="col-lg-4 mx-auto">
                  <div class="osahan-login py-4">
                     <div class="text-center mb-4">
                        <a href="index.html"><img src="images/fav.svg" alt=""></a>
                        <h5 class="font-weight-bold mt-3">Join Pro Elean</h5>
                        <p class="text-muted">Make the most of your professional life</p>
                        @if(isset($message))
                        <span class="alert alert-success">{{$message}}</span>
                        @endif
                     </div>
                     <form action="/register" method="POST">
                        @csrf
                        <div class="form-row">
                           <div class="col">
                              <div class="form-group">
                                 <label class="mb-1">Ful Name</label>
                                 @error('name')
                                 <span style="color:red;">{{$message}}</span>
                                 @enderror
                                 <div class="position-relative icon-form-control">
                                    <i class="mdi mdi-account position-absolute"></i>
                                    <input type="text" class="form-control" name="name" value="{{old('name')}}" required>
                                 </div>
                              </div>
                           </div>
                        </div>
                        <div class="form-row">
                           <div class="col">
                              <div class="form-group">
                                 <label class="mb-1">User Name</label>
                                 @error('username')
                                 <span style="color:red;">{{$message}}</span>
                                 @enderror
                                 <div class="position-relative icon-form-control">
                                    <i class="mdi mdi-account position-absolute"></i>
                                    <input type="text" class="form-control" name="username" value="{{old('username')}}" required>
                                 </div>
                              </div>
                           </div>
                        </div>
                        <div class="form-group">
                           <label class="mb-1">Address</label>
                           @error('address')
                                 <span style="color:red;">{{$message}}</span>
                           @enderror                           
                           <div class="position-relative icon-form-control">
                              <i class="mdi mdi-address-outline position-absolute"></i>
                              <input type="address" name="address" class="form-control" value="{{old('address')}}" name="address" required>
                           </div>
                        </div>
                        <div class="form-group">
                           <label class="mb-1">Email</label>
                           @error('email')
                              <span style="color:red;">{{$message}}</span>
                           @enderror
                           <div class="position-relative icon-form-control">
                              <i class="mdi mdi-email-outline position-absolute"></i>
                              <input type="email" name="email" class="form-control" value="{{old('email')}}" name="email" required>
                           </div>
                        </div>
                        <div class="form-group">
                           <label class="mb-1">Password (6 or more characters)</label>
                           @error('password')
                              <span style="color:red;">{{$message}}</span>
                           @enderror
                           <div class="position-relative icon-form-control">
                              <i class="mdi mdi-key-variant position-absolute"></i>
                              <input type="password" name="password" class="form-control" value="{{old('password')}}">
                           </div>
                        </div>
                        <div class="form-group">
                           <label class="mb-1">Confirm Password (6 or more characters)</label>
                           @error('password_confirmation')
                              <span style="color:red;">{{$message}}</span>
                           @enderror
                           <div class="position-relative icon-form-control">
                              <i class="mdi mdi-key-variant position-absolute"></i>
                              <input type="password" name="password_confirmation" value="{{old('password_confirmation')}}" class="form-control">
                           </div>
                        </div>
                        <div class="form-group">
                           <label class="mb-1">You agree to the Proelean<a href="#"> User Agreement</a>, <a href="#">Privacy Policy</a>, and <a  href="#">Cookie Policy</a>.</label>
                        </div>
                        <button class="btn btn-success btn-block text-uppercase" type="submit"> Agree & Join </button>
                        <div class="text-center mt-3 border-bottom pb-3">
                           <p class="small text-muted">Or login with</p>
                           <div class="row">
                              <!-- <div class="col-6">
                                 <button type="button" class="btn btn-outline-instagram btn-block"><i class="mdi mdi-instagram"></i> Instagram</button>
                              </div> -->
                              <div class="col-12">
                                 <button type="button" class="btn btn-outline-facebook btn-block"><i class="mdi mdi-facebook"></i> Facebook</button>
                              </div>
                           </div>
                        </div>
                        <div class="py-3 d-flex align-item-center">
                           <a href="forgot-password.html">Forgot password?</a>
                           <span class="ml-auto"> Already on Proelean? <a href="login.html">Sign in</a></span>
                        </div>
                     </form>
                  </div>
               </div>
            </div>
         </div>
      </div>
      <!-- End Register -->
@endsection