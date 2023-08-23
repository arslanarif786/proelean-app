@extends('layouts.app')
@section('content')
      <section class="py-5">
         <div class="container">
            <div class="row">
               <div class="col-lg-9">
                  <div class="bg-white rounded shadow-sm sidebar-page-right">
                     <div>
                        <div class="p-3 border-bottom">
                           <p class="text-muted font-weight-bold h6">Reset Password</p>
                        </div>
                        <div class="p-3 border-bottom">
                           <form action="{{route('update.password')}}" method="POST">
                               @csrf
                               <input type="hidden" name="token" value="{{$token}}">
                               <input type="hidden" name="email" value="{{urldecode($_GET['email'])}}">
                              <div class="row form-group d-flex align-items-center">
                                 <div class="col-md-4">
                                    <p class="text-muted font-weight-bold mb-0">NEW PASSWORD</p>
                                 </div>
                                  <div class="col-md-8">
                                    <input type="password" name="password" class="form-control font-weight-bold text-muted">
                                 </div>
                              </div>
                              <div class="row form-group d-flex align-items-center">
                                 <div class="col-md-4">
                                    <p class="text-muted font-weight-bold mb-0">CONFIRM PASSWORD</p>
                                 </div>
                                 <div class="col-md-8">
                                    <input type="password" name="password_confirmation" class="form-control font-weight-bold text-muted">
                                 </div>
                              </div>
                              <div class="text-right">
                                 <button class="btn btn-success">Reset Password</button>
                              </div>
                           </form>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </section>
      <!-- End 404 Page -->
@endsection