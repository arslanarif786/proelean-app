<template>
  <div class="col-12 col-lg-8 mb-3">
    <h3 class="app-page-title pt-3">{{ $t('myAccount.title') }}</h3>
    <div class="border-bottom my-3"></div>
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
            <h3 class="app-card-title">{{ $t('myAccount.profile') }}</h3>
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
              <div class="item-data mb-3">
                <img
                  :src="`${imgURL}/${
                    user.image ? user.image : '/assets/images/avator.png'
                  }`"
                  class="profileImage dropdown-user-img img-full rounded-circle"
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
          <div class="col-md-6 col-12">
            <div class="item border-bottom py-3">
              <div class="row justify-content-between align-items-center">
                <div class="col-auto">
                  <div class="item-label"><strong>{{ $t('myAccount.name') }}</strong></div>
                  <div class="item-data">{{ user.name }}</div>
                </div>
                <!--//col-->
              </div>
              <!--//row-->
            </div>
            <!--//item-->
            <div class="item border-bottom py-3">
              <div class="row justify-content-between align-items-center">
                <div class="col-auto">
                  <div class="item-label"><strong>{{ $t('myAccount.email') }}</strong></div>
                  <div class="item-data">
                    <input type="hidden" name="email" />
                  </div>
                  <div class="item-data">{{ user.email }}</div>
                </div>
                <!--//col-->
              </div>
              <!--//row-->
            </div>
            <!--//item-->
          </div>
          <div class="col-md-6 col-12">
            <div class="item border-bottom py-3">
              <div class="row justify-content-between align-items-center">
                <div class="col-auto">
                  <div class="item-label"><strong>{{ $t('myAccount.phone') }}</strong></div>
                  <div class="item-data">
                    <input type="hidden" name="email" />
                  </div>
                  <div class="item-data">{{ user.phone }}</div>
                </div>
                <!--//col-->
              </div>
              <!--//row-->
            </div>
            <!--//item-->
            <div class="item border-bottom py-3">
              <div class="row justify-content-between align-items-center">
                <div class="col-auto">
                  <div class="item-label"><strong>{{ $t('myAccount.address') }}</strong></div>
                  <div class="item-data">{{ user.address }}</div>
                </div>
                <!--//col-->
              </div>
              <!--//row-->
            </div>
            <!--//item-->
          </div>
        </div>
        <div class="row">
          <div class="col-12">
            <div class="item border-bottom py-3">
              <div class="row justify-content-between align-items-center">
                <div class="col-auto">
                  <div class="item-label"><strong>{{ $t('myAccount.description') }}</strong></div>
                  <div class="item-data">{{ user.description }}</div>
                </div>
                <!--//col-->
              </div>
              <!--//row-->
            </div>
          </div>
        </div>
      </div>
      <!--//app-card-body-->
      <div class="app-card-body p-4 w-100 text-center">
        <router-link
          v-if="$store.getters.isBuyerMode"
          to="/buyer/edit-profile"
          class="btn app-btn-secondary"
          >{{ $t('myAccount.editProfile') }}</router-link
        >
        <router-link
          v-else
          to="/dashboard/edit-profile"
          class="btn app-btn-secondary"
          >{{ $t('myAccount.editProfile') }}</router-link
        >
      </div>
      <!--//app-card-footer-->
    </div>
    <!--//app-card-->

    <!-- buyer Modes -->
    <div
      v-if="$store.getters.isBuyerMode"
      class="app-card app-card-account shadow-sm d-flex flex-column mt-3"
    >
      <div class="d-flex justify-content-center mt-3 d-lg-none">
        <h3 class="app-card-title">{{ $t('myAccount.buying') }}</h3>
      </div>

      <div class="app-card-body p-4 marginn w-100 text-center d-lg-none">
        <div class="px-2 mb-2">
          <router-link to="/buyer/create_job" class="btn app-btn-secondary"
            >{{ $t('myAccount.postJob') }}</router-link
          >
          <router-link to="/buyer/jobs" class="btn app-btn-secondary ml-3"
            >{{ $t('myAccount.ViewJobs') }}</router-link
          >
        </div>
      </div>
    </div>
    <!-- buyer Modes end -->
  </div>
</template>

<script>
import { computed } from "@vue/runtime-core";
import { useStore } from "vuex";
export default {
  setup() {
    const store = useStore();

    return {
      user: computed(() => store.getters.getAuthUser),
      imgURL: process.env.VUE_APP_URL,
    };
  },
};
</script>

<style>
.profileImage {
  width: 120px;
  height: 120px;
}
</style>