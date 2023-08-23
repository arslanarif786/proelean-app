<template>
  <!-- Confirmation Modal -->
  <div
    class="modal fade"
    id="exampleModalCenter"
    tabindex="-1"
    role="dialog"
    aria-labelledby="exampleModalCenterTitle"
    aria-hidden="true"
  >
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header d-flex justify-content-center">
          <h5 class="modal-title" id="exampleModalLongTitle">Custom Offer</h5>
        </div>
        <div class="modal-body text-center">
          <div class="text-left font">
            Choose a service<span class="text-danger">*</span>
            <span class="ml-2 text-danger">{{
              payloadErrorBag.serviceId
            }}</span>
          </div>
          <select
            id="deliveryTime"
            class="form-control mb-2"
            name="delivery_time"
            v-model="payload.serviceId"
            @change="handleSelectedService"
            required
          >
            <option value="0" selected>Select service</option>
            <option
              v-for="service in $store.getters.getUserServices"
              :value="service.id"
              :key="service.id"
            >
              {{ service.s_description }}
            </option>
          </select>
          <div class="text-left font">
            Describe your offer<span class="text-danger">*</span>
            <span class="ml-2 text-danger">{{
              payloadErrorBag.description
            }}</span>
          </div>

          <textarea
            type="text"
            class="form-control"
            name="description"
            v-model="payload.description"
            id="description"
            placeholder="Describe your offer"
            required
          />
          <div class="text-left font mt-2">
            Total Price<span class="text-danger">*</span>
            <span class="ml-2 text-danger">{{
              payloadErrorBag.totalOffer
            }}</span>
          </div>
          <input
            type="number"
            class="form-control"
            name="price"
            v-model="payload.totalOffer"
            id="price"
            placeholder="Total Offer(EUR)"
            required
          />
          <div class="text-left font mt-2">
            Delivery Time<span class="text-danger">*</span>
            <span class="ml-2 text-danger">{{
              payloadErrorBag.deliveryDays
            }}</span>
          </div>
          <select
            id="deliveryTime"
            class="form-control"
            name="delivery_time"
            v-model="payload.deliveryDays"
            required
          >
            <option selected value="" disabled>Select day</option>
            <option
              v-for="day in $store.getters.getDeliveryDays"
              :value="day"
              :key="day.index"
            >
              {{ day }}
            </option>
          </select>

          <div class="text-left font mt-2">Revisions<span class="text-danger">*</span>
            <span class="ml-2 text-danger">{{
              payloadErrorBag.revisions
            }}</span>

          </div>
          <select
            id="deliveryTime"
            class="form-control"
            name="delivery_time"
            v-model="payload.revisions"
            required
          >
            <option selected value="" disabled>Select revision</option>
            <option
              v-for="revision in $store.getters.getRevisions"
              :value="revision"
              :key="revision.index"
            >
              {{ revision }}
            </option>
          </select>
        </div>

        <div class="modal-footer d-flex justify-content-center">
          <button type="button" class="btn btn-secondary" id="cancel" data-dismiss="modal">
            Cancel
          </button>
          <button
            type="button"
            class="btn btn-success"
            data-dismiss="modal"
            @click.prevent="sendOffer"
            :disabled="disable"
          >
            Send
          </button>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import { ref } from "@vue/reactivity";
import { useStore } from "vuex";
import { computed, watch } from "@vue/runtime-core";
export default {
  setup() {
    const store = useStore();
    store.dispatch("userServices");
    store.dispatch("getCountriesLanguage");
    const payload = ref({
      deliveryDays: "",
      description: "",
      offerSenderId: "",
      revisions: "",
      serviceId: "",
      serviceTitle: "",
      status: 0,
      totalOffer: "",
    });

    const payloadErrorBag = ref({
      serviceId: null,
      deliveryDays: null,
      description: null,
      totalOffer: null,
      revisions: null
    });

    watch(payload.value, (value) => {
      if (!value.serviceId) {
        payloadErrorBag.value.serviceId = "Service is required";
      } else {
        payloadErrorBag.value.serviceId = null;
      }

      if (!value.deliveryDays) {
        payloadErrorBag.value.deliveryDays = "Delivery time is required";
      } else {
        payloadErrorBag.value.deliveryDays = null;
      }
      if (!value.revisions) {
        payloadErrorBag.value.revisions = "Revisions are required";
      } else {
        payloadErrorBag.value.revisions = null;
      }

      if (!value.description) {
        payloadErrorBag.value.description = "Description is required";
      } else if(value.description.length < 20){
        payloadErrorBag.value.description = "Minimum Description is 20 characters";
      } else {
        payloadErrorBag.value.description = null;
      }

      if (!value.totalOffer) {
        payloadErrorBag.value.totalOffer = "Price is required";
      } else if(value.totalOffer < 5){
        payloadErrorBag.value.totalOffer = "Minimum Price is €5";
      } else {
        payloadErrorBag.value.totalOffer = null;
      }
    });

    const handleSelectedService = () => {
      let selectedService = store.getters.getUserServices.find(
        (service) => service.id === payload.value.serviceId
      );
      payload.value.serviceId = selectedService.id;
      payload.value.serviceTitle = selectedService.s_description;
      payload.value.offerSenderId = selectedService.service_user.id;
    };
    const sendOffer = () => {
      store.dispatch("sendCustomOfferToBuyerOnChat", payload.value).then(() => {
        document.getElementById('cancel').click();
        resetFields();
      });
    };

    function resetFields() {
      payload.value.deliveryDays = "";
      payload.value.description = "";
      payload.value.offerSenderId = "";
      payload.value.revisions = "";
      payload.value.serviceId = "";
      payload.value.serviceTitle = "";
      payload.value.status = 0;
      payload.value.totalOffer = "";
    }

    return {
      payload,
      payloadErrorBag,
      sendOffer,
      handleSelectedService,
      disable: computed(() => Object.values(payload.value).includes(null || "") ? true : false),
    };
  },
};
</script>

<style>
</style>