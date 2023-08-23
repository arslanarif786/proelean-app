<template>
  <div class="container-xl">
    <div class="row g-3 mb-2 align-items-center justify-content-between">
      <div class="col-auto">
        <h1 class="app-page-title mb-0">My Services</h1>
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
            <!--//col-->
            <!-- <div class="col-auto">
              <router-link
                class="btn app-btn-secondary"
                to="/dashboard/favourite_service"
                >My Favourite Services</router-link
              >
            </div> -->
            <div class="col-auto">
              <router-link
                class="btn app-btn-primary"
                to="/dashboard/create-gig"
                >Create Service</router-link
              >
            </div>
          </div>
          <!--//row-->
        </div>
        <!--//table-utilities-->
      </div>
      <!--//col-auto-->
    </div>

    <!--//row-->
    <div class="border-bottom mb-2"></div>
    <div class="row my-3 recommended d-flex flex-wrap justify-content-start">
      <Loader v-if="$store.getters.getLoadingStatus === 'LOADING'" />
      <div
        class="col-6 col-md-4 mb-3 col-xxl-3 service-list-section"
        v-for="service in userServices"
        :key="service.id"
        v-else
      >
        <Service @selectService="selectService" :service="service" />
      </div>
    </div>
  </div>

<!-- Confirmation Modal -->
  <div
    class="modal fade"
    id="exampleModalCenter"
    tabindex="-1"
    role="dialog"
    aria-labelledby="exampleModalCenterTitle"
    aria-hidden="true"
  >
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header d-flex justify-content-center">
          <h5 class="modal-title" id="exampleModalLongTitle">Delete Service</h5>
        </div>
        <div class="modal-body text-center">
          Are you sure you want to delete the service?
        </div>
        <div class="modal-footer d-flex justify-content-center">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">
            No
          </button>
          <button
            type="button"
            class="btn btn-danger"
            data-dismiss="modal"
            @click.prevent="deleteService"
          >
            Yes
          </button>
        </div>
      </div>
    </div>
  </div>
</template>


<script>
import { useStore } from "vuex";
import { onMounted, computed, ref } from "vue";
import Service from "@/components/Service.vue";
import Loader from "@/components/loadingComponent.vue";
export default {
  components: { Service, Loader },
  setup() {
    const store = useStore();
    onMounted(store.dispatch("userServices", ""));

    const selectedService = ref({});

    const selectService = (service) => {
      selectedService.value = service;
    };

    const deleteService = () => {
      store.dispatch('deleteService', selectedService.value.id)
    };

    return {
      user: computed(() => store.getters.getAuthUser),
      userServices: computed(() => store.getters.getUserServices),
      selectService,
      selectedService,
      deleteService,
    };
  },
};
</script>