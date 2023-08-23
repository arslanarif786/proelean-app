<template>
   <div>
      <ServiceNavSection />

      <section class="py-5 p-list-two">
         <div class="container">
            <div class="row">

               <ServiceFilterSection />

               <div class="col-lg-9 view_slider recommended">
                  <div class="row">
                     <div class="col-lg-12">
                        <div class="sorting-div d-flex align-items-center justify-content-between">
                           <!-- <p class="mb-2">463 Services available</p> -->
                           <!-- <div class="sorting d-flex align-items-center">
                              <p>Sortby</p>
                              <select class="custom-select custom-select-sm border-0 shadow-sm ml-2">
                                 <option>Best Selling</option>
                                 <option>Recommended</option>
                                 <option>Newest Arrivals</option>
                              </select>
                           </div> -->
                        </div>
                        <!-- <h3 v-if="$route.params.slug || category"> 
                        {{ $t('service.serviceIn') }} {{ category + ' ' + $route.params.slug }}</h3> -->
                     </div>
                  </div>
                  <div class="row">
                     <Loader v-if="$store.getters.getLoadingStatus === 'LOADING' && $store.getters.getScreenWidth>768" />
                     <div class="service-col col-md-4 d-flex flex-column align-self-stretch"
                        v-for="service in $store.getters.getServices" :key="service.id" v-else>
                        <Service :service="service" />
                     </div>

                     <div
                        class="container"
                        v-if="!$store.getters.getServices.length && $store.getters.getLoadingStatus==='COMPLETED'" 
                     >
                     <div class="d-flex justify-content-center align-item-center">
                        {{ $t('service.noServiceFoundAgainst') }} {{ $route.params.slug  || category }}
                     </div>
                     </div>
                  </div>
                  <PaginationSection
                     v-if="$store.getters.getServices.length && $store.getters.getPages.last_page > 1" />
               </div>
            </div>
         </div>
      </section>

   </div>
</template>

<script>
import ServiceNavSection from '@/components/services/ServiceNavSection.vue';
import Service from '@/components/Service.vue';
import PaginationSection from '@/components/services/ServicePagination.vue';
import ServiceFilterSection from '@/components/services/ServiceFilterSection';
import Loader from '@/components/loadingComponent.vue';
import { useRoute } from 'vue-router';
import { computed, onMounted } from '@vue/runtime-core';
import { useStore } from 'vuex';

export default {
   components: {
      ServiceNavSection,
      Service,
      ServiceFilterSection,
      PaginationSection,
      Loader,
   },
   setup() {
      const store = useStore();
      const route = useRoute();
      const params = new URLSearchParams(window.location.search)
      const category = params.has('category') ? params.get('category') : '';
      let filter='';

      if(route.query.filter){
         filter+=`&filter=${route.query.filter}&filter_value=${route.query.filter_value}`;
      }

      onMounted(() => {
        const page=route.query.page || 1;
         if (route.query.id) {
            store.dispatch('searchServicesByCategoryId', `categories/${route.query.id}/services?page=${page}${filter}`);
         }
         else {
            store.dispatch('searchServices', `search?q=${route.params.slug ? route.params.slug.replace('-',' ') : ''}&category=${category}&page=${page}${filter}`);
         }
      })
      return {
         isNextPage: computed(() => store.getters.getNextPage),
         category
      }
   }
}
</script>
