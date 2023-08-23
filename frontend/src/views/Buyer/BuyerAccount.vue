<template>
  <div class="container-xl">
    <h3 class="app-page-title mt-4">My Account</h3>
    <div class="border-bottom my-3"></div>
    <div class="row gy-4 mb-4">
    <ProfileCard />
    <PreferencesCard />
    <SecurityCard />
    <PaymentCard />
    </div>
  </div>
</template>

<script>
import ProfileCard from "../../components/Seller/Account/ProfileCard.vue";
import PreferencesCard from "../../components/Seller/Account/PreferencesCard.vue";
import SecurityCard from "../../components/Seller/Account/SecurityCard.vue";
import PaymentCard from "../../components/Seller/Account/PaymentCard.vue";

export default {
  components: { ProfileCard, PreferencesCard, SecurityCard, PaymentCard },
};
</script>