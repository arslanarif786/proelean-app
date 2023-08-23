<template>
  <div class="container-xl">
    <h1 class="app-page-title">{{ $t('analytics.title') }}</h1>
    <div class="border-bottom my-3"></div>
    <div v-if="$store.getters.getLoadingStatus === 'LOADING'">
      <Loader />
    </div>
    <div>
      <AnalyticsCard />
      <Charts  v-if="$store.getters.getSellerAnalytics?.analytics" />
    </div>
  </div>
</template>

<script>
import Charts from "@/components/Seller/Dashboard/Charts.vue";
import AnalyticsCard from "@/components/Seller/Analytics/Analytics-Card.vue";
import { onBeforeMount } from '@vue/runtime-core';
import { useStore } from 'vuex';

export default {
  components: { AnalyticsCard, Charts },
  setup(){
    const store = useStore()
    onBeforeMount(() => {
       store.dispatch("sellerAnalytics");
    })
  }
};

</script>