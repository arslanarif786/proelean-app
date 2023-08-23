<template>
  <!---------------------    Modal (Send Offer)     --------------------->
  <div
    class="modal fade"
    id="sendOffer"
    tabindex="-1"
    role="dialog"
    aria-labelledby="sendOfferTitle"
    aria-hidden="true"
  >
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
            >
              {{ day }}
            </option>
          </select>
        </div>
        <div class="modal-footer d-flex justify-content-center">
          <button type="button" class="btn btn-success" data-dismiss="modal">

          </button>
          <button type="button" class="btn btn-secondary" data-dismiss="modal">
            Cancel
          </button>
        </div>
      </div>
    </div>
  </div>
  <!---------------------    Modal End     --------------------->
</template>

<script>
export default {
  props: {
    payload: {
      type: Object,
      required: true,
    },
  },
  // store.dispatch("getCountriesLanguage");
};
</script>
