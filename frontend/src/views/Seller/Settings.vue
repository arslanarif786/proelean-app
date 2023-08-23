<template>
  <div class="container-xl">
    <h1 class="app-page-title">Settings</h1>
    <hr class="mb-4" />
    <GeneralCard />
    <hr class="my-4" />
    <PlanCard />
    <hr class="my-4" />
    <PrivacyCard />
    <hr class="my-4" />
    <NotificationsCard />
  </div>
</template>

<script>
import GeneralCard from "../../components/Seller/Settings/GeneralCard.vue";
import PlanCard from "../../components/Seller/Settings/PlanCard.vue";
import PrivacyCard from "../../components/Seller/Settings/PrivacyCard.vue";
import NotificationsCard from "../../components/Seller/Settings/NotificationsCard.vue";

export default {
  components: { GeneralCard, PlanCard, PrivacyCard, NotificationsCard },
};
</script>