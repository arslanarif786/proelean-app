<template>
  <h1 class="app-page-title">{{iban ? 'Withdraw Amount' : 'Add Bank Account'}}</h1>
  <hr class="mb-4" />
  <div v-if="loader" class="d-flex justify-content-center s-margin">
    <div class="spinner-border text-primary m-2" role="status">
      <span class="sr-only">Loading...</span>
    </div>
  </div>
  <div class="row g-4 settings-section" v-else>
    <div class="col-12 col-md-4">
      <h3 class="section-title">General</h3>
      <div class="section-intro">
        Lorem ipsum dolor sit amet consectetur, adipisicing elit. Iure maiores
        ea vel eveniet dolore aut harum molestias ipsum ratione recusandae!
      </div>
    </div>
    <div class="col-12 col-md-8">
      <div class="app-card app-card-settings shadow-sm p-4">
        <div class="app-card-body">
          <form class="settings-form" v-if="!iban">
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
                placeholder="Enter your account name"
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
                required=""
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
                placeholder="e.g: Meezan bank limitied"
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
              Save Changes
            </button>
          </form>

          <WithdrawRequest v-else :iban="iban" />
        </div>
        <!--//app-card-body-->
      </div>
      <!--//app-card-->
    </div>
  </div>
</template>

<script>
import WithdrawRequest from "@/components/WithdrawRequest.vue";
import { ref } from "@vue/reactivity";
import { computed, onBeforeMount, watch } from "@vue/runtime-core";
import { useStore } from "vuex";
import { useRouter } from "vue-router";

export default {
  components: {WithdrawRequest},
  setup() {
    const store = useStore();
    const router = useRouter();

    onBeforeMount(store.dispatch("getSellerWithdrawalAccount"));

    const payload = ref({
      iban: "",
      bank_title: "",
      bank_name: "",
    });

    const addBankAC = () => {
      store.dispatch("saveBankAccount", payload.value).then(() => {
        router.push("/payments");
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
        payloadErrorBag.value.iban = "please enter a valid iban";
      } else {
        payloadErrorBag.value.iban = "";
      }

      if (!value.bank_title) {
        payloadErrorBag.value.bank_title = "please enter a valid bank title";
      } else {
        payloadErrorBag.value.bank_title = "";
      }
      if (!value.bank_name) {
        payloadErrorBag.value.bank_name = "please enter a valid account name";
      } else {
        payloadErrorBag.value.bank_name = "";
      }
      if (value.iban.length < 16) {
        payloadErrorBag.value.iban = "Iban must be contain 16 digits";
      } else {
        payloadErrorBag.value.iban = "";
      }
    });

    return {
      payload,
      addBankAC,
      payloadErrorBag,
      disable: computed(() =>
        Object.values(payload.value).includes(null || "") ? true : false
      ),
      iban: computed(() => store.getters.getSellerBankAccount)
    };
  },
};
</script>