<template>
  <div class="container-xl">
    <div class="d-flex justify-content-between">
      <h1 class="app-page-title mb-0">{{accountDetails ? 'Edit Bank Account' : 'Add Bank Account'}}</h1>
    </div>
  <hr class="mb-4" />
  <div v-if="loader" class="d-flex justify-content-center s-margin">
    <div class="spinner-border text-primary m-2" role="status">
      <span class="sr-only">Loading...</span>
    </div>
  </div>
  <div class="row g-4 settings-section" v-else>
    <div class="col-12 col-md-6">
      <h3 class="section-title">General</h3>
      <div class="section-intro">
        Lorem ipsum dolor sit amet consectetur, adipisicing elit. Iure maiores
        ea vel eveniet dolore aut harum molestias ipsum ratione recusandae!
      </div>
    </div>
    <div class="col-12 col-md-6">
      <div class="app-card app-card-settings shadow-sm p-4">
        <div class="app-card-body">
          <form class="settings-form">
            <div class="mb-3 text-center">
              <h5>{{accountDetails ? 'Update Bank Account' : 'Add Bank Account'}}</h5>
            </div>
            <div class="mb-3">
              <label for="setting-input-1" class="form-label"
                >Bank Name
                <span class="ml-2 text-danger">{{
                  payloadErrorBag.bank_name
                }}</span>
              </label>
              <input
                type="text"
                class="form-control"
                id="setting-input-1"
                placeholder="e.g: Meezan bank limited"
                v-model="payload.bank_name"
                required=""
              />
            </div>
            <div class="mb-3">
              <label for="setting-input-1" class="form-label"
                >IBAN
                <span class="ml-2 text-danger">{{ payloadErrorBag.iban }}</span>
              </label>
              <input
                type="text"
                class="form-control"
                id="setting-input-1"
                placeholder="12345678901234"
                v-model="payload.iban"
              />
            </div>

            <div class="form-group mb-3">
              <label for="setting-input-1" class="form-label"
                >Account Name
                <span class="ml-2 text-danger">{{
                  payloadErrorBag.bank_title
                }}</span>
              </label>
              <input
                type="text"
                class="form-control"
                id="setting-input-1"
                placeholder="Enter Bank account name"
                v-model="payload.bank_title"
                required=""
              />
            </div>
            <button
              type="submit"
              @click.prevent="addBankAC"
              :disabled="disable"
              class="btn app-btn-primary"
            >
              {{accountDetails ? 'Update Account' : 'Add Account'}}
            </button>
          </form>
        </div>
        <!--//app-card-body-->
      </div>
      <!--//app-card-->
    </div>
  </div>
  </div>
</template>

<script>
import { ref } from "@vue/reactivity";
import { computed, watch } from "@vue/runtime-core";
import { useStore } from "vuex";
import { useRouter } from "vue-router";

export default {
  setup() {
    const store = useStore();
    const router = useRouter();
    const accountDetails = ref(store.getters.getSellerBankAccount)

    const payload = ref({
      iban: accountDetails.value.iban,
      bank_title: accountDetails.value.bank_title,
      bank_name: accountDetails.value.bank_name,
    });


    const addBankAC = () => {
      store.dispatch("saveBankAccount", payload.value).then(() => {
        router.push("/dashboard/payments");
      });
    };



    const payloadErrorBag = ref({
      iban: "",
      bank_title: "",
      bank_name: "",
    });

    // validation
    watch(payload.value, (value) => {
      if (!value.iban) {
        payloadErrorBag.value.iban = "please enter a valid IBAN";
      } else if(value.iban.split("").length < 24){
        payloadErrorBag.value.iban = "IBAN can not be less than 24 characters";
      }  else if(value.iban.split("").length > 34){
        payloadErrorBag.value.iban = "IBAN can not be more than 34 characters";
      } else {
        payloadErrorBag.value.iban = "";
      }

      if (!value.bank_title) {
        payloadErrorBag.value.bank_title = "please enter a valid account title";
      } else {
        payloadErrorBag.value.bank_title = "";
      }

      if (!value.bank_name) {
        payloadErrorBag.value.bank_name = "please enter a valid bank name";
      } else {
        payloadErrorBag.value.bank_name = "";
      }
    });

    return {
      payload,
      addBankAC,
      payloadErrorBag,
      disable: computed(() =>
        Object.values(payload.value).includes(null || "") ? true : false
      ),
      accountDetails,
    };
  },
};
</script>