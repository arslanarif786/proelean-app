<template>
  <div class="container py-3">
    <div class="row d-flex justify-content-center">
      <div class="col-lg-10">
        <h4 class="font-weight-bold pb-2">Create a Job</h4>
        <form>
          <div class="bg-white rounded shadow-sm sidebar-page-right">
            <div class="bg-white rounded p-0">
              <div class="border-bottom p-3">
                <label>Describe the job</label>
                <div class="form-group">
                  <textarea
                    class="form-control"
                    v-model="createJob.description"
                    name="description"
                    rows="7"
                    placeholder="Description.."
                    required
                  ></textarea>
                </div>
              </div>
              <div class="border-bottom p-3">
                <label>Choose a category:</label>
                <div class="row">
                  <div class="form-group col-md-6">
                    <select
                      id="category"
                      class="form-control"
                      name="category_id"
                      :onchange="onChange"
                      required
                    >
                    <option selected>Select Category</option>
                      <option
                        v-for="category in $store.getters.getCategories"
                        :value="category.id"
                        :key="category.id"
                      >
                        {{ category.title }}
                      </option>

                    </select>
                  </div>
                  <div class="form-group col-md-6">
                    <select
                      id="sub_category"
                      class="form-control"
                      name="sub_category_id"
                      v-model="createJob.sub_category_id"
                      required
                    >
                          <option
                            v-for="subCategory in $store.getters.getSubCategories"
                            :value="subCategory.id"
                            :key="subCategory.id"
                          >
                            {{ subCategory.title }}
                          </option>
                      
                    </select>
                  </div>
                </div>
              </div>
              <div class="border-bottom p-3">
                <label>Delivery Time</label>
                <div class="form-group col-md-5">
                  <select
                    id="inputState"
                    class="form-control"
                    name="delivery_time"
                    v-model="createJob.delivery_time"
                    :onchange="onChange"
                    required
                  >
                    <option selected>Select day</option>
                    <option value="1">1 day</option>
                    <option value="2">2 day</option>
                    <option value="3">3 day</option>
                    <option value="4">4 day</option>
                    <option value="5">5 day</option>
                    <option value="6">6 day</option>
                    <option value="7">7 day</option>
                    <!-- <option
                        v-for="day in 30"
                        :value='day'
                        :key='day'
                      >
                        {{ day }} day
                      </option> -->
                    
                  </select>
                </div>
              </div>
              <div class="border-bottom p-3">
                <label>What's your budget? </label>
                <div class="input-group mb-2 col-md-5 p-0">
                  <div class="input-group-prepend">
                    <div class="btn btn-success">$</div>
                  </div>
                  <input
                    type="number"
                    class="form-control"
                    name="price"
                    v-model="createJob.budget"
                    id="inlineFormInputGroup"
                    required
                  />
                </div>
              </div>
              <div class="p-3 d-flex justify-content-end">
                <button
                  class="btn btn-success btn-lg font-weight-bold"
                  @click.prevent="jobCreation"
                >
                  Submit Request
                </button>
              </div>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
</template>

<script>
import useBuyer from "@/composables/useBuyer.js";
import store from '../../store'
export default {
  setup() {
    const {
      data,
      createJob,
      jobCreation,
      handleCredentials
    } = useBuyer();

    const onChange = () => {
      data.value.categoryId = document.getElementById("category").value;
      store.dispatch("loadSubCategories", data.value.categoryId);
    };

    return {
      createJob,
      jobCreation,
      handleCredentials,
      onChange,
    };
  },
};
</script>

<style>
</style>