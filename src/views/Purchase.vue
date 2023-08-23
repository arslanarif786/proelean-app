<template>
  <div class="main-page py-2">
    <div class="container-xl">
      <div>
        <h1 class="app-page-title">{{ $t('paymentDetails.confirmOrder&Pay') }}</h1>
      </div>
      <div class="border-bottom my-2"></div>
      <div class="row">
        <div class="col-md-7 col-lg-8">
          <div class="card p-4 shadow-none border">
            <div class="d-flex justify-content-between align-items-center">
              <div>
                <h6 class="text-uppercase mb-0">{{ $t('paymentDetails.title') }}</h6>
              </div>
              <div class="icons">
                <img src="https://i.imgur.com/2ISgYja.png" width="30" />
                <img src="https://i.imgur.com/W1vtnOV.png" width="30" />
                <img src="https://i.imgur.com/35tC99g.png" width="30" />
                <img src="https://i.imgur.com/2ISgYja.png" width="30" />
              </div>
            </div>

            <div class="border-bottom my-2"></div>
            <div class="row mb-2">
              <div class="col-md-6">
                <div class="position-relative">
                  <label>
                    {{ $t('paymentDetails.cardNumber') }} <span class="text-danger">*</span>
                    <span
                      class="text-danger ml-1"
                      v-show="descriptionErrors.number"
                    >
                      {{ descriptionErrors.number ? $t('errorMessages.'+ descriptionErrors.number) : '' }}
                    </span>
                  </label>
                  <input
                    type="number"
                    name="ATM_Number"
                    v-model="formData.paymentElements.number"
                    onkeypress="return this.value.length < 16;"
                    oninput="if(this.value.length>=3) { this.value = this.value.slice(0,16); }"
                    id="ATM_Number"
                    class="form-control input-alignment"
                  />
                  <div class="position-absolute icons-top">
                    <svg style="width: 22px; height: 22px" viewBox="0 0 24 24">
                      <path
                        fill="currentColor"
                        d="M20 4H4A2 2 0 0 0 2 6V18A2 2 0 0 0 4 20H20A2 2 0 0 0 22 18V6A2 2 0 0 0 20 4M20 11H4V8H20Z"
                      />
                    </svg>
                  </div>
                </div>
              </div>
              <div class="col-md-6">
                <div class="position-relative">
                  <label
                    >{{ $t('paymentDetails.cvc') }}<span class="text-danger">*</span>
                    <span
                      class="text-danger ml-1"
                      v-show="descriptionErrors.cvc"
                    >
                      {{ descriptionErrors.cvc ? $t('errorMessages.'+ descriptionErrors.cvc) : '' }}
                    </span>
                  </label>
                  <input
                    type="number"
                    class="form-control input-alignment"
                    name="cvc"
                    v-model="formData.paymentElements.cvc"
                    id="cvc"
                    onkeypress="return this.value.length < 3;"
                    oninput="if(this.value.length>=3) { this.value = this.value.slice(0,3); }"
                  />
                  <div class="position-absolute icons-top">
                    <svg
                      xmlns="http://www.w3.org/2000/svg"
                      width="22px"
                      height="22px"
                      fill="currentColor"
                      class="bi bi-lock"
                      viewBox="0 0 16 16"
                    >
                      <path
                        d="M8 1a2 2 0 0 1 2 2v4H6V3a2 2 0 0 1 2-2zm3 6V3a3 3 0 0 0-6 0v4a2 2 0 0 0-2 2v5a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V9a2 2 0 0 0-2-2zM5 8h6a1 1 0 0 1 1 1v5a1 1 0 0 1-1 1H5a1 1 0 0 1-1-1V9a1 1 0 0 1 1-1z"
                      />
                    </svg>
                  </div>
                </div>
              </div>
            </div>
            <div class="row mb-2">
              <div class="col-md-6">
                <div class="position-relative">
                  <label>
                    {{ $t('paymentDetails.cardExpMonth') }} <span class="text-danger">*</span>
                    <span
                      class="text-danger ml-1"
                      v-show="descriptionErrors.exp_month"
                    >
                      {{ descriptionErrors.exp_month ? $t('errorMessages.'+ descriptionErrors.exp_month) : '' }}
                    </span></label
                  >
                  <select
                    name="exp_month"
                    id="exp_month"
                    v-model="formData.paymentElements.exp_month"
                    class="form-control input-alignment"
                  >
                    <option value="" disabled>{{ $t('paymentDetails.selectMonth') }}</option>
                    <option
                      :value="index + 1"
                      v-for="(month, index) in months"
                      :key="month"
                      :selected="
                        index + 1 == formData.paymentElements.exp_month
                      "
                    >
                      {{ month.name }}
                    </option>
                  </select>
                  <div class="position-absolute icons-top">
                    <svg style="width: 22px; height: 22px" viewBox="0 0 24 24">
                      <path
                        fill="currentColor"
                        d="M9,10V12H7V10H9M13,10V12H11V10H13M17,10V12H15V10H17M19,3A2,2 0 0,1 21,5V19A2,2 0 0,1 19,21H5C3.89,21 3,20.1 3,19V5A2,2 0 0,1 5,3H6V1H8V3H16V1H18V3H19M19,19V8H5V19H19M9,14V16H7V14H9M13,14V16H11V14H13M17,14V16H15V14H17Z"
                      />
                    </svg>
                  </div>
                </div>
              </div>
              <div class="col-md-6">
                <div class="position-relative">
                  <label
                    >{{ $t('paymentDetails.cardExpYear') }} <span class="text-danger">*</span>
                    <span
                      class="text-danger ml-1"
                      v-show="descriptionErrors.exp_year"
                    >
                      {{ descriptionErrors.exp_year ? $t('errorMessages.'+ descriptionErrors.exp_year) : '' }}
                    </span>
                  </label>
                  <select
                    name="expiryYear"
                    id="expiryYear"
                    v-model="formData.paymentElements.exp_year"
                    class="form-control input-alignment"
                  >
                    <option value="" disabled>{{ $t('paymentDetails.selectYear') }}</option>
                    <option
                      :value="currentYear + loopYear - 1"
                      v-for="loopYear in 8"
                      :key="loopYear.index"
                      :selected="
                        currentYear + loopYear - 1 ==
                        formData.paymentElements.exp_year
                      "
                    >
                      {{ currentYear + loopYear - 1 }}
                    </option>
                  </select>
                  <div class="position-absolute icons-top">
                    <svg style="width: 22px; height: 22px" viewBox="0 0 24 24">
                      <path
                        fill="currentColor"
                        d="M19,19H5V8H19M16,1V3H8V1H6V3H5C3.89,3 3,3.89 3,5V19A2,2 0 0,0 5,21H19A2,2 0 0,0 21,19V5C21,3.89 20.1,3 19,3H18V1M17,12H12V17H17V12Z"
                      />
                    </svg>
                  </div>
                </div>
              </div>
            </div>
            <div class="border-bottom my-2"></div>
            <div class="row mb-3">
              <div class="col-md-12">
                <label for=""
                  > {{ $t('paymentDetails.desc') }} <span class="text-danger">*</span>
                  <span
                    class="text-danger ml-1"
                    v-show="descriptionErrors.description"
                  >
                    {{ descriptionErrors.description ? $t('errorMessages.'+ descriptionErrors.description) : '' }}
                  </span>
                </label>
                <textarea
                  type="text"
                  class="form-control"
                  name="description"
                  rows="3"
                  v-model="formData.descriptionData.description"
                  id="description"
                  :placeholder="$t('paymentDetails.typeDesc')"
                  required="required"
                />
              </div>
            </div>
            <div class="">
              <button
                class="btn btn-primary px-3 w-100"
                :disabled="
                  !Object.values(descriptionErrors).every((value) => !value) ||
                  registerStatus == 2
                "
                @click="purchaseService()"
              >
              {{ registerStatus == 2 ? $t('loader.loading') : $t('paymentDetails.payBtn') }}
              </button>
            </div>
          </div>
        </div>

        <div class="col-md-5 col-lg-4 right">
          <PackageDetail />
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import PackageDetail from "@/views/Buyer/PackageDetail.vue";
import useOrder from "@/composables/useOrder.js";
//import ServiceCard from "@/components/serviceDetail/ServiceCard.vue";
import { computed, onBeforeMount, ref } from "vue";
import { useStore } from "vuex";

export default {
  components: {
    PackageDetail,
    // ServiceCard
  },
  setup() {
    const store = useStore();
    const currentYear = ref(new Date().getFullYear());
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
    const { formData, descriptionRegex, descriptionErrors, payload } =
      useOrder();

    onBeforeMount(store.dispatch("userSingleService", payload));

    function purchaseService() {
      console.log("formdata values: ", formData.value);
      if (!formData.value.descriptionData.description) {
        descriptionErrors.value.description = "Description is required";
      } else {
        store.dispatch("purchaseService", formData.value);
      }
    }

    return {
      registerStatus: computed(() => store.getters.getRegisterStatus),
      formData,
      currentYear,
      loopYear,
      months,
      purchaseService,
      descriptionRegex,
      descriptionErrors,
      payload,
    };
  },
};
</script>

<style scoped>
.container-xl {
  margin-top: 50px;
  margin-bottom: 50px;
}
.form-control {
  height: 50px;
  border: 2px solid #eee;
  border-radius: 6px;
  font-size: 14px;
  font-family: sans-serif;
}
.form-control:focus {
  color: #495057;
  background-color: #fff;
  border-color: #039be5;
  outline: 0;
  box-shadow: none;
}

.form-control {
  display: block;
  width: 100%;
  min-height: calc(1.5em + 0.75rem + 2px);
  padding: 0.375rem 0.75rem;
  font-size: 1rem;
  font-weight: 400;
  line-height: 1.5;
  color: #495057;
  background-color: #fff;
  background-clip: padding-box;
  border: 1px solid #ced4da;
  -webkit-appearance: none;
  -moz-appearance: none;
  appearance: none;
  border-radius: 0.25rem;
  transition: border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out;
}

.btn-primary {
  color: #fff;
  background-color: #0d6efd;
  border-color: #0d6efd;
  height: 52px;
  font-size: 15px;
  border-radius: 8px;
}
.btn-primary:hover {
  color: #fff;
  background-color: #025ce2;
  border-color: #0257d5;
}
label {
  font-size: 13px;
  font-weight: 400;
  font-family: "Inter";
}
.main-page {
  background: #f5eee7;
}
.app-page-title {
  font-size: 1.5rem !important;
}

.icons-top {
  top: 40px;
  margin-left: 5px;
  color: #989898;
}

.input-alignment {
  padding-left: 28px;
}
</style>
