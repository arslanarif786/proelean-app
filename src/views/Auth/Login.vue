<template>
  <div class="bg-white">
    <div class="container">
      <div class="row justify-content-center align-items-center d-flex vh-100">
        <div class="col-lg-4 mx-auto">
          <div class="osahan-login py-4">
            <div class="text-center mb-4">
              <a href="/"
                ><img src="/assets/images/Pro-eLean-.png" alt=""
              /></a>
              <p class="text-muted">
                {{ $t('login.loginDesc') }}.
              </p>
            </div>
            <form id="login">
              <div class="form-group mb-1">
                <label class="mb-1">{{ $t('login.email') }}</label>

                <div class="position-relative icon-form-control">
                  <input
                    type="email"
                    :class="[{ 'border-danger': loginErrors.email },{'border-success': !loginErrors.email}]"
                    class="form-control border-10 shadow-none position-relative"
                    name="email"
                    v-model="login.email"
                    :placeholder="$t('login.enterYourEmail')"
                    required
                  />
                  <i
                    class="mdi mdi-account position-absolute"
                    style="left: 0"
                  ></i>
                </div>
                <div class="text-danger mt-1" v-show="loginErrors.email">
                  {{ loginErrors.email ? $t('errorMessages.'+ loginErrors.email) : '' }}
                </div>
              </div>

              <div>
                <label class="mb-1">{{ $t('login.password') }}</label>
                <div class="position-relative icon-form-control">
                  <input
                    ref="passwordRef"
                    type="password"
                    :class="[{ 'border-danger ': loginErrors.password },{'border-success': !loginErrors.password}]"
                    class="form-control shadow-none position-relative"
                    v-model="login.password"
                    :placeholder="$t('login.enterYourPassword')"
                    required
                  />
                  <i
                    class="mdi mdi-key-variant position-absolute"
                    style="left: 0"
                  ></i>
                  <i
                    @click="toggleVisibility"
                    class="mdi position-absolute cursor-pointer"
                    :class="`${eyeIcon}`"
                    style="right: 0" ></i>
                </div>
                <div class="text-danger mt-1" v-show="loginErrors.password">
                  {{ loginErrors.password ? $t('errorMessages.'+ loginErrors.password) : '' }}
                </div>
              </div>

              <div class="custom-control custom-checkbox mb-3">
                <input
                  type="checkbox"
                  class="custom-control-input"
                  name="remember"
                  id="customCheck1"
                />
                <label class="custom-control-label" for="customCheck1"
                  >{{ $t('login.rememberPassword') }}</label
                >
              </div>
              <!-- errors bag -->
              <button
                type="button"
                class="btn btn-success btn-block text-uppercase"
                id="loginBtn"
                :disabled="!Object.values(loginErrors).every((value) => !value) || registerStatus == 2"
                @click="handleLogin"
                >                
                {{registerStatus == 2 ? $t('loader.loading') : $t('login.title')}}
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
                <router-link to="/forgot">{{ $t('login.forgotPassword') }}</router-link>
                <span class="ml-auto">
                  {{ $t('login.newToProelean') }}?
                  <router-link to="/register">{{ $t('login.joinNow') }}</router-link></span
                >
              </div>
            </form>
          </div>

          <!-- <div class="container">
            <button type="button" class="btn btn-primary" id="liveToastBtn">
              Show live toast
            </button>

            <div class="position-fixed bottom-0 end-0 p-3" style="z-index: 11">
              <div
                id="liveToast"
                class="toast hide"
                role="alert"
                aria-live="assertive"
                aria-atomic="true"
              >
                <div class="toast-header">
                  <strong class="me-auto">Bootstrap</strong>
                  <small>11 mins ago</small>
                  <button
                    type="button"
                    class="btn-close"
                    data-bs-dismiss="toast"
                    aria-label="Close"
                  ></button>
                </div>
                <div class="toast-body">
                  Hello, world! This is a toast message.
                </div>
              </div>
            </div>
          </div> -->
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import { useRouter } from "vue-router";
import useAuth from "@/composables/useAuth";
import { computed, onBeforeMount } from "vue";
import { useStore } from 'vuex';

export default {
  name: "Login",
  setup() {
    const store = useStore()
    const router = useRouter();
    const {
      toggleVisibility,
      eyeIcon,
      passwordRef,
      loginErrors,
      login,
      loginLoading,
    } = useAuth();

    const handleLogin = async (e) => {
      e.preventDefault();
      console.log("login data:- " + JSON.stringify(login.value))
      store.dispatch('login', login.value)
   }

    onBeforeMount(() => {
      // if user already login return back to '/'
      if (localStorage.getItem("PROELEAN_TOKEN")) {
        router.push({ name: "Home" });
      }
    });

    const registerStatus = computed( () => {
      return   store.getters.getRegisterStatus;
    });
    

    return {
      registerStatus,
      login,
      handleLogin,
      loginLoading,
      loginErrors,
      passwordRef,
      eyeIcon,
      toggleVisibility,
    };
  },
};
</script>

<style scoped>
.cursor-pointer {
  cursor: pointer;
}
</style>
