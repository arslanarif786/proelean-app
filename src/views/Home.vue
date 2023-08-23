<template>
  <div>
   <HeroSection />
    <SocialSection />
    <BoostBussiness />
    <ExploreMarket />
    <div class="freelance-projects pt-2 pb-5">
        <TopPicSection />
    </div>
    <Quotation />
    <FindServices />
  </div>
</template>

<script>
import HeroSection from '@/components/home/HeroSection.vue';
import SocialSection from '@/components/home/SocialListSection.vue';
import BoostBussiness from '@/components/home/BoostBussinessSection.vue';
import ExploreMarket from '@/components/home/ExploreMarketSection.vue';
import TopPicSection from '@/components/home/TopPicSection.vue';
// import Quotation from '@/components/home/QuotationSection.vue';
import FindServices from '@/components/home/FindServicesSection.vue';

export default {
  name: 'Home',
  components: {
    HeroSection,
    SocialSection,
    BoostBussiness,
    ExploreMarket,
    TopPicSection,
    // Quotation,
    FindServices
  },
  
}
</script>
