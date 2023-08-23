@extends('layouts.app')
@section('content')
      <div class="py-5">
         <div class="container">
            <div class="row">
               <!-- Main Content -->
               <!-- <aside class="col-md-4">
                  <div class="box mb-3 shadow-sm rounded bg-white profile-box text-center">
                     <div class="py-4 px-3 border-bottom">
                        @if(isset($user) && !is_null($user))
                        <img src="{{asset($user->image)}}" class="img-fluid mt-2 rounded-circle" alt="Responsive image">
                        <h5 class="font-weight-bold text-dark mb-1 mt-4">{{$user->name}}</h5>
                        @else
                        <img src="{{asset('assets/images/avator.png')}}" class="img-fluid mt-2 rounded-circle" alt="Responsive image">
                        @endif
                     </div>
                     <div class="p-4">
                        <label data-toggle="tooltip" data-placement="top" data-original-title="Upload New Picture" class="btn btn-info m-0" for="fileAttachmentBtn">
                        <i class="mdi mdi-image"></i> Upload
                        <input id="fileAttachmentBtn" name="file-attachment" type="file" class="d-none">
                        </label>
                        <button data-toggle="tooltip" data-placement="top" data-original-title="Delete" type="submit" class="btn btn-danger"><i class="mdi mdi-delete"></i> Delete</button>
                     </div>
                  </div>
                  <div class="shadow-sm rounded bg-white mb-3">
                     <div class="box-title border-bottom p-3">
                        <h6 class="m-0">Social profiles</h6>
                        <p class="mb-0 mt-0 small">Add elsewhere links to your profile.
                        </p>
                     </div>
                     <div class="box-body">
                        <div class="p-3">
                           <div class="position-relative icon-form-control mb-2">
                              <i class="mdi mdi-instagram position-absolute text-muted"></i>
                              <input placeholder="Add Instagram link"  type="text" name="instagram" value="{{old('instagram')}}" class="form-control">
                           </div>
                           <div class="position-relative icon-form-control mb-2">
                              <i class="mdi mdi-facebook position-absolute text-muted"></i>
                              <input placeholder="Add Facebook link" type="text" name="facebook" value="{{old('facebook')}}" class="form-control">
                           </div>
                           <div class="position-relative icon-form-control mb-2">
                              <i class="mdi mdi-twitter position-absolute text-muted"></i>
                              <input placeholder="Add Twitter link" type="text" name="twitter" value="{{old('twitter')}}" class="form-control">
                           </div>
                        </div>
                     </div>
                  </div>
               </aside> -->
               <main class="col-md-8">
                  @if(isset($message))
                  <span class="alert alert-success">{{$message}}</span>
                  @endif
               <form  action="/become-seller" method="POST">
                  @csrf
                  <div class="shadow-sm rounded bg-white mb-3">
                     <div class="box-title border-bottom p-3">
                        <h6 class="m-0">Edit Basic Info</h6>
                        <p class="mb-0 mt-0 small">Lorem ipsum dolor sit amet, consecteturs.
                        </p>
                     </div>
                     <div class="box-body p-3">
                           <div class="row">
                              <div class="col-sm-6 mb-2">
                                 <div class="js-form-message">
                                    <label id="titleLabel" class="form-label">
                                    Freelancer Title
                                    <span class="text-danger">*</span>
                                    </label>
                                    @error('freelancer_title')
                                    <span style="color:red">{{$message}}</span>
                                    @enderror
                                    <div class="form-group">
                                       <input type="text" class="form-control" name="freelancer_title" required value="{{old('freelancer_title')}}" placeholder="Enter your freelancer title" aria-label="Enter your freelancer title" aria-describedby="titleLabel" data-msg="Please enter a valid title." data-error-class="u-has-error" data-success-class="u-has-success">
                                    </div>
                                 </div>
                              </div>                              
                              <!-- End Input -->
                           </div>
                          
                           <div class="row">
                              <div class="col-sm-6 mb-2">
                                 <div class="js-form-message">
                                    <label class="form-label">
                                    Preferred language
                                    <span class="text-danger">*</span>
                                    </label>
                                    @error('lang')
                                    <span style="color:red">{{$message}}</span>
                                    @enderror
                                    <div class="form-group">
                                       <select class="custom-select w-100" name="lang">
                                          <option selected>Select language</option>
                                          @foreach ($languages as $language)
                                             <option value="{{$language->language}}">{{$language->language}}</option>
                                          @endforeach
                                       </select>
                                    </div>
                                 </div>
                              </div>
                              <div class="col-sm-6 mb-2">
                                 <div class="js-form-message">
                                    <label class="form-label">
                                    Availability
                                    <span class="text-danger">*</span>
                                    </label>
                                    @error('availability')
                                    <span style="color:red">{{$message}}</span>
                                    @enderror
                                    <div class="form-group">
                                       <select class="custom-select" name="availability">
                                          <option selected>Select availability</option>
                                             <option value="full_time">Full Time</option>
                                             <option value="part_time">Part Time</option>
                                       </select>
                                    </div>
                                 </div>
                              </div>
                           </div>
                              <!-- End Input -->
                              <div class="row">
                              <div class="col-sm-6 mb-2">
                                 <div class="js-form-message">
                                    <label id="websiteLabel" class="form-label">
                                    Website
                                    <span class="text-danger">*</span>
                                    </label>
                                    @error('portfolio')
                                    <span style="color:red">{{$message}}</span>
                                    @enderror
                                    <div class="form-group">
                                       <input class="form-control" type="url" name="portfolio" value="{{old('portforlio')}}" placeholder="Enter your website" aria-label="Enter your website"  aria-describedby="websiteLabel" data-msg="Password enter a valid website" data-error-class="u-has-error" data-success-class="u-has-success">
                                    </div>
                                 </div>
                              </div>
                              <!-- End Input -->
                           </div>
                     </div>
                  </div>
                  <div class="shadow-sm rounded bg-white mb-3">
                     <div class="box-title border-bottom p-3">
                        <h6 class="m-0">About</h6>
                        <p class="mb-0 mt-0 small">Tell about yourself in two sentences.</p>
                     </div>
                     <div class="box-body">
                        <div class="p-3">
                           <div class="form-group mb-4">
                              <label class="mb-1">BIO</label>
                              @error('description')
                              <span style="color:red">{{$message}}</span>
                              @enderror
                              <div class="position-relative">
                                 <textarea class="form-control" rows="4" name="description" name="text" min="15" placeholder="Enter Bio" required>{{old('description')}}</textarea>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
                  <div class="shadow-sm rounded bg-white mb-3">
                     <div class="box-title border-bottom p-3">
                        <h6 class="m-0">Category
                        </h6>
                        <p class="mb-0 mt-0 small">Tell about your work, job, and other experiences.
                        </p>
                     </div>
                     <div class="box-body px-3 pt-3 pb-0">
                        <div class="row">
                        <div class="col-sm-6 mb-2">
                                 <div class="js-form-message">
                                    <label class="form-label">
                                    Category
                                    <span class="text-danger">*</span>
                                    </label>
                                    @error('category_id')
                                    <span style="color:red">{{$message}}</span>
                                    @enderror
                                    <div class="form-group">
                                       <select class="form-control custom-select" name="category_id" id="category_id" onchange="getSubCategories(this)"  data-msg="Please select your gender." data-error-class="u-has-error" data-success-class="u-has-success">
                                          <option value="genderSelect1" selected="">Select Category</option>
                                          @foreach ($categories as $category)
                                             <option value="{{$category->id}}">{{$category->title}}</option>                                                      
                                          @endforeach
                                       </select>
                                    </div>
                                 </div>
                              </div>

                              <div class="col-sm-6 mb-2">
                                 <div class="js-form-message">
                                    <label class="form-label">
                                    Sub Category
                                    <span class="text-danger">*</span>
                                    </label>
                                    @error('sub_category_id')
                                    <span style="color:red">{{$message}}</span>
                                    @enderror
                                    <div class="form-group">
                                       <select class="form-control custom-select" name="sub_category_id" id="sub_category_id" data-msg="Please select your gender." data-error-class="u-has-error" data-success-class="u-has-success">
                                          <option value="genderSelect1" selected="">Select Sub Category</option>
                                          @foreach ($subCategories as $category)
                                          <option value="{{$category->id}}">{{$category->title}}</option>                                                      
                                          @endforeach
                                       </select>
                                    </div>
                                 </div>
                              </div>
                        </div>
                     </div>
                  </div>

                  <div class="shadow-sm rounded bg-white mb-3">
                     <div class="box-title border-bottom p-3">
                        <h6 class="m-0">Social profiles</h6>
                        <p class="mb-0 mt-0 small">Add elsewhere links to your profile.</p>
                     </div>
                     <div class="box-body">
                        <div class="p-3">
                           <div class="position-relative icon-form-control mb-2">
                              <i class="mdi mdi-instagram position-absolute text-muted"></i>
                              <input placeholder="Add Instagram link"  type="text" name="instagram" value="{{old('instagram')}}" class="form-control">
                           </div>
                           <div class="position-relative icon-form-control mb-2">
                              <i class="mdi mdi-facebook position-absolute text-muted"></i>
                              <input placeholder="Add Facebook link" type="text" name="facebook" value="{{old('facebook')}}" class="form-control">
                           </div>
                           <div class="position-relative icon-form-control mb-2">
                              <i class="mdi mdi-twitter position-absolute text-muted"></i>
                              <input placeholder="Add Twitter link" type="text" name="twitter" value="{{old('twitter')}}" class="form-control">
                           </div>
                        </div>
                     </div>
                  </div>

                  <div class="mb-3 text-right">
                     <button type="submit" class="btn btn-outline-success">Cancel</button>
                     <button type="submit" class="btn btn-success">Submit</button>
                  </div>
               </form>
               </main>
            </div>
         </div>
      </div>
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