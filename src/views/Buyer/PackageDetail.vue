<template>
 <div class="tab-content shadow-none"  v-if="service.s_description">
   <div id="basic" class="tab-pane fade show active">
      <h4>{{ $t('service_card.title') }}</h4>
      <hr class="my-2">
      <div class="header text-secondary">
         <p >{{service.s_description}}</p>
            <p>
              {{service.description.substr(0,100)}}{{service.description.length > 100 ? '..' : ''}}
            </p>
            <p>
              {{service.additional_info.substr(0,100)}}{{service.additional_info.length > 100 ? '...' : ''}}
            </p>
      </div>
      <article>
              <div class="delivery"
                ><i class="mdi mdi-clock" aria-hidden="true"></i><b class="mr-2"> {{ $t('service_card.deliveryTime') }}:  </b> <span class="text-muted"> {{ service.delivery_time}} </span> 
                </div >
          </article>
          <article>
              <div class="delivery"
                ><i class="mdi mdi-sync" aria-hidden="true"></i> <b class="mr-2"> {{ $t('service_card.revision') }}:  </b> <span class="text-muted">  {{ service.revision}} </span></div
              >
          </article>
          <article>
            <div>
              <div class="delivery"
                ><i class="mdi mdi-radiobox-blank" aria-hidden="true"></i><b class="mr-2"> {{ $t('service_card.category') }}:  </b> <span class="text-muted">  {{ service.category.title}} </span>
                </div >
            </div>
            <div>
              <div class="delivery d-none d-lg-block">
              <i class="mdi mdi-google-circles-extended" aria-hidden="true"></i> <b class="mr-2">{{ $t('service_card.subCategory') }}:  </b> <span class="text-muted">{{service.sub_category.title}} </span> </div
              >
            </div>
            <div class="delivery d-lg-none">
              <i class="mdi mdi-google-circles-extended" aria-hidden="true"></i> <b class="mr-2"> {{ $t('service_card.subCategory') }}:  </b> <span class="text-muted">{{service.sub_category.title.substr(0,13)}}{{service.sub_category.title.length > 13 ? '..' : ''}} </span>
              </div>
          </article>
          <article>
            <div>
              <div class="delivery"
                ><i class="mdi mdi-currency-eur" aria-hidden="true"></i><b class="mr-2"> {{ $t('service_card.price') }}:  </b> <span class="text-muted">  €{{service.price}}
                </span> </div >
            </div>
          </article>
   </div>
</div>
</template>

<script>
import { computed } from "vue";
import { useStore } from "vuex";

export default {
  setup() {
    const store = useStore();
    return {
      service: computed(() => store.getters.getSingleService),
    };
  },
};
</script>

<style scoped>
.width {
  width: 140px;
}
.main-page .right .tab-content p{
  margin: 15px 5px;
}
</style>