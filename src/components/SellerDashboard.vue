<template>
   <div class="main-page second py-5">
         <div class="container">
            <div class="row">
               <PersonalDetails/>
               <div class="col-lg-8 right">
                  <div class="d-flex align-items-center p-3 bg-white rounded shadow-sm h5 m-0">
                     <b>Active orders</b>
                     <div class="ml-auto d-flex align-items-center h5 m-0 text-muted">
                        02 (€200)
                     </div>
                  </div>
                 <h5 class="pt-4 pb-1 pl-3">Earnings</h5>
                 <div class="mb-3 border-0 bg-white shadow-sm rounded ">
                     <div class="card-body">
                         
                        <div class="row">
                           <div class="col-md-4 col-12 text-center border-box">
                              <p>Personal Balance </p>
                              <h1 class="font-weight-bold m-0">€1,000</h1>
                           </div>
                           <div class="col-md-4 col-12 text-center border-box">
                              <p>Earned in March</p>
                              <h1 class="font-weight-bold m-0">€1,00</h1>
                           </div>
                           <div class="col-md-4 col-12 text-center border-box">
                              <p> Avg Order Price</p>
                              <h1 class="font-weight-bold m-0">€1500</h1>
                           </div>
                       
                        </div>
                        <hr>
                        <div class="row">
                           <div class="col-md-4 col-12 text-center border-box">
                              <p> Active Orders </p>
                              <h1 class="font-weight-bold m-0">€200</h1>
                           </div>
                           <div class="col-md-4 col-12 text-center border-box">
                              <p>Pending Clearance</p>
                              <h1 class="font-weight-bold m-0">€1,00</h1>
                           </div>
                           <div class="col-md-4 col-12 text-center border-box">
                              <p>Canelled Orders</p>
                              <h1 class="font-weight-bold m-0">€500</h1>
                           </div>
                       
                        </div>
                     </div>
                  </div>
                  
               </div>
            </div>
         </div>
      </div>
      
</template>

<script>
import PersonalDetails from '@/components/profile/PersonalDetails.vue';
export default {
  name: 'SellerDashboard',
  components: {
    PersonalDetails,
  },
}
</script>

<style scoped>
.font-weight-bold{
    font-size: 25px !important;
}
</style>