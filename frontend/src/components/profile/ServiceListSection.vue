<template>

     <div class="gig-img-outer">
    <router-link :to="{name:'GigDetail', params:{id:service.id}}" >
        <img
          class="img-full"
          :src="(service.service_media.length && service.service_media[0].media) ? `${imgURL}/${service.service_media[0].media}` : `/assets/images/sample-gig.png`" />
    </router-link>
    </div>
      <div class="inner-slider">
        <div class="inner-wrapper d-flex flex-column align-content-between">
          <div class="d-flex align-items-center">
            <span class="seller-image">
              <img
                class="img-fluid"
                :src="`${imgURL}/${service.service_user.image}`"
                alt="img"
              />
            </span>
            <span class="seller-name">
              <p>{{ service.service_user.username }}</p>
              <span class="level hint--top level-one-seller">
                Level 1 Seller
              </span>
            </span>
          </div>
          <h3>
            <!-- {{ service.s_description.substr(0, 25) }} -->
            {{service.s_description.substr(0, 25)}} {{service.s_description.length > 25 ? '...' : ''}}
          </h3>
          <div class="content-info">
            <div class="rating-wrapper">
              <span class="gig-rating text-body-2">
                <svg
                  xmlns="http://www.w3.org/2000/svg"
                  viewBox="0 0 1792 1792"
                  width="15"
                  height="15"
                >
                  <path
                    fill="currentColor"
                    d="M1728 647q0 22-26 48l-363 354 86 500q1 7 1 20 0 21-10.5 35.5t-30.5 14.5q-19 0-40-12l-449-236-449 236q-22 12-40 12-21 0-31.5-14.5t-10.5-35.5q0-6 2-20l86-500-364-354q-25-27-25-48 0-37 56-46l502-73 225-455q19-41 49-41t49 41l225 455 502 73q56 9 56 46z"
                  ></path>
                </svg>
                {{ service.service_rating }}
                <span>({{ service.total_reviews }})</span>
              </span>
            </div>
          </div>
          <div class="footer">
              <i  class="fa fa-spinner fa-spin" v-if="loader"></i>
              <i @click="wishlistAction(service.id)" class="fa fa-heart cursor-pointer" :class="{ redIcon : service.favourite}"   aria-hidden="true"></i>
            <div class="price">
              <a href="#">
                Starting At <span> ${{ service.price }}</span>
              </a>
            </div>
          </div>
        </div>
      </div>
      
    
</template>

<script>
import { computed } from "vue";
import { useStore } from "vuex";

export default {
  
    props :{
      services:{
        type: Array,
        required: true
      }
    },
  setup() {
    const store = useStore()
    return {
      imgURL: process.env.VUE_APP_URL,
      loader: computed (() => store.getters.getRegisterStatus)
    };
  },
};
</script>

<style scoped>
.service-list-section{
  padding-right: 5px !important;
  padding-left: 10px !important;
}
.redIcon{
  color: red !important;
}
</style>
