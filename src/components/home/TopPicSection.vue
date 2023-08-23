<template>
  <div class="container" v-if="$store.getters.getFeatGigs.length > 0">
    <h2>
      {{ $t('topPicksForYou') }}
      <!-- <a href="#"  class="float-right ">See More ></a> -->
    </h2>
    <div class="row freelance-slider">
      <div
        class="
          col-lg-3 col-md-4
          d-flex
          align-items-stretch
          justify-content-center
        "
        v-for="service in $store.getters.getFeatGigs"
        :key="service.id"
      >
        <div class="freelancer">
         
          <router-link
            
            :to="{ name: 'BuyerServiceDetail', params: { id: service.id } }"
          >
            <img
              class="img-fluid img-thumbnail gm-image"
              :src="
                `${imgURL}/${service.service_media[0].media}` ??
                '/assets/images/banner.png'"
            />
          </router-link>
          <div class="freelancer-footer">
            <img
              :src="`${imgURL}/${
                service.service_user.image
                  ? service.service_user.image
                  : '/assets/images/avator.png'
              }`"
              class="profile-pict-img img-fluid"
              alt="img"
            />
            <h5>
              {{ service.s_description }}
              <span
                >by <i>{{ service.service_user.username }}</i></span
              >
            </h5>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- New Slider -->
  <!-- <div class="owl-carousel owl-theme ">
            <div class="item">
                <div class="card  p-1   professional-services-cards ">
                    <img src="https://images.pexels.com/photos/11189614/pexels-photo-11189614.jpeg?auto=compress&cs=tinysrgb&dpr=2&h=650&w=940"  alt="">
                    <div class="card-body">
                        <h4 class="card-title">Logo Design</h4>
                        <p class="card-text text-muted">Build Your Brand</p>
                    </div>
                </div>
            </div>
        </div> -->
</template>

<script>
import { onMounted } from "@vue/runtime-core";

export default {
  setup() {
    // const imgURL = process.env.VUE_APP_URL

    onMounted(() => {
      window.$(".owl-carousel").owlCarousel({
        loop: true,
        margin: 10,
        nav: false,
        dots: false,
        autoplay: true,
        autoplayTimeout: 2000,
        stagePadding: 50,
        responsive: {
          0: {
            items: 1,
          },
          600: {
            items: 3,
          },

          1000: {
            items: 5,
          },
          1400: {
            items: 5,
          },
        },
      });
    });

    return {
      imgURL: process.env.VUE_APP_URL,
    };
  },
};
</script>

<style>
</style>