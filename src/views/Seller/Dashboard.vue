<template>
  <div class="container-xl" v-if="orders">
    <h1 class="app-page-title">{{ $t('dashboard.dashboard') }}</h1>
    <!-- <CountDown /> -->
    <AppCard class="marginBottom" />

    <ActiveOrderCard v-if="orders.length > 0" class="margin" :orders="orders" />
    <div class="d-flex justify-content-center my-3" v-if="orderLength !== allOrders.length && orders.length > 0" >
      <button class="btn app-btn-secondary mb-3" @click="loadOrders" >{{ $t('loadMore') }}</button>
    </div>
    <AnalyticBoxes />
    <Charts v-if="analytics && analytics.analytics.length > 0" />
    <!-- <StatsSection /> -->
    <ActionCards />
  </div>
</template>

<script>
import AppCard from "../../components/Seller/Dashboard/AppCard.vue";
import AnalyticBoxes from "../../components/Seller/Dashboard/AnalyticBoxes.vue";
import Charts from "../../components/Seller/Dashboard/Charts.vue";
// import StatsSection from "../../components/Seller/Dashboard/StatsSection.vue";
import ActionCards from "../../components/Seller/Dashboard/ActionCards.vue";
import { useStore } from "vuex";
import { computed, onBeforeMount, ref } from "@vue/runtime-core";
import ActiveOrderCard from "../../components/Seller/Dashboard/ActiveOrderCard.vue";
//import ActiveOrderFilter from "../../components/Seller/Dashboard/ActiveOrderFilter.vue";
// import CountDown from "../../components/Seller/Dashboard/CountDown.vue";

export default {
  components: { AppCard, AnalyticBoxes, Charts, ActionCards, ActiveOrderCard },
  setup() {
    const store = useStore();
    const sellerOrderURL = "seller/orders?status=";
    const allOrders = ref( computed (() => store.getters.getMyOrders.filter(order => order.status_id === 1)))
    console.log("Active orders",allOrders.value)
    const orders = ref()
    const orderLength = ref(3)

    const loadOrders = () =>{
      if(orderLength.value+3 < allOrders.value.length){
        orderLength.value = orderLength.value+3
      }
      else{
        orderLength.value = allOrders.value.length
      }
      orders.value = allOrders.value.slice(0,orderLength.value)
    }

    onBeforeMount(() => {
      store.dispatch("sellerAnalytics");
      store.dispatch("myOrders", sellerOrderURL);
    });
    return {
      orders: computed(() => allOrders.value.slice(0,orderLength.value)),
      analytics: computed(() => store.getters.getSellerAnalytics),
      allOrders,
      orderLength,
      loadOrders
    };
  },
};
</script>

<style scoped>
</style>