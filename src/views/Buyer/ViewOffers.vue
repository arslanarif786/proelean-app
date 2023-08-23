<template>
  <div class="container-xl">
    <div>
      <div class="d-flex justify-content-between">
        <div>
          <h3 class="app-page-title mb-0 mt-3">{{ $t('viewOffers.title') }}</h3>
        </div>
      </div>
    </div>
    <div class="border-bottom my-3"></div>
    <div
      v-if="$store.getters.getLoaderVal"
      class="d-flex justify-content-center s-margin"
    >
      <div class="spinner-border text-primary m-5" role="status">
        <span class="sr-only">{{ $t('loader.loading') }}</span>
      </div>
    </div>
    <div v-else class="mb-4">
      <div v-if="offers.length > 0">
        <div
          class="app-card app-card-notification shadow-sm mb-2 p-2"
          v-for="offer in offers"
          :key="offer.id"
        >
          <!-- WEB Screen -->
          <div class="d-none d-sm-block">
            <div
              class="app-card-header px-4 py-2 d-flex justify-content-between"
            >
              <div class="row g-3 align-items-center">
                <div
                  class="
                    pr-0
                    col-md-auto
                    text-center text-md-start
                    d-none d-sm-block
                  "
                >
                  <img
                    class="img-fluid rounded-circle mr-2"
                    style="width: 45px; height: 45px; object-fit: cover"
                    :src="`${imgURL}/${offer.profile.image}`"
                    alt=""
                  />
                </div>
                <!--//col-->
                <div class="col-md-auto text-md-start d-none d-sm-block">
                  <h4 class="notification-title mb-1">
                    {{ offer.profile.username }}
                  </h4>
                </div>
                <!--//col-->
              </div>
              <!--//row-->
              <div>
                <ul
                  class="notification-meta list-inline mb-0 d-none d-sm-block"
                >
                  <li class="list-inline-item">
                    <b> <i class="mdi mdi-clock"></i> {{ $t('viewOffers.s_duration') }} : </b>
                    {{ offer.delivery_time }}
                  </li>
                  <li class="list-inline-item">|</li>
                  <li class="list-inline-item">
                    <b><i class="mdi mdi-database"></i> {{ $t('viewOffers.s_budget') }} : </b>€{{
                      offer.price
                    }}
                  </li>
                </ul>
              </div>
            </div>
          </div>
          <!--//app-card-header-->

          <div class="d-none d-sm-block">
            <div class="row app-card-body text-justify px-4 py-2">
              <div class="col-lg-9 col-md-7">
                {{ offer.description }}
              </div>
              <div class="col-lg-3 col-md-5">
                <div class="d-flex justify-content-end">
                  <button
                    aria-hidden="true"
                    data-toggle="modal"
                    data-target="#placeorder"
                    class="btn btn-sm btn-danger"
                    :id="offer.id"
                    @click.prevent="handlePurchaseService(offer.id)"
                  >
                    {{ $t('viewOffers.placeOrder') }}
                  </button>
                  <router-link
                    :to="{ name: 'Chat', params: { id: offer.profile.id } }"
                    class="ml-2 btn btn-sm btn-light"
                  >
                    {{ $t('viewOffers.contactSeller') }}
                  </router-link>
                </div>
              </div>
            </div>
          </div>
          <!--//app-card-body-->
          <!-- WEB Screen END -->

          <!-- mobile Screen -->
          <div class="app-card-header px-4 py-2 d-sm-none">
            <div class="row g-3 align-items-center">
              <div class="pr-0 col-md-auto text-center text-md-start d-sm-none">
                <img
                  class="img-fluid rounded-circle"
                  style="width: 55px; height: 55px; object-fit: cover"
                  :src="`${imgURL}/${offer.profile.image}`"
                  alt=""
                />
                <h4 class="notification-title mb-1">
                  {{ offer.profile.username }}
                </h4>
              </div>
              <!--//col-->
              <!-- <div class="col-md-auto text-md-start d-sm-none"> -->

              <ul class="notification-meta list-inline mb-0 ml-3">
                <div class="d-flex flex-column">
                  <li class="list-inline-item d-sm-none">
                    <b> <i class="mdi mdi-clock"></i> {{ $t('viewOffers.s_duration') }} : </b>
                    {{ offer.delivery_time }}
                  </li>
                  <li class="list-inline-item d-sm-none">
                    <b><i class="mdi mdi-database"></i> {{ $t('viewOffers.s_budget') }} : </b>€{{
                      offer.price
                    }}
                  </li>
                </div>
              </ul>

              <!--//col-->
            </div>
            <!--//row-->
          </div>

          <div class="px-4 text-justify d-flex flex-column d-sm-none">
            <div class="notification-content d-flex align-items-center">
              <div class="d-sm-none pb-2">
                {{ offer.description }}
              </div>
            </div>
            <div class="pb-2">
              <button
                aria-hidden="true"
                data-toggle="modal"
                data-target="#placeorder"
                class="btn btn-sm btn-danger w-100"
                @click.prevent="handlePurchaseService(offer.id)"
              >
                {{ $t('viewOffers.placeOrder') }}
              </button>
              <router-link
                :to="{ name: 'Chat', params: { id: offer.profile.id } }"
                class="mt-2 btn btn-sm btn-light text-black w-100"
              >
                {{ $t('viewOffers.contactSeller') }}
              </router-link>
            </div>
          </div>
          <!-- Mobile Screen END -->

          <!--//app-card-footer-->
        </div>
        <PlaceOrder :offerId="selectedOfferId" />
      </div>
      <div v-else class="card shadow-none text-center py-5">
        <h3>{{ $t('viewOffers.noOffer') }}</h3>
      </div>
    </div>
  </div>
</template>


<script>
import PlaceOrder from "@/components/modals/PlaceOrder.vue";
import { computed, onMounted, ref } from "@vue/runtime-core";
import { useRoute } from "vue-router";
import { useStore } from "vuex";
export default {
  components: { PlaceOrder },
  setup() {
    const store = useStore();
    const route = useRoute();
    const id = route.params.id;
    const selectedOfferId = ref(null);

    onMounted(async () => {
      store.dispatch("viewOffers", id);
    });

    const handlePurchaseService = (offerID) => {
      selectedOfferId.value = offerID;
    }

    return {
      id,
      offers: computed(() => store.getters.getViewOffers),
      imgURL: process.env.VUE_APP_URL,
      handlePurchaseService,
      selectedOfferId
    };
  },
};
</script>

<style>
.s-margin {
  margin-bottom: 8rem;
  margin-top: 5rem;
}
</style>