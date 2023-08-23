<template>
  <div class="main-page second pt-3">
    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <div class="d-flex align-items-center justify-content-between mb-3 border-bottom">
            <h3 class="font-weight-bold mb-3">{{ $t('orders.title') }}</h3>            
              <select class="form-control-sm" aria-label="Default select example"  @change="showFilter" id="ordersValue">
                <option :value="order.value" v-for="order in OrderSelectionType" :key="order.index">
                  {{ $t('orders.'+order.name.toLowerCase()) }}
                </option>
              </select>
            </div>
          </div>
        </div>
      </div>
    </div>
    

        <!-- for mobile screen -->
       <div class="container tab-content osahan-table rounded d-sm-none">
        <div class="tab-pane active" id="active">
          <div v-if="loader" class="d-flex justify-content-center s-margin">
            <div class="spinner-border text-primary m-2" role="status">
              <span class="sr-only">{{ $t('loader.loading') }}</span>
            </div>
          </div>
          <div v-else>
          <div v-if="orders.length > 0">
          <div
            v-for="order in orders"
            :key="order.id"
            class="card d-md-none shadow-sm border-primary"
          >
            <div class="card-body">
              <div class="d-flex justify-content-between flex-wrap">
              <span>
                <img
                   class="img-fluid bg-info rounded-circle mr-2"
                   style="width: 35px; height: 35px; object-fit:cover;"
                   :src="`${imgURL}/${order.image}`"
                   alt="user-image"
                  />
                <span> {{ order.username }} </span>
                </span>
                <span class="mt-2">{{ moment.utc(order.created_at).fromNow() }}</span>
              </div>
              <h5 class="card-title bg-light mt-3">{{ order.description }}</h5>
              <span class="text-muted"> <i class="mdi mdi-clock"></i>  {{ $t('orders.s_duration') }}: </span> <span> {{ order.delivery_time }}</span>
              <span class="text-muted ml-4"> <i class="mdi mdi-database"></i>  {{ $t('orders.s_budget') }}: </span> <span> {{ order.amount }}€</span>
              <div class="d-flex justify-content-end mt-2">
                <div>
                    <button class="badge bg-success w-100" v-if="order.status_id == 1"> {{ $t('orders.active') }} </button>
                    <button class="badge bg-secondary w-100" v-if="order.status_id == 2"> {{ $t('orders.delivered') }} </button>
                    <button class="badge bg-info w-100" v-if="order.status_id == 3"> {{ $t('orders.revision') }} </button>
                    <button class="badge bg-primary w-100" v-if="order.status_id == 4"> {{ $t('orders.completed') }} </button>
                    <button class="badge bg-danger w-100" v-if="order.status_id == 5"> {{ $t('orders.disputed') }} </button>
                    <button class="badge bg-warning w-100" v-if="order.status_id == 6"> {{ $t('orders.late') }} </button>
                </div>
                <span class="ml-2">
                  <router-link 
                  :to="{name:'OrderDetailsBuyer', params:order}"
                  class="badge bg-light text">
                     {{ $t('orders.view') }} 
                  </router-link>
                </span>
              </div>
            </div>
          </div>
          <div class="marginn"></div>
          </div>
            <div v-else class="card shadow-none text-center py-5">
              <h3>{{ $t('orders.noOrder') }}</h3>
            </div>
          </div>
        </div>
      </div>



          <!-- For Web Screen -->
          <div  class="tab-content osahan-table rounded d-none d-sm-block container">
                <div v-if="loader" class="d-flex justify-content-center s-margin">
                  <div class="spinner-border text-primary m-2" role="status">
                    <span class="sr-only">{{ $t('loader.loading') }}</span>
                  </div>
                </div>
            <div v-else class="tab-pane active" id="active">
                <div v-if="orders.length>0">
                  <div
                  class="table-responsive box-table mt-1 bg-white mb-5" 
                  >
                      <table class="table table-bordered" >
                        <thead>
                          <tr>
                            <th class="text-center">{{ $t('orders.username') }}</th>
                            <th>{{ $t('orders.orderDesc') }}</th>
                            <th class="text-center">{{ $t('orders.postedDate') }}</th>
                            <th class="text-center">{{ $t('orders.duration') }}</th>
                            <th class="text-center">{{ $t('orders.budget') }}</th>
                            <th class="text-center">{{ $t('orders.status') }}</th>
                            <th class="text-center">{{ $t('orders.details') }}</th>
                          </tr>
                        </thead>
                        <tbody>
                          <tr v-for="order in orders" :key="order.id">
                            <td class="text-center">
                              <div>
                                <img
                                  class="img-fluid bg-info rounded-circle mb-1"
                                  style="width: 35px; height: 35px; object-fit:cover;"
                                  :src="`${imgURL}/${order.image}`"
                                  alt="img"
                                />
                              </div>
                              <div>
                              {{ order.username }}
                              </div>
                            </td>
                            <td>
                                <p class="order-proposal-title ml-1">
                                  {{ order.description.substr(0, 50) }}
                                </p>
                            </td>
                            <td class="text-center">{{ moment.utc(order.created_at).fromNow() }}</td>
                            <td class="text-center">{{ order.delivery_time }}</td>
                            <td class="text-center">{{ order.amount }}.0€</td>
                            <td class="text-center">
                              <a
                                ><span
                                  class="badge bg-success cursor-pointer-2"
                                  v-if="order.status_id == 1"
                                  >{{ $t('orders.active') }}</span
                                ></a
                              >
                              <a
                                ><span
                                  class="badge bg-secondary cursor-pointer-2"
                                  v-if="order.status_id == 2"
                                  >{{ $t('orders.delivered') }}</span
                                ></a
                              >
                              <a
                                ><span class="badge bg-info cursor-pointer-2" v-if="order.status_id == 3"
                                  >{{ $t('orders.revision') }}</span
                                ></a
                              >
                              <a
                                ><span
                                  class="badge bg-primary cursor-pointer-2"
                                  v-if="order.status_id == 4"
                                  >{{ $t('orders.completed') }}</span
                                ></a
                              >
                              <a
                                ><span
                                  class="badge bg-danger cursor-pointer-2"
                                  v-if="order.status_id == 5"
                                  >{{ $t('orders.disputed') }}</span
                                ></a
                              >
                              <a
                                ><span
                                  class="badge bg-warning cursor-pointer-2"
                                  v-if="order.status_id == 6"
                                  >{{ $t('orders.late') }}</span
                                ></a
                              >
                            </td>
                            <td class="text-center">
                               <router-link :to="{name:'OrderDetailsBuyer', params:order}"
                                class="btn btn-light">
                                {{ $t('orders.view') }} 
                              </router-link>
                            </td>
                          </tr>
                        </tbody>
                      </table>
                  </div>
                </div>
                <div v-else class="container card shadow-none tab-content text-center py-5">
                  <h3>{{ $t('orders.noOrder') }}</h3>
                </div>
            </div>
          </div>
</template>

<script>
import { onMounted, computed } from "@vue/runtime-core";
import moment from "moment";
import { useStore } from 'vuex';

export default {
  setup() {
    const store = useStore()
    const buyerOrderURL = "buyer/orders?status=";
    onMounted(() => {
      store.dispatch("myOrders", buyerOrderURL);
    });
    
    const OrderSelectionType =  [ 
      { value: 0, name:"All" },
      { value: 1, name:"Active" },
      { value: 2, name:"Delivered" },
      { value: 3, name:"Revision" },
      { value: 4, name:"Completed" },
      { value: 5, name:"Disputed" },
      { value: 6, name:"Late" },
    ]


    function showFilter() {
      let value = document.getElementById("ordersValue").value;
      console.log("value", value);
      store.dispatch("myOrders", `${buyerOrderURL}${value}`);
    }

    return {
      imgURL: process.env.VUE_APP_URL,
      orders: computed(() => store.getters.getMyOrders),
      loader: computed(() => store.getters.getLoaderVal),
      showFilter,
      OrderSelectionType,
      moment
    };
  },
};
</script>

<style scoped>


.s-margin{
  margin-bottom: 8rem;
  margin-top: 5rem ;
}
.badge {
    display: inline-block;
    padding: 0.35em 0.65em;
    font-size: 0.75em;
    font-weight: 700;
    line-height: 1;
    color: #fff;
    text-align: center;
    white-space: nowrap;
    vertical-align: baseline;
    border-radius: 0.25rem;
}

.text{
  color:rgb(60, 219, 94);
}


</style>