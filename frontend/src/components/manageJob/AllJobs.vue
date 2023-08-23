<template>
  <div class="main-page second py-5">
    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <div class="d-flex align-items-center mb-3 pb-3 border-bottom">
            <h2 class="mb-0 p-0">Jobs</h2>
            <router-link
              class="btn btn-sm btn-success ml-auto light"
              to="/buyer/create_job"
            >
              Create a new job
            </router-link>
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
                    <table class="table table-bordered">
                      <thead>
                        <tr>
                          <th>JOB DESCRIPTION</th>
                          <th>POSTED DATE</th>
                          <th>DURATION</th>
                          <th>BUDGET</th>
                          <th>OFFERS</th>
                          <th>ACTION</th>
                        </tr>
                      </thead>
                      <tbody>
                        <tr v-for="job in jobs" :key="job.id">
                          <td>
                            <a href="#" class="make-black">
                              <p class="order-proposal-title">
                                {{ job.description }}
                              </p>
                            </a>
                          </td>
                          <td>{{ job.created_at }}</td>
                          <td>{{ job.delivery_time }} days</td>
                          <td>${{ job.budget }}</td>
                          <td>
                            <button class="btn btn-sm btn-primary">
                              {{ job.total_offers }}
                            </button>
                          </td>
                          <td>
                            <!---------------------    Button trigger modal    -------------------->
                            <button type="button" @click="getJobId(job.id)" class="btn btn-danger" data-toggle="modal" data-target="#exampleModalCenter">
                              Delete
                            </button>
                            <!---------------------    Modal     --------------------->
                            <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                              <div class="modal-dialog modal-dialog-centered" role="document">
                                <div class="modal-content">
                                  <div class="modal-header d-flex justify-content-center">
                                    <h5 class="modal-title" id="exampleModalLongTitle">Delete Job</h5> 
                                  </div>
                                  <div class="modal-body text-center">
                                    Are you sure you want to delete the job?
                                  </div>
                                  <div class="modal-footer d-flex justify-content-center">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
                                    <button type="button" class="btn btn-danger" data-dismiss="modal" @click="deleteJob()">Yes</button>
                                  </div>
                                </div>
                              </div>
                            </div>
                            <!---------------------    Modal End     --------------------->

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
import { onMounted, computed, ref } from "@vue/runtime-core";
import store from "../../store";
export default {
  setup() {
    onMounted(store.dispatch("showAllJobs"));
    
    const jobId = ref('');
    const getJobId = (id) => {
      jobId.value = id
    };

    function deleteJob() {
      store.dispatch("deleteAJob", jobId.value);
      console.log("delete job id: ",jobId.value)
    }
    return {
      jobs: computed(() => store.getters.getAllJobs),
      loader: computed(() => store.getters.getLoaderVal),
      deleteJob,
      getJobId,
      jobId
    };
  },
};
</script>

<style scoped>
.loader{
  display: block;
}
.spinner-border{
  width: 4rem;
  height: 4rem;
}
</style>