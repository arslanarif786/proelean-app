<template>
  <!-- <nav v-if="$store.getters.isBuyerMode" class="navbar navbar-expand-lg navbar-light bg-white osahan-nav-mid px-0 border-top shadow-sm">
    <div class="container-fluid">
       <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
       <span class="navbar-toggler-icon"></span>
       </button>
       <div class="collapse navbar-collapse" id="navbarResponsive">
          <ul class="navbar-nav">
            
             <li class="nav-item" v-for="category in $store.getters.getCategories" :key="category.id">
                <router-link  class="nav-link" :to="'/gigs/'+category.slug">{{ category.title }}</router-link>
             </li>       
          </ul>
       </div>
       <ul class="navbar-nav ml-auto" v-if="!$store.state.isSeller && $store.state.isLoggedIn">
            <li class="nav-item">
                <router-link class="btn btn-success" to="/become_seller">
                <i class="fa fa-fw fa-trophy"></i>
                <span>Become A Seller</span>
                </router-link>
            </li>
       </ul>
    </div>
 </nav> -->

  <div class="navbar">
    <div class="container-fluid">
      <div class="dropdown" @mouseleave="unSelectCategoryMenu()">
        <button
          class="dropbtn"
          v-for="category in store.getters.getCategories"
          :key="category.id"
          @click="selectCategory(category)"
        >
          {{ category.title }}

          <i class="fa fa-caret-down"></i>
        </button>
        <div
          class="dropdown-content"
          v-if="store.getters.getSubCategories.length"
          v-show="categoriesMenu"
        >
          <div class="row">
            <div
              class="col-md-4 col-lg-3 col-12"
              v-for="subCat in store.getters.getSubCategories"
              :key="subCat.id"
            >
              <router-link :to="'/gigs/' + subCat.slug + '?id='+subCat.id"
                >{{ subCat.title }}
                <span class="badge bg-secondary">New</span></router-link
              >
            </div>
          </div>
        </div>
      </div>

      <ul
        class="navbar-nav ml-auto"
        v-if="!store.state.isSeller && store.state.isLoggedIn"
      >
        <li class="nav-item">
          <router-link class="btn btn-success text-white" to="/become_seller">
            <i class="fa fa-fw fa-trophy"></i>
            <span>
              <!-- Become A Seller -->
              {{ $t('nav.becomeASeller') }}
            </span>
          </router-link>
        </li>
      </ul>
    </div>
  </div>
</template>

<script setup>
import { onMounted, ref } from "@vue/runtime-core";
import { useStore } from "vuex";
//import { useRouter } from "vue-router";
// const router = useRouter();
const store = useStore();
const categoriesMenu = ref(false);
//const imageBaseURL = process.env.imagesBaseURL;

onMounted(() => {
  // store.loadCategories();
});

const selectCategory = (category) => {
  categoriesMenu.value = true;
  store.dispatch("loadSubCategories", category.id);
};
const unSelectCategoryMenu = () => {
  categoriesMenu.value = false;
};

</script>

<style lang="scss" scoped>
.container-fluid{
  max-width: 1500px;
  padding: 0px;
}
.navbar {
  font-family: Arial, Helvetica, sans-serif;
  position: relative;
  background-color: #fff;
  border-top: 1px solid #dedede;
  // box-shadow: 0px 8px 16px 0px rgba(0, 0, 0, 0.2);
}

.navbar a {
  float: left;
  font-size: 14px;
  color: #000;
  margin: 10px 10px;
  text-decoration: none;
}
.navbar a:hover {
  color: rgb(58, 57, 57);
}

.dropdown {
  float: left;
}

.dropdown .dropbtn {
  font-size: 16px;
  border: none;
  outline: none;
  color: #333;
  padding: 8px 14px;
  background-color: inherit;
  font: inherit;
  text-transform: captalize;
  font-family: sans-serif;
  margin: 0;
}

.navbar .dropbtn {
  &:hover {
    color: #212529;
    background-color: #f8f9fa;
    border-color: #f8f9fa;
  }
}

.navbar .dropbtn:focus {
  background-color: #f45a2a;
  color: #fff;
}

.dropdown-content {
  position: absolute;
  background-color: #fff;
  width: 100%;
  left: 0;
  box-shadow: 0px 8px 16px 0px rgba(0, 0, 0, 0.2);
  z-index: 2;
  padding: 10px;
  border-bottom-right-radius: 5px;
  border-bottom-left-radius: 5px;
}



 
.badge {
  color: #fff;
}

  

@media (max-width: 1216px) { 
.dropdown .dropbtn {
  padding: 10px;
  font-size: 12px;
}


}

</style>
