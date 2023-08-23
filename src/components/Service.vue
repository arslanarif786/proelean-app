<template>
  <div class="my-2">
    <div class="card h-100 shadow-none position-relative">
        <router-link
          v-if="!$store.getters.isBuyerMode"
          :to="{ name: 'GigDetail', params: { id: service.id } }"
        >
          <img
            class="img-fluid"
            :src="imgURL + '/' + service.service_media[0].media"
          />
        </router-link>
        <router-link
          v-else
          :to="{ name: 'BuyerServiceDetail', params: { id: service.id } }"
        >
          <img
            class="img-fluid"
            :src="imgURL + '/' + service.service_media[0].media"
          />
        </router-link>
        <div class="inner-slider">
          <div class="inner-wrapper d-flex flex-column align-content-between">
            <div class="d-flex align-items-center">
              <span class="seller-image">
                <img
                  class="img-fluid"
                  :src="`${imgURL}/${
                    service.service_user
                      ? service.service_user.image
                      : '/assets/images/avator.png'
                  }`"
                  alt="img"
                />
              </span>
              <span class="seller-name">
                {{ service.service_user.username }}
             </span>
            </div>
              <router-link
                v-if="!$store.getters.isBuyerMode"
                :to="{ name: 'GigDetail', params: { id: service.id } }">
                <h3 style="overflow: hidden; height: 3rem">
                  <!-- {{ service.s_description.substr(0, 125) }} -->
                  {{ service.s_description.substr(0, 75)
                  }}{{ service.s_description.length > 75 ? "..." : "" }}
                </h3>
                <div class="content-info">
                <div class="rating-wrapper">
                  <span class="gig-rating text-body-2">
                    <svg
                      xmlns="http://www.w3.org/2000/svg"
                      viewBox="0 0 1792 1792"
                      width="15"
                      height="15"
                    >
                      <path
                        fill="currentColor"
                        d="M1728 647q0 22-26 48l-363 354 86 500q1 7 1 20 0 21-10.5 35.5t-30.5 14.5q-19 0-40-12l-449-236-449 236q-22 12-40 12-21 0-31.5-14.5t-10.5-35.5q0-6 2-20l86-500-364-354q-25-27-25-48 0-37 56-46l502-73 225-455q19-41 49-41t49 41l225 455 502 73q56 9 56 46z"
                      ></path>
                    </svg>
                    {{ service.service_rating }}
                    <span>({{ service.total_reviews }})</span>
                  </span>
                </div>
            </div>
            </router-link>
            <router-link
                v-else
                :to="{ name: 'BuyerServiceDetail', params: { id: service.id } }"
              >
                <h3 style="overflow: hidden; height: 3rem">
                  <!-- {{ service.s_description.substr(0, 125) }} -->
                  {{ service.s_description.substr(0, 75)
                  }}{{ service.s_description.length > 20 ? "..." : "" }}
                </h3>
              <div class="content-info">
              <div class="rating-wrapper">
                <span class="gig-rating text-body-2">
                  <svg
                    xmlns="http://www.w3.org/2000/svg"
                    viewBox="0 0 1792 1792"
                    width="15"
                    height="15"
                  >
                    <path
                      fill="currentColor"
                      d="M1728 647q0 22-26 48l-363 354 86 500q1 7 1 20 0 21-10.5 35.5t-30.5 14.5q-19 0-40-12l-449-236-449 236q-22 12-40 12-21 0-31.5-14.5t-10.5-35.5q0-6 2-20l86-500-364-354q-25-27-25-48 0-37 56-46l502-73 225-455q19-41 49-41t49 41l225 455 502 73q56 9 56 46z"
                    ></path>
                  </svg>
                  {{ service.service_rating }}
                  <span>({{ service.total_reviews }})</span>
                </span>
              </div>
            </div>
            </router-link>
            <div class="footer">
              <div class="dropdown" v-if="!$store.getters.isBuyerMode">
                <a
                  class="dropdown-toggle"
                  href="#"
                  id="dropdownMenuLink"
                  data-bs-toggle="dropdown"
                >
                  <i class="mdi mdi-dots-vertical md-size-5x"></i>
                </a>
                <ul class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                  <router-link
                    :to="{ name: 'GigDetail', params: { id: service.id } }"
                    ><li class="dropdown-item"><i class="mdi mdi-folder-open"></i> {{ $t('extra.open') }}</li></router-link
                  >
                  <router-link
                    :to="{ name: 'UpdateService', params: { id: service.id } }"
                    ><li class="dropdown-item"><i class="mdi mdi-pencil"></i> {{ $t('extra.edit') }}</li></router-link
                  >
                  <a
                    @click="$emit('selectService', service)"
                    class="cursor-pointer"
                    data-toggle="modal"
                    data-target="#exampleModalCenter"
                  >
                    <li class="dropdown-item"> <i class="mdi mdi-delete"></i> {{ $t('delete.del') }} </li>
                  </a>
                </ul>
              </div>
              <a
                :class="{
                  disable:
                    $store.getters.getAuthUser && service.service_user.id === $store.getters.getAuthUser.id,
                }"
                @click="handleWishlist(service.id,service.favourite)"
              >
                <i class="mdi mdi-repeat fs-2" v-if="heartStatus == service.id"></i>
                <i
                  v-else
                  class="mdi mdi-heart cursor-pointer fs-2"
                  :class="{ redIcon: service.favourite }"
                  :disabled="heartStatus === service.id"
                  aria-hidden="true"
                ></i>
              </a>
              <div class="price">
                <a href="#">
                  {{ $t('price.starting') }} <span> €{{ service.price }}</span>
                </a>
              </div>
            </div>
          </div>
        </div>
        <!-- Share Button -->
        <div @click="shareService(service.id)" class="p-2 position-absolute share-btn">
          <svg
            xmlns="http://www.w3.org/2000/svg"
            width="16"
            height="16"
            fill="currentColor"
            class="bi bi-share"
            viewBox="0 0 16 16"
          >
            <path
              d="M13.5 1a1.5 1.5 0 1 0 0 3 1.5 1.5 0 0 0 0-3zM11 2.5a2.5 2.5 0 1 1 .603 1.628l-6.718 3.12a2.499 2.499 0 0 1 0 1.504l6.718 3.12a2.5 2.5 0 1 1-.488.876l-6.718-3.12a2.5 2.5 0 1 1 0-3.256l6.718-3.12A2.5 2.5 0 0 1 11 2.5zm-8.5 4a1.5 1.5 0 1 0 0 3 1.5 1.5 0 0 0 0-3zm11 5.5a1.5 1.5 0 1 0 0 3 1.5 1.5 0 0 0 0-3z"
            />
          </svg>
        </div>
    </div>
  </div>
</template>

<script>
import { useStore } from "vuex";
import { computed } from "vue";
import { useRoute } from "vue-router";
import nativeShare from "../composables/useShare";
export default {
  props: {
    service: {
      type: Object,
      required: true,
    },
  },
  setup() {
    const store = useStore();
    const route = useRoute();
    const handleWishlist = (id,wishlistValue) => {
      let routeType = ''
      if(route.name === 'Gigs')
      {
        routeType = "gigs"
      }else if(route.name === 'BuyerServiceDetail')
      {
        routeType = "offeredServices"
      }else{
        routeType = "favouriteService"
      }
      let payload = {
        service_id: id,
        type:  routeType,
        favourite: wishlistValue
      };
      store.dispatch("wishlist", payload);
    };

    const shareService = (id) => {
      nativeShare('Share This Service',`/gig-detail/${id}`);
    };
    return {
      handleWishlist,
      heartStatus: computed(() => store.getters.getRegisterStatus),
      imgURL: process.env.VUE_APP_URL,
      shareService
    };
  },
};
</script>


<style scoped>

.card {
  margin-bottom: 0px !important;
}
.inner-slider {
  margin-bottom: 0px !important;
}
.redIcon {
  color: red !important;
}
.disable {
  visibility: hidden;
}
.dropdown-toggle::after {
  display: none;
}
 

.mdi-dots-vertical {
  font-size: 17px;
}

.share-btn {
  top: 5px;
  right: 5px;
  background: #fff;
  border-radius: 5px;
  cursor: pointer;
  box-shadow: 0 1rem 3rem rgba(0, 0, 0, 0.175) !important;
}

svg.bi.bi-share {
  color: #15a362;
}
</style>