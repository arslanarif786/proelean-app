<template>
   <h3 id="aboutSeller">{{ $t('service_detail.aboutTheSeller') }}</h3>
      <div class="user-profile-image d-flex">
         <label class="profile-pict" for="profile_image">
         <img
            :src="`${imgURL}/${service.service_user.image}`"
            class="profile-pict-img img-fluid object" alt="img">
         </label>
         <div class="right">
            <div class="profile-name">
               <span class="user-status">
               <a class="seller-link">{{service.service_user.username}}</a>
               </span>
               <div class="seller-level">{{service.s_description}} </div>
            </div>
            <div class="user-info">
               <span class="user-info-rating d-flex align-items-center">
                  <div class="star-rating-s15-wrapper">
                     <span class="rate-10">
                     <i class="fa fa-star" aria-hidden="true"   v-for="star in service.service_user.user_rating" :key="star" ></i>
                     </span>
                   
                  </div>
                  <span class="total-rating-out-five">{{service.service_user.user_rating}}</span>
                  <span class="total-rating">({{service.service_user.total_reviews}})</span>
               </span>
               <button :disabled="$store.getters.getAuthUser && $store.getters.getAuthUser.id==service.service_user.id" @click="$router.push(`/chat/${service.service_user.id}`)"  class="btn btn-success">
                  {{ $t('service_detail.contactMe') }}
               </button>
            </div>
         </div>
      </div>
      <div class="stats-desc">
         <ul class="user-stats">
            <li>{{ $t('service_detail.from') }}<strong> {{service.service_user.country}} </strong></li>
            <li>{{ $t('service_detail.memberSince') }}<strong>{{ moment.utc(service.service_user.created_at).fromNow() }}</strong></li>
         </ul>
         <article class="seller-desc">
            <div>{{ $t('service_detail.userDesc') }}</div>
            <div class="inner">{{service.service_user.description}}</div>
         </article>
      </div>
</template>

<script>
import { computed } from '@vue/runtime-core'
import moment from "moment";
import { useStore } from 'vuex'

export default {
   props: {
      service: {
         type: Object,
         required: true
      }
   },
   setup(){
      const store = useStore()
      return {
        user: computed(() => store.getters.getAuthUser),
        imgURL: process.env.VUE_APP_URL, moment
      }
   }
}
</script>

<style scoped>
.object{
   object-fit: cover;
}
</style>