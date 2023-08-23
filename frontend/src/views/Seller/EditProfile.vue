<template>
  <div class="container-xl pt-2 mb-3">
    <div class="row gy-4 d-flex justify-content-center">

      <div class="col-12 col-lg-8">
        <h4>{{ $t('myAccount.title') }}</h4>
        <div class="border-bottom mb-3"></div>
        <div
          class="
            app-card app-card-account
            shadow-sm
            d-flex
            flex-column
            align-items-start
          "
        >
          <div class="app-card-body p-4 w-100 text-center">
            <div class="align-items-center">
              <div></div>
              <!--//col-->
              <div class="col-auto">
                <h3 class="app-card-title">{{ $t('myAccount.editProfile') }}</h3>
              </div>
              <!--//col-->
            </div>
            <!--//row-->
          </div>

          <!--//app-card-header-->
          <div class="app-card-body px-4 w-100">
            <div class="item border-bottom">
              <div class="row justify-content-center">
                <div class="col-auto">
                  <!-- <div class="item-label mb-2"><strong>Photo</strong></div> -->
                  <div class="item-data position-relative mb-3 cursor-pointer">
                    <img
                      v-if="!imageBase64"
                      :src="`${imgURL}/${
                        editUser.image
                          ? editUser.image
                          : '/assets/images/avator.png'
                      }`"
                      class="
                        profileImage
                        dropdown-user-img
                        img-full
                        rounded-circle
                      "
                      alt="profile_img"
                    />
                    <img
                      v-else
                      :src="imageBase64"
                      class="
                        profileImage
                        dropdown-user-img
                        img-full
                        rounded-circle
                      "
                      alt="profile_img"
                    />
                    <input
                      type="file"
                      ref="profileInput"
                      accept="image/*"
                      @change="handleProfileImage($event)"
                      style="display: none"
                    />
                  </div>
                  <i
                    @click="$refs.profileInput.click"
                    class="
                      mdi mdi-pencil
                      position-absolute
                      cursor-pointer
                      rounded-circle
                    "
                    style="
                      bottom: 15%;
                      right: 9%;
                      font-size: 20px;
                      background-color: white;
                    "
                  ></i>
                </div>
                <!--//col-->
                <!--//col-->
              </div>
              <!--//row-->
            </div>
            <!--//item-->
            <div class="row">
              <div class="col-md-6 col-12">
                <div class="item py-2">
                  <div>
                    <div class="item-label mb-2">
                      <strong>{{ $t('myAccount.name') }}</strong>
                      <span class="text-danger">*</span>
                      <span
                        class="text-danger mt-1 ml-1"
                        v-show="editUserError.name"
                      >
                        {{ editUserError.name }}</span
                      >
                    </div>
                    <input
                      type="text"
                      class="form-control"
                      id="name"
                      name="name"
                      v-model="editUser.name"
                      :placeholder="$t('myAccount.enterYourName')"
                      required
                    />
                  </div>
                  <!--//col-->
                  <!--//row-->
                </div>

                <!--//item-->
                <div class="item py-2">
                  <div>
                    <div class="item-label mb-2"><strong>{{ $t('myAccount.email') }}</strong></div>
                    <input
                      type="text"
                      class="form-control"
                      readonly
                      id="email"
                      v-model="editUser.email"
                      placeholder="Enter your Email"
                      required
                    />
                  </div>
                  <!--//row-->
                </div>

                <!--//item-->
              </div>
              <div class="col-md-6 col-12">
                <div class="item py-2">
                  <div>
                    <div class="item-label mb-2">
                      <strong>{{ $t('myAccount.phone') }}</strong>
                      <span class="text-danger">*</span>
                      <span
                        class="text-danger mt-1 ml-1"
                        v-show="editUserError.phone"
                      >
                        {{ editUserError.phone }}</span
                      >
                    </div>
                    <input
                      type="text"
                      class="form-control"
                      id="phone"
                      v-model="editUser.phone"
                      :placeholder="$t('myAccount.enterYourPhone')"
                      required
                    />
                  </div>
                  <!--//row-->
                </div>

                <!--//item-->
                <div class="item py-2">
                  <div>
                    <div class="item-label mb-2"><strong>{{ $t('myAccount.address') }}</strong></div>
                    <input
                      type="text"
                      class="form-control"
                      id="address"
                      v-model="editUser.address"
                      :placeholder="$t('myAccount.enterYourAddress')"
                      required
                    />
                  </div>
                  <!--//row-->
                </div>
                <!--//item-->
              </div>
            </div>
            <div class="item pt-2">
              <div>
                <div class="item-label mb-2"><strong>{{ $t('myAccount.description') }}</strong></div>
                <textarea
                  type="text"
                  class="form-control mb-4"
                  id="description"
                  rows="4"
                  v-model="editUser.description"
                  :placeholder="$t('myAccount.enterYourDesc')"
                  required
                />
              </div>
              <!--//row-->
            </div>
          </div>
          <div class="app-card-body mb-4 w-100 text-center">
            <button class="btn app-btn-secondary" @click="update"
            :disabled="!Object.values(editUserError).every(value => !value)"
            >{{
              btnStatus === 2 ? $t('loader.loading') : $t('myAccount.updateBtn')
            }}</button>
          </div>
          <div v-if="$store.getters.isBuyerMode" class="marginn d-lg-none"></div>
        </div>
      </div>
      <!--//app-card-body-->
      <!--//app-card-footer-->
    </div>
    <!--//app-card-->
  </div>
</template>

<script>
import useEditProfile from "@/composables/profile/useEditProfile";
export default {
  setup() {
    const {
      editUser,
      editUserError,
      btnStatus,
      imageBase64,
      handleProfileImage,
      update,
    } = useEditProfile();

    return {
      btnStatus,
      editUserError,
      imageBase64,
      handleProfileImage,
      update,
      editUser,
      imgURL: process.env.VUE_APP_URL,
    };
  },
};
</script>

<style>
.profileImage {
  width: 120px !important;
  height: 120px !important;
}
</style>