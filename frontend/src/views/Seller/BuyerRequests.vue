<template>
  <div class="container-xl">
    <div class="mb-3">
      <div class="d-flex mb-2 justify-content-between ">
        <div >
        <h1 class="app-page-title mb-0">{{ $t('buyerRequests.title') }}</h1>
        </div>
        <div>
        <select class="form-select form-control-sm" aria-label="Default select example"  @change="showFilter" id="requestValue">
          <option :value="req.value" v-for="req in buyerRequestType" :key="req.index">
            <!-- {{ req.name }} -->
            {{ $t('buyerRequests.'+req.name) }}
          </option>
        </select>
      </div>
      </div>
      <div class="border-bottom my-3"></div>
    </div>
    <div v-if="$store.getters.getBuyerRequestLoader" class="d-flex justify-content-center s-margin">
      <div class="spinner-border text-primary m-5" role="status">
        <span class="sr-only">{{ $t('loader.loading') }}</span>
      </div>
    </div>
    <div v-else>
      <div v-if="$store.getters.getBuyerRequests">
        <div
          class="app-card app-card-notification shadow-sm mb-4"
          v-for="request in $store.getters.getBuyerRequests"
          :key="request.id"
        >
          <div class="app-card-header px-4 py-3 d-flex justify-content-between">
            <div class="row g-3 align-items-center">
              <div class="col-12 col-md-auto text-center text-lg-start">
                <img
                  class="img-fluid rounded-circle mr-2"
                  style="width: 45px; height: 45px; object-fit: cover"
                  :src="`${imgURL}/${request.user.image}`"
                  alt=""
                />
              </div>
              <!--//col-->
              <div class="col-12 marg col-lg-auto text-lg-start">
                <h4 class="notification-title mb-1">
                  {{ request.user.username }}
                </h4>
                <ul class="notification-meta list-inline mb-0">
                  <li class="list-inline-item"> <i class="mdi mdi-clock"></i> {{ $filters.timeAgo(request.created_at) }}</li>
                  <li class="list-inline-item">|</li>
                  <li class="list-inline-item"> <i class="mdi mdi-file"></i> <b> {{ $t('buyerRequests.document') }}: </b> {{ $t('buyerRequests.noAttachment') }}</li>
                  <div class="d-flex flex-column">
                    <li class="list-inline-item d-sm-none"><b> <i class="mdi mdi-clock"></i> {{ $t('buyerRequests.duration') }} : </b> {{ request.delivery_time }}</li>
                    <li class="list-inline-item d-sm-none"><b><i class="mdi mdi-database"></i> {{ $t('buyerRequests.budget') }} : </b>€{{ request.budget }}</li>
                  </div>
                </ul>
              </div>
              <!--//col-->
            </div>
            <!--//row-->
            <div>
              <ul class="notification-meta list-inline mb-0 d-none d-sm-block ">
                <li class="list-inline-item"><b> <i class="mdi mdi-clock"></i> {{ $t('buyerRequests.duration') }} : </b> {{ request.delivery_time }}</li>
                <li class="list-inline-item">|</li>
                <li class="list-inline-item"><b><i class="mdi mdi-database"></i> {{ $t('buyerRequests.budget') }} : </b>€{{ request.budget }}</li>
              </ul>
            </div>
          </div>
          <!--//app-card-header-->
          
          <div class="app-card-body px-4 py-2 text-justify">
            <div class="notification-content">
              {{ request.description }}
            </div>
          </div>
          <!--//app-card-body-->

          <!-- For Web Screen & Tablet -->
          <div class="app-card-footer px-4 py-2 text-center d-none d-sm-block">
            <div style="cursor: default;" type="button"  class="badge back text-dark mr-2 mb-2 p-2">
              {{ request.total_offers }} {{ $t('buyerRequests.offersSent') }}
            </div>
            <div
              class="badge bg-primary cursor-pointer mr-2 mb-2 p-2"
              :style="{ 'pointer-events': request.is_applied ? 'none' : '' }"
              data-toggle="modal"
              data-target="#sendOfferModal"
              @click.prevent="defineOffer(request.id)"
            >
              {{ request.is_applied ? $t('buyerRequests.applied') : $t('buyerRequests.sendOffer') }}
            </div>
            <div
              :disabled="getBtnStatus == request.id"
              class="badge bg-danger cursor-pointer mr-2 mb-2 p-2"
              @click="deleteJob(request.id)"
            >
              {{ getBtnStatus == request.id ? $t('loader.loading') : $t('buyerRequests.cancelOffer') }}
            </div>
          </div>
          <!-- Web Screen & Tablet Section END -->

          <!----- For Mobile Screen ----->
          <div class="app-card-footer px-4 pb-1 text-center d-flex justify-content-center d-sm-none">
            <div style="cursor: default;"  
            class="badge back text-dark mr-2 mb-2 p-2">
              {{ request.total_offers }} {{ $t('buyerRequests.offersSent') }}
            </div>
            <div
              class="badge bg-primary cursor-pointer mr-2 mb-2 p-2"
              :style="{ 'pointer-events': request.is_applied ? 'none' : '' }"
              data-toggle="modal"
              data-target="#sendOfferModal"
              @click.prevent="defineOffer(request.id)"
            >
              {{ request.is_applied ? $t('buyerRequests.applied') : $t('buyerRequests.sendOffer') }}
            </div>
            <div
              :disabled="getBtnStatus == request.id"
              class="badge bg-danger cursor-pointer mb-2 p-2"
              @click="deleteJob(request.id)"
            >
              {{ getBtnStatus == request.id ? $t('loader.loading') : $t('buyerRequests.cancelOffer') }}
            </div>
          </div>
          <!-- Mobile Screen Section END -->

          <!--//app-card-footer-->
         </div>
          <div class="text-center mt-4" v-if="$store.getters.getPages.last_page > 1" >
          <nav aria-label="Page navigation example" >
            <ul class="pagination d-flex justify-content-center">
              <li class="page-item" :class="{disabled:!$store.getters.getLinks.prev}" >
                <a class="page-link d-flex"   @click="previous($store.getters.getPages.current_page)"> <i class="mdi mdi-chevron-left"></i>Previous </a>
              </li>
              <li class="page-item" v-for="page in $store.getters.getPages.last_page" :key="page">
                <a class="page-link"  :class="{activePagination:$store.getters.getPages.current_page == page}"  @click="loadOtherRequest(page)" >{{ page }}</a>
              </li>
              <li class="page-item" :class="{disabled:!$store.getters.getLinks.next}" >
                <a class="page-link d-flex"  @click="next($store.getters.getPages.current_page)" >Next <i class="mdi mdi-chevron-right"></i> </a> 
              </li>
            </ul>
          </nav>
        </div>
      </div>

      <div v-else class="container card shadow-none text-center py-5">
        <h2>{{ $t('buyerRequests.noRequestAvailable') }}</h2>
      </div>
    </div>

    <!-- -------------------    Modal (Send Offer)     --------------------->
      <div
        class="modal fade"
        id="sendOfferModal"
        tabindex="-1"
        role="dialog"
        aria-labelledby="sendOfferModalTitle"
        aria-hidden="true"
      >
        <div class="modal-dialog modal-dialog-centered" role="document">
          <div class="modal-content">
            <div class="modal-header d-flex justify-content-center">
              <h5 class="modal-title" id="exampleModalLongTitle">
                {{ $t('buyerRequests.sendOffer') }}
              </h5>
            </div>
            <div class="modal-body text-center">
              <div class="my-2">
                <div class="text-left font mt-2">{{ $t('buyerRequests.chooseService') }}<span class="text-danger mr-1">*</span>
                  <span class="text-danger" v-show="sendRequestError.service_id">
                  {{ sendRequestError.service_id ? $t('errorMessages.'+ sendRequestError.service_id) : '' }}</span>
                </div>
                <select
                  id="services"
                  class="form-control"
                  name="service"
                  v-model="sendRequest.service_id"
                  required
                >
                  <option selected value="" disabled>{{ $t('buyerRequests.selectService') }}</option>
                  <option
                    v-for="service in $store.getters.getUserServices"
                    :value="service.id"
                    :key="service.id"
                  >
                    {{ service.s_description }}
                  </option>
                </select>
              </div>
              <div class="my-2">
                <div class="text-left font">{{ $t('buyerRequests.describeYourOffer') }}<span class="text-danger mr-1">*</span>
                  <span class="text-danger" v-show="sendRequestError.description">{{ sendRequestError.description ? $t('errorMessages.'+ sendRequestError.description) : '' }}</span>
                </div>
                <textarea
                  type="text"
                  class="form-control"
                  name="description"
                  v-model="sendRequest.description"
                  id="description"
                  :placeholder="$t('buyerRequests.describeYourOffer')"
                  required
                />
              </div>
              <div class="my-2">
                <div class="text-left font mt-2">{{ $t('buyerRequests.totalPrice') }}<span class="text-danger mr-1">*</span>
                  <span class="text-danger" v-show="sendRequestError.price">{{ sendRequestError.price ? $t('errorMessages.'+ sendRequestError.price) : '' }}</span>
                </div>
                <input
                  type="number"
                  class="form-control"
                  name="price"
                  v-model="sendRequest.price"
                  id="price"
                  :placeholder="$t('buyerRequests.totalOffer')"
                  required
                />
              </div>
              <div class="my-2">
                <div class="text-left font mt-2">{{ $t('buyerRequests.deliveryTime') }}<span class="text-danger mr-1">*</span>
                  <span class="text-danger" v-show="sendRequestError.delivery_time">{{ sendRequestError.delivery_time ? $t('errorMessages.'+ sendRequestError.delivery_time) : '' }}</span>
                </div>
                <select
                  id="deliveryTime"
                  class="form-control"
                  name="delivery_time"
                  v-model="sendRequest.delivery_time"
                  required
                >
                  <option selected>{{ $t('buyerRequests.selectDay') }}</option>
                  <option
                    v-for="day in $store.getters.getDeliveryDays"
                    :value="day"
                    :key="day.index"
                  >
                    {{ day }}
                  </option>
                </select>
              </div>
            </div>
            <div class="modal-footer d-flex justify-content-center">
              <button
                type="button"
                class="btn btn-success"
                data-dismiss="modal"
                @click.prevent="sendOffer()"
                :disabled="!Object.values(sendRequestError).every(value => !value)"
              >
                {{ $t('buyerRequests.sendOffer') }}
              </button>
              <button
                type="button"
                class="btn btn-secondary"
                data-dismiss="modal"
              >
                {{ $t('bool.cancel') }}
              </button>
            </div>
          </div>
        </div>
      </div>
    <!----------------------    Modal End     ------------------- -->
  </div>
</template>



<script>
import { computed, onBeforeMount, onMounted } from "vue";
import { useStore } from "vuex";
import useBuyerRequest from '@/composables/useSeller/useBuyerRequest.js'

export default {
  setup() {
    const store = useStore();
    onBeforeMount(() => store.dispatch("showBuyerRequests",requestType.value));
    onMounted(()=>{
      store.dispatch("getCountriesLanguage");
      store.dispatch("userServices");
    })
    const{
      pages,
      requestType,
      previous,
      next,
      showFilter,
      sendRequest,
      sendRequestError,
      loadOtherRequest,
      defineOffer,
      sendOffer,
      deleteJob,
      jobId,
    } = useBuyerRequest();

    const buyerRequestType = [
        { value: 0, name: "Buyer Request" },
        { value: 1, name: "Sent Offer" },
    ];

    return {
      pages,
      previous,
      requestType,
      next,
      buyerRequestType,
      showFilter,
      getBtnStatus: computed(() => store.getters.getRegisterStatus),
      imgURL: process.env.VUE_APP_URL,
      sendRequest,
      sendRequestError,
      loadOtherRequest,
      defineOffer,
      sendOffer,
      deleteJob,
      jobId,
    };
    },
};
</script>

<style scoped>

.activePagination{
  background-color:#2cdd9b;
  color: #fff !important;
  pointer-events: none 
}

.marg{
  margin-left: -15px;
}

.back{
  background-color: rgba(235, 229, 229, 0.822);
}

</style>
