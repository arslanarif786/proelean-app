<template>
  <div class="py-4">
    <div class="container">
      <div class="row d-flex justify-content-center">
        <main class="col-md-8">
          <div>
            <h3>{{ $t('becomeASeller.title') }}</h3>
          </div>
          <form>
            <div class="shadow-sm rounded bg-white mb-3">
              <div class="box-title border-bottom p-3">
                <h6 class="m-0">{{ $t('becomeASeller.basicInfo') }}</h6>
              </div>
              <div class="box-body p-3">
                <div class="row">
                  <div class="col-sm-6 mb-2">
                    <div class="js-form-message">
                      <label id="titleLabel" class="form-label">
                        {{ $t('becomeASeller.freelancerTitle') }}
                        <span class="text-danger">*</span>
                        <span
                          class="text-danger"
                          v-if="dataErrors.freelancer_title"
                          >
                          <!-- {{ dataErrors.freelancer_title }} -->
                          {{ dataErrors.freelancer_title ? $t('errorMessages.'+ dataErrors.freelancer_title) : '' }}</span
                        >
                      </label>
                      <div class="form-group">
                        <input
                          type="text"
                          required
                          class="form-control"
                          name="freelancer_title"
                          :placeholder="$t('becomeASeller.enterYourFreelancerTitle')"
                          aria-label="Enter your freelancer title"
                          aria-describedby="titleLabel"
                          data-msg="Please enter a valid title."
                          data-error-class="u-has-error"
                          data-success-class="u-has-success"
                          v-model="data.freelancer_title"
                        />
                      </div>
                    </div>
                  </div>

                  <div class="col-sm-6 mb-2">
                    <div class="js-form-message">
                      <label class="form-label">
                        {{ $t('becomeASeller.preferredLanguage') }}
                        <span class="text-danger">*</span>
                        <span class="text-danger" v-if="dataErrors.lang">
                        {{ dataErrors.lang ? $t('errorMessages.'+ dataErrors.lang) : '' }}</span>
                      </label>
                      <div class="form-group">
                        <select
                          class="custom-select w-100"
                          id="language"
                          :onchange="selectLanguage"
                        >
                          <option selected>{{ $t('becomeASeller.selectLanguage') }}</option>
                          <option
                            v-for="language in $store.getters.getLanguages"
                            :key="language"
                            :value="language"
                          >
                            {{ language }}
                          </option>
                        </select>
                      </div>
                    </div>
                  </div>
                  <!-- End Input -->
                </div>

                <div class="row">
                  <div class="col-sm-6 mb-2">
                    <div class="js-form-message">
                      <label class="form-label">
                        {{ $t('becomeASeller.availability') }}
                        <span class="text-danger">*</span>
                        <span
                          class="text-danger"
                          v-if="dataErrors.availability"
                          >
                          {{ dataErrors.availability ? $t('errorMessages.'+ dataErrors.availability) : '' }}</span
                        >
                      </label>
                      <div class="form-group">
                        <select
                          class="custom-select w-100"
                          id="availability"
                          :onchange="selectAvailability"
                        >
                          <option selected>{{ $t('becomeASeller.selectAvailability') }}</option>
                          <option value="full time">{{ $t('becomeASeller.fullTime') }}</option>
                          <option value="part time">{{ $t('becomeASeller.partTime') }}</option>
                        </select>
                      </div>
                    </div>
                  </div>

                  <div class="col-sm-6 mb-2">
                    <div class="js-form-message">
                      <label class="form-label">
                        {{ $t('becomeASeller.country') }}
                        <span class="text-danger">*</span>
                        <span
                          class="text-danger"
                          v-if="dataErrors.country_id"
                          >
                          {{ dataErrors.country_id ? $t('errorMessages.'+ dataErrors.country_id) : '' }}</span
                        >
                      </label>
                      <div class="form-group">
                        <select
                          class="custom-select w-100"
                          id="country"
                          :onchange="selectCountry"
                        >
                          <option selected>{{ $t('becomeASeller.selectCountry') }}</option>
                          <option
                            v-for="country in $store.getters.getCountries"
                            :value="country.id"
                            :key="country.id"
                          >
                            {{ country.name }}
                          </option>
                        </select>
                      </div>
                    </div>
                  </div>
                </div>
                <!-- End Input -->
              </div>
            </div>
            <div class="shadow-sm rounded bg-white mb-3">
              <div class="box-title border-bottom p-3 pb-2">
                <h6 class="m-0">{{ $t('becomeASeller.about') }}</h6>
              </div>

              <div class="box-body">
                <div class="p-3">
                  <div class="form-group mb-4">
                    <label class="mb-1">{{ $t('becomeASeller.BIO') }}</label>
                    <span class="text-danger">*</span>
                    <span class="text-danger" v-if="dataErrors.description">
                      <!-- {{ dataErrors.description }} -->
                      {{ dataErrors.description ? $t('errorMessages.'+ dataErrors.description) : '' }}
                    </span>
                    <div class="position-relative">
                      <textarea
                        class="form-control"
                        rows="4"
                        name="description"
                        min="15"
                        :placeholder="$t('becomeASeller.enterBio')"
                        v-model="data.description"
                      ></textarea>
                    </div>
                  </div>
                  <div class="d-flex justify-content-center">
                    <label for="cnin">{{ $t('becomeASeller.CNICFrontImage') }}</label>
                    <span class="text-danger">*</span>
                    <span class="text-danger" v-if="dataErrors.cinic">
                    <!-- {{
                      dataErrors.cinic
                    }} -->
                    {{ dataErrors.cinic ? $t('errorMessages.'+ dataErrors.cinic) : '' }}
                    </span>
                  </div>
                  <div
                    class="
                      upload-cnic
                      d-flex
                      position-relative
                      align-items-center
                      justify-content-center
                      mx-auto
                    "
                    :style="`background-image: url(${preview})`"
                  >
                    <i
                      v-if="!data.cinic"
                      @click="$refs.cnicInput.click()"
                      class="mdi mdi-image-plus cursor-pointer"
                      style="font-size: 20px"
                    ></i>
                    <input
                      type="file"
                      ref="cnicInput"
                      accept="image/*"
                      @change="handleCinic($event)"
                      style="display: none"
                    />
                    <i
                      v-if="data.cinic"
                      @click="removeImage()"
                      class="mdi mdi-close-box position-absolute cursor-pointer"
                      style="top: 1%; right: 1%; font-size: 16px; color: red"
                    ></i>
                  </div>
                </div>
              </div>
            </div>
            <div class="shadow-sm rounded bg-white mb-3">
              <div class="box-title border-bottom p-3">
                <h6 class="m-0">{{ $t('becomeASeller.category') }}</h6>
              </div>
              <div class="box-body px-3 pt-3 pb-0">
                <div class="row">
                  <div class="col-sm-6 mb-2">
                    <div class="js-form-message">
                      <label class="form-label">
                        {{ $t('becomeASeller.category') }}
                        <span class="text-danger">*</span>
                        <span class="text-danger" v-if="dataErrors.category_id">
                          <!-- {{ dataErrors.category_id }} -->
                          {{ dataErrors.category_id ? $t('errorMessages.'+ dataErrors.category_id) : '' }}
                        </span>
                      </label>
                      <div class="form-group">
                        <select
                          class="form-control custom-select"
                          id="category"
                          data-msg="Please select category."
                          :data-error-class="dataErrors.categoryId"
                          data-success-class="u-has-success"
                          :onchange="onCategorySelected"
                        >
                          <option
                            v-for="category in $store.getters.getCategories"
                            v-bind:value="category.id"
                            :key="category.id"
                          >
                            {{ category.title }}
                          </option>
                        </select>
                      </div>
                    </div>
                  </div>

                  <div class="col-sm-6 mb-2">
                    <div class="js-form-message">
                      <label class="form-label">
                        {{ $t('becomeASeller.subCategory') }}
                        <span class="text-danger">*</span>
                        <span
                          class="text-danger"
                          v-if="dataErrors.sub_category_id"
                        >
                          <!-- {{ dataErrors.sub_category_id }} -->
                          {{ dataErrors.sub_category_id ? $t('errorMessages.'+ dataErrors.sub_category_id) : '' }}
                        </span>
                      </label>
                      <div class="form-group">
                        <select
                          class="form-control custom-select"
                          id="subcategoryID"
                          data-msg="Please select your gender."
                          data-error-class="u-has-error"
                          data-success-class="u-has-success"
                          :onchange="selectSubCategory"
                          :disabled="subCatLoader"
                        >
                          <option value="SubCatSelect1" selected="">
                            {{ $t('becomeASeller.selectSubCategory') }}
                          </option>
                          <option
                            v-for="subCategory in $store.getters
                              .getSubCategories"
                            :value="subCategory.id"
                            :key="subCategory.id"
                          >
                            {{ subCategory.title }}
                          </option>
                        </select>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <!-- <div class="shadow-sm rounded bg-white mb-3">
              <div class="box-title border-bottom p-3">
                <h6 class="m-0">Social profiles</h6>
                <p class="mb-0 mt-0 small">
                  Add elsewhere links to your profile.
                </p>
              </div>
              <div class="box-body">
                <div class="p-3">
                  <div class="position-relative icon-form-control mb-2">
                    <i
                      class="mdi mdi-web position-absolute text-muted"
                    ></i>
                    <input
                      placeholder="Enter your website"
                      type="text"
                      name="portfolio"
                      v-model="data.portfolio"
                      class="form-control"
                    />
                  </div>
                  <div class="text-danger" v-if="dataErrors.portfolio">
                      {{ dataErrors.portfolio }}
                    </div>
                  <div class="position-relative icon-form-control mb-2">
                    <i
                      class="mdi mdi-instagram position-absolute text-muted"
                    ></i>
                    <input
                      placeholder="Add Instagram link"
                      type="text"
                      name="instagram"
                      v-model="data.instagram"
                      class="form-control"
                    />
                  </div>
                    <div class="text-danger" v-if="dataErrors.instagram">
                      {{ dataErrors.instagram }}
                    </div>
                  <div class="position-relative icon-form-control mb-2">
                    <i
                      class="mdi mdi-facebook position-absolute text-muted"
                    ></i>
                    <input
                      placeholder="Add Facebook link"
                      type="text"
                      name="facebook"
                      v-model="data.facebook"
                      class="form-control"
                    />
                  </div>
                    <div class="text-danger" v-if="dataErrors.facebook">
                      {{ dataErrors.facebook }}
                    </div>
                  <div class="position-relative icon-form-control mb-2">
                    <i class="mdi mdi-twitter position-absolute text-muted"></i>
                    <input
                      placeholder="Add Twitter link"
                      type="text"
                      name="twitter"
                      v-model="data.twitter"
                      class="form-control"
                    />
                  </div>
                    <div class="text-danger" v-if="dataErrors.twitter">
                      {{ dataErrors.twitter }}
                    </div>
                </div>
              </div>
            </div> -->

            <div class="mb-3 text-right">
              <button
                type="submit"
                class="btn btn-success ml-2"
                :disabled="
                  !Object.values(dataErrors).every((value) => !value) ||
                  btnStatus == 2
                "
                @click.prevent="handleBecomeSeller"
              >
                {{ btnStatus == 2 ? $t('loader.loading') : $t('becomeASeller.submit') }}
              </button>
            </div>
          </form>
        </main>
      </div>
    </div>
  </div>
</template>

<script>
import useBecomeSeller from "@/composables/useBecomeSeller";

export default {
  setup() {
    const {
      data,
      dataErrors,
      onCategorySelected,
      subCategories,
      subCatLoader,
      preview,
      handleCinic,
      removeImage,
      handleBecomeSeller,
      btnStatus,
    } = useBecomeSeller();

    const selectSubCategory = () => {
      data.value.sub_category_id =
        document.querySelector("#subcategoryID").value;
    };
    const selectLanguage = () => {
      data.value.lang = document.querySelector("#language").value;
    };
    const selectCountry = () => {
      data.value.country_id = document.querySelector("#country").value;
    };
    const selectAvailability = () => {
      data.value.availability = document.querySelector("#availability").value;
    };

    return {
      data,
      preview,
      dataErrors,
      handleBecomeSeller,
      onCategorySelected,
      subCategories,
      subCatLoader,
      handleCinic,
      removeImage,
      selectLanguage,
      selectCountry,
      selectAvailability,
      selectSubCategory,
      btnStatus,
    };
  },
};
</script>

<style lang="scss" scoped>
.upload-cnic {
  width: 80px;
  height: 80px;
  border: 1px solid grey;
  margin-bottom: 10px;
  background-size: cover;
  background-position: center;
}
</style>