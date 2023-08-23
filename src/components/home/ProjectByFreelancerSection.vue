<template>
   <div class="freelance-projects pt-2 pb-5">
      <div class="container">
         <h2>
            Top Pics For You
            <a href="#" class="float-right">See More ></a>
         </h2>
         <div class="row freelance-slider" v-if="$store.getters.getFeatGigs.length > 0">
            <div class="col" v-for="gig in $store.getters.getFeatGigs" :key="gig.id">
               <div class="freelancer">
                  <img :src="getImgUrl(gig.service_media[0].media)">
                  <div class="freelancer-footer">
                     <img src="assets/images/user/s1.png">
                     <h5>{{ gig.s_description }}
                        <span>by <i>{{ gig.service_user.username }}</i></span>
                     </h5>
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
         
      </div>
   </div>
</template>

<script>
import { onMounted } from '@vue/runtime-core'


export default {
   setup()
   {
      // const imgURL = process.env.VUE_APP_URL

       onMounted(() => {
         window.$ ('.owl-carousel').owlCarousel({
            loop: true,
            margin: 10,
            nav: false,
            dots: false,
            autoplay:true,
            autoplayTimeout:2000,
            stagePadding:50,
            responsive: {
                0: {
                    items: 1
                },
                600: {
                    items: 3
                },

                1000: {
                    items: 5
                },
                1400: {
                    items: 5
                }
            }
        })
      })

      return {
         getImgUrl : (banner => "https://api.dex.proelean.com/"+banner)
      }

   }
}
</script>

<style>

</style>