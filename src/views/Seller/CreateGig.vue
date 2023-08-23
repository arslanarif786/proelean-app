<template>
  <div class="container-xl">
    <h1 class="app-page-title mb-2">{{ $t('createService.title') }}</h1>
    <div class="border-bottom mb-3"></div>
    <div class="row g-4 settings-section">
      <div class="col-12 col-md-12">
        <div class="app-card app-card-settings shadow-sm p-4">
          <div class="app-card-body">
            <form class="settings-form">
              <div class="mb-3">
                <label for="setting-input-1" class="form-label"
                  >{{ $t('createService.enterYourTitle') }}
                  <span class="text-danger m-0 p-0">*</span>
                  <span class="text-danger mt-1" v-show="createServiceError.s_description">
                  {{ createServiceError.s_description ? $t('errorMessages.'+ createServiceError.s_description) : '' }}
                  </span>
                </label>
                <input
                  type="text"
                  class="form-control"
                  id="setting-input-1"
                  v-model="createService.s_description"
                  name="s_description"
                  :placeholder="$t('createService.iWillCreate')"
                  required
                />
              </div>
              <div class="mb-3">
                <label for="setting-input-2" class="form-label"
                  >{{ $t('createService.describeYourServices') }}
                  <span class="text-danger m-0 p-0">*</span>
                  <span class="text-danger mt-1" v-show="createServiceError.description">
                  {{ createServiceError.description ? $t('errorMessages.'+ createServiceError.description) : '' }}</span>
                  </label
                >
                <div class="form-group">
                  <textarea
                    class="form-control"
                    v-model="createService.description"
                    name="description"
                    rows="4"
                    :placeholder="$t('createService.describeAboutYourService')"
                    required
                  ></textarea>
                </div>
              </div>
              <div class="mb-5">
                <label for="setting-input-2" class="form-label"
                  >{{ $t('createService.uploadImages') }}
                  <span style="font-size: 12px;font-weight: 500;">{{ $t('createService.perfectThumbnailSize') }} (650*350)</span>
                    <span class="text-danger m-0 p-0">*</span>
                    <span class="text-danger mt-1" v-show="createServiceError.banner">
                    <!-- {{ createServiceError.banner }} -->
                    {{ createServiceError.banner ? $t('errorMessages.'+ createServiceError.banner) : '' }}
                    </span>
                  </label
                >
                <div class="wrapper d-flex flex-wrap justify-content-center align-items-center">
                  <div
                    v-show="bannersBase64.length < 4"
                    class="file-upload mr-2"
                    @click="$refs.bannerInput.click()"
                  >
                    <i class="fa fa-arrow-up cursor-pointer"></i>
                    <input
                      type="file"
                      ref="bannerInput"
                      id="bannerInput"
                      style="display: none"
                      accept="image/*"
                      @change="selectThumbnail"
                      required
                    />
                  </div>
                  <div v-for="(banner, index) in bannersBase64" :key="index">
                    <div
                      class="cursor-pointer position-relative"
                      style="
                        height: 90px;
                        width: 90px;
                        border: 1px solid grey;
                        margin-left: 10px;
                        background-size: cover;
                      "
                      :style="`background-image: url(${banner});`"
                    >
                      <i
                        @click="removeImage(index)"
                        class="mdi mdi-close-box position-absolute"
                        style="top: 1%; right: 1%; font-size: 16px; color: red"
                      ></i>
                    </div>
                    <!-- <div class="gigs-thumbnail" >
                      <img  src="{banner}" class="gigs-thumbnail-img"/>
                    </div> -->
                  </div>
                </div>
              </div>

              <div class="mb-3">
                <div class="row">
                  <div class="form-group col-md-6">
                    <label for="setting-input-2" class="form-label"
                      >{{ $t('createService.chooseACategory') }}
                      <span class="text-danger m-0 p-0">*</span>
                      <span class="text-danger mt-1" v-show="createServiceError.category_id">
                      <!-- {{ createServiceError.category_id }} -->
                      {{ createServiceError.category_id ? $t('errorMessages.'+ createServiceError.category_id) : '' }}
                      </span>
                      </label
                    >
                    <select
                      id="category"
                      class="form-control"
                      name="category_id"
                      :placeholder="$t('createService.selectCategory')"
                      data-msg="Please select category."
                      v-model="createService.category_id"
                      :onchange="getCategory"
                      required=""
                    >
                      <option selected disabled="" value="">{{ $t('createService.selectCategory') }}</option>
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
                    <label for="setting-input-2" class="form-label"
                      >{{ $t('createService.chooseASubCategory') }}
                      <span class="text-danger m-0 p-0">*</span>
                      <span class="text-danger mt-1" v-show="createServiceError.sub_category_id">
                      <!-- {{ createServiceError.sub_category_id }} -->
                      {{ createServiceError.sub_category_id ? $t('errorMessages.'+ createServiceError.sub_category_id) : '' }}
                      </span>
                      </label>
                    <select
                      style="width:100%"
                      id="subCategory"
                      class="form-control shadow-none"
                      name="category_id"
                      v-model="createService.sub_category_id"
                      required
                    >
                      <option disabled="" value="">{{ $t('createService.selectSubCategory') }}</option>
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
              <div class="mb-3">
                <div class="row">
                  <div class="form-group col-md-6">
                    <label for="setting-input-2" class="form-label"
                      >{{ $t('createService.deliveryDays') }}
                      <span class="text-danger m-0 p-0">*</span>
                      <span class="text-danger mt-1" v-show="createServiceError.delivery_time">
                      <!-- {{ createServiceError.delivery_time }} -->
                      {{ createServiceError.delivery_time ? $t('errorMessages.'+ createServiceError.delivery_time) : '' }}
                      </span>
                      </label
                    >
                    <select
                      id="deliveryTime"
                      class="form-control"
                      name="delivery_time"
                      :placeholder="$t('createService.selectCategory')"
                      v-model="createService.delivery_time"
                      data-msg="Please select category."
                      required=""
                    >
                      <option disabled="" value="">{{ $t('createService.selectDays') }}</option>
                      <option
                        v-for="day in $store.getters.getDeliveryDays"
                        :value="day"
                        :key="day.index"
                      >
                        {{ day }}
                      </option>
                    </select>
                  </div>
                  <div class="form-group col-md-6">
                    <label for="setting-input-2" class="form-label"
                      >{{ $t(`createService.whatsYourBudget`) }}?
                      <span class="text-danger m-0 p-0">*</span>
                      <span class="text-danger mt-1" v-show="createServiceError.price">
                      <!-- {{ createServiceError.price }} -->
                      {{ createServiceError.price ? $t('errorMessages.'+ createServiceError.price) : '' }}
                      </span>
                      </label
                    >
                    <div class="input-group">
                      <div
                        class="input-group-prepend d-flex align-items-center"
                      >
                        <div class="btn app-btn-secondary">€</div>
                      </div>
                      <input
                        type="number"
                        class="form-control"
                        name="price"
                        v-model="createService.price"
                        required=""
                      />
                    </div>
                  </div>
                </div>
              </div>
              <div class="mb-3">
                <div class="row">
                  <div class="form-group col-md-6">
                    <label for="setting-input-2" class="form-label"
                      >{{ $t('createService.noOfRevisions') }}
                      <span class="text-danger m-0 p-0">*</span>
                      <span class="text-danger mt-1" v-show="createServiceError.revision">
                      <!-- {{ createServiceError.revision }} -->
                      {{ createServiceError.revision ? $t('errorMessages.'+ createServiceError.revision) : '' }}
                      </span>
                      </label>
                      <select
                        id="revision"
                        class="form-control"
                        name="delivery_time"
                        :placeholder="$t('createService.selectCategory')"
                        v-model="createService.revision"
                        data-msg="Please select category."
                        required=""
                      >
                        <option disabled="" selected value="">{{ $t('createService.selectRevisions') }}</option>
                        <option
                        v-for="revision in $store.getters.getRevisions" :key="revision"
                        :value="revision"
                        >{{ revision }}</option>
                      </select>
                    </div>
                </div>
              </div>
              <div class="mb-3">
                <label for="setting-input-2" class="form-label"
                  >{{ $t('createService.additionalInfo') }}
                  </label
                >
                <div class="form-group">
                  <textarea
                    class="form-control"
                    v-model="createService.additional_info"
                    name="description"
                    rows="4"
                    :placeholder="$t('createService.describeAboutYourService')"
                    required
                  ></textarea>
                </div>
              </div>
              <button
                class="btn app-btn-primary"
                @click.prevent="gigCreation"
                :disabled="!Object.values(createServiceError).every(value => !value) || btnStatus == 2"
              >
                {{ btnStatus === 2 ? $t('loader.loading') : $t('createService.create') }}
              </button>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import useCreateService from "@/composables/useSeller/useCreateService";
import { computed, onBeforeMount } from "@vue/runtime-core";
import { useStore } from "vuex";

export default {
  setup() {
    const store = useStore();
    const {
      createService,
      createServiceError,
      data,
      bannersBase64,
      gigCreation,
      selectThumbnail,
      removeImage,
      getCategory,
      encodeImageFileAsURL,
    } = useCreateService();

    onBeforeMount(() => store.dispatch("getCountriesLanguage"));

    return {
      btnStatus: computed(() => store.getters.getRegisterStatus),
      createService,
      createServiceError,
      getCategory,
      data,
      gigCreation,
      selectThumbnail,
      bannersBase64,
      removeImage,
      encodeImageFileAsURL,
    };
  },
};
</script>

<style scoped>
.wrapper {
  width: 100%;
  background: #fafbff;
  height: 100%;
  padding: 10px;
 
 
}
.wrapper .file-upload {
  height: 100px;
  width: 100px;
  border-radius: 100px;
  position: relative;
  display: flex;
  justify-content: center;
  align-items: center;
  border: 4px solid #fff;
  overflow: hidden;
  background-image: linear-gradient(to bottom, #2590eb 50%, #fff 50%);
  background-size: 100% 200%;
  transition: all 1s;
  color: #fff;
  font-size: 100px;
}
.wrapper .file-upload input[type="file"] {
  height: 200px;
  width: 200px;
  position: absolute;
  top: 0;
  left: 0;
  opacity: 0;
  cursor: pointer;
}
.wrapper .file-upload:hover {
  background-position: 0 -100%;
  color: #2590eb;
}

.gigs-thumbnail{
  height: 100px;
  width: 100px;
  border: 1px solid red;
}
gigs-thumbnail-img{
  height: 100%;
  width: 100%;
  overflow: hidden;
  object-fit: cover;

}

</style>