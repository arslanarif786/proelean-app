<template>
  <div class="bg-white">
    <div class="container">
      <div class="row justify-content-center align-items-center d-flex vh-100">
        <div class="col-lg-4 mx-auto">
          <div class="osahan-login py-4">
            <div class="text-center mb-4">
              <a href="index.html"
                ><img src="/assets/images/Pro-eLean-.png" alt=""
              /></a>
              <p class="text-muted">
                {{ $t('forgot.forgotDesc') }}.
              </p>
            </div>
            <form id="login">
              <div>
                <label class="mb-1">{{ $t('forgot.email') }}</label>
                <div class="position-relative icon-form-control">
                  <input
                    type="email"
                    :class="[{ 'border-danger': forgotErrors.email },{'border-success': !forgotErrors.email}]"
                    class="form-control border-10 shadow-none position-relative"
                    name="email"
                    :placeholder="$t('forgot.enterEmail')"
                    v-model="forgot.email"
                    once:readonly="passwordSectionVisibility"
                    required
                  />
                  <i
                    class="mdi mdi-account position-absolute"
                    style="left: 0"
                  ></i>
                </div>
                <div class="text-danger mt-1" v-show="forgotErrors.email">
                  {{ forgotErrors.email ? $t('errorMessages.'+ forgotErrors.email) : '' }}
                </div>
              </div>

              <div v-show="passwordSectionVisibility">
                <div>
                <label class="mb-1">{{ $t('forgot.token') }}</label>
                <div class="position-relative icon-form-control">
                  <input
                    type="number"
                    :placeholder="$t('forgot.enterToken')"
                    class="form-control userForm position-relative"
                    :class="[{ 'border-danger ': forgotErrors.token },{'border-success': !forgotErrors.token}]"
                    v-model="forgot.token"
                  />
                  <i class="mdi mdi-onepassword position-absolute" style="left:0"></i>
                </div>
                  <div class="text-danger mt-1" v-show="forgotErrors.token">
                     {{ forgotErrors.token ? $t('errorMessages.'+ forgotErrors.token) : '' }}
                  </div>
              </div>

                <div>
                <label class="mb-1">{{ $t('forgot.password') }}</label>
                <div class="position-relative icon-form-control">
                  <input
                    ref="passwordRef"
                    type="password"
                    :placeholder="$t('forgot.enterPassword')"
                    class="form-control userForm position-relative"
                    :class="[{ 'border-danger ': forgotErrors.password },{'border-success': !forgotErrors.password}]"
                    v-model="forgot.password"
                  />
                  <i class="mdi mdi-lock position-absolute" style="left:0"></i>
                  <i @click="toggleVisibility"  class="mdi position-absolute cursor-pointer" 
                     :class="`${eyeIcon}`" style="right:0"></i>
                </div>
                  <div class="text-danger mt-1" v-show="forgotErrors.password">
                     {{ forgotErrors.password ? $t('errorMessages.'+ forgotErrors.password) : '' }}
                  </div>
              </div>

              <div>
                <label class="mb-1">{{ $t('forgot.confirmPassword') }}</label>
                <div class="position-relative icon-form-control">
                  <input
                    ref="passwordConRef"
                    type="password"
                    :placeholder="$t('forgot.enterConfirmPassword')"
                    class="form-control userForm position-relative"
                    :class="[{ 'border-danger ': forgotErrors.confirmation_password },{'border-success': !forgotErrors.confirmation_password}]"
                    v-model="forgot.password_confirmation"
                  />
                  <i class="mdi mdi-lock position-absolute" style="left:0"></i>
                  <i @click="toggleVisSignupConPass"  class="mdi position-absolute cursor-pointer" 
                     :class="`${eyeIcon2}`" style="right:0"></i>                  
                </div>
                  <div class="text-danger mt-1" v-show="forgotErrors.confirmation_password">
                     {{ forgotErrors.confirmation_password ? $t('errorMessages.'+ forgotErrors.confirmation_password) : '' }}
                  </div>
              </div>

              </div>

              <!-- errors bag -->
              <button
              v-if="!passwordSectionVisibility"
                type="button"
                class="btn btn-success btn-block text-uppercase mt-2"
                :disabled="forgotErrors.email || registerStatus == 2 || forgot.email === ''"
                @click.prevent="forgotPassword()"
                >                
                {{registerStatus == 2 ? $t('loader.loading') : $t('forgot.capTitle') }}
              </button>

              <button
                v-else
                type="button"
                class="btn btn-success btn-block text-uppercase mt-2"
                :disabled="forgotErrors.email || registerStatus == 2 || forgot.email === ''"
                @click.prevent="changePassword()"
                >                
                {{registerStatus == 2 ? $t('loader.loading') : $t('forgot.setPassword')}}
              </button>
              <!-- <div class="text-center mt-3 border-bottom pb-3">
                <p class="small text-muted">Or login with</p>
                <div class="row">
                  <div class="col-6">
                    <button
                      type="button"
                      class="btn btn-outline-instagram btn-block"
                    >
                      <i class="mdi mdi-instagram"></i> Instagram
                    </button>
                  </div>
                  <div class="col-6">
                    <button
                      type="button"
                      class="btn btn-outline-facebook btn-block"
                    >
                      <i class="mdi mdi-facebook"></i> Facebook
                    </button>
                  </div>
                </div>
              </div> -->
              <div class="py-3 d-flex align-item-center">
                <router-link to="/login">{{ $t('forgot.loginTitle') }}</router-link>
                <span class="ml-auto">
                  {{ $t('forgot.newToProelean') }}?
                  <router-link to="/register">{{ $t('forgot.joinNow') }}</router-link></span
                >
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import useAuth from "@/composables/useAuth";
import { computed, onBeforeMount } from "vue";
import { useStore } from 'vuex';
import { useRouter } from 'vue-router';

export default {
  name: "Forgot",
  setup() {
    const router = useRouter()
    const store = useStore()
    const {
      toggleVisibility,
      eyeIcon,
      eyeIcon2,
      passwordRef,
      passwordConRef,
      forgotErrors,
      toggleVisSignupConPass,
      forgot,
    } = useAuth();


    function forgotPassword() {
      store.dispatch('forgotPassword',forgot.value)
   }
    function changePassword() {
      console.log(forgot.value)
      store.dispatch('changePassword',forgot.value)
   }

    onBeforeMount(() => {
      // if user already login return back to '/'
      if (localStorage.getItem("PROELEAN_TOKEN")) {
        router.push({ name: "Home" });
      }
    });


    return {
      registerStatus: computed(() => store.getters.getRegisterStatus),
      passwordSectionVisibility: computed(() => store.getters.getPasswordSection),
      forgotPassword,
      changePassword,
      toggleVisSignupConPass,
      passwordRef,
      passwordConRef,
      forgotErrors,
      forgot,
      eyeIcon,
      eyeIcon2,
      toggleVisibility,
    };
  },
};
</script>

<style scoped>
.cursor-pointer {
  cursor: pointer;
}
input::-webkit-inner-spin-button {
  -webkit-appearance: none;
  margin: 0;
}
</style>
