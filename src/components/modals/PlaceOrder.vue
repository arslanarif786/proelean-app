<template>
  <!---------------------     Modal    ---------------------->
  <div
    class="modal fade"
    id="placeorder"
    data-backdrop="static"
    data-keyboard="false"
    tabindex="-1"
    aria-labelledby="staticBackdropLabel"
    aria-hidden="true"
  >
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="staticBackdropLabel">{{ $t('purchaseService.title') }}</h5>
        </div>
        <div class="modal-body">
            <div class="row mb-2">
              <div class="col-12 mb-3">
                <div class="position-relative">
                  <label>
                    {{ $t('purchaseService.cardNumber') }} <span class="text-danger">*</span>
                    <span class="ml-2 text-danger">
                    {{ payloadErrorBag.number ? $t('errorMessages.'+ payloadErrorBag.number) : '' }}</span>
                  </label>
                  <input
                    type="number"
                    name="ATM_Number"
                    v-model="payload.number"
                    onkeypress="return this.value.length < 16;" 
                    oninput="if(this.value.length>=3) { this.value = this.value.slice(0,16); }"
                    id="ATM_Number"
                    class="form-control input-alignment"
                  />
                  <div class="position-absolute icons-top">
                    <svg style="width: 17px; height: 17px" viewBox="0 0 24 24">
                      <path
                        fill="currentColor"
                        d="M20 4H4A2 2 0 0 0 2 6V18A2 2 0 0 0 4 20H20A2 2 0 0 0 22 18V6A2 2 0 0 0 20 4M20 11H4V8H20Z"
                      />
                    </svg>
                  </div>
                </div>
              </div>
              <div class="col-12 mb-3">
                <div class="position-relative">
                  <label
                    > {{ $t('purchaseService.cvc') }} <span class="text-danger">*</span>
                    <span class="ml-2 text-danger">
                    {{ payloadErrorBag.cvc ? $t('errorMessages.'+ payloadErrorBag.cvc) : '' }}</span>
                  </label>
                  <input
                    type="number"
                    class="form-control input-alignment"
                    name="cvc"
                     v-model="payload.cvc"
                    id="cvc"
                    onkeypress="return this.value.length < 3;" 
                    oninput="if(this.value.length>=3) { this.value = this.value.slice(0,3); }"
                  />
                  <div class="position-absolute icons-top">
                    <svg
                      xmlns="http://www.w3.org/2000/svg"
                      width="16"
                      height="16"
                      fill="currentColor"
                      class="bi bi-credit-card-2-back"
                      viewBox="0 0 16 16"
                    >
                      <path
                        d="M11 5.5a.5.5 0 0 1 .5-.5h2a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-2a.5.5 0 0 1-.5-.5v-1z"
                      />
                      <path
                        d="M2 2a2 2 0 0 0-2 2v8a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V4a2 2 0 0 0-2-2H2zm13 2v5H1V4a1 1 0 0 1 1-1h12a1 1 0 0 1 1 1zm-1 9H2a1 1 0 0 1-1-1v-1h14v1a1 1 0 0 1-1 1z"
                      />
                    </svg>
                  </div>
                </div>
              </div>
              <div class="col-12 mb-3">
                <div class="position-relative">
                  <label>
                    {{ $t('purchaseService.cardExpMonth') }} <span class="text-danger">*</span>
                    <span class="ml-2 text-danger">{{ payloadErrorBag.exp_month ? $t('errorMessages.'+ payloadErrorBag.exp_month) : '' }}</span></label
                  >
                  <select
                    name="exp_month"
                    id="exp_month"
                    v-model="payload.exp_month"
                    class="form-control input-alignment"
                  >
                    <option value="" disabled>{{ $t('purchaseService.selectMonth') }}</option>
                    <option
                      :value="index + 1"
                      v-for="(month, index) in months"
                      :key="month"
                      :selected="
                        index + 1 == payload.exp_month"
                    >
                      {{ month.name }}
                    </option>
                  </select>
                  <div class="position-absolute icons-top">
                    <svg style="width: 17px; height: 17px" viewBox="0 0 24 24">
                      <path
                        fill="currentColor"
                        d="M9,10V12H7V10H9M13,10V12H11V10H13M17,10V12H15V10H17M19,3A2,2 0 0,1 21,5V19A2,2 0 0,1 19,21H5C3.89,21 3,20.1 3,19V5A2,2 0 0,1 5,3H6V1H8V3H16V1H18V3H19M19,19V8H5V19H19M9,14V16H7V14H9M13,14V16H11V14H13M17,14V16H15V14H17Z"
                      />
                    </svg>
                  </div>
                </div>
              </div>
              <div class="col-12 mb-3">
                <div class="position-relative">
                  <label
                    >{{ $t('purchaseService.cardExpYear') }} <span class="text-danger">*</span>
                    <span class="ml-2 text-danger">
                    {{ payloadErrorBag.exp_year ? $t('errorMessages.'+ payloadErrorBag.exp_year) : '' }}</span>
                  </label>
                  <select
                    name="expiryYear"
                    id="expiryYear"
                    v-model="payload.exp_year"
                    class="form-control input-alignment"
                  >
                    <option value="" disabled>{{ $t('purchaseService.selectYear') }}</option>
                    <option
                      :value="currentYear + loopYear - 1"
                      v-for="loopYear in 8"
                      :key="loopYear.index"
                      :selected="
                        currentYear + loopYear - 1 ==
                        payload.exp_year"
                    >
                      {{ currentYear + loopYear - 1 }}
                    </option>
                  </select>
                  <div class="position-absolute icons-top">
                    <svg style="width: 17px; height: 17px" viewBox="0 0 24 24">
                      <path
                        fill="currentColor"
                        d="M19,19H5V8H19M16,1V3H8V1H6V3H5C3.89,3 3,3.89 3,5V19A2,2 0 0,0 5,21H19A2,2 0 0,0 21,19V5C21,3.89 20.1,3 19,3H18V1M17,12H12V17H17V12Z"
                      />
                    </svg>
                  </div>
                </div>
              </div>
          </div>
        </div>

        <div class="modal-footer d-flex justify-content-center">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">
            {{ $t('bool.cancel') }}
          </button>
          <button
            type="button"
            class="btn btn-danger"
            data-dismiss="modal"
            @click="handleCustomerDetail($event, offerId)"
            :disabled="!Object.values(payloadErrorBag).every((value) => !value) || btnStatus == 2"
          >
            {{ btnStatus == 2 ? $t('loader.loading') : $t('bool.continue')  }}
          </button>
        </div>
      </div>
    </div>
  <!---------------------    Modal End     --------------------->
  </div>
</template>

<script>
import { computed, ref } from "@vue/reactivity";
import { useStore } from "vuex";
import { watch } from "@vue/runtime-core";
export default {
  props: {
    offerId: {
      required: true,
      type: String,
    },
  },
  setup() {
    const store = useStore();
    const currentDate = new Date();
    const currentMonth = currentDate.getMonth()+1
    const currentYear = currentDate.getFullYear();
    const loopYear = ref(0);
    const months = ref([
      { name: "01" },
      { name: "02" },
      { name: "03" },
      { name: "04" },
      { name: "05" },
      { name: "06" },
      { name: "07" },
      { name: "08" },
      { name: "09" },
      { name: "10" },
      { name: "11" },
      { name: "12" },
    ]);

    const payload = ref({
      number: 4242424242424242,
      exp_month: 12,
      exp_year: 2027,
      cvc: 123,
    });

    const payloadErrorBag = ref({
      number: "",
      exp_month: "",
      exp_year: "",
      cvc: "",
    });

    watch(payload.value, (value) => {
      if (!value.number) {
        payloadErrorBag.value.number = "please enter a valid card number";
      } else if (value.number.toString().length < 16) {
        payloadErrorBag.value.number = "card number must contain 16 digits";
      } else {
        payloadErrorBag.value.number = "";
      }

      if (!value.exp_month) {
        payloadErrorBag.value.exp_month = "please enter a valid expiry month";
      } else {
        payloadErrorBag.value.exp_month = "";
      }

      if (!value.exp_year) {
        payloadErrorBag.value.exp_year = "please enter a valid expiry year";
      } else if (value.exp_month < currentMonth && value.exp_year <= currentYear ) {
        payloadErrorBag.value.exp_month = "please enter a valid expiry month";
      } else {
        payloadErrorBag.value.exp_year = "";
      }

      if (!value.cvc || value.cvc.toString().length < 3) {
        payloadErrorBag.value.cvc = "please enter a valid cvc";
      } else {
        payloadErrorBag.value.cvc = "";
      }
    });

    const handleCustomerDetail = (e, offerID) => {
      e.preventDefault();
      store
        .dispatch("purchaseJobOfferedService", [payload.value, offerID]);
    };
    return {
      loopYear,
      currentYear,
      months,
      payload,
      payloadErrorBag,
      handleCustomerDetail,
      btnStatus: computed(() => store.getters.getRegisterStatus),
    };
  },
};
</script>

<style scoped>
.app-page-title {
  font-size: 1.5rem !important;
}

.icons-top {
  top: 33px;
  margin-left: 5px;
}

.input-alignment {
  padding-left: 25px;
}
</style>
