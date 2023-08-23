<template>
  <div class="main-page second py-5">
    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <div class="d-flex align-items-center mb-3 pb-3 border-bottom">
            <h2 class="mb-0 p-0">Orders</h2>
            
            
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

          <div
            class="
              tab-content
              osahan-table
              rounded
              px-3
            "
          >
            <div class="tab-pane active" id="active">
                <div v-if="loader" class="text-center loader vh-100">
                  <div class="spinner-border text-primary m-2" role="status">
                    <span class="sr-only">Loading...</span>
                  </div>
                </div>
                <div v-else>
                  <div class="table-responsive box-table mt-3 bg-white">
                      <table class="table table-bordered" >
                        <thead>
                          <tr>
                            <th>USERNAME</th>
                            <th>ORDER DESCRIPTION</th>
                            <th>POSTED DATE</th>
                            <th>DURATION</th>
                            <th>BUDGET</th>
                            <th>STATUS</th>
                          </tr>
                        </thead>
                        <tbody>
                          <tr v-for="order in orders" :key="order.buyer_id">
                            <td>
                              {{ order.username }}
                            </td>
                            <td>
                              <a href="#" class="make-black">
                                <p class="order-proposal-title">
                                  {{ order.description }}
                                </p>
                              </a>
                            </td>
                            <td>{{ order.created_at }}</td>
                            <td>{{ order.delivery_time }}</td>
                            <td>{{ order.amount }}.0{{ order.currency }}</td>
                            <td>
                              <button class="btn btn-sm btn-primary w-100" v-if="order.status_id == 1"> Active </button>
                              <button class="btn btn-sm btn-primary w-100" v-if="order.status_id == 2"> Delivered </button>
                              <button class="btn btn-sm btn-primary w-100" v-if="order.status_id == 3"> Revision </button>
                              <button class="btn btn-sm btn-success w-100" v-if="order.status_id == 4"> Complete </button>
                              <button class="btn btn-sm btn-danger w-100" v-if="order.status_id == 5"> Disputed </button>
                              <button class="btn btn-sm btn-primary w-100" v-if="order.status_id == 6"> Late </button>
                            </td>
                          </tr>
                        </tbody>
                      </table>
                  </div>
                </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import { onMounted, computed } from "@vue/runtime-core";
import store from "../../store";
export default {
  setup() {
    onMounted(() => {
      store.dispatch("showAllOrders");
    })

    function showAll(){
      store.dispatch("showAllOrders");
    }

    function showFilter(value){
      store.dispatch("showFilteredOrders",value);
    }

    return {
      orders: computed(() => store.getters.getAllOrders),
      loader: computed(() => store.getters.getLoaderVal),
      showFilter,
      showAll
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
</style>