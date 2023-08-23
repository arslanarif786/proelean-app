<template>
<!-- For Web Screen -->
<div class="app-card app-card-orders-table shadow-sm d-none d-sm-block my-3" >
   <div class="app-card-body" >
      <div class="table-responsive">
         <table class="table app-table-hover mb-0 p-1 text-left" >
            <thead >
               <tr >
                  <th class="cell bold text-center" >{{ $t('dashboard.service') }}</th>
                  <th class="cell bold" >{{ $t('dashboard.tittle') }}</th>
                  <th class="cell bold" >{{ $t('dashboard.price') }}</th>
                  <th class="cell bold text-center" >{{ $t('dashboard.dueDate') }}</th>
                  <th class="cell bold text-center" >{{ $t('dashboard.status') }}</th>
                  <th class="cell bold" ></th>
               </tr>
            </thead>
            <tbody >
               <tr v-for="(order) in orders" :key="order.id">
                  <td class="text-center cell" >
                  <div class="item-data mb-3">
                     <img
                        :src="imgURL + '/' + order.image"
                        class="profileImage dropdown-user-img img-full rounded-circle"
                        alt="profile_img"
                     />
                  </div>
                  </td>
                  <td class="cell" ><span class="truncate" >{{order.description}} </span></td>
                  <td class="cell" ><span class="truncate" >{{order.currency}}{{order.amount}}</span></td>
                  <td class="text-center cell " ><span class="truncate mdi mdi-clock" > {{ moment.utc(order.end_date).fromNow() }}</span></td>
                   
                  <td class="text-center cell" >
                    
                  <span class="badge bg-success cursor-pointer-2" v-if="order.status_id == 1">{{ $t('dashboard.inProgress') }}</span> 
                    
                  </td>
                  <td class="cell" >
                      <router-link :to="{name:'OrderDetails', params:order}"
                        class="btn btn-light">
                        {{ $t('dashboard.view') }} 
                      </router-link>
                  </td>
               </tr>
            </tbody>
         </table>
      </div>
      <!--//table-responsive-->
   </div>
   <!--//app-card-body-->
</div>
<!-- For Web Screen END-->


<!-- For Mobile Screen (CARD) -->
      <div class="d-sm-none">
          <div
            v-for="order in orders"
            :key="order.id"
            class="card d-md-none shadow-sm border-primary"
          >
          <div class="app-card-header px-2 py-2">
            <div class="g-3 align-items-center">
              <div class="col-12 text-center">
                <img
                  class="img-fluid rounded-circle mr-2"
                  style="width: 55px; height: 55px; object-fit: cover"
                  :src="`${imgURL}/${order.image}`"
                  alt=""
                />
              </div>
              <div class="d-flex justify-content-between px-2 pt-2">
                <h4 class="margin-minus">
                  {{ order.username }}
                </h4>
                <div class="d-flex align-items-center"> <button class="badge bg-success border border-success" v-if="order.status_id == 1"> {{ $t('dashboard.inProgress') }} </button> </div>
              </div>
                <div class="d-flex flex-column">
                  <div class=""> <i class="mdi mdi-clock"></i> <b> {{ $t('dashboard.dueDate') }} : </b> {{ moment.utc(order.end_date).fromNow() }}</div> 
                  <!-- <div class=""> <i class="mdi mdi-clock"></i> <b> Delivery Time: </b>  {{ order.delivery_time }}</div>  -->
                  <div class=""> <i class="mdi mdi-database"></i> <b> {{ $t('dashboard.price') }} : </b> {{ order.currency }}{{ order.amount }}</div> 
                </div>
              </div>
          </div>
          <!--//app-card-header-->

          <div class="app-card-body ml-2 mr-2 mb-3">
              {{ order.description.substr(0,50)}}{{order.description.length > 50 ? '..' : ''}}
          </div>
          <div class="app-card-footer">
               <div class="mx-3">
                  <router-link :to="{name:'OrderDetails', params:order}"
                   class="btn btn-light mb-3 w-100">
                   {{ $t('dashboard.view') }}
                  </router-link>
               </div>
          </div>
         </div>
      </div>
<!-- For Mobile Screen END -->
</template>

<script>
import { ref } from '@vue/reactivity';
import moment from "moment";
export default {
   props: {
      orders: {
         type: Array,
         required: true
      }
   },
   setup() {
      const loadMore = ref();
      loadMore.value = 3
      return{
         loadMore, imgURL: process.env.VUE_APP_URL, moment
      }
   }
};
</script>

<style scoped>
 
 .bold{
  font-weight: 500 !important;
}

.name-holder{
  position: relative;
  display: flex;
  justify-content: center;
  align-items: center;
  height: 40px;
  width: 40px;
  /* background-color: #E4E5E5; */
  background: rgba(0, 0, 0, 0.562);
  padding: 10px;
  color:#fff;
  border-radius: 50%;
  font-weight: 600;
}
.online-icon{
  position: absolute;
  height: 10px;
  width: 10px;
  border-radius: 50%;
 background: #75a925;
  bottom: 2px;
  right: 2px;
}

.margin-minus{
   margin-left: -6px;
}
.profileImage {
  width: 60px !important;
  height: 60px !important;
  object-fit: cover;
}

</style>