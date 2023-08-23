<template>
  <footer class="bg-white">
        <div class="container">
           <div v-if="isAuthenticated" class="d-flex justify-content-between">
              <div class="footer-list">
                 <h4>{{ $t('footer.categories') }}</h4>
                 <ul class="list" v-if="$store.state.isLoggedIn">
                    <li  v-for="(category,index) in $store.getters.getCategories" :key="category.id" v-show="index < 6">
                       <router-link :to="'/gigs/'+category.slug" >{{category.title}}</router-link>
                     </li>
                 </ul>
                 <ul v-else>
                    <li><a href="#"> Graphic & Design </a></li>
                    <li><a href="#"> Digital Marketing </a></li>
                    <li><a href="#"> Writing & translation </a></li>
                    <li><a href="#"> Video Animation </a></li>
                    <li><a href="#"> Music & Audio </a></li>
                    <li><a href="#"> Programming & Tech </a></li>
                 </ul>
              </div>
              <div class="footer-list">
                 <h4>{{ $t('footer.about') }}</h4>
                 <ul class="list">
                    <li><a href="#">{{ $t('about.careers') }}</a></li>
                    <li><router-link to="/about">{{ $t('about.about') }}</router-link></li>
                    <li><a :href="`${URL}/privacy-policy`" target="_blank">{{ $t('about.privacyPolicy') }}</a></li>
                    <li><a href="#">{{ $t('about.termsOfService') }}</a></li>
                    <li><a href="#">{{ $t('about.intellectualPropertyClaims') }}</a></li>
                 </ul>
              </div>
              <div class="footer-list">
                 <h4>{{ $t('footer.support') }}</h4>
                 <ul class="list">
                    <li><a href="/coming-soon" >{{ $t('support.help&Support') }}</a></li>
                    <li><a href="/coming-soon">{{ $t('support.trust&Safety') }}</a></li>
                    <li><a href="/coming-soon" >{{ $t('support.sellingOnProelean') }}
                       </a>
                    </li>
                    <li><a href="/coming-soon">{{ $t('support.buyingOnProelean') }}
                       </a>
                    </li>
                 </ul>
              </div>
              
           </div>
           <div class="copyright mb-5 mb-lg-0">
              <div class="logo">
                 <router-link to="/">
                 <img src="/assets/images/Pro-eLean-.png">
                 </router-link>
              </div>
              <p class="text-sm-center">© Copyright 2022 Pro eLean. All Rights Reserved
              </p>
              <ul class="social">
                 <li>
                    <a href="https://www.facebook.com/proelean" target="_blank"><i class="mdi mdi-facebook" aria-hidden="true"></i></a>
                 </li>
                 <!-- <li>
                    <a href="#"><i class="fa fa-twitter" aria-hidden="true"></i></a>
                 </li> -->
                 <!-- <li>
                    <a href="#"><i class="fa fa-linkedin" aria-hidden="true"></i></a>
                 </li> -->
                 <li>
                    <a href="https://www.instagram.com/proelean/" target="_blank"><i class="mdi mdi-instagram" aria-hidden="true"></i></a>
                 </li>
              </ul>
           </div>
        </div>
     </footer>
</template>

<script>
export default {
   setup(){
      return{
         isAuthenticated: localStorage.getItem("PROELEAN_TOKEN"),
         URL: process.env.VUE_APP_URL
      }
   }
}
</script>

<style scoped>

</style>