<template>
  <div class="main-page second py-3">
    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <div class="d-flex align-items-center mb-3 border-bottom">
            <h3 class="font-weight-bold mb-3">Orders</h3>
            
            
            <!----------------------    Button trigger modal    --------------------->
            <button type="button" class="btn btn-sm btn-success ml-auto light" data-toggle="modal" data-target="#exampleModalCenter">
              Use Filter
            </button>

            <!------------------------      Modal     -------------------------->
            <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
              <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Filter</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                  <div class="modal-body">
                    <input type="radio" id="all" name="filter" class="close" data-dismiss="modal" @click="showAll()" value="">
                    <label>All</label><br>
                    <input type="radio" id="active" name="filter" class="close" data-dismiss="modal" @click="showFilter(1)" value="1">
                    <label>Active</label><br>
                    <input type="radio" id="delivered" name="filter" class="close" data-dismiss="modal" @click="showFilter(2)" value="2">
                    <label>Delivered</label><br>
                    <input type="radio" id="revision" name="filter" class="close" data-dismiss="modal" @click="showFilter(3)" value="3">
                    <label>Revision</label><br>
                    <input type="radio" id="complete" name="filter" class="close" data-dismiss="modal" @click="showFilter(4)" value="4">
                    <label>Complete</label><br>
                    <input type="radio" id="disputed" name="filter" class="close" data-dismiss="modal" @click="showFilter(5)" value="5">
                    <label>Disputed</label><br>
                    <input type="radio" id="late" name="filter" class="close" data-dismiss="modal" @click="showFilter(6)" value="6">
                    <label>Late</label><br>
                  </div>
                </div>
              </div>
            </div>
            <!------------------------      Modal End     -------------------------->
          </div>
        </div>
      </div>


       <div class="tab-content osahan-table rounded d-sm-none">
        <div class="tab-pane active" id="active">
          <div v-if="loader" class="d-flex justify-content-center s-margin">
            <div class="spinner-border text-primary m-2" role="status">
              <span class="sr-only">Loading...</span>
            </div>
          </div>
          <div
            v-for="order in orders"
            :key="order.id"
            class="card d-md-none shadow-sm border-primary"
          >
            <div class="card-body">
              <div class="d-flex justify-content-between">
              <span>
                <img
                   class="img-fluid bg-info rounded-circle mr-2"
                   style="width: 35px; height: 35px; object-fit:cover;"
                   :src="`${imgURL}/${order.image}`"
                   alt="user-image"
                  />
                <span> {{ order.username }} </span>
                </span>
                <span class="mt-2">{{ order.created_at }}</span>
              </div>
              <h5 class="card-title bg-light mt-3">{{ order.description }}</h5>
              <span class="text-muted"> <i class="fa fa-clock-o"></i>  Duration: </span> <span> {{ order.delivery_time }}</span>
              <span class="text-muted ml-5"> <i class="fa fa-usd"></i>  Budget: </span> <span> {{ order.amount }}</span>
              <div class="d-flex justify-content-end mt-2">
                <td>
                    <button class="btn btn-sm btn-primary w-100" v-if="order.status_id == 1"> Active </button>
                    <button class="btn btn-sm btn-primary w-100" v-if="order.status_id == 2"> Delivered </button>
                    <button class="btn btn-sm btn-primary w-100" v-if="order.status_id == 3"> Revision </button>
                    <button class="btn btn-sm btn-success w-100" v-if="order.status_id == 4"> Complete </button>
                    <button class="btn btn-sm btn-danger w-100" v-if="order.status_id == 5"> Disputed </button>
                    <button class="btn btn-sm btn-primary w-100" v-if="order.status_id == 6"> Late </button>
                </td>
              </div>
            </div>
          </div>
        </div>
      </div>

    </div>


          <div class="tab-content osahan-table rounded d-none d-sm-block container">
            <div class="tab-pane active" id="active">
                <div v-if="loader" class="d-flex justify-content-center s-margin">
                  <div class="spinner-border text-primary m-2" role="status">
                    <span class="sr-only">Loading...</span>
                  </div>
                </div>
                <div v-else>
                  <div
                  v-if="orders.length"
                  class="table-responsive box-table mt-3 bg-white" 
                  >
                      <table class="table table-bordered" >
                        <thead>
                          <tr>
                            <th class="text-center">USERNAME</th>
                            <th>ORDER DESCRIPTION</th>
                            <th class="text-center">POSTED DATE</th>
                            <th class="text-center">DURATION</th>
                            <th class="text-center">BUDGET</th>
                            <th class="text-center">STATUS</th>
                            <th class="text-center">DETAIL</th>
                          </tr>
                        </thead>
                        <tbody>
                          <tr v-for="order in orders" :key="order.buyer_id">
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
                                <p class="order-proposal-title">
                                  {{ order.description }}
                                </p>
                            </td>
                            <td class="text-center">{{ order.created_at }}</td>
                            <td class="text-center">{{ order.delivery_time }}</td>
                            <td class="text-center">{{ order.amount }}.0{{ order.currency }}</td>
                            <td>
                              <button class="btn btn-sm btn-primary w-100" v-if="order.status_id == 1"> Active </button>
                              <button class="btn btn-sm btn-primary w-100" v-if="order.status_id == 2"> Delivered </button>
                              <button class="btn btn-sm btn-primary w-100" v-if="order.status_id == 3"> Revision </button>
                              <button class="btn btn-sm btn-success w-100" v-if="order.status_id == 4"> Complete </button>
                              <button class="btn btn-sm btn-danger w-100" v-if="order.status_id == 5"> Disputed </button>
                              <button class="btn btn-sm btn-primary w-100" v-if="order.status_id == 6"> Late </button>
                            </td>
                            <td>view</td>
                          </tr>
                        </tbody>
                      </table>
                  </div>
                </div>
            </div>
          </div>
      

      <div v-if="!orders.length" v-show="!loader" class="container text-center py-5">
        <h2>No Any Order Available</h2>
      </div>

  </div>
</template>

<script>
import { onMounted, computed, ref } from "@vue/runtime-core";
import { useStore } from 'vuex';

export default {
  setup() {
    const store = useStore();
    const  buyerOrderURL = "buyer/orders?status=";
    onMounted(() => {
      store.dispatch("myOrders", buyerOrderURL);
    });
    const orderSection = ref(false);
    const orderType = ref({
      order_no: "",
      type: 5,
      description: "i want to cancel the order",
      url: "buyer/manage_order",
    });

    const singleOrder = ref(null);
    const getOrderNumber = (index,orderNo) => {
      orderType.value.order_no = orderNo;
      singleOrder.value = store.getters.myOrders[index];
      console.log("order no", orderNo);
    };

    function showFilter(value) {
      store.dispatch("myOrders", `${buyerOrderURL}${value}`);
    }
    function submitOrder() {
      orderSection.value = true;
    }
    function manage_Order() {
      console.log("manage order", orderType.value);
      store.dispatch("manageOrder", orderType.value);
    }

    return {
      imgURL: process.env.VUE_APP_URL,
      orders: computed(() => store.getters.myOrders),
      loader: computed(() => store.getters.getLoaderVal),
      showFilter,
      orderType,
      getOrderNumber,
      manage_Order,
      singleOrder,
      orderSection,
      submitOrder,
    };
  },
};
</script>

<style scoped>
.loader{
  display: block;
  position: relative;
}
.spinner-border{
  width: 4rem;
  height: 4rem;
}
.s-margin{
  margin-bottom: 8rem;
  margin-top: 5rem ;
}
</style>