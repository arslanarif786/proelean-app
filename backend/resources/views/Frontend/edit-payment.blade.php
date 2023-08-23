@extends('layouts.app')
@section('content')

      <section class="py-5">
         <div class="container">
            <div class="row">
               <div class="col-lg-3">
                  <div class="bg-white rounded shadow-sm py-3 sidebar-fix">
                     <div class="dropdown-menu-show">
                        <a class="dropdown-item py-2" href="customer-order.html">Customer Order</a>
                        <a class="dropdown-item py-2" href="overview.html">Overview</a>
                        <a class="dropdown-item py-2" href="business.html">Business</a>
                        <a class="dropdown-item py-2" href="edit-account.html">Edit Account</a>
                        <a class="dropdown-item py-2" href="edit-security.html">Edit Security</a>
                        <a class="dropdown-item py-2" href="edit-notifications.html">Edit Notification</a>
                        <a class="dropdown-item py-2" href="edit-billing.html">Edit Billing</a>
                        <a class="dropdown-item py-2 active" href="edit-payment.html">Edit Payment</a>
                     </div>
                  </div>
               </div>
               <div class="col-lg-9">
                  <div class="bg-white rounded shadow-sm sidebar-page-right">
                     <div>
                        <div class="p-3">
                           <p class="text-muted font-weight-bold h6 mb-3">Your Account Balance</p>
                           <p class="text-muted font-weight-bold mb-0">When available, we use your funds and credits as your primary payment method for new orders.</p>
                           <div class="border my-4 rounded">
                              <div class="bg-light d-flex border-bottom">
                                 <div class="p-3">
                                    <p class="text-muted font-weight-bold mb-0">MIVER BALANCE</p>
                                 </div>
                                 <div class="border-left p-3 ml-auto">
                                    <p class="text-muted font-weight-bold mb-0">TOTAL ₹0.00</p>
                                 </div>
                              </div>
                              <div class="d-flex border-bottom">
                                 <div class="p-3">
                                    <p class="text-muted font-weight-bold mb-0">Your Earnings</p>
                                 </div>
                                 <div class="p-3 ml-auto">
                                    <p class="text-muted font-weight-bold mb-0">₹0.00</p>
                                 </div>
                              </div>
                              <div class="d-flex">
                                 <div class="p-3">
                                    <p class="text-muted font-weight-bold mb-0">Your Reimbursements <span data-toggle="tooltip" data-placement="right" title="Funds credited back to your account for canceled orders."><i class="fa fa-question-circle" aria-hidden="true"></i></span></p>
                                    <p class="mb-0 text-muted">Funds that were credited back to your account for canceled orders.</p>
                                 </div>
                                 <div class="p-3 ml-auto">
                                    <p class="text-muted font-weight-bold mb-0">₹0.00</p>
                                 </div>
                              </div>
                           </div>
                           <div class="border my-4 rounded">
                              <div class="bg-light d-flex border-bottom">
                                 <div class="p-3">
                                    <p class="text-muted font-weight-bold mb-0">MIVER CREDITS <span data-toggle="tooltip" data-placement="right" title="Miver Credits are funds you can only use for buying services on Miver, within a limited period of time. Please note credits data is updated every few minutes"><i class="fa fa-question-circle" aria-hidden="true"></i></span></p>
                                 </div>
                                 <div class="border-left p-3 ml-auto">
                                    <p class="text-muted font-weight-bold mb-0">TOTAL ₹0.00</p>
                                 </div>
                              </div>
                              <div class="text-center py-5">
                                 <p class="font-weight-bold h6">No Credits Yet</p>
                                 <p class="text-muted font-weight-bold">Refer a friend to Miver and get credits to buy the freelance services you need.</p>
                                 <a href="#" class="btn btn-success btn-lg my-3">Get Miver Credits</a>
                              </div>
                           </div>
                           <p class="text-muted">Please note it may take a few minutes to update new Miver Credits in your account balance.</p>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </section>
@endsection