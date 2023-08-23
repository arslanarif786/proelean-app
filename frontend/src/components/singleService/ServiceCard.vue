<template>
    <div class="col-lg-4 right">
    <div class="">
        
        <div class="tab-content">
        <div id="basic" class="tab-pane fade show active">
            <h4>Package Detail</h4>
            <hr>
            <div class="header">
                <h3><b class="title">10 Screens</b><span class="price">$8,029</span></h3>
                <p>I will design rough sketches for upto 5 Screens of your website/Mobile app.
                </p>
            </div>
            <article>
                <div class="d-flex">
                    <b class="delivery"><i class="fa fa-clock-o" aria-hidden="true"></i> 3 Days
                    Delivery</b>
                    <b class="delivery ml-3"><i class="fa fa-refresh" aria-hidden="true"></i> 1
                    Revision</b>
                </div>
                <ul class="features">
                    <li class="feature included"><i class="fa fa-check" aria-hidden="true"></i>Source File
                    </li>
                    <li class="feature included"><i class="fa fa-check" aria-hidden="true"></i>Commercial
                    Use
                    </li>
                    <li class="feature"><i class="fa fa-check" aria-hidden="true"></i>Interactive
                    Mockup
                    </li>
                    <li class="feature included"><i class="fa fa-check" aria-hidden="true"></i>10
                    Pages
                    </li>
                </ul>
            </article>
            <button class="btn-primary Lwidth">Continue ($8,029)</button>
        </div>

        </div>
        <div class="contact-seller-wrapper d-flex justify-content-center">
            <!-- Button trigger modal -->
            <button type="button" @click.prevent="getServiceId(service.service_user.id)" class="btn btn-success width" data-toggle="modal" data-target="#staticBackdrop">
            Purchase
            </button>

            <!---------------------     Modal    ---------------------->
            <div class="modal fade" id="staticBackdrop" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">Purchase Service</h5> 
                    </div>
                    <div class="modal-body text-center">      
                        <!-- <div class="text-left font ">Description</div> -->
                        <!-- <textarea
                        type="text"
                        class="form-control"
                        name="description"
                        v-model="paymentElements.description"
                        id="description"
                        placeholder="Describe your request"
                        required
                        /> -->
                        <div class="text-left font">ATM Number</div>
                        <input
                        type="number"
                        class="form-control"
                        name="ATM_Number"
                        v-model="paymentElements.number"
                        id="ATM_Number"
                        placeholder="Enter 16 characters of your ATM Number "
                        required
                        />
                        <div class="text-left font mt-2">Card Expiry Month</div>
                        <input
                        type="number"
                        class="form-control"
                        name="expiryMonth"
                        v-model="paymentElements.exp_month"
                        id="expiryMonth"
                        placeholder="Enter Card Expiry Month"
                        required
                        />
                        <div class="text-left font mt-2">Card Expiry Year</div>
                        <input
                        type="number"
                        class="form-control"
                        name="expiryYear"
                        v-model="paymentElements.exp_year"
                        id="expiryYear"
                        placeholder="Enter Card Expiry Year"
                        required
                        />
                        <div class="text-left font mt-2">CVC</div>
                        <input
                        type="number"
                        class="form-control"
                        name="cvc"
                        v-model="paymentElements.cvc"
                        id="cvc"
                        placeholder="Enter CVC"
                        required
                        />
                    </div>
                <div class="modal-footer d-flex justify-content-center">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-danger" data-dismiss="modal" @click="atmCardApproved()">Purchase</button>
                    </div>
                </div>
            </div>
            </div>
            <!---------------------    Modal End     --------------------->

        <button class="btn btn-success ml-3 width" type="button">Contact Seller</button>
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
    //   store.dispatch("showBuyerRequests");
    });
    const paymentElements = ref({
      serviceUserId:'',
      number:'',
      exp_month:1,
      exp_year:2022,
      cvc:'',
    });
    const getServiceId = (id) => {
      paymentElements.value.serviceUserId = id
    };

    function atmCardApproved() {
      store.dispatch("purchaseService", paymentElements.value);
      console.log("service id: ",paymentElements.value);
      paymentElements.value = {}
    }

    return {
      service: computed(() => store.getters.getSingleService),
      atmCardApproved,
      getServiceId,
      paymentElements
    };
  },
};
</script>

<style scoped>
.width{
    width:140px;
}

</style>