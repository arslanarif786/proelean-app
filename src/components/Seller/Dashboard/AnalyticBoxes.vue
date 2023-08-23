<template>
  <div class="row g-4 mb-4" v-if="analytics">
    <div class="col-6 col-lg-3 my-2">
      <div class="app-card app-card-stat shadow-sm h-100">
        <div class="app-card-body p-3 p-lg-4">
          <h4 class="stats-type mb-1">{{ $t('dashboard.balance') }}</h4>
          <div class="stats-figure">€ {{analytics.current_balance}}</div>
        </div>
        <!--//app-card-body-->  
        <a class="app-card-link-mask" href="#"></a>
      </div>
      <!--//app-card-->
    </div>
    <!--//col-->
    <div class="col-6 col-lg-3 my-2">
      <div class="app-card app-card-stat shadow-sm h-100">
        <div class="app-card-body p-3 p-lg-4">
          <h4 class="stats-type mb-1">{{ $t('dashboard.activeOrders') }}</h4>
          <div class="stats-figure">{{analytics.active_orders}}</div>
        </div>
        <!--//app-card-body-->
        <a class="app-card-link-mask" href="#"></a>
      </div>
      <!--//app-card-->
    </div>
    <!--//col-->
    <div class="col-6 col-lg-3 my-2">
      <div class="app-card app-card-stat shadow-sm h-100">
        <div class="app-card-body p-3 p-lg-4">
          <h4 class="stats-type mb-1">{{ $t('dashboard.impressions') }}</h4>
          <div class="stats-figure">{{analytics.total_impressions}}</div>
          <!-- <div class="stats-meta text-success">
            <svg
              width="1em"
              height="1em"
              viewBox="0 0 16 16"
              class="bi bi-arrow-up"
              fill="currentColor"
              xmlns="http://www.w3.org/2000/svg"
            >
              <path
                fill-rule="evenodd"
                d="M8 15a.5.5 0 0 0 .5-.5V2.707l3.146 3.147a.5.5 0 0 0 .708-.708l-4-4a.5.5 0 0 0-.708 0l-4 4a.5.5 0 1 0 .708.708L7.5 2.707V14.5a.5.5 0 0 0 .5.5z"
              />
            </svg>
            20%
          </div> -->
        </div>
        <!--//app-card-body-->
        <a class="app-card-link-mask" href="#"></a>
      </div>
      <!--//app-card-->
    </div>
    <!--//col-->

    <div class="col-6 col-lg-3 my-2">
      <div class="app-card app-card-stat shadow-sm h-100">
        <div class="app-card-body p-3 p-lg-4">
          <h4 class="stats-type mb-1">{{ $t('dashboard.clicks') }}</h4>
          <div class="stats-figure"> {{analytics.total_clicks}}</div>
          <!-- <div class="stats-meta text-success">
            <svg
              width="1em"
              height="1em"
              viewBox="0 0 16 16"
              class="bi bi-arrow-down"
              fill="currentColor"
              xmlns="http://www.w3.org/2000/svg"
            >
              <path
                fill-rule="evenodd"
                d="M8 1a.5.5 0 0 1 .5.5v11.793l3.146-3.147a.5.5 0 0 1 .708.708l-4 4a.5.5 0 0 1-.708 0l-4-4a.5.5 0 0 1 .708-.708L7.5 13.293V1.5A.5.5 0 0 1 8 1z"
              />
            </svg>
            5%
          </div> -->
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
import { computed } from '@vue/runtime-core';
import { useStore } from 'vuex'
export default {
  setup() {
    const store= useStore();
    return{
      analytics: computed(() => store.getters.getSellerAnalytics),
    }
  }
};
</script>

<style>
</style>