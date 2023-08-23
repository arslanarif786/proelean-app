<template>
  
    <div class="row g-3 mb-4 align-items-center justify-content-between">
      <div class="col-auto">
        <h1 class="app-page-title mb-0">Payments</h1>
      </div>
      
      <div class="col-auto">
        <div class="page-utilities">
          <div
            class="
              row
              g-2
              justify-content-start justify-content-md-end
              align-items-center
            "
          >
            <div class="col-auto">
              <form class="table-search-form row gx-1 align-items-center">
                <div class="col-auto">
                  <input
                    type="text"
                    id="search-orders"
                    name="searchorders"
                    class="form-control search-orders"
                    placeholder="Search"
                  />
                </div>
                <div class="col-auto">
                  <button type="submit" class="btn app-btn-secondary">
                    Search
                  </button>
                </div>
              </form>
            </div>
            <!--//col-->
            <div class="col-auto">
              <select class="form-select w-auto">
                <option selected="" value="option-1">All</option>
                <option value="option-2">This week</option>
                <option value="option-3">This month</option>
                <option value="option-4">Last 3 months</option>
              </select>
            </div>
            <div class="col-auto">
              <a class="btn app-btn-secondary" href="#">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-bank" viewBox="0 0 16 16">
  <path d="M8 .95 14.61 4h.89a.5.5 0 0 1 .5.5v2a.5.5 0 0 1-.5.5H15v7a.5.5 0 0 1 .485.379l.5 2A.5.5 0 0 1 15.5 17H.5a.5.5 0 0 1-.485-.621l.5-2A.5.5 0 0 1 1 14V7H.5a.5.5 0 0 1-.5-.5v-2A.5.5 0 0 1 .5 4h.89L8 .95zM3.776 4h8.447L8 2.05 3.776 4zM2 7v7h1V7H2zm2 0v7h2.5V7H4zm3.5 0v7h1V7h-1zm2 0v7H12V7H9.5zM13 7v7h1V7h-1zm2-1V5H1v1h14zm-.39 9H1.39l-.25 1h13.72l-.25-1z"/>
</svg>
                Bank Transfer
              </a>
            </div>
          </div>
          <!--//row-->
        </div>
        <!--//table-utilities-->
      </div>
      <!--//col-auto-->
    </div>
    <div class="border-bottom my-3"></div>
    <!--//row-->

   

    <div class="tab-content" id="orders-table-tab-content">
      <div
        class="tab-pane fade show active"
        id="orders-all"
        role="tabpanel"
        aria-labelledby="orders-all-tab"
      >
        <div class="app-card app-card-orders-table shadow-sm mb-5">
          <div class="app-card-body">
            <div class="table-responsive">
              <table class="table app-table-hover mb-0 text-left">
                <thead>
                  <tr>
                    <th class="cell">Order</th>
                    <th class="cell">Product</th>
                    <th class="cell">Customer</th>
                    <th class="cell">Date</th>
                    <th class="cell">Status</th>
                    <th class="cell">Total</th>
                    <th class="cell"></th>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <td class="cell">#15346</td>
                    <td class="cell">
                      <span class="truncate"
                        >Lorem ipsum dolor sit amet eget volutpat erat</span
                      >
                    </td>
                    <td class="cell">John Sanders</td>
                    <td class="cell">
                      <span>17 Oct</span><span class="note">2:16 PM</span>
                    </td>
                    <td class="cell">
                      <span class="badge bg-success">Paid</span>
                    </td>
                    <td class="cell">$259.35</td>
                    <td class="cell">
                      <a class="btn-sm app-btn-secondary" href="#">View</a>
                    </td>
                  </tr>
                  <tr>
                    <td class="cell">#15345</td>
                    <td class="cell">
                      <span class="truncate">Consectetur adipiscing elit</span>
                    </td>
                    <td class="cell">Dylan Ambrose</td>
                    <td class="cell">
                      <span class="cell-data">16 Oct</span
                      ><span class="note">03:16 AM</span>
                    </td>
                    <td class="cell">
                      <span class="badge bg-warning">Pending</span>
                    </td>
                    <td class="cell">$96.20</td>
                    <td class="cell">
                      <a class="btn-sm app-btn-secondary" href="#">View</a>
                    </td>
                  </tr>
                  <tr>
                    <td class="cell">#15344</td>
                    <td class="cell">
                      <span class="truncate">Pellentesque diam imperdiet</span>
                    </td>
                    <td class="cell">Teresa Holland</td>
                    <td class="cell">
                      <span class="cell-data">16 Oct</span
                      ><span class="note">01:16 AM</span>
                    </td>
                    <td class="cell">
                      <span class="badge bg-success">Paid</span>
                    </td>
                    <td class="cell">$123.00</td>
                    <td class="cell">
                      <a class="btn-sm app-btn-secondary" href="#">View</a>
                    </td>
                  </tr>

                  <tr>
                    <td class="cell">#15343</td>
                    <td class="cell">
                      <span class="truncate"
                        >Vestibulum a accumsan lectus sed mollis ipsum</span
                      >
                    </td>
                    <td class="cell">Jayden Massey</td>
                    <td class="cell">
                      <span class="cell-data">15 Oct</span
                      ><span class="note">8:07 PM</span>
                    </td>
                    <td class="cell">
                      <span class="badge bg-success">Paid</span>
                    </td>
                    <td class="cell">$199.00</td>
                    <td class="cell">
                      <a class="btn-sm app-btn-secondary" href="#">View</a>
                    </td>
                  </tr>

                  <tr>
                    <td class="cell">#15342</td>
                    <td class="cell">
                      <span class="truncate">Justo feugiat neque</span>
                    </td>
                    <td class="cell">Reina Brooks</td>
                    <td class="cell">
                      <span class="cell-data">12 Oct</span
                      ><span class="note">04:23 PM</span>
                    </td>
                    <td class="cell">
                      <span class="badge bg-danger">Cancelled</span>
                    </td>
                    <td class="cell">$59.00</td>
                    <td class="cell">
                      <a class="btn-sm app-btn-secondary" href="#">View</a>
                    </td>
                  </tr>

                  <tr>
                    <td class="cell">#15341</td>
                    <td class="cell">
                      <span class="truncate"
                        >Morbi vulputate lacinia neque et sollicitudin</span
                      >
                    </td>
                    <td class="cell">Raymond Atkins</td>
                    <td class="cell">
                      <span class="cell-data">11 Oct</span
                      ><span class="note">11:18 AM</span>
                    </td>
                    <td class="cell">
                      <span class="badge bg-success">Paid</span>
                    </td>
                    <td class="cell">$678.26</td>
                    <td class="cell">
                      <a class="btn-sm app-btn-secondary" href="#">View</a>
                    </td>
                  </tr>
                </tbody>
              </table>
            </div>
            <!--//table-responsive-->
          </div>
          <!--//app-card-body-->
        </div>
        <!--//app-card-->
        <nav class="app-pagination">
          <ul class="pagination justify-content-center">
            <li class="page-item disabled">
              <a class="page-link" href="#" tabindex="-1" aria-disabled="true"
                >Previous</a
              >
            </li>
            <li class="page-item active">
              <a class="page-link" href="#">1</a>
            </li>
            <li class="page-item"><a class="page-link" href="#">2</a></li>
            <li class="page-item"><a class="page-link" href="#">3</a></li>
            <li class="page-item">
              <a class="page-link" href="#">Next</a>
            </li>
          </ul>
        </nav>
        <!--//app-pagination-->
      </div>
      <!--//tab-pane-->

      <div
        class="tab-pane fade"
        id="orders-paid"
        role="tabpanel"
        aria-labelledby="orders-paid-tab"
      >
        <div class="app-card app-card-orders-table mb-5">
          <div class="app-card-body">
            <div class="table-responsive">
              <table class="table mb-0 text-left">
                <thead>
                  <tr>
                    <th class="cell">Order</th>
                    <th class="cell">Product</th>
                    <th class="cell">Customer</th>
                    <th class="cell">Date</th>
                    <th class="cell">Status</th>
                    <th class="cell">Total</th>
                    <th class="cell"></th>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <td class="cell">#15346</td>
                    <td class="cell">
                      <span class="truncate"
                        >Lorem ipsum dolor sit amet eget volutpat erat</span
                      >
                    </td>
                    <td class="cell">John Sanders</td>
                    <td class="cell">
                      <span>17 Oct</span><span class="note">2:16 PM</span>
                    </td>
                    <td class="cell">
                      <span class="badge bg-success">Paid</span>
                    </td>
                    <td class="cell">€259.35</td>
                    <td class="cell">
                      <a class="btn-sm app-btn-secondary" href="#">View</a>
                    </td>
                  </tr>

                  <tr>
                    <td class="cell">#15344</td>
                    <td class="cell">
                      <span class="truncate">Pellentesque diam imperdiet</span>
                    </td>
                    <td class="cell">Teresa Holland</td>
                    <td class="cell">
                      <span class="cell-data">16 Oct</span
                      ><span class="note">01:16 AM</span>
                    </td>
                    <td class="cell">
                      <span class="badge bg-success">Paid</span>
                    </td>
                    <td class="cell">€123.00</td>
                    <td class="cell">
                      <a class="btn-sm app-btn-secondary" href="#">View</a>
                    </td>
                  </tr>

                  <tr>
                    <td class="cell">#15343</td>
                    <td class="cell">
                      <span class="truncate"
                        >Vestibulum a accumsan lectus sed mollis ipsum</span
                      >
                    </td>
                    <td class="cell">Jayden Massey</td>
                    <td class="cell">
                      <span class="cell-data">15 Oct</span
                      ><span class="note">8:07 PM</span>
                    </td>
                    <td class="cell">
                      <span class="badge bg-success">Paid</span>
                    </td>
                    <td class="cell">€199.00</td>
                    <td class="cell">
                      <a class="btn-sm app-btn-secondary" href="#">View</a>
                    </td>
                  </tr>

                  <tr>
                    <td class="cell">#15341</td>
                    <td class="cell">
                      <span class="truncate"
                        >Morbi vulputate lacinia neque et sollicitudin</span
                      >
                    </td>
                    <td class="cell">Raymond Atkins</td>
                    <td class="cell">
                      <span class="cell-data">11 Oct</span
                      ><span class="note">11:18 AM</span>
                    </td>
                    <td class="cell">
                      <span class="badge bg-success">Paid</span>
                    </td>
                    <td class="cell">€678.26</td>
                    <td class="cell">
                      <a class="btn-sm app-btn-secondary" href="#">View</a>
                    </td>
                  </tr>
                </tbody>
              </table>
            </div>
            <!--//table-responsive-->
          </div>
          <!--//app-card-body-->
        </div>
        <!--//app-card-->
      </div>
      <!--//tab-pane-->

   
  
    </div>
    <!--//tab-content-->
 
</template>

<script>
import { onMounted, computed } from "@vue/runtime-core";
import { useStore } from "vuex";

export default {
  setup() {
    const store = useStore();
    onMounted(() => {
      store.dispatch("myOrders");
    });

    function showAll() {
      store.dispatch("myOrders");
    }

    function showFilter(value) {
      store.dispatch("showFilteredOrders", value);
    }

    return {
      imgURL: process.env.VUE_APP_URL,
      orders: computed(() => store.getters.getMyOrders),
      loader: computed(() => store.getters.getLoaderVal),
      showFilter,
      showAll,
    };
  },
};
</script>

<style scoped>
.s-margin {
  margin-bottom: 8rem;
  margin-top: 5rem;
}
</style>