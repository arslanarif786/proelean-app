<template>
  <div class="container-xl">
    <div class="row gy-4 d-flex justify-content-center">
      <ProfileCard  />
    </div>
  </div>
</template>

<script>
import ProfileCard from "../../components/Seller/Account/ProfileCard.vue";
// import PreferencesCard from "../../components/Seller/Account/PreferencesCard.vue";
// import SecurityCard from "../../components/Seller/Account/SecurityCard.vue";
// import PaymentCard from "../../components/Seller/Account/PaymentCard.vue";

export default {
  components: { ProfileCard },

};
</script>

<style>
.seller-app .app-page-title {
    font-size: 1.5rem !important;
    margin-bottom: 1.5rem;
}
</style>