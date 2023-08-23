<template>
  <div class="py-3">
    <div class="container">
      <div class="mb-3">
        <div class="d-flex mb-2 align-items-center border-bottom">
          <h3>{{ $t('favouriteServices.favServices') }}</h3>
        </div>
      </div>
       <Loader v-if="$store.getters.getLoaderVal === 1" />
        <div v-else>
          <div v-if="favouriteServices.length" class="row g-4 recommended d-flex flex-wrap justify-content-start" >
          <div
            class="col-12 col-md-4 mb-3 col-xxl-3 service-list-section"
            v-for="favouriteService in favouriteServices"
            :key="favouriteService.id"
          >
            <div>
              <Service :service="favouriteService" />
            </div>
          </div>
          <div class="marginn">.</div>
        </div>
          <div class="text-center m-3 card p-5 shadow-none" v-else>
            <h3>{{ $t('favouriteServices.noServiceAvail') }}</h3>
          </div>
        </div>
      </div>
  </div>
</template>

<script>
import { computed, onMounted } from "@vue/runtime-core";
import { useStore } from "vuex";
import Loader from "@/components/loadingComponent.vue";
import Service from "@/components/Service.vue";

export default {
  components: { Loader, Service },
  setup() {
    const store = useStore();
    onMounted(() => {
      store.dispatch("allWishlistServices");
    });
    return {
      favouriteServices: computed(() => store.getters.getWishlistServices),
    };
  },
};
</script>

<style>
.marginn{
  margin-bottom: 45px;
}
</style>