<template>
   <h3 id="aboutSeller">About The Seller</h3>
      <div class="user-profile-image d-flex">
         <label class="profile-pict" for="profile_image">
         <img
            :src="`${imgURL}/${service.service_user.image}`"
            class="profile-pict-img img-fluid" alt="img">
         </label>
         <div class="right">
            <div class="profile-name">
               <span class="user-status">
               <a href="#" class="seller-link">{{service.service_user.username}}</a>
               </span>
               <div class="seller-level">{{service.s_description}} </div>
            </div>
            <div class="user-info">
               <span class="user-info-rating d-flex align-items-center">
                  <div class="star-rating-s15-wrapper">
                     <span class="star-rating-s15 rate-10">
                     <i class="fa fa-star" aria-hidden="true"></i>
                     <i class="fa fa-star" aria-hidden="true"></i>
                     <i class="fa fa-star" aria-hidden="true"></i>
                     <i class="fa fa-star" aria-hidden="true"></i>
                     <i class="fa fa-star" aria-hidden="true"></i>
                     </span>
                  </div>
                  <span class="total-rating-out-five">{{service.service_rating}}</span>
                  <span class="total-rating">({{service.total_reviews}})</span>
               </span>
               <a href="#">Contact Me</a>
            </div>
         </div>
      </div>
      <div class="stats-desc">
         <ul class="user-stats">
            <li>From<strong>India</strong></li>
            <li>Member since<strong>Sep 2018</strong></li>
            <li>Avg. Response Time<strong>1 hour</strong></li>
         </ul>
         <article class="seller-desc">
            <div class="inner">- Wireframes for mobile apps &amp; Website <br />
               - Flowcharts for the whole system <br />
               - Mobile app prototypes, interactive UI designs <br />
               - UI for social media postings <br />
               - Design an app to achieve a business objective (web or mobile). <br />
               - Design or re-design a website to grow revenue, close more sales and generate more leads.
               <br />
               - Optimize their existing website with a conversion rate audit and strategy. <br />
               - Design a high converting landing page. <br />
               <span>Excellent communication and availability.
               Reach me any time during our project on Whatsapp, Skype, Text or any other
               messenger.</span>
            </div>
         </article>
      </div>
</template>

<script>

export default {
   props: {
      service: {
         type: Object,
         required: true
      }
   },
   setup(){
      return {
        imgURL: process.env.VUE_APP_URL
      }
   }
}
</script>