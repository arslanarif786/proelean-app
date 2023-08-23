<template>
  <form class="settings-form">
    <div class="mb-3">
      <label for="setting-input-1" class="form-label">Bank Name </label>
      <p>{{ iban.bank_name }}</p>
    </div>
    <div class="mb-3">
      <label for="setting-input-1" class="form-label">IBAN </label>
      <p>{{ iban.iban }}</p>
    </div>

    <div class="form-group mb-3">
      <label for="setting-input-1" class="form-label">Account Name </label>
      <p>{{ iban.bank_title }}</p>
    </div>
    <div class="form-group mb-3">
      <label for="setting-input-1" class="form-label">Amount </label>
      <input
        type="number"
        class="form-control"
        id="setting-input-1"
        placeholder="Enter your account name"
        v-model="payload.amount"
        required=""
      />
    </div>
    <button
      type="submit"
      @click.prevent="withdrawAmount"
      :disabled="disable"
      class="btn app-btn-primary"
    >
      Withdraw
    </button>
  </form>
</template>

<script>
import { ref } from "@vue/reactivity";
import { computed } from "@vue/runtime-core";
import { useStore } from "vuex";
import { useRouter } from "vue-router";

export default {
  props: {
    iban: {
      required: true,
      type: Object,
    },
  },
  setup() {
    const store = useStore();
    const router = useRouter();

    const payload = ref({
      amount: 0,
    });

    const withdrawAmount = () => {
      store.dispatch("withdrawCashRequest", payload.value).then((res) => {
        if (res.status === 200) {
          router.push("/dashboard/payments");
        }
      });
    };

    return {
      payload,
      withdrawAmount,
      disable: computed(() =>
        Object.values(payload.value).includes("" || null || 0) ||
        store.getters.getPreWithdrawRequest === "LOADING"
          ? true
          : false
      ),
    };
  },
};
</script>
