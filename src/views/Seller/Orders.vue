<template>
  <div class="container-xl">
    <div class="row g-3 mb-3 align-items-center justify-content-between">
      <div class="col-auto">
        <h1 class="app-page-title mb-0">{{ $t("seller_orders.title") }}</h1>
      </div>
      <div class="col-7">
        <div class="page-utilities">
          <div
            class="
              row
              g-2
              mr-1
              justify-content-end
              align-items-center
            "
          >
            <div class="col-6 padding-minus">
              <form class="table-search-form align-items-center">
                  <input
                    type="text"
                    id="search-orders"
                    name="searchorders"
                    v-model="searchQuery"
                    class="form-control search-orders"
                    :placeholder="$t('seller_orders.search')"
                  />
              </form>
            </div>
            <!-- //col -->
            <div class="col-6 padding-minus d-sm-none">
              <select class="form-select-md form-control border border-light" aria-label="Default select example"  @change="filteration" id="ordersValue">
                <option :value="order.value" v-for="order in OrderSelectionType" :key="order.index">
                  {{ order.name }}
                </option>
              </select>
            </div>
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
        d-none d-sm-flex
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
        >{{ $t("seller_orders.all") }}</a
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
        >{{ $t("seller_orders.completed") }}</a
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
        >{{ $t("seller_orders.active") }}</a
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
        >{{ $t("seller_orders.delivered") }}</a
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
        >{{ $t("seller_orders.revision") }}</a
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
        >{{ $t("seller_orders.late") }}</a
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
        >{{ $t("seller_orders.disputed") }}</a
      >
    </nav>

    <!-- FOr Web Screen -->
    <div class="tab-content d-none d-sm-block" id="orders-table-tab-content">
      <div
        class="tab-pane fade show active"
        id="orders-all"
        role="tabpanel"
        aria-labelledby="orders-all-tab"
      >
        <div v-if="loader" class="d-flex justify-content-center s-margin">
          <div class="spinner-border text-primary m-2" role="status">
            <span class="sr-only">{{ $t("loader.loading") }}</span>
          </div>
        </div>
        <div v-else class="app-card app-card-orders-table shadow-sm mb-5">
          <div class="app-card-body">
            <div class="table-responsive">
              <div v-if="orders.length > 0">
                <table class="table app-table-hover mb-0 p-1 text-left">
                  <thead>
                    <tr>
                      <th class="cell text-center bold">{{ $t("seller_orders.user") }}</th>
                      <th class="cell bold">{{ $t("seller_orders.orderDescription") }}</th>
                      <th class="cell bold">{{ $t("seller_orders.duration") }}</th>
                      <th class="cell text-center bold">{{ $t("seller_orders.deliveryTime") }}</th>
                      <th class="cell text-center bold">{{ $t("seller_orders.budget") }}</th>
                      <th class="cell text-center bold">{{ $t("seller_orders.status") }}</th>
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
                        <span class="truncate"> {{ moment.utc(order.end_date).fromNow() }} </span>
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
                            class="badge bg-success cursor-pointer-2"
                            v-if="order.status_id == 1"
                            >{{ $t("seller_orders.active") }}</span
                          ></a
                        >
                        <a
                          ><span
                            class="badge bg-secondary cursor-pointer-2"
                            v-if="order.status_id == 2"
                            >{{ $t("seller_orders.delivered") }}</span
                          ></a
                        >
                        <a
                          ><span
                            class="badge bg-info cursor-pointer-2"
                            v-if="order.status_id == 3"
                            >{{ $t("seller_orders.revision") }}</span
                          ></a
                        >
                        <a
                          ><span
                            class="badge bg-primary cursor-pointer-2"
                            v-if="order.status_id == 4"
                            >{{ $t("seller_orders.completed") }}</span
                          ></a
                        >
                        <a
                          ><span
                            class="badge bg-danger cursor-pointer-2"
                            v-if="order.status_id == 5"
                            >{{ $t("seller_orders.disputed") }}</span
                          ></a
                        >
                        <a
                          ><span
                            class="badge bg-warning cursor-pointer-2"
                            v-if="order.status_id == 6"
                            >{{ $t("seller_orders.late") }}</span
                          ></a
                        >
                      </td>
                      <td class="cell">
                        <!-- Button trigger modal -->
                        <!-- params:{id:order} , props:{order} -->
                        <router-link
                          :to="{ name: 'OrderDetails', params: order }"
                          class="btn btn-light"
                        >
                          {{ $t("seller_orders.view") }}
                        </router-link>
                      </td>
                    </tr>
                  </tbody>
                </table>
              </div>
              <div v-else class="m-5 text-center">
                <h4>{{ $t("seller_orders.noOrderAvailable") }}</h4>
                <figure class="py-3 m-0">
                  <img
                    src="/assets/seller/images/svg-icons/notfound.svg"
                    alt="notfound"
                    width="150"
                  />
                </figure>
              </div>
            </div>
            <!--//table-responsive-->
          </div>
          <!--//app-card-body-->
        </div>
      </div>
    </div>
    <!-- Web Screen END -->


    <!-- For Mobile Screen (CARD) -->
      <div class="d-sm-none">
        <div v-if="loader" class="d-flex justify-content-center s-margin">
          <div class="spinner-border text-primary m-2" role="status">
            <span class="sr-only">{{ $t("loader.loading") }}</span>
          </div>
        </div>
        <div v-else>
           <div v-if="orders.length>0">
            <div
              v-for="order in orders"
              :key="order.id"
              class="card shadow-sm border-primary"
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
                  <div class="d-flex align-items-center" v-if="order.status_id == 1"> <button class="badge bg-success border border-success cursor-pointer-2"> {{ $t("seller_orders.active") }} </button> </div>
                  <div class="d-flex align-items-center" v-if="order.status_id == 2"> <button class="badge bg-secondary border border-secondary cursor-pointer-2"> {{ $t("seller_orders.delivered") }}</button> </div>
                  <div class="d-flex align-items-center" v-if="order.status_id == 3"> <button class="badge bg-info border border-info cursor-pointer-2"> {{ $t("seller_orders.revision") }} </button> </div>
                  <div class="d-flex align-items-center" v-if="order.status_id == 4"> <button class="badge bg-primary border border-primary cursor-pointer-2"> {{ $t("seller_orders.completed") }} </button> </div>
                  <div class="d-flex align-items-center" v-if="order.status_id == 5"> <button class="badge bg-danger border border-danger cursor-pointer-2"> {{ $t("seller_orders.disputed") }} </button> </div>
                  <div class="d-flex align-items-center" v-if="order.status_id == 6"> <button class="badge bg-warning border border-warning cursor-pointer-2"> {{ $t("seller_orders.late") }} </button> </div>
                </div>
                  <div class="d-flex flex-column">
                    <div class=""> <i class="mdi mdi-clock"></i> <b> {{ $t("seller_orders.dueIn") }}: </b> {{ moment.utc(order.end_date).fromNow() }} </div> 
                    <div class=""> <i class="mdi mdi-database"></i> <b> {{ $t("seller_orders.price") }} : </b> {{ order.currency }}{{ order.amount }}</div> 
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
                    {{ $t("seller_orders.view") }}
                    </router-link>
                </div>
            </div>
            </div>
           </div>
          <div v-else class="card shadow-none m-4 py-3 text-center">
                    <h5>{{ $t("seller_orders.noOrderAvailable") }} </h5>
                    <figure class="py-3 m-0">
                      <img
                        src="/assets/seller/images/svg-icons/notfound.svg"
                        alt="notfound"
                        width="150"
                      />
                    </figure>
          </div>
        </div>
    </div>
    <!-- For Mobile Screen END -->

  </div>
</template>


<script>
import { onMounted, computed, ref } from "@vue/runtime-core";
import moment from "moment";
import { useStore } from "vuex";

export default {
  setup() {
    const store = useStore();
    const sellerOrderURL = "seller/orders?status=";
    const searchQuery = ref();
    onMounted(() => {
      store.dispatch("myOrders", sellerOrderURL);
    });
    computed(() => console.log(searchQuery.value));

    const OrderSelectionType =  [ 
      { value: 0, name:"All" },
      { value: 1, name:"Active" },
      { value: 2, name:"Delivered" },
      { value: 3, name:"Revision" },
      { value: 4, name:"Complete" },
      { value: 5, name:"Dispute" },
      { value: 6, name:"Late" },
    ]

    function filteration() {
      let value = document.getElementById("ordersValue").value;
      console.log("value", value);
      store.dispatch("myOrders", `${sellerOrderURL}${value}`);
    }

    const showFilter = (value) => {
      store.dispatch("myOrders", `${sellerOrderURL}${value}`);
    };

    const orders = computed(() => {
      if (!store.getters.getMyOrders.length || !searchQuery.value) {
        return store.getters.getMyOrders;
      }
      const query = searchQuery.value.toLowerCase();
      return store.getters.getMyOrders.filter(
        (order) =>
          order.username.toLowerCase().includes(query) ||
          (order.description && order.description.toLowerCase().includes(query))
      );
    });
    return {
      searchQuery,
      imgURL: process.env.VUE_APP_URL,
      orders,
      OrderSelectionType,
      filteration,
      // orders: computed(() => store.getters.getMyOrders),
      loader: computed(() => store.getters.getLoaderVal),
      showFilter, moment
    };
  },
};
</script>

<style scoped>
.s-margin {
  margin-bottom: 8rem;
  margin-top: 5rem;
}
.bold {
  font-weight: bolder !important;
}

.padding-minus{
  padding: 0px 2px 0px 2px;
}

.margin-minus{
   margin-left: -6px;
}

</style>