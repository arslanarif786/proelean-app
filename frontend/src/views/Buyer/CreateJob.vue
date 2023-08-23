<template>
  <div class="container mt-3 mb-5">
    <div class="row d-flex justify-content-center">
      <div class="col-lg-10">
        <h4 class="font-weight-bold">{{ $t('createJob.job') }}</h4>
        <div class="border-bottom my-2"></div>
        <form>
          <div class="bg-white rounded shadow-sm sidebar-page-right">
            <div class="bg-white rounded p-0">
              <div class="border-bottom p-3">
                <label>{{ $t('createJob.jobDesc') }}
                  <span class="text-danger m-0 p-0">*</span>
                  <span class="text-danger mt-1" v-show="createJobError.description">
                  {{ createJobError.description ? $t('errorMessages.'+ createJobError.description) : '' }}</span></label>
                <div class="form-group">
                  <textarea
                    class="form-control"
                    v-model="createJob.description"
                    name="description"
                    rows="7"
                    :placeholder="$t('createJob.desc')"
                    required
                  ></textarea>
                </div>
              </div>
              <div class="border-bottom p-3">
                <div class="row">
                  <div class="form-group col-md-6">
                <label>{{ $t('createJob.cat') }}:<span class="text-danger m-0 p-0">*</span>
                  <span class="text-danger mt-1" v-show="createJobError.category_id">
                  {{ createJobError.category_id ? $t('errorMessages.'+ createJobError.category_id) : '' }}</span>
                  </label>
                    <select
                      id="category_id"
                      class="form-control"
                      name="category_id"
                      v-model="createJob.category_id"
                      :onchange="getCategory"
                      required
                    >
                    <option selected disabled value="">{{ $t('createJob.sCat') }}</option>
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
                    <label>{{ $t('createJob.subCat') }}:<span class="text-danger m-0 p-0">*</span>
                    <span class="text-danger mt-1" v-show="createJobError.sub_category_id">
                    {{ createJobError.sub_category_id ? $t('errorMessages.'+ createJobError.sub_category_id) : '' }}</span>
                    </label>
                    <select
                      id="sub_category_id"
                      class="form-control"
                      v-model="createJob.sub_category_id"
                      name="sub_category_id"
                      required
                    >
                      <option selected disabled value="">{{ $t('createJob.sSubCat') }}</option>
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
                    <label>{{ $t('createJob.delivery') }}
                        <span class="text-danger m-0 p-0">*</span>
                        <span class="text-danger mt-1" v-show="createJobError.delivery_time">
                        {{ createJobError.delivery_time ? $t('errorMessages.'+ createJobError.delivery_time) : '' }}</span>
                    </label>
                      <select
                        id="delivery_time"
                        class="form-control"
                        name="delivery_time"
                        v-model="createJob.delivery_time"
                        required
                      >
                        <option selected disabled value="">{{ $t('createJob.day') }}</option>
                        <option  
                          v-for="day in $store.getters.getDeliveryDays"
                          :value="day" 
                          :key="day.index"
                        > {{ day }} </option>
                      </select>
                   </div>
                    <div class="form-group col-md-6">
                      <label>{{ $t('createJob.budget') }}
                        <span class="text-danger m-0 p-0">*</span>
                        <span class="text-danger mt-1" v-show="createJobError.budget">
                        {{ createJobError.budget ? $t('errorMessages.'+ createJobError.budget) : '' }}</span>
                        </label>
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
                  @click.prevent="jobCreation"
                  :disabled="!Object.values(createJobError).every((value) => !value) || btnStatus == 2"
                >                                 
                  {{ btnStatus == 2 ? $t('loader.loading') : $t('createJob.submit')  }}
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
import useCreateJob from "@/composables/useCreateJob.js";
import { useStore } from 'vuex';
import { computed, onMounted } from '@vue/runtime-core';
export default {
  setup() {
    const store = useStore()
    
    const {
      createJob,
      getCategory,
      createJobError,
      jobCreation,
      handleCredentials
    } = useCreateJob();

    onMounted(() => {
      store.dispatch("getCountriesLanguage");
    });

    return {
      btnStatus: computed(() => store.getters.getRegisterStatus),
      createJob,
      createJobError,
      jobCreation,
      handleCredentials,
      getCategory,
    };
  },
};
</script>

<style>
</style>