<template>
  <div>
    <section class="py-5 ">
      <div class="container ">
        <div class="row d-flex justify-content-center">
          <div class="col-lg-9">
            <h4 class="font-weight-bold pb-3">Create Serivce</h4>
            <form>
              <div class="bg-white rounded shadow-sm sidebar-page-right">
                <div class="bg-white rounded p-0">
                  <div class="border-bottom p-3">
                    <label>Enter Your Title</label>
                    <!-- @error('s_description')
                           <span style="color:red">{{$message}}</span>
                           @enderror -->
                    <div class="form-group">
                      <input
                        type="text"
                        v-model="createGig.s_description"
                        name="s_description"
                        class="form-control"
                        placeholder="I will create"
                        required
                      />
                    </div>
                    <label>Describe your service</label>
                    <!-- @error('description')
                              <span style="color:red">{{$message}}</span>
                              @enderror -->
                    <div class="form-group">
                      <textarea
                        class="form-control"
                        v-model="createGig.description"
                        name="description"
                        rows="7"
                        placeholder="Describe About Your Serivce"
                        required
                      ></textarea>
                    </div>

                    <div class="d-flex">
                      <div
                        class="
                          cursor-pointer
                          d-flex
                          justify-content-center
                          align-items-center
                        "
                        @click="$refs.bannerInput.click()"
                        style="
                          height: 80px;
                          width: 80px;
                          border: 1px solid grey;
                        "
                      >
                        <i
                          style="font-size: 32px"
                          class="fa fa-file-image-o"
                        ></i>

                        <input
                          type="file"
                          multiple
                          ref="bannerInput"
                          id="bannerInput"
                          style="display: none"
                          @change="selectThumbnail"
                          required
                        />
                      </div>

                      <div
                        v-for="(banner, index) in bannersBase64"
                        :key="index"
                      >
                        <div
                          class="
                            cursor-pointer
                            position-relative
                          "
                          style="
                            height: 80px;
                            width: 80px;
                            border: 1px solid grey;
                            margin-left:20px;
                            background-size:cover;
                          "
                          :style="`background-image: url(${banner});`"
                        >
                          <i @click="removeImage(index)" class="fa fa-close position-absolute" style="top:1%; right:1%; font-size:16px; color:red"></i>
                        </div>
                      </div>
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
                          data-msg="Please select category."
                          :onchange="getCategory"
                          required
                        >
                          <option selected >
                            Select Category
                          </option>
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
                          id="subCategory"
                          class="form-control"
                          name="category_id"
                          v-model="createGig.sub_category_id"
                          required
                        >
                          <option selected disabled>
                            Select Sub Category
                          </option>
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
                    <div class="form-group col-md-6">
                      <select
                        id="deliveryTime"
                        class="form-control"
                        name="delivery_time"
                        required
                      >
                        <option selected disabled>Select day</option>
                        <option  
                        v-for="day in $store.getters.getDeliveryDays"
                        :value="day" 
                        :key="day.index"
                        >{{ day }} </option>
                      </select>
                    </div>
                  </div>
                  <div class="border-bottom p-3">
                    <label>What is your budget for this service?</label>
                    <div class="input-group mb-2 col-md-4 p-0">
                      <div class="input-group-prepend">
                        <div class="btn btn-success">$</div>
                      </div>
                      <input
                        type="number"
                        class="form-control"
                        name="price"
                        v-model="createGig.price"
                        id="inlineFormInputGroup"
                        required
                      />
                    </div>
                  </div>
                  <div class="p-3 d-flex justify-content-end">
                    <button
                      class="btn btn-success btn-lg font-weight-bold"
                      @click.prevent="gigCreation"
                    >
                      {{registerStatus == 2 ? 'Loading...' : 'Create'}}
                    </button>
                  </div>
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>
    </section>
  </div>
</template>

<script>
import useSeller from '@/composables/useSeller.js'
import { computed, onBeforeMount } from '@vue/runtime-core';
import store from '../../store';
export default {
  setup() {
const { createGig,
        data,
        bannersBase64,
        gigCreation,
        selectThumbnail,
        removeImage,
        getCategory,
        encodeImageFileAsURL } = useSeller();

      onBeforeMount(() => store.dispatch("getCountriesLanguage"))

    return {
      registerStatus: computed(() => store.getters.getRegisterStatus),
      createGig,
      getCategory,
      data,
      gigCreation,
      selectThumbnail,
      bannersBase64,
      removeImage,
      encodeImageFileAsURL
    };  },
};
</script>

<style>
</style>