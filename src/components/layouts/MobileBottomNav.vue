<template>
<nav class="nav">

      <!------------------------------    Buyer Side Nav     ------------------------------->
  <router-link  to="/" class="nav__link"  active-link="nav__link--active">
    <i class="material-icons nav__icon">home</i>
    <span class="nav__text">Home</span>
  </router-link>

  <router-link  to="/chat" class="nav__link" active-link="nav__link--active">
    <i class="material-icons nav__icon">mail</i>
    <span class="nav__text">Inbox</span>
  </router-link>

  <router-link  to="/gigs" class="nav__link" active-link="nav__link--active">
    <i class="material-icons nav__icon">search</i>
    <span class="nav__text">Search</span>
  </router-link>

  <router-link  to="/buyer/manage_order" class="nav__link" active-link="nav__link--active">
    <i class="material-icons nav__icon">shopping_bag</i>
    <span class="nav__text">Orders</span>
  </router-link>

  <router-link  to="/buyer/favourite_services" class="nav__link" active-link="nav__link--active">
    <i class="mdi mdi-heart"></i>
    <span class="nav__text">Favourite</span>
  </router-link>



      <!------------------------------    Seller Side Nav     ----------------------------->
    <!-- <router-link v-if="!$store.getters.isBuyerMode"  to="/dashboard" class="nav__link"  active-link="nav__link--active">
    <i class="material-icons nav__icon">home</i>
    <span class="nav__text">Dashboard</span>
  </router-link>

    <router-link v-if="!$store.getters.isBuyerMode"  to="/dashboard/chat" class="nav__link" active-link="nav__link--active">
    <i class="material-icons nav__icon">mail</i>
    <span class="nav__text">Inbox</span>
  </router-link>

  <router-link v-if="!$store.getters.isBuyerMode"  to="/dashboard/orders" class="nav__link" active-link="nav__link--active">
    <i class="material-icons nav__icon">shopping_bag</i>
    <span class="nav__text">Orders</span>
  </router-link>

  <router-link v-if="!$store.getters.isBuyerMode"  to="/dashboard/account" class="nav__link" active-link="nav__link--active">
    <i class="material-icons nav__icon">person</i>
    <span class="nav__text">Profile</span>
  </router-link> -->


  

</nav>
</template>

<script>
export default {

}
</script>

<style scoped>

		body {
    margin: 0 0 55px 0;
}

.nav {
    position: fixed;
    bottom: 0;
    width: 100%;
    height: 55px;
    box-shadow: 0 0 3px rgba(0, 0, 0, 0.2);
    background-color: #ffffff;
    display: flex;
    overflow-x: auto;
 
 
}

.nav__link {
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    flex-grow: 1;
    min-width: 50px;
    overflow: hidden;
    white-space: nowrap;
    font-family: sans-serif;
    font-size: 13px;
    color: #444444;
    text-decoration: none;
    -webkit-tap-highlight-color: transparent;
    transition: background-color 0.1s ease-in-out;
}

.nav__link:hover {
    background-color: #eeeeee;
   
}

/* .nav__link--active {
    color: #007bff;
} */
a.router-link-active.router-link-exact-active.nav__link {

    color: #007bff;
    }


.nav__icon {
    font-size: 18px;
}

</style>