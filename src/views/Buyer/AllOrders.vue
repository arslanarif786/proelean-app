<template>
  <div class="main-page second pt-3">
    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <div class="d-flex align-items-center justify-content-between mb-3 border-bottom">
            <h3 class="font-weight-bold mb-3">Orders</h3>            
              <select class="form-select form-control-sm" aria-label="Default select example"  @change="showFilter" id="ordersValue">
                <option :value="order.value" v-for="order in OrderSelectionType" :key="order.index">
                  {{ order.name }}
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
                <div>
                    <button class="btn btn-sm btn-primary w-100" v-if="order.status_id == 1"> Active </button>
                    <button class="btn btn-sm btn-primary w-100" v-if="order.status_id == 2"> Delivered </button>
                    <button class="btn btn-sm btn-primary w-100" v-if="order.status_id == 3"> Revision </button>
                    <button class="btn btn-sm btn-success w-100" v-if="order.status_id == 4"> Completed </button>
                    <button class="btn btn-sm btn-danger w-100" v-if="order.status_id == 5"> Disputed </button>
                    <button class="btn btn-sm btn-primary w-100" v-if="order.status_id == 6"> Late </button>
                </div>
                <span class="ml-2">
                              <!-- Button trigger modal -->
                              <button
                                type="button"
                                class="btn btn-light"
                                data-bs-toggle="modal"
                                data-bs-target="#exampleModalMobile"
                                @click="getOrderNumber(order.orderNo)"
                              >
                                View
                              </button>

                            </span>
              </div>
            </div>
          </div>
        </div>
      </div>
          <!-- Mob Screen END -->


          <!-- For Web Screen -->
          <div v-if="orders.length>0" class="tab-content osahan-table rounded d-none d-sm-block container">
            <div class="tab-pane active" id="active">
                <div v-if="loader" class="d-flex justify-content-center s-margin">
                  <div class="spinner-border text-primary m-2" role="status">
                    <span class="sr-only">Loading...</span>
                  </div>
                </div>
                <div v-else>
                  <div
                  class="table-responsive box-table mt-1 bg-white mb-5" 
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
                            <th class="text-center">DETAILS</th>
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
                            <td class="text-center">
                              <!-- Button trigger modal -->
                              <button
                                type="button"
                                class="btn btn-light"
                                data-bs-toggle="modal"
                                data-bs-target="#exampleModal"
                                @click="getOrderNumber(order.orderNo)"
                              >
                                View
                              </button>
                            </td>
                          </tr>
                        </tbody>
                      </table>
                  </div>
                </div>
            </div>
          </div>
          <!-- Web Screen END -->
      
      <div v-else v-show="!loader" class="container tab-content text-center py-5">
        <h2>No Any Order Available</h2>
      </div>


<!--=== Modal ----->
                              <div
                                class="modal fade"
                                id="exampleModalMobile"
                                tabindex="-1"
                                aria-labelledby="exampleModalMobileLabel"
                                aria-hidden="true"
                              >
                                <div class="modal-dialog modal-dialog-centered">
                                  <div class="modal-content" v-if="singleOrder && !orderSection">
                                    <div class="modal-header">
                                      <h5 class="modal-title" id="exampleModalMobileLabel">
                                        Order Detail
                                      </h5>
                                    </div>
                                    <div class="modal-body d-flex flex-column">
                                      <div class="row">
                                        <div class="col-3 text-dark">Order</div>
                                        <div class="col-9 text-left">{{ singleOrder.orderNo }}</div>
                                      </div>
                                      <div class="row">
                                        <div class="col-3 col-sm-4 text-dark">Description</div>
                                        <div class="col-9 col-sm-8 text-left">
                                          {{ singleOrder.description }}
                                        </div>
                                      </div>
                                      <div class="row">
                                        <div class="col-3 text-dark">Seller</div>
                                        <div class="col-9 text-left">{{ singleOrder.username }}</div>
                                      </div>
                                      <div class="row">
                                        <div class="col-3 text-dark">Price</div>
                                        <div class="col-9 text-left">{{ singleOrder.amount }}</div>
                                      </div>
                                      <div class="row">
                                        <div class="col-3 text-dark">Revisions</div>
                                        <div class="col-9 text-left">{{ singleOrder.revision }}</div>
                                      </div>
                                      <div class="row">
                                        <div class="col-3 text-dark">Duration</div>
                                        <div class="col-9 text-left">
                                          {{ singleOrder.delivery_time }}
                                        </div>
                                      </div>
                                    </div>
                                    <div class="modal-footer">
                                      <button
                                        type="button"
                                        class="btn btn-secondary"
                                        data-bs-dismiss="modal"
                                      >
                                        Close
                                      </button>
                                      <button
                                        type="button"
                                        v-if="singleOrder.status_id == 1"
                                        class="btn btn-danger"
                                        @click="submitOrder()"
                                      >
                                        Dispute Order
                                      </button>
                                    </div>
                                  </div>

                                  <div class="modal-content" v-else>
                                    <div class="modal-header">
                                      <h5 class="modal-title" id="exampleModalMobileLabel">
                                        Order Detail
                                      </h5>
                                    </div>
                                    <div class="modal-body">
                                      <textarea
                                        type="text"
                                        class="form-control"
                                        name="description"
                                        v-model="orderType.description"
                                        id="description"
                                        placeholder="Type description"
                                        required
                                      />
                                    </div>
                                    <div class="modal-footer">
                                      <button
                                        type="button"
                                        class="btn btn-secondary"
                                        data-bs-dismiss="modal"
                                      >
                                        Close
                                      </button>
                                      <button
                                        type="button"
                                        v-if="order.status_id == 1 || order.status_id == 5"
                                        class="btn btn-danger"
                                        data-bs-dismiss="modal"
                                        @click="manage_Order()"
                                      >
                                        Submit
                                      </button>
                                    </div>
                                  </div>
                                </div>
                              </div>
<!----- Modal End ----->

<!----- Modal ----->
                              <div
                                class="modal fade"
                                id="exampleModal"
                                tabindex="-1"
                                aria-labelledby="exampleModalLabel"
                                aria-hidden="true"
                              >
                                <div class="modal-dialog modal-dialog-centered">
                                  <div class="modal-content" v-if="singleOrder && !orderSection">
                                    <div class="modal-header">
                                      <h5 class="modal-title" id="exampleModalLabel">
                                        Order Detail
                                      </h5>
                                    </div>
                                    <div class="modal-body d-flex flex-column">
                                      <div class="row">
                                        <div class="col-2 text-dark">Order</div>
                                        <div class="col-10 text-left">{{ singleOrder.orderNo }}</div>
                                      </div>
                                      <div class="row">
                                        <div class="col-2 text-dark">Description</div>
                                        <div class="col-10 text-left">
                                          {{ singleOrder.description }}
                                        </div>
                                      </div>
                                      <div class="row">
                                        <div class="col-2 text-dark">Seller</div>
                                        <div class="col-10 text-left">{{ singleOrder.username }}</div>
                                      </div>
                                      <div class="row">
                                        <div class="col-2 text-dark">Price</div>
                                        <div class="col-10 text-left">{{ singleOrder.amount }}</div>
                                      </div>
                                      <div class="row">
                                        <div class="col-2 text-dark">Revisions</div>
                                        <div class="col-10 text-left">{{ singleOrder.revision }}</div>
                                      </div>
                                      <div class="row">
                                        <div class="col-2 text-dark">Duration</div>
                                        <div class="col-10 text-left">
                                          {{ singleOrder.delivery_time }}
                                        </div>
                                      </div>
                                    </div>
                                    <div class="modal-footer">
                                      <button
                                        type="button"
                                        class="btn btn-secondary"
                                        data-bs-dismiss="modal"
                                      >
                                        Close
                                      </button>
                                      <button
                                        type="button"
                                        v-if="singleOrder.status_id == 1"
                                        class="btn btn-danger"
                                        @click="submitOrder()"
                                      >
                                        Dispute Order
                                      </button>
                                    </div>
                                  </div>

                                  <div class="modal-content" v-else>
                                    <div class="modal-header">
                                      <h5 class="modal-title" id="exampleModalLabel">
                                        Order Detail
                                      </h5>
                                    </div>
                                    <div class="modal-body">
                                      <textarea
                                        type="text"
                                        class="form-control"
                                        name="description"
                                        v-model="orderType.description"
                                        id="description"
                                        placeholder="Type description"
                                        required
                                      />
                                    </div>
                                    <div class="modal-footer">
                                      <button
                                        type="button"
                                        class="btn btn-secondary"
                                        data-bs-dismiss="modal"
                                      >
                                        Close
                                      </button>
                                      <button
                                        type="button"
                                        v-if="order.status_id == 1 || order.status_id == 5"
                                        class="btn btn-danger"
                                        data-bs-dismiss="modal"
                                        @click="manage_Order()"
                                      >
                                        Submit
                                      </button>
                                    </div>
                                  </div>
                                </div>
                              </div>
<!----- Modal End ----->

</template>

<script>
import { onMounted, computed, ref } from "@vue/runtime-core";
import { useStore } from 'vuex';

export default {
  setup() {
    const store = useStore()
    const buyerOrderURL = "buyer/orders?status=";
    onMounted(() => {
      store.dispatch("myOrders", buyerOrderURL);
    });
    const orderSection = ref(false);
    
    const OrderSelectionType =  [ 
      { value: 0, name:"All" },
      { value: 1, name:"Active" },
      { value: 2, name:"Delivered" },
      { value: 3, name:"Revision" },
      { value: 4, name:"Complete" },
      { value: 5, name:"Dispute" },
      { value: 6, name:"Late" },
    ]
    const orderType = ref({
      order_no: "",
      type: 5,
      description: "i want to cancel the order",
      url: "buyer/manage_order",
    });

    const singleOrder = ref(null);
    const getOrderNumber = (orderNo) => {
      orderType.value.order_no = orderNo;
      singleOrder.value = store.getters.myOrders.find(order => order.orderNo === orderNo);
      console.log("singleOrder", singleOrder.value);
    };

    function showFilter() {
      let value = document.getElementById("ordersValue").value;
      console.log("value", value);
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
      OrderSelectionType,
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
.s-margin{
  margin-bottom: 8rem;
  margin-top: 5rem ;
}

</style>