<template>
  <div class="col-lg-4 right">
    <div class="mt-2 d-flex justify-content-end" v-if="!$store.getters.isBuyerMode">
      <router-link
        class="text-primary edit-btn d-none btn app-btn-secondary"
        :to="{ name: 'UpdateService', params: { id: service.id } }"
      >
        <i class="mdi mdi-pencil"></i>
        {{ $t('service_card.editService') }}
      </router-link>
    </div>
    <div class="mt-md-2 pt-2">
      <div class="tab-content">
        <div id="basic" class="tab-pane fade show active">
          <h4>{{ $t('service_card.title') }}</h4>
          <hr class="my-2" />
          <div class="header text-secondary">
            <p>
              {{ service.s_description }}
            </p>
            <p>
              {{ service.description.substr(0, 100)
              }}{{ service.description.length > 100 ? ".." : "" }}
            </p>
            <p>
              {{ service.additional_info.substr(0, 100)
              }}{{ service.additional_info.length > 100 ? "..." : "" }}
            </p>
          </div>
          <article>
            <div class="delivery text-muted">
              <i class="mdi mdi-clock" aria-hidden="true"></i
              ><b class="mr-2 text-dark"> {{ $t('service_card.deliveryTime') }}: </b>
              {{ service.delivery_time }}
            </div>
          </article>
          <article>
            <div class="delivery text-muted">
              <i class="mdi mdi-sync" aria-hidden="true"></i>
              <b class="mr-2 text-dark"> {{ $t('service_card.revision') }}: </b> {{ service.revision }}
            </div>
          </article>
          <article>
            <div>
              <div class="delivery text-muted">
                <i class="mdi mdi-radiobox-blank" aria-hidden="true"></i
                ><b class="mr-2 text-dark"> {{ $t('service_card.category') }}: </b>
                {{ service.category.title }}
              </div>
            </div>
            <div>
              <div class="delivery text-muted d-none d-sm-block">
                <i
                  class="mdi mdi-google-circles-extended"
                  aria-hidden="true"
                ></i>
                <b class="mr-2 text-dark"> {{ $t('service_card.subCategory') }}: </b>
                 {{service.sub_category.title}}
              </div>
              <div class="delivery text-muted d-sm-none">
                <i
                  class="mdi mdi-google-circles-extended"
                  aria-hidden="true"
                ></i>
                <b class="mr-2 text-dark"> {{ $t('service_card.subCategory') }}:</b>
                {{service.sub_category.title.trim().substr(0,13)}} {{service.sub_category.title.length > 13 ? '..' : ''}}
              </div>

            </div>
          </article>
          <article>
            <div>
              <div class="delivery text-muted">
                <i class="mdi mdi-currency-eur" aria-hidden="true"></i
                ><b class="mr-2 text-dark"> {{ $t('service_card.price') }}: </b> €{{ service.price }}
              </div>
            </div>
          </article>

          <router-link
            :to="{ name: 'Purchase', params: { id: service.id } }"
            class="btn app-btn-primary w-100"
            v-if="!$store.getters.getAuthUser || $store.getters.getAuthUser.id!=service.service_user.id"
          >
            {{ $t('service_card.purchase') }}
          </router-link>

          <router-link
            :to="{
              name: 'Chat',
              params: { id: `${service.service_user.id}` },
              query: { gig: service.id },
            }"
            class="btn app-btn-secondary w-100 mt-3"
            v-if="!$store.getters.getAuthUser || $store.getters.getAuthUser.id!=service.service_user.id"
          >
            {{ $t('service_card.contactSeller') }}
          </router-link>
          <div class="marginn d-lg-none">.</div>
        </div>
      </div>
      <!---------------------    Modal End     --------------------->
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
      isBuyerMode: computed(() => store.getters.isBuyerMode),
      service: computed(() => store.getters.getSingleService),
    };
  },
};
</script>
 
<style scoped>
.width {
  width: 140px;
}
.main-page .right .tab-content p {
  margin: 15px 5px;
}

@media (min-width: 991.98px) { 
  .edit-btn{
    display: block !important;
  }
}
</style>