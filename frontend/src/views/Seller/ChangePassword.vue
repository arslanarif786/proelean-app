<template>
  <div class="container-xl py-3">
    <div class="row gy-4 d-flex justify-content-center">
      <div class="col-12 col-lg-6">
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
                <h3 class="app-card-title">{{ $t('myAccount.changePassword') }}</h3>
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
                  <div
                    class="item-data position-relative mb-3 cursor-pointer"
                    @click="$refs.profileInput.click"
                  >
                    <img
                      :src="`${imgURL}/${
                        user.image ? user.image : '/assets/images/avator.png'
                      }`"
                      class="
                        profileImage
                        dropdown-user-img
                        img-full
                        rounded-circle
                      "
                      alt="profile_img"
                    />
                  </div>
                </div>
                <!--//col-->
                <!--//col-->
              </div>
              <!--//row-->
            </div>
            <!--//item-->
            <div class="row">
              <div class="item py-1 col-12">
                <div class="form-group mb-0">
                  <label class="mb-1"><b>{{ $t('myAccount.currentPassword') }} </b></label>
                  <div class="position-relative icon-form-control">
                    <input
                      ref="currentPasswordRef"
                      type="password"
                      class="form-control userForm position-relative"
                      :class="[{ 'border-danger ': changePasswordError.current_password },{'border-success': !changePasswordError.current_password}]"
                      :placeholder="$t('myAccount.enterCurrentPassword')"
                      v-model="changePassword.current_password"
                    />
                    <i
                      class="mdi mdi-key-variant position-absolute"
                      style="left: 0"
                    ></i>
                    <i
                      @click="toggleVisiCurrentPassword"
                      class="mdi position-absolute cursor-pointer"
                      :class="`${eyeIconCurrentPassword}`"
                      style="right: 0"
                    ></i>
                  </div>
                  <div
                    class="text-danger mt-1"
                    v-show="changePasswordError.current_password"
                  >
                    {{ changePasswordError.current_password }}
                  </div>
                </div>
              </div>
              <div class="item py-1 col-12">
                <div class="form-group mb-0">
                  <label class="mb-1"><b>{{ $t('myAccount.newPassword') }} </b></label>
                  <div class="position-relative icon-form-control">
                    <input
                      ref="passwordRef"
                      type="password"
                      class="form-control userForm position-relative"
                      :class="[
                        {
                          'border-danger ':
                            changePasswordError.password,
                        },
                        {
                          'border-success':
                            !changePasswordError.password,
                        },
                      ]"
                      :placeholder="$t('myAccount.enterNewPassword')"
                      v-model="changePassword.password"
                    />
                    <i
                      class="mdi mdi-key-variant position-absolute"
                      style="left: 0"
                    ></i>
                    <i
                      @click="toggleVisiPassword"
                      class="mdi position-absolute cursor-pointer"
                      :class="`${eyeIconPassword}`"
                      style="right: 0"
                    ></i>
                  </div>
                  <div
                    class="text-danger mt-1"
                    v-show="changePasswordError.password"
                  >
                    {{ changePasswordError.password }}
                  </div>
                </div>
              </div>
              <div class="item py-1 col-12">
                <div class="form-group mb-4">
                  <label class="mb-1"><b>{{ $t('myAccount.confirmPassword') }}</b></label>
                  <div class="position-relative icon-form-control">
                    <input
                      ref="confirmPasswordRef"
                      type="password"
                      class="form-control userForm position-relative"
                      :class="[
                        {
                          'border-danger ':
                            changePasswordError.password_confirmation,
                        },
                        {
                          'border-success':
                            !changePasswordError.password_confirmation,
                        },
                      ]"
                      :placeholder="$t('myAccount.enterConfirmPassword')"
                      v-model="changePassword.password_confirmation"
                    />
                    <i
                      class="mdi mdi-key-variant position-absolute"
                      style="left: 0"
                    ></i>
                    <i
                      @click="toggleVisiConfirmPassword"
                      class="mdi position-absolute cursor-pointer"
                      :class="`${eyeIconConfirmPassword}`"
                      style="right: 0"
                    ></i>
                  </div>
                  <div
                    class="text-danger mt-1"
                    v-show="changePasswordError.password_confirmation"
                  >
                    {{ changePasswordError.password_confirmation }}
                  </div>
                </div>
              </div>
            </div>
          </div>
          <!--//app-card-body-->
          <div class="app-card-body pb-4 w-100 text-center">
            <button  class="btn app-btn-secondary mr-2" 
            :disabled="!Object.values(changePasswordError).every(value => !value) || btnStatus === 2"
            @click="updatePassword">{{
              btnStatus === 2 ? $t('loader.loading') : $t('myAccount.title')
            }}</button>
          </div>
          <!--//app-card-footer-->
        </div>
        <!--//app-card-->
      </div>
    </div>
  </div>
</template>

<script>
import userChangePassword from "@/composables/profile/userChangePassword";
export default {
  setup() {
    const {
      eyeIconCurrentPassword,
      eyeIconPassword,
      eyeIconConfirmPassword,
      currentPasswordRef,
      passwordRef,
      confirmPasswordRef,
      toggleVisiCurrentPassword,
      toggleVisiPassword,
      toggleVisiConfirmPassword,
      btnStatus,
      updatePassword,
      changePasswordError,
      user,
      changePassword,
    } = userChangePassword();

    return {
      eyeIconCurrentPassword,
      eyeIconPassword,
      eyeIconConfirmPassword,
      currentPasswordRef,
      passwordRef,
      confirmPasswordRef,
      toggleVisiCurrentPassword,
      toggleVisiPassword,
      toggleVisiConfirmPassword,
      changePassword,
      updatePassword,
      changePasswordError,
      imgURL: process.env.VUE_APP_URL,
      btnStatus,
      user,
    };
  },
};
</script>

<style>
.profileImage{
    width: 120px !important;
    height: 120px !important;
}
</style>