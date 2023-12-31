@extends('layouts.app')
@section('content')

<!-- Inner Header -->
      <section class="py-5 bg-dark inner-header">
         <div class="container">
            <div class="row">
               <div class="col-md-12 text-center">
                  <h1 class="mt-0 mb-3 text-white">Product</h1>
                  <div class="breadcrumbs">
                     <p class="mb-0 text-white"><a class="text-white" href="#">Home</a>  /  <span class="text-success">Product</span></p>
                  </div>
               </div>
            </div>
         </div>
      </section>
      <!-- End Inner Header -->
      <!--   header -->
      <div class="third-menu filter-options py-3">
         <div class="container">
            <div class="row">
               <div class="col-lg-12 d-flex align-items-center justify-content-between">
                  <div class="left">
                     <div class="dropdown-filters d-flex">
                        <div class="dropdown">
                           <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                           Seller Details
                           </button>
                           <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                              <div class="options">
                                 <h5>Main type</h5>
                                 <div class="row">
                                    <div class="col-md-6">
                                       <label class="custom-checkbox">Mobile Apps
                                       <span class="count">(150)</span>
                                       <input type="checkbox">
                                       <span class="checkmark"></span>
                                       </label>
                                    </div>
                                    <div class="col-md-6">
                                       <label class="custom-checkbox">Email Templates
                                       <span class="count">(150)</span>
                                       <input type="checkbox">
                                       <span class="checkmark"></span>
                                       </label>
                                    </div>
                                    <div class="col-md-6">
                                       <label class="custom-checkbox">Landing pages
                                       <span class="count">(150)</span>
                                       <input type="checkbox">
                                       <span class="checkmark"></span>
                                       </label>
                                    </div>
                                    <div class="col-md-6">
                                       <label class="custom-checkbox">Websites
                                       <span class="count">(150)</span>
                                       <input type="checkbox">
                                       <span class="checkmark"></span>
                                       </label>
                                    </div>
                                 </div>
                              </div>
                              <div class="options">
                                 <h5>Image file format</h5>
                                 <div class="row">
                                    <div class="col-md-6">
                                       <label class="custom-checkbox">jpg
                                       <span class="count">(150)</span>
                                       <input type="checkbox">
                                       <span class="checkmark"></span>
                                       </label>
                                    </div>
                                    <div class="col-md-6">
                                       <label class="custom-checkbox">png
                                       <span class="count">(150)</span>
                                       <input type="checkbox">
                                       <span class="checkmark"></span>
                                       </label>
                                    </div>
                                    <div class="col-md-6">
                                       <label class="custom-checkbox">psd
                                       <span class="count">(150)</span>
                                       <input type="checkbox">
                                       <span class="checkmark"></span>
                                       </label>
                                    </div>
                                    <div class="col-md-6">
                                       <label class="custom-checkbox">pdf
                                       <span class="count">(150)</span>
                                       <input type="checkbox">
                                       <span class="checkmark"></span>
                                       </label>
                                    </div>
                                 </div>
                              </div>
                           </div>
                        </div>
                        <div class="dropdown ml-4">
                           <button class="btn btn-secondary dropdown-toggle" type="button" id="budget" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                           Budget
                           </button>
                           <div class="dropdown-menu budget" aria-labelledby="budget">
                              <div class="options">
                                 <div class="row">
                                    <div class="col-md-6">
                                       <label>Min.</label>
                                       <input type="text" placeholder="Any">
                                       <i class="fa fa-inr" aria-hidden="true"></i>
                                    </div>
                                    <div class="col-md-6">
                                       <label>Min.</label>
                                       <input type="text" placeholder="Any">
                                       <i class="fa fa-inr" aria-hidden="true"></i>
                                    </div>
                                 </div>
                              </div>
                           </div>
                        </div>
                        <div class="dropdown ml-4">
                           <button class="btn btn-secondary dropdown-toggle" type="button" id="delivery" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                           Delivery Time
                           </button>
                           <div class="dropdown-menu delivery" aria-labelledby="delivery">
                              <div class="options">
                                 <div class="row">
                                    <div class="col-md-12">
                                       <div class="fake-radio-wrapper">
                                          <div><input type="hidden" name="gig_items[2][0007284419489][gig_item_id]"
                                             value="117210558"><input type="hidden"
                                             name="gig_items[2][0007284419489][quantity]" value="0"></div>
                                          <label
                                             class="fake-radio"><input type="radio" name="2" value="0" checked=""><span
                                             class="radio-img"></span><span>Express 24H</span></label><label
                                             class="fake-radio"><input type="radio" name="2" value="1"><span
                                             class="radio-img"></span><span>Up to 3 days</span>
                                          </label>
                                          <label
                                             class="fake-radio"><input type="radio" name="2" value="1"><span
                                             class="radio-img"></span><span>Up to 7 days</span>
                                          </label>
                                          <label
                                             class="fake-radio"><input type="radio" name="2" value="1"><span
                                             class="radio-img"></span><span>Anytime</span>
                                          </label>
                                       </div>
                                    </div>
                                 </div>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
                  <div class="right">
                     <ul class="d-flex align-items-center">
                        <li>
                           <label class="switch">
                           <input type="checkbox">
                           <span class="slider round"></span>
                           </label>
                           <h5>Pro Services</h5>
                        </li>
                        <li>
                           <label class="switch">
                           <input type="checkbox">
                           <span class="slider round"></span>
                           </label>
                           <h5>Local Sellers</h5>
                        </li>
                        <li>
                           <label class="switch">
                           <input type="checkbox">
                           <span class="slider round"></span>
                           </label>
                           <h5>Online Sellers</h5>
                        </li>
                     </ul>
                  </div>
               </div>
            </div>
         </div>
      </div>
      <div class="main-page best-selling">
         <div class="view_slider recommended pt-5">
            <div class="container">
               <div class="sorting-div d-flex align-items-center justify-content-between">
                  <p class="mb-2">463 Services available</p>
                  <div class="sorting d-flex align-items-center">
                     <p>Sortby</p>
                     <select class="custom-select custom-select-sm border-0 shadow-sm ml-2">
                        <option>Best Selling</option>
                        <option>Recommended</option>
                        <option>Newest Arrivals</option>
                     </select>
                  </div>
               </div>
               <h3>Services In Web &amp; Mobile Design</h3>
            </div>
            <div class="container">
               <div class="row">
                  <div class="col-md-3">
                     <a href="product-detail.html">
                     <img class="img-fluid" src="images/list/v1.png" />
                     </a>
                     <div class="inner-slider">
                        <div class="inner-wrapper">
                           <div class="d-flex align-items-center">
                              <span class="seller-image">
                              <img class="img-fluid"
                                 src="images/user/s1.png"
                                 alt='' />
                              </span>
                              <span class="seller-name">
                              <a href="#">Stave Martin</a>
                              <span class="level hint--top level-one-seller">
                              Level 1 Seller
                              </span>
                              </span>
                           </div>
                           <h3>
                              Contrary to popular belief, Lorem Ipsum is not simply...
                           </h3>
                           <div class="content-info">
                              <div class="rating-wrapper">
                                 <span class="gig-rating text-body-2">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1792 1792" width="15" height="15">
                                       <path fill="currentColor"
                                          d="M1728 647q0 22-26 48l-363 354 86 500q1 7 1 20 0 21-10.5 35.5t-30.5 14.5q-19 0-40-12l-449-236-449 236q-22 12-40 12-21 0-31.5-14.5t-10.5-35.5q0-6 2-20l86-500-364-354q-25-27-25-48 0-37 56-46l502-73 225-455q19-41 49-41t49 41l225 455 502 73q56 9 56 46z">
                                       </path>
                                    </svg>
                                    5.0
                                    <span>(7)</span>
                                 </span>
                              </div>
                           </div>
                           <div class="footer">
                              <i class="fa fa-heart" aria-hidden="true"></i>
                              <div class="price">
                                 <a href="#">
                                 Starting At <span> $1,205</span>
                                 </a>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
                  <div class="col-md-3">
                     <a href="product-detail.html">
                     <img class="img-fluid" src="images/list/v2.png" />
                     </a>
                     <div class="inner-slider">
                        <div class="inner-wrapper">
                           <div class="d-flex align-items-center">
                              <span class="seller-image">
                              <img class="img-fluid"
                                 src="images/user/s2.png"
                                 alt='' />
                              </span>
                              <span class="seller-name">
                              <a href="#">Stave Martin</a>
                              <span class="level hint--top level-one-seller">
                              Level 1 Seller
                              </span>
                              </span>
                           </div>
                           <h3>
                              Contrary to popular belief, Lorem Ipsum is not simply...
                           </h3>
                           <div class="content-info">
                              <div class="rating-wrapper">
                                 <span class="gig-rating text-body-2">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1792 1792" width="15" height="15">
                                       <path fill="currentColor"
                                          d="M1728 647q0 22-26 48l-363 354 86 500q1 7 1 20 0 21-10.5 35.5t-30.5 14.5q-19 0-40-12l-449-236-449 236q-22 12-40 12-21 0-31.5-14.5t-10.5-35.5q0-6 2-20l86-500-364-354q-25-27-25-48 0-37 56-46l502-73 225-455q19-41 49-41t49 41l225 455 502 73q56 9 56 46z">
                                       </path>
                                    </svg>
                                    5.0
                                    <span>(7)</span>
                                 </span>
                              </div>
                           </div>
                           <div class="footer">
                              <i class="fa fa-heart" aria-hidden="true"></i>
                              <div class="price">
                                 <a href="#">
                                 Starting At <span> $1,205</span>
                                 </a>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
                  <div class="col-md-3">
                     <a href="product-detail.html">
                     <img class="img-fluid" src="images/list/v3.png" />
                     </a>
                     <div class="inner-slider">
                        <div class="inner-wrapper">
                           <div class="d-flex align-items-center">
                              <span class="seller-image">
                              <img class="img-fluid"
                                 src="images/user/s3.png"
                                 alt='' />
                              </span>
                              <span class="seller-name">
                              <a href="#">Stave Martin</a>
                              <span class="level hint--top level-one-seller">
                              Level 1 Seller
                              </span>
                              </span>
                           </div>
                           <h3>
                              Contrary to popular belief, Lorem Ipsum is not simply...
                           </h3>
                           <div class="content-info">
                              <div class="rating-wrapper">
                                 <span class="gig-rating text-body-2">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1792 1792" width="15" height="15">
                                       <path fill="currentColor"
                                          d="M1728 647q0 22-26 48l-363 354 86 500q1 7 1 20 0 21-10.5 35.5t-30.5 14.5q-19 0-40-12l-449-236-449 236q-22 12-40 12-21 0-31.5-14.5t-10.5-35.5q0-6 2-20l86-500-364-354q-25-27-25-48 0-37 56-46l502-73 225-455q19-41 49-41t49 41l225 455 502 73q56 9 56 46z">
                                       </path>
                                    </svg>
                                    5.0
                                    <span>(7)</span>
                                 </span>
                              </div>
                           </div>
                           <div class="footer">
                              <i class="fa fa-heart" aria-hidden="true"></i>
                              <div class="price">
                                 <a href="#">
                                 Starting At <span> $1,205</span>
                                 </a>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
                  <div class="col-md-3">
                     <a href="product-detail.html">
                     <img class="img-fluid" src="images/list/v4.png" />
                     </a>
                     <div class="inner-slider">
                        <div class="inner-wrapper">
                           <div class="d-flex align-items-center">
                              <span class="seller-image">
                              <img class="img-fluid"
                                 src="images/user/s4.png"
                                 alt='' />
                              </span>
                              <span class="seller-name">
                              <a href="#">Stave Martin</a>
                              <span class="level hint--top level-one-seller">
                              Level 1 Seller
                              </span>
                              </span>
                           </div>
                           <h3>
                              Contrary to popular belief, Lorem Ipsum is not simply...
                           </h3>
                           <div class="content-info">
                              <div class="rating-wrapper">
                                 <span class="gig-rating text-body-2">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1792 1792" width="15" height="15">
                                       <path fill="currentColor"
                                          d="M1728 647q0 22-26 48l-363 354 86 500q1 7 1 20 0 21-10.5 35.5t-30.5 14.5q-19 0-40-12l-449-236-449 236q-22 12-40 12-21 0-31.5-14.5t-10.5-35.5q0-6 2-20l86-500-364-354q-25-27-25-48 0-37 56-46l502-73 225-455q19-41 49-41t49 41l225 455 502 73q56 9 56 46z">
                                       </path>
                                    </svg>
                                    5.0
                                    <span>(7)</span>
                                 </span>
                              </div>
                           </div>
                           <div class="footer">
                              <i class="fa fa-heart" aria-hidden="true"></i>
                              <div class="price">
                                 <a href="#">
                                 Starting At <span> $1,205</span>
                                 </a>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
                  <div class="col-md-3">
                     <a href="product-detail.html">
                     <img class="img-fluid" src="images/list/v5.png" />
                     </a>
                     <div class="inner-slider">
                        <div class="inner-wrapper">
                           <div class="d-flex align-items-center">
                              <span class="seller-image">
                              <img class="img-fluid"
                                 src="images/user/s5.png"
                                 alt='' />
                              </span>
                              <span class="seller-name">
                              <a href="#">Stave Martin</a>
                              <span class="level hint--top level-one-seller">
                              Level 1 Seller
                              </span>
                              </span>
                           </div>
                           <h3>
                              Contrary to popular belief, Lorem Ipsum is not simply...
                           </h3>
                           <div class="content-info">
                              <div class="rating-wrapper">
                                 <span class="gig-rating text-body-2">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1792 1792" width="15" height="15">
                                       <path fill="currentColor"
                                          d="M1728 647q0 22-26 48l-363 354 86 500q1 7 1 20 0 21-10.5 35.5t-30.5 14.5q-19 0-40-12l-449-236-449 236q-22 12-40 12-21 0-31.5-14.5t-10.5-35.5q0-6 2-20l86-500-364-354q-25-27-25-48 0-37 56-46l502-73 225-455q19-41 49-41t49 41l225 455 502 73q56 9 56 46z">
                                       </path>
                                    </svg>
                                    5.0
                                    <span>(7)</span>
                                 </span>
                              </div>
                           </div>
                           <div class="footer">
                              <i class="fa fa-heart" aria-hidden="true"></i>
                              <div class="price">
                                 <a href="#">
                                 Starting At <span> $1,205</span>
                                 </a>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
                  <div class="col-md-3">
                     <a href="product-detail.html">
                     <img class="img-fluid" src="images/list/v6.png" />
                     </a>
                     <div class="inner-slider">
                        <div class="inner-wrapper">
                           <div class="d-flex align-items-center">
                              <span class="seller-image">
                              <img class="img-fluid"
                                 src="images/user/s6.png"
                                 alt='' />
                              </span>
                              <span class="seller-name">
                              <a href="#">Stave Martin</a>
                              <span class="level hint--top level-one-seller">
                              Level 1 Seller
                              </span>
                              </span>
                           </div>
                           <h3>
                              Contrary to popular belief, Lorem Ipsum is not simply...
                           </h3>
                           <div class="content-info">
                              <div class="rating-wrapper">
                                 <span class="gig-rating text-body-2">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1792 1792" width="15" height="15">
                                       <path fill="currentColor"
                                          d="M1728 647q0 22-26 48l-363 354 86 500q1 7 1 20 0 21-10.5 35.5t-30.5 14.5q-19 0-40-12l-449-236-449 236q-22 12-40 12-21 0-31.5-14.5t-10.5-35.5q0-6 2-20l86-500-364-354q-25-27-25-48 0-37 56-46l502-73 225-455q19-41 49-41t49 41l225 455 502 73q56 9 56 46z">
                                       </path>
                                    </svg>
                                    5.0
                                    <span>(7)</span>
                                 </span>
                              </div>
                           </div>
                           <div class="footer">
                              <i class="fa fa-heart" aria-hidden="true"></i>
                              <div class="price">
                                 <a href="#">
                                 Starting At <span> $1,205</span>
                                 </a>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
                  <div class="col-md-3">
                     <a href="product-detail.html">
                     <img class="img-fluid" src="images/list/v7.png" />
                     </a>
                     <div class="inner-slider">
                        <div class="inner-wrapper">
                           <div class="d-flex align-items-center">
                              <span class="seller-image">
                              <img class="img-fluid"
                                 src="images/user/s7.png"
                                 alt='' />
                              </span>
                              <span class="seller-name">
                              <a href="#">Stave Martin</a>
                              <span class="level hint--top level-one-seller">
                              Level 1 Seller
                              </span>
                              </span>
                           </div>
                           <h3>
                              Contrary to popular belief, Lorem Ipsum is not simply...
                           </h3>
                           <div class="content-info">
                              <div class="rating-wrapper">
                                 <span class="gig-rating text-body-2">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1792 1792" width="15" height="15">
                                       <path fill="currentColor"
                                          d="M1728 647q0 22-26 48l-363 354 86 500q1 7 1 20 0 21-10.5 35.5t-30.5 14.5q-19 0-40-12l-449-236-449 236q-22 12-40 12-21 0-31.5-14.5t-10.5-35.5q0-6 2-20l86-500-364-354q-25-27-25-48 0-37 56-46l502-73 225-455q19-41 49-41t49 41l225 455 502 73q56 9 56 46z">
                                       </path>
                                    </svg>
                                    5.0
                                    <span>(7)</span>
                                 </span>
                              </div>
                           </div>
                           <div class="footer">
                              <i class="fa fa-heart" aria-hidden="true"></i>
                              <div class="price">
                                 <a href="#">
                                 Starting At <span> $1,205</span>
                                 </a>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
                  <div class="col-md-3">
                     <a href="product-detail.html">
                     <img class="img-fluid" src="images/list/v8.png" />
                     </a>
                     <div class="inner-slider">
                        <div class="inner-wrapper">
                           <div class="d-flex align-items-center">
                              <span class="seller-image">
                              <img class="img-fluid"
                                 src="images/user/s8.png"
                                 alt='' />
                              </span>
                              <span class="seller-name">
                              <a href="#">Stave Martin</a>
                              <span class="level hint--top level-one-seller">
                              Level 1 Seller
                              </span>
                              </span>
                           </div>
                           <h3>
                              Contrary to popular belief, Lorem Ipsum is not simply...
                           </h3>
                           <div class="content-info">
                              <div class="rating-wrapper">
                                 <span class="gig-rating text-body-2">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1792 1792" width="15" height="15">
                                       <path fill="currentColor"
                                          d="M1728 647q0 22-26 48l-363 354 86 500q1 7 1 20 0 21-10.5 35.5t-30.5 14.5q-19 0-40-12l-449-236-449 236q-22 12-40 12-21 0-31.5-14.5t-10.5-35.5q0-6 2-20l86-500-364-354q-25-27-25-48 0-37 56-46l502-73 225-455q19-41 49-41t49 41l225 455 502 73q56 9 56 46z">
                                       </path>
                                    </svg>
                                    5.0
                                    <span>(7)</span>
                                 </span>
                              </div>
                           </div>
                           <div class="footer">
                              <i class="fa fa-heart" aria-hidden="true"></i>
                              <div class="price">
                                 <a href="#">
                                 Starting At <span> $1,205</span>
                                 </a>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
                  <div class="col-md-3">
                     <a href="product-detail.html">
                     <img class="img-fluid" src="images/list/v2.png" />
                     </a>
                     <div class="inner-slider">
                        <div class="inner-wrapper">
                           <div class="d-flex align-items-center">
                              <span class="seller-image">
                              <img class="img-fluid"
                                 src="images/user/s9.png"
                                 alt='' />
                              </span>
                              <span class="seller-name">
                              <a href="#">Stave Martin</a>
                              <span class="level hint--top level-one-seller">
                              Level 1 Seller
                              </span>
                              </span>
                           </div>
                           <h3>
                              Contrary to popular belief, Lorem Ipsum is not simply...
                           </h3>
                           <div class="content-info">
                              <div class="rating-wrapper">
                                 <span class="gig-rating text-body-2">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1792 1792" width="15" height="15">
                                       <path fill="currentColor"
                                          d="M1728 647q0 22-26 48l-363 354 86 500q1 7 1 20 0 21-10.5 35.5t-30.5 14.5q-19 0-40-12l-449-236-449 236q-22 12-40 12-21 0-31.5-14.5t-10.5-35.5q0-6 2-20l86-500-364-354q-25-27-25-48 0-37 56-46l502-73 225-455q19-41 49-41t49 41l225 455 502 73q56 9 56 46z">
                                       </path>
                                    </svg>
                                    5.0
                                    <span>(7)</span>
                                 </span>
                              </div>
                           </div>
                           <div class="footer">
                              <i class="fa fa-heart" aria-hidden="true"></i>
                              <div class="price">
                                 <a href="#">
                                 Starting At <span> $1,205</span>
                                 </a>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
                  <div class="col-md-3">
                     <a href="product-detail.html">
                     <img class="img-fluid" src="images/list/v4.png" />
                     </a>
                     <div class="inner-slider">
                        <div class="inner-wrapper">
                           <div class="d-flex align-items-center">
                              <span class="seller-image">
                              <img class="img-fluid"
                                 src="images/user/s10.png"
                                 alt='' />
                              </span>
                              <span class="seller-name">
                              <a href="#">Stave Martin</a>
                              <span class="level hint--top level-one-seller">
                              Level 1 Seller
                              </span>
                              </span>
                           </div>
                           <h3>
                              Contrary to popular belief, Lorem Ipsum is not simply...
                           </h3>
                           <div class="content-info">
                              <div class="rating-wrapper">
                                 <span class="gig-rating text-body-2">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1792 1792" width="15" height="15">
                                       <path fill="currentColor"
                                          d="M1728 647q0 22-26 48l-363 354 86 500q1 7 1 20 0 21-10.5 35.5t-30.5 14.5q-19 0-40-12l-449-236-449 236q-22 12-40 12-21 0-31.5-14.5t-10.5-35.5q0-6 2-20l86-500-364-354q-25-27-25-48 0-37 56-46l502-73 225-455q19-41 49-41t49 41l225 455 502 73q56 9 56 46z">
                                       </path>
                                    </svg>
                                    5.0
                                    <span>(7)</span>
                                 </span>
                              </div>
                           </div>
                           <div class="footer">
                              <i class="fa fa-heart" aria-hidden="true"></i>
                              <div class="price">
                                 <a href="#">
                                 Starting At <span> $1,205</span>
                                 </a>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
                  <div class="col-md-3">
                     <a href="product-detail.html">
                     <img class="img-fluid" src="images/list/v5.png" />
                     </a>
                     <div class="inner-slider">
                        <div class="inner-wrapper">
                           <div class="d-flex align-items-center">
                              <span class="seller-image">
                              <img class="img-fluid"
                                 src="images/user/s1.png"
                                 alt='' />
                              </span>
                              <span class="seller-name">
                              <a href="#">Stave Martin</a>
                              <span class="level hint--top level-one-seller">
                              Level 1 Seller
                              </span>
                              </span>
                           </div>
                           <h3>
                              Contrary to popular belief, Lorem Ipsum is not simply...
                           </h3>
                           <div class="content-info">
                              <div class="rating-wrapper">
                                 <span class="gig-rating text-body-2">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1792 1792" width="15" height="15">
                                       <path fill="currentColor"
                                          d="M1728 647q0 22-26 48l-363 354 86 500q1 7 1 20 0 21-10.5 35.5t-30.5 14.5q-19 0-40-12l-449-236-449 236q-22 12-40 12-21 0-31.5-14.5t-10.5-35.5q0-6 2-20l86-500-364-354q-25-27-25-48 0-37 56-46l502-73 225-455q19-41 49-41t49 41l225 455 502 73q56 9 56 46z">
                                       </path>
                                    </svg>
                                    5.0
                                    <span>(7)</span>
                                 </span>
                              </div>
                           </div>
                           <div class="footer">
                              <i class="fa fa-heart" aria-hidden="true"></i>
                              <div class="price">
                                 <a href="#">
                                 Starting At <span> $1,205</span>
                                 </a>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
                  <div class="col-md-3">
                     <a href="product-detail.html">
                     <img class="img-fluid" src="images/list/v1.png" />
                     </a>
                     <div class="inner-slider">
                        <div class="inner-wrapper">
                           <div class="d-flex align-items-center">
                              <span class="seller-image">
                              <img class="img-fluid"
                                 src="images/user/s3.png"
                                 alt='' />
                              </span>
                              <span class="seller-name">
                              <a href="#">Stave Martin</a>
                              <span class="level hint--top level-one-seller">
                              Level 1 Seller
                              </span>
                              </span>
                           </div>
                           <h3>
                              Contrary to popular belief, Lorem Ipsum is not simply...
                           </h3>
                           <div class="content-info">
                              <div class="rating-wrapper">
                                 <span class="gig-rating text-body-2">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1792 1792" width="15" height="15">
                                       <path fill="currentColor"
                                          d="M1728 647q0 22-26 48l-363 354 86 500q1 7 1 20 0 21-10.5 35.5t-30.5 14.5q-19 0-40-12l-449-236-449 236q-22 12-40 12-21 0-31.5-14.5t-10.5-35.5q0-6 2-20l86-500-364-354q-25-27-25-48 0-37 56-46l502-73 225-455q19-41 49-41t49 41l225 455 502 73q56 9 56 46z">
                                       </path>
                                    </svg>
                                    5.0
                                    <span>(7)</span>
                                 </span>
                              </div>
                           </div>
                           <div class="footer">
                              <i class="fa fa-heart" aria-hidden="true"></i>
                              <div class="price">
                                 <a href="#">
                                 Starting At <span> $1,205</span>
                                 </a>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </div>
         <div class="footer-pagination text-center">
            <nav aria-label="Page navigation example">
               <ul class="pagination">
                  <li class="page-item">
                     <a class="page-link" href="#" aria-label="Previous">
                        <span aria-hidden="true"><i class="fa fa-chevron-left" aria-hidden="true"></i></span>
                        <!--                    <span class="sr-only"></span>-->
                     </a>
                  </li>
                  <li class="page-item"><a class="page-link" href="#">1</a></li>
                  <li class="page-item active"><a class="page-link" href="#">2</a></li>
                  <li class="page-item"><a class="page-link" href="#">4</a></li>
                  <li class="page-item"><a class="page-link" href="#">5</a></li>
                  <li class="page-item">
                     <a class="page-link" href="#" aria-label="Next">
                        <span aria-hidden="true"><i class="fa fa-chevron-right" aria-hidden="true"></i></span>
                        <!--                    <span class="sr-only"></span>-->
                     </a>
                  </li>
               </ul>
            </nav>
         </div>
         <section class="related-links">
            <h2>Explore More Web &amp; Mobile Design Services</h2>
            <ul>
               <li>
                  <a href="#" class="related-link" target="">Email Templates Design</a>
               </li>
               <li>
                  <a href="#" class="related-link" target="">Landing Pages Design</a>
               </li>
               <li>
                  <a href="#" class="related-link" target="">Mobile Apps Design</a>
               </li>
            </ul>
         </section>
         <div class="container">
            <section class="faqs">
               <h2>Web &amp; Mobile Design FAQs</h2>
               <ul>
                  <li>
                     <h3>What is web design?</h3>
                     <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged.
                     </p>
                  </li>
                  <li>
                     <h3>What kinds of projects need web design?</h3>
                     <p>When an unknown printer took Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s,  a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged.</p>
                  </li>
                  <li>
                     <h3>What makes good web design?</h3>
                     <p>It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using 'Content here, content here', making it look like readable English. Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for 'lorem ipsum' will uncover many.                     </p>
                  </li>
                  <li>
                     <h3>How do I pick the right web designer for me?</h3>
                     <p>Making it look like readable English It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using 'Content here, content here. Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for 'lorem ipsum' will uncover many.</p>
                  </li>
               </ul>
            </section>
         </div>
      </div>
@endsection
