<template>
  <div class="row m-0 p-0">
    <div class="col-lg-12">
      <h3 class="app-page-title">{{ $t('notifications.notification') }}</h3>
      <div class="border-bottom my-3"></div>
      <div v-if="loader" class="d-flex justify-content-center s-margin">
        <div class="spinner-border text-primary m-2" role="status">
          <span class="sr-only">{{ $t('loader.loading') }}...</span>
        </div>
      </div>
      <div  v-else class="box shadow-sm rounded bg-white mb-3">
        <div class="box-title border-bottom p-3">
          <h6 class="m-0">{{ $t('notifications.allNotification') }}</h6>
        </div>
        <div v-if="earlierNotification.length > 0">
          <div
            class="box-body p-0"
            v-for="notification in earlierNotification"
            :key="notification.index"
          >
            <div   class=" p-3 bg-light border-bottom osahan-post-header">
              <div class="row d-flex align-items-center">
                <div  class="col-auto cursor-pointer" @click="handleNotification(notification)">
                  <div class="dropdown-list-image">
                    <img
                      class="rounded-circle"
                      :src="`${imgURL}/${notification.sender_pic ? notification.sender_pic : '/assets/images/avator.png'}`"
                      alt=""
                    />
                  </div>
                </div>
                <div @click="handleNotification(notification)"  class="col-md-6 cursor-pointer">
                  <div class="font-weight-bold text-truncate text-left">
                    {{ notification.name }}
                  </div>
                </div>
                <div class="col-auto ml-auto d-flex">
                  <div class="text-muted ml-2 mt-1">
                    {{ $filters.timeAgo(notification.created_at) }}
                  </div>
                  <div class="text-muted ml-2">
                    <i style="font-size:22px" data-toggle="modal" data-target="#exampleModal"
                    @click="deleteNotification(notification.id)"
                      class="mdi mdi-delete text-danger cursor-pointer"></i>
                  </div> 
                </div>
              </div>
              <div @click="handleNotification(notification)" class="row cursor-pointer">
                <div class="col-10 p-3">
                  <div class="text-muted" style="word-break: break-word">
                    {{ notification.body }}
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div v-if="$store.getters.isBuyerMode" class="marginn d-lg-none"></div>
        </div>
        <div class="app-card-body" v-else>
          <div class="table-responsive flex-width-center">
            <div class="m-5 text-center">
              <h5>{{ $t('notifications.noNotification') }}</h5>
              <figure class="">
                <img
                  class="rounded-circle"
                  :src="'/assets/images/notify.svg'"
                  alt=""
                  width="200"
                />
              </figure>
            </div>
          </div>
        </div>
      </div>

      <!-- Confirmation Modal -->
      <!-- <div
        class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true"
      >
        <div class="modal-dialog modal-dialog-centered" role="document">
          <div class="modal-content">
            <div class="modal-header d-flex justify-content-center">
              <h5 class="modal-title" id="exampleModalLongTitle">Delete Service</h5>
            </div>
            <div class="modal-body text-center">
              Are you sure you want to delete the service?
            </div>
            <div class="modal-footer d-flex justify-content-center">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">
                No
              </button>
              <button
                type="button"
                class="btn btn-danger"
                data-dismiss="modal"
                @click.prevent="deleteNotification"
              >
                Yes
              </button>
            </div>
          </div>
        </div>
      </div> -->
    </div>
  </div>
</template>

<script>
import { computed, onMounted } from "vue";
import { useStore } from "vuex";
import { useRouter } from 'vue-router';
export default {
  setup() {
    const store = useStore();
    const router = useRouter();
    function deleteNotification(id) {
      console.log("Deleted Successfully",id);
      store.dispatch("deleteNotification",id)
    }

    function handleNotification(notification) {
      console.log(notification.type)
      switch (notification.type) {
        case "ORDER":{
          if(store.getters.isBuyerMode){
            router.push(`/order-details/${notification.content_id}`);
          }
          else{
            router.push(`/dashboard/order-details/${notification.content_id}`);
          }
          break;
        }
        case "OFFER":{
          if(store.getters.isBuyerMode){
            router.push(`/buyer/view-offers/${notification.content_id}`);
          }
          else{
            router.push(`/dashboard/buyer/view-offers/${notification.content_id}`);
          }
          break;
        }
        case "MESSAGE":{
          if(store.getters.isBuyerMode){
            router.push("/chat");
          }
          else{
            router.push("/dashboard/chat");
          }
          break;
        }
        default:{
          router.push("/dashboard/notifications");
        }
      }
    }

    onMounted(() => store.dispatch("getNotification"));
    return {
      handleNotification,
      deleteNotification,
      loader: computed(() => store.getters.getLoaderVal),
      imgURL: process.env.VUE_APP_URL,
      earlierNotification: computed(() => store.getters.getAllNotifications),
    };
  },
};
</script>

<style scoped>
.osahan-post-header:hover{
  background-color: rgba(224, 224, 224, 0.799) !important;
}
</style>