<template>
  <div class="container pt-3">
    <div class="row d-flex justify-content-center">
      <div class="col-lg-10">   
        <h1 class="app-page-title mb-0">Buyer Requests</h1>
        
        <div>
          <div v-if="loader" class="d-flex justify-content-center s-margin">
            <div class="spinner-border text-primary m-5" role="status">
              <span class="sr-only">Loading...</span>
            </div>
          </div>
          <div v-if="requests">
            <div v-for="request in requests" :key="request.id">
              <div class="card shadow-none">
                <div class="card-body">
                  <div class="row">
                    <div class="col-lg-6 col-md-6 d-flex justify-content-between">
                      <div class="d-flex justify-content-start mb-3">
                      <img
                        class="img-fluid rounded-circle mr-2"
                        style="width: 45px; height: 45px; object-fit:cover;"
                        :src="`${imgURL}/${request.user.image}`"
                        alt=""
                      />
                        <p class="seller-name mt-2" style="font-size:15px">{{ request.user.username }}</p>
                      </div>
                       <div class="mt-2 d-md-none" style="font-size: 12px">{{ request.created_at }}</div>
                    </div>
                    <div class="col-lg-6 col-md-6 d-none d-md-flex justify-content-end">
                      <div class="d-flex flex-column my-1">
                        <span class="mb-2" style="font-size: 14px"
                          >Duration: {{ request.delivery_time }}</span
                        >
                        <span class="mb-2" style="font-size: 14px"
                          >budget: {{ request.budget }}$</span
                        >
                      </div>
                    </div>
                  </div>
                  <p class="card-text">
                    {{ request.description }}
                  </p>
                  <div class="d-flex justify-content-start flex-column my-1">
                    <div class="my-2 d-none d-md-flex" style="font-size: 12px">Posted Date: {{ request.created_at }}</div>
                    <div class="mb-2 d-md-none">Duration: {{ request.delivery_time }}</div>
                    <div class="mb-2 d-md-none">budget: {{ request.budget }}$</div>
                    <div class="mb-2">Document: No Attachment</div>
                  </div>
                  <div class="d-flex justify-content-end">

                    <button class="btn btn-dark"
                      >{{ request.total_offers }} Offers Sent</button
                    >

                    <button type="button" class="btn btn-primary ml-2"
                      :style="{ 'pointer-events': request.is_applied ? 'none' : '' }"
                      data-toggle="modal"
                      data-target="#sendOfferModal"
                      @click.prevent="defineOffer(request.id)"
                      >
                        {{ request.is_applied ? "Applied" : "Send Offer" }}
                    </button>
                    <!---------------------    Modal (Send Offer)     --------------------->
                    <div class="modal fade" id="sendOfferModal" tabindex="-1" role="dialog" aria-labelledby="sendOfferModalTitle" aria-hidden="true">
                      <div class="modal-dialog modal-dialog-centered" role="document">
                        <div class="modal-content">
                          <div class="modal-header d-flex justify-content-center">
                              <h5 class="modal-title" id="exampleModalLongTitle">Send Offer</h5> 
                          </div>
                          <div class="modal-body text-center">
                              <div class="text-left font">Describe your offer</div>
                              <textarea
                                  type="text"
                                  class="form-control"
                                  name="description"
                                  v-model="payload.description"
                                  id="description"
                                  placeholder="Describe your offer"
                                  required
                                />
                                <div class="text-left font mt-2">Total Price</div>
                              <input
                                  type="number"
                                  class="form-control"
                                  name="price"
                                  v-model="payload.price"
                                  id="price"
                                  placeholder="Total Offer(EUR)"
                                  required
                                />
                                <div class="text-left font mt-2">Delivery Time</div>
                              <select
                                  id="deliveryTime"
                                  class="form-control"
                                  name="delivery_time"
                                  v-model="payload.delivery_time"
                                  required
                                >
                                  <option selected>Select day</option>
                                  <option  
                                  v-for="day in $store.getters.getDeliveryDays"
                                  :value="day" 
                                  :key="day.index"
                                  >{{ day }} </option>
                                </select>

                                <div class="text-left font mt-2">Service</div>
                                <select
                                  id="services"
                                  class="form-control"
                                  name="service"
                                  v-model="payload.service_id"
                                  required
                                >
                                  <option selected disabled>Select Service</option>
                                  <option  
                                  v-for="service in $store.getters.getUserServices"
                                  :value="service.id" 
                                  :key="service.id"
                                  >{{ service.s_description }} </option>
                                </select>
                          </div>
                          <div class="modal-footer d-flex justify-content-center">
                              <button type="button" class="btn btn-success" :disabled="getBtnStatus == 2" data-dismiss="modal" @click.prevent="sendOffer()" >
                              {{ getBtnStatus == 2 ? "Loading..." : "Send Offer"  }} 
                                </button>
                              <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                          </div>
                      </div>
                    </div>
                    </div>
                    <!---------------------    Modal End     --------------------->


                    <!---------------------    Button trigger modal    -------------------->
                    <button type="button" @click.prevent="getJobId(request.id)" class="btn btn-success ml-2"
                      data-toggle="modal" data-target="#exampleModalCenter2">
                      Cancel Offer
                    </button>
                    <!---------------------    Modal (Cancel Offer)     --------------------->
                    <div class="modal fade" id="exampleModalCenter2" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenter2Title" aria-hidden="true">
                      <div class="modal-dialog modal-dialog-centered" role="document">
                        <div class="modal-content">
                          <div class="modal-header d-flex justify-content-center">
                            <h5 class="modal-title" id="exampleModalLongTitle">Cancel Offer</h5> 
                          </div>
                          <div class="modal-body text-center">
                            Are you sure you want to cancel the offer?
                          </div>
                          <div class="modal-footer d-flex justify-content-center">
                            <button type="button" class="btn btn-danger" data-dismiss="modal" @click.prevent="deleteJob()">Yes</button>
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
                          </div>
                        </div>
                      </div>
                    </div>
                    <!---------------------    Modal End     --------------------->
                  </div>
                </div>
              </div>
            </div>
          </div>
           <div v-if="!requests" class="container text-center py-5">
            <h2>No Any Service Available</h2>
           </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import { computed, onMounted, ref } from "vue";
import { useStore } from 'vuex';

export default {
  setup() {
    const store = useStore()
    onMounted(() => {
      store.dispatch("showBuyerRequests");
    });
    const jobId = ref('');
    const payload = ref({
      job_id:'',
      service_id:'',
      description:'',
      price:'',
      delivery_time:''
    });
    const getJobId = (id) => {
      jobId.value = id
    };

    function defineOffer(jobID) {
      payload.value.job_id = jobID;
      store.dispatch("getCountriesLanguage");
      store.dispatch("userServices");
    }

    function sendOffer() {
      store.dispatch("sendOffer",payload.value);
    }

    function deleteJob() {
      store.dispatch("deleteBuyerJob", jobId.value);
      console.log("delete request id: ",jobId.value)
    }
    return {
      requests: computed(() => store.getters.getBuyerRequests),
      loader: computed(() => store.getters.getLoaderVal),
      getBtnStatus: computed(() => store.getters.getRegisterStatus),
      imgURL: process.env.VUE_APP_URL,
      payload,
      defineOffer,
      sendOffer,
      deleteJob,
      getJobId,
      jobId,
    };
  },
};
</script>

<style scoped>
.spinner-border{
  width: 4rem;
  height: 4rem;
}
.s-margin{
  margin-bottom: 8rem;
  margin-top: 5rem ;
}

</style>