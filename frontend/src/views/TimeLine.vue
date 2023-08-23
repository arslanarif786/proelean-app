<template>
  <div class="row d-flex justify-content-center my-5">
    <div class="col-md-12">
      <div class="main-card mb-3 card shadow-none">
        <div class="card-body">
          <h5 class="card-title">{{ $t("orderDetails.timeline") }}</h5>
          <div class="">
            <!-- {{order}} -->
            <div v-for="(orderTime, index) in timeline" :key="index"
              class="vertical-timeline-item vertical-timeline-element">
              <div>
                <span class="vertical-timeline-element-icon bounce-in">
                  <i class="badge badge-dot badge-dot-xl badge-success"></i>
                </span>
                <div class="mt-3 bg-light rounded p-2">
                  <!-- <h6 class="timeline-title">Subject</h6> -->
                  <div class="d-flex justify-content-between">
                    <div class="">{{ orderTime.description }}</div>
                    <div class="text-muted">
                      {{ moment.utc(orderTime.created_at).fromNow() }}
                    </div>
                  </div>

                  <!-- dispute order request button-->
                  <div class="d-flex justify-content-start my-2" v-if="
                    orderTime.properties.type === 'ORDER' &&
                    orderTime.properties.value &&
                    orderTime.properties.value.toLowerCase() === 'disputed'
                  ">
                    <div v-if="
                      index == 0 &&
                      ($store.getters.getShowDisputeBtn == true ||
                        $store.getters.getShowDisputeBtn == 'true')
                    ">
                      <div class="badge bg-danger text-white cursor-pointer" @click.prevent="acceptDispute($event)">
                        {{ $t("orderDetails.accept") }}
                      </div>
                      <span class="badge bg-primary ml-2 text-white cursor-pointer"
                        @click.prevent="rejectDispute($event)">
                        {{ $t("orderDetails.reject") }}
                      </span>
                    </div>
                  </div>

                  <!-- Extend order request button-->
                  <div class="d-flex justify-content-between my-1" v-if="orderTime.properties.type === 'EXTEND_ORDER'">
                    <div class="back text-dark mt-1">
                      {{ $t("orderDetails.sellerWantsToExtendTheOrderUpto") }}
                      {{ orderTime.properties.value }}
                    </div>
                    <div class="mt-1" v-if="
                      $store.getters.isBuyerMode &&
                      index == 0 &&
                      $store.getters.getShowBtn == true
                    ">
                      <div class="badge bg-danger mr-2 text-white cursor-pointer" @click.prevent="extendTime()">
                        {{ $t("orderDetails.accept") }}
                      </div>
                      <div class="badge bg-primary text-white cursor-pointer" @click.prevent="extendTimeReject()">
                        {{ $t("orderDetails.reject") }}
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <!-- =============================================Five Star Design ========================-->
          <div v-if="order.status_id == 4 && $store.getters.isBuyerMode && order.is_rated == 0">

            <h5 class="card-title" data-v-e1907bca="">Rating</h5>
            <div class="form-group">
              <label for="exampleFormControlTextarea1">Type Review</label>
              <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" v-model="reviews"></textarea>
            </div>
            <div class="five_star_container">
              <div class="container d-flex align-items-center justify-content-center">
                <div class="row justify-content-center">
                  <!-- star rating -->
                  <div class="rating-wrapper">
                    <!-- star 5 -->
                    <input type="radio" id="5-star-rating" name="star-rating" value="5"
                      @click.prevent="save_Review(5)" />
                    <label for="5-star-rating" class="star-rating">
                      <i class="fas fa-star d-inline-block"></i>
                    </label>

                    <!-- star 4 -->
                    <input type="radio" id="4-star-rating" name="star-rating" value="4"
                      @click.prevent="save_Review(4)" />
                    <label for="4-star-rating" class="star-rating star">
                      <i class="fas fa-star d-inline-block"></i>
                    </label>

                    <!-- star 3 -->
                    <input type="radio" id="3-star-rating" name="star-rating" value="3"
                      @click.prevent="save_Review(3)" />
                    <label for="3-star-rating" class="star-rating star">
                      <i class="fas fa-star d-inline-block"></i>
                    </label>

                    <!-- star 2 -->
                    <input type="radio" id="2-star-rating" name="star-rating" value="2"
                      @click.prevent="save_Review(2)" />
                    <label for="2-star-rating" class="star-rating star">
                      <i class="fas fa-star d-inline-block"></i>
                    </label>

                    <!-- star 1 -->
                    <input type="radio" id="1-star-rating" name="star-rating" value="1"
                      @click.prevent="save_Review(1)" />
                    <label for="1-star-rating" class="star-rating star">
                      <i class="fas fa-star d-inline-block"></i>
                    </label>
                  </div>
                </div>
               </div>
            </div>
          </div>
          <!-- =============================================Five Star Design End ========================-->

          <!-- =============================================Five Star Design After Submited ================-->
          <div class="five_star_container p-2"
            v-if="order.status_id == 4 && !$store.getters.isBuyerMode && order.is_rated == 1">
            <label for="exampleFormControlTextarea1">
              Thank you for the service
              <!-- {{order.review}} -->
              </label>
            <div class="ratings d-flex justify-content-center align-items-center">
              <div v-for="index in order.service_rating" :key="index">
                <i class="fa fa-star rating-color"></i>
              </div>
              <div v-for="indax in remainingRating" :key="indax">
                <i class="grey_star fa fa-star"></i>
              </div>
            </div>
          </div>
          <!-- =============================================Five Star Design After Submited ================-->

        </div>
      </div>
    </div>
  </div>
</template>

<script>
import { computed, onMounted, ref } from "@vue/runtime-core";
// import useOrder from "@/composables/useOrder";
import { useStore } from "vuex";
import { useRoute } from "vue-router";
import moment from "moment";

export default {
  components: {},
  props: {
    order: {
      type: Object,
      required: true,
    },
  },
  setup(props) {
    const store = useStore();
    const route = useRoute();
    const orderId = route.params.id;
    const showBtn = ref(true);
    const showDisputeBtn = ref(true);
    const remainingRating = ref('');
    const reviews = ref('');

    const payload = ref({
      order_id: orderId,
      accept: "ACCEPTED",
      description: "Accept extend days for this order",
    });

    const saveReview = ref({
      user_id: props.order.buyer_id,
      service_id: props.order.service_id,
      type: 10,
      description: "",
      rating: "",
      url: "buyer/manage_order",
      order_no: props.order.orderNo
    });
    remainingRating.value = 5 - props.order.service_rating;
    console.log(remainingRating.value);

    onMounted(() => {
      console.log("orderNo", props.order.orderNo);
      store.dispatch("timeline", props.order.orderNo || orderId);
    });

    const AcceptOrderCancelRequest = ref({
      order_no: orderId,
      type: null,
      url: "buyer/manage_order",
    });

    function disableButton(event) {
      event.target.innerText = "Loading...";
      event.target.disabled = true;
    }
    function sellerMode() {
      if (!store.getters.isBuyerMode) {
        AcceptOrderCancelRequest.value.url = "seller/manage_order";
      }
    }

    const acceptDispute = (event) => {
      disableButton(event);
      sellerMode();
      AcceptOrderCancelRequest.value.type = 9;
      store.dispatch("manageOrder", AcceptOrderCancelRequest.value);
      localStorage.setItem("showDisputeBtn", JSON.stringify(false));
    };

    const rejectDispute = (event) => {
      disableButton(event);
      sellerMode();
      AcceptOrderCancelRequest.value.type = 8;
      store.dispatch("manageOrder", AcceptOrderCancelRequest.value);
      localStorage.setItem("showDisputeBtn", JSON.stringify(false));
    };

    const extendTime = () => {
      store.dispatch("extendOrderRequest", payload.value);
      localStorage.setItem("showBtn", JSON.stringify(false));
    };

    const extendTimeReject = () => {
      payload.value.accept = "CANCELLED";
      store.dispatch("extendOrderRequest", payload.value);
      localStorage.setItem("showBtn", JSON.stringify(false));
    };

    function save_Review(rating) {
      saveReview.value.rating = rating;
      saveReview.value.description = reviews;
      console.log("Save Review: ", saveReview.value);
      store.dispatch("manageOrder", saveReview.value);
    }

    return {
      timeline: computed(() => store.getters.getTimeline),
      acceptDispute,
      rejectDispute,
      extendTime,
      extendTimeReject,
      payload,
      showBtn,
      showDisputeBtn,
      saveReview,
      save_Review,
      moment, reviews,
      remainingRating
    };
  },
};
</script>

<style scoped>
.card {
  box-shadow: 0 0.46875rem 2.1875rem rgba(4, 9, 20, 0.03),
    0 0.9375rem 1.40625rem rgba(4, 9, 20, 0.03),
    0 0.25rem 0.53125rem rgba(4, 9, 20, 0.05),
    0 0.125rem 0.1875rem rgba(4, 9, 20, 0.03);
  border-width: 0;
  transition: all 0.2s;
}

.card {
  position: relative;
  display: flex;
  flex-direction: column;
  min-width: 0;
  word-wrap: break-word;
  background-color: #fff;
  background-clip: border-box;
  border: 1px solid rgba(26, 54, 126, 0.125);
  border-radius: 0.25rem;
}

.card-body {
  flex: 1 1 auto;
  padding: 1.25rem;
}

.vertical-timeline {
  width: 100%;
  position: relative;
  padding: 1.5rem 0 1rem;
}

.vertical-timeline::before {
  content: "";
  position: absolute;
  top: 0;
  left: 67px;
  height: 100%;
  width: 4px;
  background: #e9ecef;
  border-radius: 0.25rem;
}

.vertical-timeline-element {
  position: relative;
  margin: 0 0 1rem;
}

.vertical-timeline--animate .vertical-timeline-element-icon.bounce-in {
  visibility: visible;
  animation: cd-bounce-1 0.8s;
}

.vertical-timeline-element-icon {
  position: absolute;
  top: 0;
  left: 60px;
}

.vertical-timeline-element-icon .badge-dot-xl {
  box-shadow: 0 0 0 5px #fff;
}

.badge-dot-xl {
  width: 18px;
  height: 18px;
  position: relative;
}

.badge:empty {
  display: none;
}

.badge-dot-xl::before {
  content: "";
  width: 10px;
  height: 10px;
  border-radius: 0.25rem;
  position: absolute;
  left: 50%;
  top: 50%;
  margin: -5px 0 0 -5px;
  background: #fff;
}

.vertical-timeline-element-content {
  position: relative;
  margin-left: 90px;
  font-size: 0.8rem;
}

.vertical-timeline-element-content .timeline-title {
  font-size: 0.8rem;
  text-transform: uppercase;
  margin: 0 0 0.5rem;
  padding: 2px 0 0;
  font-weight: bold;
}

.vertical-timeline-element-content .vertical-timeline-element-date {
  display: block;
  position: absolute;
  left: -90px;
  top: 0;
  padding-right: 10px;
  text-align: right;
  color: #adb5bd;
  font-size: 0.7619rem;
  white-space: nowrap;
}

.vertical-timeline-element-content:after {
  content: "";
  display: table;
  clear: both;
}

/* Rating Css */
.five_star_container {
  background-color: #edf0f9;
}

.rating-wrapper {
  align-self: center;
  border-radius: 5rem;
  display: inline-flex;
  direction: rtl !important;
  padding: 1.5rem 2.5rem;
  margin-left: auto;
}

.rating-wrapper label {
  color: #e1e6f6;
  cursor: pointer;
  display: inline-flex;
  font-size: 2rem;
  padding: 0rem 0.6rem;
  transition: color 0.5s;
}

.rating-wrapper svg {
  -webkit-text-fill-color: transparent;
  -webkit-filter: drop-shadow 4px 1px 6px #c6ceed;
  filter: drop-shadow(5px 1px 3px #c6ceed);
}

.rating-wrapper input {
  height: 100%;
  width: 100%;
}

.rating-wrapper input {
  display: none;
}

.rating-wrapper label:hover,
.rating-wrapper label:hover~label,
.rating-wrapper input:checked~label {
  color: #ffc100;
}


.ratings>.fa-star {
  margin: 5px;
}


.rating-color {
  color: #fbc634 !important;
  font-size: 2rem;
}

.grey_star {
  color: #CECECE;
  font-size: 2rem;
}
</style>