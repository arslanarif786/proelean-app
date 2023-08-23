<template>

  <div class="container-fluid">
    <CountDown class="my-3"/>
    <div class="row my-4">
      <div class="col-md-8">
        <div class="app-card app-card-notification shadow-sm">
          <div class="app-card-header px-4 py-3">
            <div class="row g-3 align-items-center">
              <div class="col-12 col-lg-auto text-center text-lg-left">
                <div class="app-icon-holder">
                  <svg
                    width="1em"
                    height="1em"
                    viewBox="0 0 16 16"
                    class="bi bi-receipt"
                    fill="currentColor"
                    xmlns="http://www.w3.org/2000/svg"
                  >
                    <path
                      fill-rule="evenodd"
                      d="M1.92.506a.5.5 0 0 1 .434.14L3 1.293l.646-.647a.5.5 0 0 1 .708 0L5 1.293l.646-.647a.5.5 0 0 1 .708 0L7 1.293l.646-.647a.5.5 0 0 1 .708 0L9 1.293l.646-.647a.5.5 0 0 1 .708 0l.646.647.646-.647a.5.5 0 0 1 .708 0l.646.647.646-.647a.5.5 0 0 1 .801.13l.5 1A.5.5 0 0 1 15 2v12a.5.5 0 0 1-.053.224l-.5 1a.5.5 0 0 1-.8.13L13 14.707l-.646.647a.5.5 0 0 1-.708 0L11 14.707l-.646.647a.5.5 0 0 1-.708 0L9 14.707l-.646.647a.5.5 0 0 1-.708 0L7 14.707l-.646.647a.5.5 0 0 1-.708 0L5 14.707l-.646.647a.5.5 0 0 1-.708 0L3 14.707l-.646.647a.5.5 0 0 1-.801-.13l-.5-1A.5.5 0 0 1 1 14V2a.5.5 0 0 1 .053-.224l.5-1a.5.5 0 0 1 .367-.27zm.217 1.338L2 2.118v11.764l.137.274.51-.51a.5.5 0 0 1 .707 0l.646.647.646-.646a.5.5 0 0 1 .708 0l.646.646.646-.646a.5.5 0 0 1 .708 0l.646.646.646-.646a.5.5 0 0 1 .708 0l.646.646.646-.646a.5.5 0 0 1 .708 0l.646.646.646-.646a.5.5 0 0 1 .708 0l.509.509.137-.274V2.118l-.137-.274-.51.51a.5.5 0 0 1-.707 0L12 1.707l-.646.647a.5.5 0 0 1-.708 0L10 1.707l-.646.647a.5.5 0 0 1-.708 0L8 1.707l-.646.647a.5.5 0 0 1-.708 0L6 1.707l-.646.647a.5.5 0 0 1-.708 0L4 1.707l-.646.647a.5.5 0 0 1-.708 0l-.509-.51z"
                    ></path>
                    <path
                      fill-rule="evenodd"
                      d="M3 4.5a.5.5 0 0 1 .5-.5h6a.5.5 0 1 1 0 1h-6a.5.5 0 0 1-.5-.5zm0 2a.5.5 0 0 1 .5-.5h6a.5.5 0 1 1 0 1h-6a.5.5 0 0 1-.5-.5zm0 2a.5.5 0 0 1 .5-.5h6a.5.5 0 1 1 0 1h-6a.5.5 0 0 1-.5-.5zm0 2a.5.5 0 0 1 .5-.5h6a.5.5 0 0 1 0 1h-6a.5.5 0 0 1-.5-.5zm8-6a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 0 1h-1a.5.5 0 0 1-.5-.5zm0 2a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 0 1h-1a.5.5 0 0 1-.5-.5zm0 2a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 0 1h-1a.5.5 0 0 1-.5-.5zm0 2a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 0 1h-1a.5.5 0 0 1-.5-.5z"
                    ></path>
                  </svg>
                </div>
                <!--//app-icon-holder-->
              </div>
              <!--//col-->
              <div class="col-12 col-lg-auto text-center text-lg-left">
                
                <h4 class="notification-title mb-1">
                  Delivery Note
                </h4>

                <ul class="notification-meta list-inline mb-0">
                  <li class="list-inline-item">1 day ago</li>
                  <!-- <li class="list-inline-item">|</li>
                  <li class="list-inline-item">System</li> -->
                </ul>
              </div>
              <!--//col-->
            </div>
            <!--//row-->
          </div>
          <!--//app-card-header-->
          <div class="app-card-body p-4">
            <div class="notification-content">
              Lorem ipsum, dolor sit amet consectetur adipisicing elit. Facere, quas deleniti inventore ab nulla officiis labore sequi, alias tempora dignissimos recusandae voluptate .
            </div>

      


            
          </div>
          <!--//app-card-body-->
          <div class="app-card-footer px-4 py-3">
            <router-link to="/chat" class="action-link" 
              >Go to Inbox <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-envelope" viewBox="0 0 16 16">
  <path d="M0 4a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v8a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V4Zm2-1a1 1 0 0 0-1 1v.217l7 4.2 7-4.2V4a1 1 0 0 0-1-1H2Zm13 2.383-4.708 2.825L15 11.105V5.383Zm-.034 6.876-5.64-3.471L8 9.583l-1.326-.795-5.64 3.47A1 1 0 0 0 2 13h12a1 1 0 0 0 .966-.741ZM1 11.105l4.708-2.897L1 5.383v5.722Z"/>
</svg>
            </router-link>
          </div>
          <!--//app-card-footer-->
        </div>
           <TimeLine/>
      </div>
      <div class="col-md-4 mt-2">
       

        <div
          class="tab-content shadow-none"
          data-v-0d25e83c=""
          data-v-73f1a28a=""
        >
          <div id="basic" class="tab-pane fade show active" data-v-0d25e83c="">
            <h4 data-v-0d25e83c="">Order Details</h4>
            
              <img src="https://api.dex.proelean.com/uploads/SellerMedia/123416456141564.jpg" class="img-fluid" alt="Responsive image" />
          
              <p class="p-1"> I will design front end web development using react, bootstrap, CSS</p>
              <div>
            <button type="button" class="btn badge bg-success pl-4 pr-4 text-white">
              Completed
            </button>
          </div>
          <hr>
      <div class="order-deatils-header py-2">
             <div class="order-deatils-card">
             <p class="text-muted">Ordered from</p>
             <p>Asif Ali</p>
           </div>
           <div class="order-deatils-card">
             <p class="text-muted">Delivery date</p>
             <p>Sep 17, 7:43 PM</p>
           </div>
           <div class="order-deatils-card">
             <p class="text-muted">Duration</p>
             <p>3 Days</p>
           </div>
           <div class="order-deatils-card">
             <p class="text-muted">Revisions</p>
             <p>3</p>
           </div>
           <div class="order-deatils-card">
             <p class="text-muted">Order number</p>
             <p>#FO293FD99C53</p>
           </div>
           <div class="order-deatils-card">
             <p class="text-muted">Price</p>
             <p>250$</p>
           </div>

           <button class="btn btn-danger">Cancel Order</button>
      </div>
             
             
          </div>
        </div>
      </div>
    </div>
 
  </div>
</template>

<script>
import CountDown from "../components/Seller/Dashboard/CountDown.vue";
import TimeLine from "./TimeLine.vue";
export default { components: { CountDown, TimeLine } };
</script>

<style scoped>
  .tab-content {
    box-shadow: 0 1px 2px rgb(0 0 0 / 20%);
    border-radius: 4px;
    background-color: #ffffff;
    padding: 25px;
}
.order-deatils-card{
  display: flex;
  justify-content: space-between;
}

.app-card-footer {
    background: #fafbff;
}

</style>