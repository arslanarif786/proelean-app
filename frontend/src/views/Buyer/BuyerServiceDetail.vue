<template>
  <div class="main-page py-3">
    <div
      v-if="$store.getters.getServiceLoader === 'LOADING'"
      class="text-center spinnerInden vh-100"
    >
      <div class="spinner-border text-primary m-2" role="status">
        <span class="sr-only">{{ $t('loader.loading') }}...</span>
      </div>
    </div>
    <div v-else class="container">
      <div class="row">
        <div class="col-lg-8 left">
          <!-- <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active" aria-current="page">
                Library
              </li>
            </ol>
          </nav> -->
          <h2 class="h2-cutom-font pb-0 d-none d-sm-block">
            {{ service.s_description }}
          </h2>
          <h2 class="h2-cutom-font pb-0 d-sm-none">
            {{ service.s_description.substr(0, 18)
            }}{{ service.s_description.length > 18 ? ".." : "" }}
          </h2>
          <Gallery :serviceMedia="service.service_media" />
          <AboutService :service="service" />
          <div class="profile-card">
            <AboutSeller :service="service" />

            <h3 v-if="service.offered_services.length">
              {{ $t('service_detail.otherServicesIOffer') }}
            </h3>
            <div class="recommended d-flex flex-wrap justify-content-start">
              <Loader
                v-if="
                  $store.getters.getServiceLoader === 'LOADING' &&
                  service.offered_services.length
                "
              />

              <div
                class="col-md-4 mb-3 service-list-section"
                v-for="offeredService in service.offered_services"
                :key="offeredService.id"
                v-else
              >
                <Service :service="offeredService" />
              </div>
            </div>
          </div>
          <ReviewSection />
        </div>
        <ServiceCard />
        <TopPicSection />
      </div>
    </div>

    <!-- <PeopleViewProfile /> -->
  </div>
</template>

<script>
import { computed, onBeforeMount } from "@vue/runtime-core";
import { useRoute } from "vue-router";
import { useStore } from "vuex";
import Gallery from "@/components/serviceDetail/Gallery.vue";
import AboutService from "@/components/serviceDetail/AboutService.vue";
import AboutSeller from "@/components/serviceDetail/AboutSeller.vue";
import Service from "@/components/Service.vue";
import ReviewSection from "@/components/profile/SellerReviewsSection.vue";
import ServiceCard from "@/components/serviceDetail/ServiceCard.vue";
// import PeopleViewProfile from '@/components/serviceDetail/PeopleViewProfile.vue';
import TopPicSection from "@/components/home/TopPicSection.vue";

export default {
  name: "GigDetail",
  components: {
    Gallery,
    AboutService,
    AboutSeller,
    Service,
    ReviewSection,
    ServiceCard,
    //  PeopleViewProfile,
    TopPicSection,
  },
  setup() {
    const store = useStore();
    const route = useRoute();
    const payload = {
      id: route.params.id,
      type: "SERVICE_DETAIL",
    };
    onBeforeMount(store.dispatch("userSingleService", payload));

    return {
      service: computed(() => store.getters.getSingleService),
      // sellerOfferedServices: computed(() => store.getters.getSellerOfferedServices.filter(service => service.id!=route.params.id).slice(0,3))
    };
  },
};
</script>

<style>
</style>