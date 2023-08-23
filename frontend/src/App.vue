<template>
  <div v-if="!$route.path.includes('coming-soon')">
    <div v-if="!$route.path.includes('/dashboard')">
      <TopNav />
      <div class="d-none d-lg-block">
            <BottomNav v-if="$store.getters.isBuyerMode && isAuthenticated && !$route.path.includes('chat')" />
      </div>
      <router-view :key="$route.fullPath"   />
      <Footer v-if="$store.getters.isBuyerMode && isAuthenticated && !$route.path.includes('chat')" />
      <div class="d-lg-none">
          <MobileBottomNav v-if="$store.getters.isBuyerMode && isAuthenticated" />
      </div>
    </div>

    <div v-else class="seller-app">
      <SellerHeader />
      <div class="app-wrapper">
        <div class="app-content" :class="$route.name != 'SellerChat' && `pt-3 p-md-3 p-lg-4`">
          <router-view :key="$route.fullPath" />
        </div>
        <SellerFooter />
        <div class="d-lg-none">
          <MobileBottomNav v-if="$store.getters.isBuyerMode && isAuthenticated" />
        </div>
      </div>
    </div>
  </div>
   <router-view v-else :key="$route.fullPath" />
</template>


<script>
import TopNav from "./components/layouts/TopNav.vue";
import BottomNav from "./components/layouts/BottomNav.vue";
import Footer from "./components/layouts/Footer.vue";
import MobileBottomNav from "./components/layouts/MobileBottomNav.vue";
import { onBeforeMount, onMounted } from "@vue/runtime-core";
import useFirebaseAuth from '@/composables/Auth/useFirebaseAuth'
import { useStore } from 'vuex'

import SellerHeader from "./components/layouts/Seller/Header.vue";
import SellerFooter from "./components/layouts/Seller/Footer.vue";

export default {
  name: "App",
  components: {
    TopNav,
    BottomNav,
    Footer,
    MobileBottomNav,
    SellerHeader,
    SellerFooter,
  },
  setup() {
    const store = useStore();
    onBeforeMount(() => {
      localStorage.setItem("USER_MODE", "BUYER")

      if (!store.getters.getCategories.length) {
        store.dispatch("getHomeList");
      }
    });

    onMounted(() => {
      store.dispatch('updateScreenWidthOnResize');
      const firebaseAuth = useFirebaseAuth();
      firebaseAuth.checkAuthStatus();
      if (!store.getters.amILoggedInOnFirebase) {
        firebaseAuth.loginAnonymously();
      }

    });
    return {
      isAuthenticated: localStorage.getItem("PROELEAN_TOKEN"),
    };
  },
};
</script>


<style lang="scss">
.cursor-pointer {
  cursor: pointer;
}

.gig-img-outer {
  height: 200px;
  width: 100%;
}

.img-full {
  height: 100%;
  width: 100%;
  overflow: hidden;
  object-fit: cover;
}

.cursor-pointer-2 {
  cursor: default
}
</style>