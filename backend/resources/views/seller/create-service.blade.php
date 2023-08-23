@extends('layouts.app')
@section('content')
      <!-- 404 Page -->
      <section class="py-5">
         <div class="container">
            <div class="row">
               @if(isset($message))
               <span class="alert alert-success">{{$message}}</span>
               @endif
               <div class="col-lg-3">
                  <div class="bg-white rounded shadow-sm py-3 sidebar-fix">
                     <div class="dropdown-menu-show">
                        <a class="dropdown-item py-2 active" href="customer-order.html">Customer Order</a>
                        <a class="dropdown-item py-2" href="overview.html">Overview</a>
                        <a class="dropdown-item py-2" href="business.html">Business</a>
                        <a class="dropdown-item py-2" href="edit-account.html">Edit Account</a>
                        <a class="dropdown-item py-2" href="edit-security.html">Edit Security</a>
                        <a class="dropdown-item py-2" href="edit-notifications.html">Edit Notification</a>
                        <a class="dropdown-item py-2" href="edit-billing.html">Edit Billing</a>
                        <a class="dropdown-item py-2" href="edit-payment.html">Edit Payment</a>
                     </div>
                  </div>
               </div>
               <div class="col-lg-9">
                  <h4 class="font-weight-bold pb-3">Create Serivce</h4>
                  <form action="/seller/gig" method="POST" enctype="multipart/form-data"> 
                     @csrf
                  <div class="bg-white rounded shadow-sm sidebar-page-right">
                     <div class="bg-white rounded p-0">
                        <div class="border-bottom p-3">
                           <label>Enter Your Title</label>
                           @error('s_description')
                           <span style="color:red">{{$message}}</span>
                           @enderror
                             <div class="form-group">
                                 <input type="text" name="s_description" class="form-control" placeholder="I will create" required>
                              </div>
                              <label>Describe your service</label>
                              @error('description')
                              <span style="color:red">{{$message}}</span>
                              @enderror
                              <div class="form-group">
                                 <textarea class="form-control" name="description" rows="7" placeholder="Describe About Your Serivce" required></textarea>
                              </div>
                              <div class="form-group d-md-flex justify-content-center align-items-center py-4">
                                 <label for="exampleFormControlFile1" class="font-weight-bold pr-2 py-3">Banner</label>
                                 <input type="file" class="form-control-file" name="banner[]" id="exampleFormControlFile1" required>
                                  <label for="exampleFormControlFile1" class="font-weight-bold pr-2 py-3">Banner</label>
                                 <input type="file" class="form-control-file" name="banner[]" id="exampleFormControlFile1" required>
                                  <label for="exampleFormControlFile1" class="font-weight-bold pr-2 py-3">Banner</label>
                                 <input type="file" class="form-control-file" name="banner[]" id="exampleFormControlFile1" required>
                              </div>
                        </div>
                        <div class="border-bottom p-3">
                           <label>Choose a category:</label>
                           <div class="row">
                              <div class="form-group col-md-6">
                                 <select id="inputState" class="form-control" id="category_id" onchange="getSubCategories(this)" name="category_id" required>
                                    <option selected>Select...</option>
                                    @foreach ($categories as $category)
                                       <option value="{{$category->id}}">{{$category->title}}</option>                                       
                                    @endforeach
                                 </select>
                              </div>
                              <div class="form-group col-md-6">
                                 <select class="form-control" id="sub_category_id" name="sub_category_id" required>
                                    <option selected>Select subcategory</option>
                                 </select>
                              </div>
                           </div>
                        </div>
                        <div class="border-bottom p-3">
                           <label>Delivery Time</label>
                           <div class="form-group col-md-6">
                                 <select id="inputState" class="form-control" name="delivery_time" required>
                                    <option selected>Select...</option>
                                    @foreach($days as $day)
                                    <option>{{$day->days}}</option>                                    
                                    @endforeach
                                 </select>
                              </div>
                        </div>
                        <div class="border-bottom p-3">
                           <label>What is your budget for this service?</label>
                           <div class="input-group mb-2 col-md-4 p-0">
                              <div class="input-group-prepend">
                                 <div class="btn btn-success">$</div>
                              </div>
                              <input type="number" class="form-control" name="price" id="inlineFormInputGroup" required>
                           </div>
                        </div>
                        <div class="p-3 d-flex justify-content-end">
                           <button class="btn btn-success btn-lg font-weight-bold" type="submit">Submit Request</button>
                        </div>
                     </div>
                  </div>
                  </form>
               </div>
            </div>
         </div>
      </section>
      <!-- End 404 Page -->
      @endsection

@push('js')
<script>
   var sub_categories;
   var getSubCategories=(category)=>{      
      document.getElementById("sub_category_id").disabled = true;
      $.ajax({
       url: `{{env('APP_URL')}}/api/sub_category/${category.value}`,
       method: 'GET',
       success: function(res){
         res.data.forEach(appendSubCategories);
         document.getElementById("sub_category_id").disabled = false;
         console.log(res.data);
       },
       error: function(err){
         console.log(err);
       }
      });
   }
   function appendSubCategories(item,index){
      // $('#sub_category_id').selectpicker('refresh');
      $('#sub_category_id')
         .append($(`<option value=${item.id}>${item.title}</option>`)
                    .attr("value", item.id)
                    .text(item.title));
   }

</script>

@endpush