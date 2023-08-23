<template>
   
    <div class="row g-3 mb-3 align-items-center justify-content-between">
      <div class="col-auto">
        <h1 class="app-page-title mb-0">Orders</h1>
      </div>
      <div class="col-7">
        <div class="page-utilities">
          <div
            class="
              row
              g-2
              justify-content-start justify-content-md-end
              align-items-center
            "
          >
            <div class="col-8">
              <form class="table-search-form gx-1 align-items-center">
                <div class="col-auto">
                  <input
                    type="text"
                    id="search-orders"
                    name="searchorders"
                    v-model="buyerName"
                    class="form-control search-orders"
                    placeholder="Search"
                  />
                </div>
              </form>
            </div>
            <!--//col-->
            
            
          </div>
          <!--//row-->
        </div>
        <!--//table-utilities-->
      </div>
      <!--//col-auto-->
    </div>
    <!--//row-->
    <div class="border-bottom mb-3"></div>

    <nav
      id="orders-table-tab"
      class="
        orders-table-tab
        app-nav-tabs
        nav
        shadow-sm
        flex-column flex-sm-row
        mb-2
      "
    >
      <a
        class="flex-sm-fill text-sm-center nav-link active"
        id="orders-all-tab"
        data-bs-toggle="tab"
        href="#orders-all"
        role="tab"
        aria-controls="orders-all"
        aria-selected="true"
        @click="showFilter(0)"
        >All</a
      >
      <a
        class="flex-sm-fill text-sm-center nav-link"
        id="orders-paid-tab"
        data-bs-toggle="tab"
        href="#orders-all"
        role="tab"
        aria-controls="orders-paid"
        aria-selected="false"
        @click="showFilter(4)"
        >Completed</a
      >
      <a
        class="flex-sm-fill text-sm-center nav-link"
        id="orders-pending-tab"
        data-bs-toggle="tab"
        href="#orders-all"
        role="tab"
        aria-controls="orders-pending"
        aria-selected="false"
        @click="showFilter(1)"
        >Active</a
      >
      <a
        class="flex-sm-fill text-sm-center nav-link"
        id="orders-pending-tab"
        data-bs-toggle="tab"
        href="#orders-all"
        role="tab"
        aria-controls="orders-pending"
        aria-selected="false"
        @click="showFilter(2)"
        >Delivered</a
      >
      <a
        class="flex-sm-fill text-sm-center nav-link"
        id="orders-pending-tab"
        data-bs-toggle="tab"
        href="#orders-all"
        role="tab"
        aria-controls="orders-pending"
        aria-selected="false"
        @click="showFilter(3)"
        >Revision</a
      >
      <a
        class="flex-sm-fill text-sm-center nav-link"
        id="orders-pending-tab"
        data-bs-toggle="tab"
        href="#orders-all"
        role="tab"
        aria-controls="orders-pending"
        aria-selected="false"
        @click="showFilter(6)"
        >Late</a
      >
      <a
        class="flex-sm-fill text-sm-center nav-link"
        id="orders-cancelled-tab"
        data-bs-toggle="tab"
        href="#orders-all"
        role="tab"
        aria-controls="orders-cancelled"
        aria-selected="false"
        @click="showFilter(5)"
        >Disputed</a
      >
    </nav>

    <div class="tab-content" id="orders-table-tab-content">
      <div
        class="tab-pane fade show active"
        id="orders-all"
        role="tabpanel"
        aria-labelledby="orders-all-tab"
      >
        <div v-if="loader" class="d-flex justify-content-center s-margin">
          <div class="spinner-border text-primary m-2" role="status">
            <span class="sr-only">Loading...</span>
          </div>
        </div>
        <div v-else class="app-card app-card-orders-table shadow-sm mb-5">
          <div class="app-card-body">
            <div class="table-responsive  flex-width-center">
              <div class="m-5 text-center" v-if="!orders.length > 0">
                <h5>No any orders available in this field</h5>
                <figure class="py-3 m-0">
                  <img src="/assets/seller/images/svg-icons/notfound.svg" alt="notfound" width="150">
                </figure>
              </div>
              <table v-else class="table app-table-hover mb-0 p-1 text-left">
                <thead>
                  <tr>
                    <th class="cell text-center bold">User</th>
                    <th class="cell bold">Order Description</th>
                    <th class="cell bold">Duration</th>
                    <th class="cell text-center bold">Post Date</th>
                    <th class="cell text-center bold">Budget</th>
                    <th class="cell text-center bold">Status</th>
                    <th class="cell"></th>
                  </tr>
                </thead>
                <tbody>
                  <tr v-for="order in orders" :key="order.id">
                    <td class="text-center cell">
                      <div>
                        <img
                          class="img-fluid bg-info rounded-circle mb-1"
                          style="width: 35px; height: 35px; object-fit: cover"
                          :src="`${imgURL}/${order.image}`"
                          alt="img"
                        />
                      </div>
                      <div class="py-2"> 
                       <strong> {{ order.username }}</strong>
                      </div>
                    </td>
                    <td class="cell">
                      <span class="truncate">{{
                        order.description.substr(0, 50)
                      }}</span>
                    </td>
                    <td class="cell">
                      <span class="truncate">{{ order.created_at }}</span>
                    </td>
                    <td class="text-center cell">
                      <span class="truncate">{{ order.delivery_time }}</span>
                    </td>
                    <td class="text-center cell">
                      <span class="truncate">€{{ order.amount }}</span>
                    </td>
                    <td class="text-center cell">
                      <a
                        ><span
                          class="badge bg-success"
                          v-if="order.status_id == 1"
                          >Active</span
                        ></a
                      >
                      <a
                        ><span
                          class="badge bg-secondary"
                          v-if="order.status_id == 2"
                          >Delivered</span
                        ></a
                      >
                      <a
                        ><span class="badge bg-info" v-if="order.status_id == 3"
                          >Revision</span
                        ></a
                      >
                      <a
                        ><span
                          class="badge bg-primary"
                          v-if="order.status_id == 4"
                          >Completed</span
                        ></a
                      >
                      <a
                        ><span
                          class="badge bg-danger"
                          v-if="order.status_id == 5"
                          >Disputed</span
                        ></a
                      >
                      <a
                        ><span
                          class="badge bg-warning"
                          v-if="order.status_id == 6"
                          >Late</span
                        ></a
                      >
                    </td>
                    <td class="cell">
                      <!-- Button trigger modal -->
                      <!-- params:{id:order} , props:{order} -->
                      <router-link :to="{name:'OrderDetails', params:order}"
                        class="btn btn-light">
                        View 
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
      </div>
    </div>
 
</template>

<script>
import { onMounted, computed, ref} from "@vue/runtime-core";
import { useStore } from "vuex";

export default {
  setup() {
    const store = useStore();
    const sellerOrderURL = "seller/orders?status=";

    onMounted(() => {
      store.dispatch("myOrders", sellerOrderURL);
    });
    const buyerName = ref()

    function showFilter(value) {
      store.dispatch("myOrders", `${sellerOrderURL}${value}`);
    }
    return {
      buyerName,
      imgURL: process.env.VUE_APP_URL,
      orders: computed(() => store.getters.myOrders),
      loader: computed(() => store.getters.getLoaderVal),
      showFilter,
    };
  },
};
</script>

<style scoped>
.s-margin {
  margin-bottom: 8rem;
  margin-top: 5rem;
}
.bold{
  font-weight: bolder !important;
}
</style>