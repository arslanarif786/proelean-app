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
                      <option selected>Select Sub Category</option>
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
                 <div class="row">
                    <div class="form-group col-md-6">
                    <label>Delivery Time</label>
                      <select
                        id="inputState"
                        class="form-control"
                        name="delivery_time"
                        v-model="createJob.delivery_time"
                        :onchange="onChange"
                        required
                      >
                        <option selected>Select day</option>
                        <option  
                          v-for="day in $store.getters.getDeliveryDays"
                          :value="day" 
                          :key="day.index"
                        > {{ day }} </option>
                        
                      </select>
                   </div>
                    <div class="form-group col-md-6">
                      <label>What's your budget? </label>
                        <div class="input-group">
                          <div class="input-group-prepend">
                            <div class="btn btn-success">€</div>
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
                 </div>
               </div>
              <div class="p-3 d-flex justify-content-end">
                <button
                  class="btn btn-success btn-lg font-weight-bold"
                  :disabled="getBtnStatus == 2"
                  @click.prevent="jobCreation"
                >
                  {{ getBtnStatus == 2 ? "Loading..." : "Submit Request"  }}
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
import { useStore } from 'vuex';
import { computed, onMounted } from '@vue/runtime-core';
export default {
  setup() {
    const store = useStore()
    const {
      data,
      createJob,
      jobCreation,
      handleCredentials
    } = useBuyer();

    onMounted(() => {
      store.dispatch("getCountriesLanguage");
    });

    const onChange = () => {
      data.value.categoryId = document.getElementById("category").value;
      store.dispatch("loadSubCategories", data.value.categoryId);
    };

    return {
      getBtnStatus: computed(() => store.getters.getRegisterStatus),
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