@extends('layouts.app')
@section('content')
      <div class="main-page second py-5">
         <div class="container">
            <div class="row">
               <div class="col-md-12">
                  <h2 class="mb-3">Manage Proposal/Service Orders
                  </h2>
                  <ul class="nav osahan-tabs nav-tabs flex-column flex-sm-row ">
                     <li class="nav-item">
                        <a href="#active" data-toggle="tab" class="nav-link make-black active">
                        ACTIVE <span class="badge badge-success">35</span>
                        </a>
                     </li>
                     <li class="nav-item">
                        <a href="#delivered" data-toggle="tab" class="nav-link make-black">
                        DELIVERED <span class="badge badge-success">3</span>
                        </a>
                     </li>
                     <li class="nav-item">
                        <a href="#completed" data-toggle="tab" class="nav-link make-black">
                        COMPLETED <span class="badge badge-success">77</span>
                        </a>
                     </li>
                     <li class="nav-item">
                        <a href="#cancelled" data-toggle="tab" class="nav-link make-black">
                        CANCELLED <span class="badge badge-success">61</span>
                        </a>
                     </li>
                     <li class="nav-item">
                        <a href="#all" data-toggle="tab" class="nav-link make-black">
                        ALL <span class="badge badge-success">191</span>
                        </a>
                     </li>
                  </ul>
                  <div class="tab-content osahan-table bg-white rounded shadow-sm px-3 pt-1">
                     <div class="tab-pane active" id="active">
                        <div class="table-responsive box-table mt-3">
                           <table class="table table-bordered">
                              <thead>
                                 <tr>
                                    <th>ORDER SUMMARY</th>
                                    <th>ORDER DATE</th>
                                    <th>DUE ON</th>
                                    <th>TOTAL</th>
                                    <th>STATUS</th>
                                 </tr>
                              </thead>
                              <tbody>
                                 <tr>
                                    <td>
                                       <a href="#" class="make-black">
                                          <img class="order-proposal-image" src="images/senatopcustudio.jpg">
                                          <p class="order-proposal-title">Logo Design</p>
                                       </a>
                                    </td>
                                    <td>March 23, 2021</td>
                                    <td>March 24, 2021</td>
                                    <td>$15.00</td>
                                    <td><button class="btn btn-sm btn-success">Progress</button></td>
                                 </tr>
                                 <tr>
                                    <td>
                                       <a href="#">
                                          <img class="order-proposal-image" src="images/designerheather.jpg">
                                          <p class="order-proposal-title">Accounting book keeping</p>
                                       </a>
                                    </td>
                                    <td>November 07, 2019</td>
                                    <td>November 14, 2019</td>
                                    <td>$1.00</td>
                                    <td><button class="btn btn-sm btn-success">Cancelled</button></td>
                                 </tr>
                                 <tr>
                                    <td>
                                       <a href="#">
                                          <img class="order-proposal-image" src="images/artsi3d.jpg">
                                          <p class="order-proposal-title">Brand Style Guides</p>
                                       </a>
                                    </td>
                                    <td>November 05, 2019</td>
                                    <td>November 06, 2019</td>
                                    <td>$10.00</td>
                                    <td><button class="btn btn-sm btn-success">Cancelled</button></td>
                                 </tr>
                                 <tr>
                                    <td>
                                       <a href="#">
                                          <img class="order-proposal-image" src="images/senatopcustudio.jpg">
                                          <p class="order-proposal-title">Design profile</p>
                                       </a>
                                    </td>
                                    <td>November 09, 2019</td>
                                    <td>November 10, 2019</td>
                                    <td>$1,000.00</td>
                                    <td><button class="btn btn-sm btn-success">Cancelled</button></td>
                                 </tr>
                              </tbody>
                           </table>
                        </div>
                     </div>
                     <div class="tab-pane" id="delivered">
                        <div class="table-responsive box-table mt-3">
                           <table class="table table-bordered">
                              <thead>
                                 <tr>
                                    <th>ORDER SUMMARY</th>
                                    <th>ORDER DATE</th>
                                    <th>DUE ON</th>
                                    <th>TOTAL</th>
                                    <th>STATUS</th>
                                 </tr>
                              </thead>
                              <tbody>
                                 <tr>
                                    <td>
                                       <a href="#">
                                          <img class="order-proposal-image" src="images/senatopcustudio.jpg">
                                          <p class="order-proposal-title">Design profile</p>
                                       </a>
                                    </td>
                                    <td>November 09, 2019</td>
                                    <td>November 10, 2019</td>
                                    <td>$1,000.00</td>
                                    <td><button class="btn btn-sm btn-success">Cancelled</button></td>
                                 </tr>
                                 <tr>
                                    <td>
                                       <a href="#">
                                          <img class="order-proposal-image" src="images/designerheather.jpg">
                                          <p class="order-proposal-title">Accounting book keeping</p>
                                       </a>
                                    </td>
                                    <td>November 07, 2019</td>
                                    <td>November 14, 2019</td>
                                    <td>$1.00</td>
                                    <td><button class="btn btn-sm btn-success">Cancelled</button></td>
                                 </tr>
                                 <tr>
                                    <td>
                                       <a href="#">
                                          <img class="order-proposal-image" src="images/artsi3d.jpg">
                                          <p class="order-proposal-title">Brand Style Guides</p>
                                       </a>
                                    </td>
                                    <td>November 05, 2019</td>
                                    <td>November 06, 2019</td>
                                    <td>$10.00</td>
                                    <td><button class="btn btn-sm btn-success">Cancelled</button></td>
                                 </tr>
                              </tbody>
                           </table>
                        </div>
                     </div>
                     <div class="tab-pane" id="completed">
                        <div class="table-responsive box-table mt-3">
                           <table class="table table-bordered">
                              <thead>
                                 <tr>
                                    <th>ORDER SUMMARY</th>
                                    <th>ORDER DATE</th>
                                    <th>DUE ON</th>
                                    <th>TOTAL</th>
                                    <th>STATUS</th>
                                 </tr>
                              </thead>
                              <tbody>
                                 <tr>
                                    <td>
                                       <a href="#">
                                          <img class="order-proposal-image" src="images/designerheather.jpg">
                                          <p class="order-proposal-title">Accounting book keeping</p>
                                       </a>
                                    </td>
                                    <td>November 07, 2019</td>
                                    <td>November 14, 2019</td>
                                    <td>$1.00</td>
                                    <td><button class="btn btn-sm btn-success">Cancelled</button></td>
                                 </tr>
                                 <tr>
                                    <td>
                                       <a href="#">
                                          <img class="order-proposal-image" src="images/senatopcustudio.jpg">
                                          <p class="order-proposal-title">Design profile</p>
                                       </a>
                                    </td>
                                    <td>November 09, 2019</td>
                                    <td>November 10, 2019</td>
                                    <td>$1,000.00</td>
                                    <td><button class="btn btn-sm btn-success">Cancelled</button></td>
                                 </tr>
                                 <tr>
                                    <td>
                                       <a href="#">
                                          <img class="order-proposal-image" src="images/artsi3d.jpg">
                                          <p class="order-proposal-title">Brand Style Guides</p>
                                       </a>
                                    </td>
                                    <td>November 05, 2019</td>
                                    <td>November 06, 2019</td>
                                    <td>$10.00</td>
                                    <td><button class="btn btn-sm btn-success">Cancelled</button></td>
                                 </tr>
                              </tbody>
                           </table>
                        </div>
                     </div>
                     <div class="tab-pane" id="cancelled">
                        <div class="table-responsive box-table mt-3">
                           <table class="table table-bordered">
                              <thead>
                                 <tr>
                                    <th>ORDER SUMMARY</th>
                                    <th>ORDER DATE</th>
                                    <th>DUE ON</th>
                                    <th>TOTAL</th>
                                    <th>STATUS</th>
                                 </tr>
                              </thead>
                              <tbody>
                                 <tr>
                                    <td>
                                       <a href="#">
                                          <img class="order-proposal-image" src="images/designerheather.jpg">
                                          <p class="order-proposal-title">Accounting book keeping</p>
                                       </a>
                                    </td>
                                    <td>November 07, 2019</td>
                                    <td>November 14, 2019</td>
                                    <td>$1.00</td>
                                    <td><button class="btn btn-sm btn-success">Cancelled</button></td>
                                 </tr>
                                 <tr>
                                    <td>
                                       <a href="#">
                                          <img class="order-proposal-image" src="images/artsi3d.jpg">
                                          <p class="order-proposal-title">Brand Style Guides</p>
                                       </a>
                                    </td>
                                    <td>November 05, 2019</td>
                                    <td>November 06, 2019</td>
                                    <td>$10.00</td>
                                    <td><button class="btn btn-sm btn-success">Cancelled</button></td>
                                 </tr>
                                 <tr>
                                    <td>
                                       <a href="#">
                                          <img class="order-proposal-image" src="images/senatopcustudio.jpg">
                                          <p class="order-proposal-title">Design profile</p>
                                       </a>
                                    </td>
                                    <td>November 09, 2019</td>
                                    <td>November 10, 2019</td>
                                    <td>$1,000.00</td>
                                    <td><button class="btn btn-sm btn-success">Cancelled</button></td>
                                 </tr>
                              </tbody>
                           </table>
                        </div>
                     </div>
                     <div class="tab-pane" id="all">
                        <div class="table-responsive box-table mt-3">
                           <table class="table table-bordered">
                              <thead>
                                 <tr>
                                    <th>ORDER SUMMARY</th>
                                    <th>ORDER DATE</th>
                                    <th>DUE ON</th>
                                    <th>TOTAL</th>
                                    <th>STATUS</th>
                                 </tr>
                              </thead>
                              <tbody>
                                 <tr>
                                    <td>
                                       <a href="#" class="make-black">
                                          <img class="order-proposal-image " src="images/digitalgeria.jpg">
                                          <p class="order-proposal-title">Packaging Design</p>
                                       </a>
                                    </td>
                                    <td>June 28, 2019</td>
                                    <td>July 01, 2019</td>
                                    <td>$10.00</td>
                                    <td><button class="btn btn-sm btn-success">Progress</button></td>
                                 </tr>
                              </tbody>
                           </table>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
@endsection