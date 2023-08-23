<template>
  <div class="container-xl">
    <div class="row d-flex justify-content-between">
      <div class="col-md-3 col-12">
        <h1 class="app-page-title mb-1" data-v-d1f2b3da="">{{ $t("payments.title") }}</h1>
      </div>
      <div class="col-md-4 col-8">
        <input
          type="text"
          id="search-orders"
          name="searchorders"
          class="form-control search-orders"
          :placeholder="$t('payments.search')"
        />
      </div>
      <!-- <div class="col-md-2 col-4">
        <select class="form-select" data-v-d1f2b3da="">
          <option selected="" value="option-1" data-v-d1f2b3da="">{{ $t("payments.all") }}</option>
          <option value="option-2" data-v-d1f2b3da="">{{ $t("payments.thisWeek") }}</option>
          <option value="option-3" data-v-d1f2b3da="">{{ $t("payments.thisMonth") }}</option>
          <option value="option-4" data-v-d1f2b3da="">{{ $t("payments.last3Months") }}</option>
        </select>
      </div> -->
      <div class="col-md-3 col-12 text-right">
        <!-- <router-link to="/dashboard/bank-attachment" class="btn app-btn-secondary my-2 m-md-0">
          <i class="mdi mdi-bank"></i>
          {{ $store.getters.getAuthUser.payments_enabled ? "Withdraw" : "Add Bank Account" }}</router-link> -->
          
           <!-- Button trigger modal -->
          <button class="btn app-btn-secondary mb-md-2 m-md-0" @click="paymentMethod" 
          :disabled="addBankRequestLoading">
          <i :class="!addBankRequestLoading ? 'mdi mdi-bank' : 'fa fa-refresh fa-spin'" ></i>
           {{ $store.getters.getAuthUser.payments_enabled ? $t("payments.updateBankAccount") : $t("payments.addBankAccount") }}
           </button>

          <button
          :disabled="$store.getters.getAuthUser.payments_enabled==false"
           class="btn app-btn-secondary m-md-0" data-bs-toggle="modal"
           data-bs-target="#exampleModalCenterSmall">
              <i class="mdi mdi-bank" ></i>
               {{ $t("payments.withdraw") }}
          </button>
        

      </div>
    </div>
    <div class="border-bottom my-3"></div>
    <!--//row-->
    <div class="tab-content" id="orders-table-tab-content">
      <div
        class="tab-pane fade show active"
        id="orders-all"
        role="tabpanel"
        aria-labelledby="orders-all-tab"
      >
        <div v-if="loader" class="d-flex justify-content-center s-margin">
          <div class="spinner-border text-primary m-2" role="status">
            <span class="sr-only">{{ $t("loader.loading") }}</span>
          </div>
        </div>
        <div class="app-card app-card-orders-table shadow-sm mb-5" v-else>
          <div class="app-card-body">
            <div class="table-responsive">
              <table class="table app-table-hover mb-0 text-left">
                <thead>
                  <tr>
                    <th class="cell">{{ $t("payments.name") }}</th>
                    <th class="cell">{{ $t("payments.date") }}</th>
                    <th class="cell text-center">{{ $t("payments.status") }}</th>
                    <th class="cell">{{ $t("payments.total") }}</th>
                    <!-- <th class="cell"></th> -->
                  </tr>
                </thead>
                <tbody>
                  <tr
                    v-for="(withdraw,index) in $store.getters.getWithdrawRequest"
                    :key="index"
                  >
                    <td class="cell">
                      {{ $store.getters.getAuthUser.username }}
                    </td>
                    <td class="cell">
                      <span>{{ withdraw.created_at }}</span
                      ><span class="note">2:16 PM</span>
                    </td>
                    <td class="cell text-center">
                      <span :class="{'badge bg-warning': withdraw.status==='PENDING'}">{{
                        withdraw.status
                      }}</span>
                    </td>
                    <td class="cell">€{{ withdraw.amount }}</td>
                    <!-- <td class="cell">
                      <a class="btn-sm app-btn-secondary" href="#">View</a>
                    </td> -->
                  </tr>
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

   <!-----------------------   Modal  ---------------------->
             <div
                      v-if="$store.getters.getAuthUser.payments_enabled ==true"
                      class="modal fade"
                      id="exampleModalCenterSmall"
                      tabindex="-1"
                      role="dialog"
                      aria-labelledby="exampleModalCenterSmall"
                      aria-hidden="true"
                    >
                      <div
                        class="modal-dialog modal-dialog-centered"
                        role="document"
                      >
                        <div class="modal-content">
                          <div
                            class="modal-header d-flex justify-content-center"
                          >
                            <h5 class="modal-title" id="exampleModalLongTitle">
                              {{ $t("payments.withdraw") }}
                            </h5>
                          </div>
                          <div class="modal-body text-center">
                            <!-- Are you sure you want to withdraw the cash? -->
                            {{ $t("payments.Are you sure you want to withdraw the cash") }}?
                          </div>
                          <div
                            class="modal-footer d-flex justify-content-center"
                          >
                            <button
                              type="button"
                              class="btn btn-secondary"
                              data-bs-dismiss="modal"
                            >
                            {{ $t("bool.no") }}
                              <!-- No -->
                            </button>
                            <button
                              type="button"
                              class="btn btn-danger"
                              data-bs-dismiss="modal"
                              @click="paymentMethod"
                              :disabled="addBankRequestLoading"
                            >
                            {{ $t("bool.yes") }}
                              <!-- Yes -->
                            </button>
                          </div>
                        </div>
                      </div>
                    </div>
              <!------------------------   MOdal End   ------------------------>
</template>

<script>
import { computed, onMounted } from "@vue/runtime-core";
// import { useRouter } from "vue-router";
import { useStore } from "vuex";
export default {
  setup() {
    const store = useStore();
    onMounted(store.dispatch("getWithdrawRequest"));

    const paymentMethod = () => {
      const isPaymentEnabled = store.getters.getAuthUser.payments_enabled;
      if(isPaymentEnabled) {
        store.dispatch("withdrawCashRequest");
        // const router = useRouter();
        // router.push("/withdraw");        
      } else {
        store.dispatch("connectStripeAccount");
      }
    }

    return {
      paymentMethod,
      loader: computed(() =>
        store.getters.getPaymentLoadingStatus === "LOADING" ? true : false
      ),
      addBankRequestLoading: computed(() => store.getters.stripeConnectStatus)
      
    };
  },
};
</script>

<style scoped>
.s-margin {
  margin-bottom: 8rem;
  margin-top: 5rem;
}
.form-control {
  padding: 18px 10px !important;
}
</style>