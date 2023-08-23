<template>
  <div class="py-5">
         <div class="container ">
            <div class="row d-flex justify-content-center col-12 m-0 p-0">
               <div class="col-md-9">
                  <h4 class="mb-3">Notifications</h4>
                  <!-- <div class="box shadow-sm rounded bg-white mb-3">
                     <div class="box-title border-bottom p-3">
                        <h6 class="m-0">Recent</h6>
                     </div>
                     <div class="box-body p-0" v-for="notification in recentNotification" :key="notification.index">
                       <div class="p-3 d-flex align-items-center bg-light border-bottom osahan-post-header">
                           <div class="dropdown-list-image mr-3">
                              <img class="rounded-circle" src="/assets/images/user/s4.png" alt="">
                           </div>
                           <div class="font-weight-bold mr-3">
                              <div class="text-truncate">{{ notification.name }}</div>
                              <div class="small">{{ notification.body }}</div>
                           </div>
                           <span class="ml-auto my-auto">
                              <div class="d-flex">
                              <div class="text-right text-muted ml-2">{{ $filters.timeAgo( notification.created_at ) }}</div>
                                 <div>
                                    <i class="mdi text-danger cursor-pointer mdi-delete fa-lg p-1 m-2"></i>
                              </div>
                              </div>
                           </span>
                        </div>
                     </div>
                  </div> -->
                  <div class="box shadow-sm rounded bg-white mb-3">
                     <div class="box-title border-bottom p-3">
                        <h6 class="m-0">All Notifications</h6>
                     </div>
                     <div class="box-body p-0" v-for="notification in earlierNotification" :key="notification.index">
                       <div class="p-3 d-flex align-items-center bg-light border-bottom osahan-post-header">
                           <div class="dropdown-list-image mr-3">
                              <img class="rounded-circle" src="/assets/images/user/s4.png" alt="">
                           </div>
                           <div class="font-weight-bold mr-3">
                              <div class="text-truncate">{{ notification.name }}</div>
                              <div class=" text-muted ">{{ notification.body }}</div>
                           </div>
                           <span class="ml-auto my-auto">
                              <div class="d-flex">
                              <div class="text-right text-muted ml-2">{{ $filters.timeAgo( notification.created_at ) }}</div>
                                 <div>
                                    <i class="mdi text-danger cursor-pointer mdi-delete fa-lg p-1 m-2"
                                       data-toggle="modal"
                                       data-target="#exampleModalCenter"></i>
                                 </div>
                              <div
                                 class="modal fade"
                                 id="exampleModalCenter"
                                 tabindex="-1"
                                 role="dialog"
                                 aria-labelledby="exampleModalCenterTitle"
                                 aria-hidden="true"
                              >
                                 <div
                                 class="modal-dialog modal-dialog-centered"
                                 role="document"
                                 >
                                 <div class="modal-content">
                                    <div
                                       class="modal-header d-flex justify-content-center"
                                    >
                                       <h5
                                       class="modal-title"
                                       id="exampleModalLongTitle"
                                       >
                                       Delete Notification
                                       </h5>
                                    </div>
                                    <div class="modal-body text-center">
                                       Are you sure you want to delete the service?
                                    </div>
                                    <div
                                       class="modal-footer d-flex justify-content-center"
                                    >
                                       <button
                                       type="button"
                                       class="btn btn-secondary"
                                       data-dismiss="modal"
                                       >
                                       No
                                       </button>
                                       <button
                                       type="button"
                                       class="btn btn-danger"
                                       data-dismiss="modal"
                                       @click="deleteNotification"
                                       >
                                       Yes
                                       </button>
                                    </div>
                                 </div>
                                 </div>
                              </div>
                              </div>
                           </span>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
</template>

<script>
import { computed } from "vue"
import { useStore } from 'vuex'
export default {
   setup(){
      const store = useStore()
      function deleteNotification () {
         console.log("Deleted Successfully")
      }
      return{
         deleteNotification,
         earlierNotification: computed( () => store.getters.getAllNotifications),
      }
   }

}
</script>

<style>

</style>