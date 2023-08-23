<template>
  <div class="row g-4 mb-4" v-if="analytics">
    <div class="col-6 col-lg-4 mb-4">
      <div class="app-card app-card-stat shadow-sm h-100">
        <div class="app-card-body p-3 p-lg-4">
          <h4 class="stats-type mb-1">{{ $t('analytics.currentBalance') }}</h4>
          <div class="stats-figure">€{{ analytics.current_balance }}</div>
        </div>
        <!--//app-card-body-->
        <a class="app-card-link-mask" href="#"></a>
      </div>
      <!--//app-card-->
    </div>
    <!--//col-->
    <div class="col-6 col-lg-4 mb-4">
      <div class="app-card app-card-stat shadow-sm h-100">
        <div class="app-card-body p-3 p-lg-4">
          <h4 class="stats-type mb-1">{{ $t('analytics.earningThisWeek') }}</h4>
          <div class="stats-figure">€{{ analytics.weekly_earning }}</div>
        </div>
        <!--//app-card-body-->
        <a class="app-card-link-mask" href="#"></a>
      </div>
      <!--//app-card-->
    </div>
    <!--//col-->
    <div class="col-6 col-lg-4 mb-4">
      <div class="app-card app-card-stat shadow-sm h-100">
        <div class="app-card-body p-3 p-lg-4">
          <h4 class="stats-type mb-1">{{ $t('analytics.earningThisMonth') }}</h4>
          <div class="stats-figure">€{{ analytics.monthly_earning }}</div>
        </div>
        <!--//app-card-body-->
        <a class="app-card-link-mask" href="#"></a>
      </div>
      <!--//app-card-->
    </div>
    <!--//col-->
    <div class="col-6 col-lg-4 mb-4">
      <div class="app-card app-card-stat shadow-sm h-100">
        <div class="app-card-body p-3 p-lg-4">
          <h4 class="stats-type mb-1">{{ $t('analytics.activeOrders') }}</h4>
          <div class="stats-figure">{{ analytics.active_orders }}</div>
        </div>
        <!--//app-card-body-->
        <a class="app-card-link-mask" href="#"></a>
      </div>
      <!--//app-card-->
    </div>
    <!--//col-->
    <div class="col-6 col-lg-4 mb-4">
      <div class="app-card app-card-stat shadow-sm h-100">
        <div class="app-card-body p-3 p-lg-4">
          <h4 class="stats-type mb-1">{{ $t('analytics.earningThisYear') }}</h4>
          <div class="stats-figure">€{{ analytics.year_earning }}</div>
        </div>
        <!--//app-card-body-->
        <a class="app-card-link-mask" href="#"></a>
      </div>
      <!--//app-card-->
    </div>
    <!--//col-->
    <div class="col-6 col-lg-4 mb-4">
      <div class="app-card app-card-stat shadow-sm h-100">
        <div class="app-card-body p-3 p-lg-4">
          <h4 class="stats-type mb-1">{{ $t('analytics.totalEarning') }}</h4>
          <div class="stats-figure">
            €{{ analytics.total_earning }}
          </div>
        </div>
        <!--//app-card-body-->
        <a class="app-card-link-mask" href="#"></a>
      </div>
      <!--//app-card-->
    </div>
    <!--//col-->
  </div>

</template>

<script>
import { computed } from "@vue/runtime-core";
import { useStore } from "vuex";

export default {
  setup() {
    const store = useStore();
    return {
      analytics: computed(() => store.getters.getSellerAnalytics),
    };
  },
};
</script>

<style>
</style>