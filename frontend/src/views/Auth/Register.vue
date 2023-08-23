<template>
  <div class="bg-white">
    <div class="container">
      <div class="row justify-content-center align-items-center d-flex vh-100">
        <div class="col-lg-4 mx-auto">
          <div class="osahan-login py-4">
            <div class="text-center mb-4">
              <a href="index.html"><img src="images/fav.svg" alt="" /></a>
              <h5 class="font-weight-bold mt-3">{{ $t('register.joinProelean') }}</h5>
              <p class="text-muted">{{ $t('register.registerDesc') }}</p>
            </div>
            <form action="index.html">
              <div class="form-row">
                <div class="col">
                  <div class="form-group">
                    <label class="mb-1">{{ $t('register.name') }}</label>
                    <div class="position-relative icon-form-control">
                      <i class="mdi mdi-account position-absolute"></i>
                      <input
                        type="text"
                        :class="[{ 'border-danger ': signupErrors.name },{'border-success': !signupErrors.name}]"
                        class="form-control userForm"
                        :placeholder="$t('register.enterName')"
                        v-model="signup.name"
                      />
                    </div>
                     <div class="text-danger mt-1" v-show="signupErrors.name">
                        {{ signupErrors.name ? $t('errorMessages.'+ signupErrors.name) : '' }}
                     </div>
                  </div>
                </div>
                <div class="col">
                  <div class="form-group">
                    <label class="mb-1">{{ $t('register.username') }}</label>
                    <div class="position-relative">
                      <input
                        type="text"
                        :class="[{ 'border-danger ': signupErrors.username },{'border-success': !signupErrors.username}]"
                        class="form-control userForm"
                        :placeholder="$t('register.enterUsername')"
                        v-model="signup.username"
                      />
                    </div>
                     <div class="text-danger mt-1" v-show="signupErrors.username">
                        {{ signupErrors.username ? $t('errorMessages.'+ signupErrors.username) : '' }}
                     </div>
                  </div>
                </div>
              </div>
              <div class="form-group">
                <label class="mb-1">{{ $t('register.email') }}</label>
                <div class="position-relative icon-form-control">
                  <i class="mdi mdi-email-outline position-absolute"></i>
                  <input
                    type="email"
                    :class="[{ 'border-danger ': signupErrors.email },{'border-success': !signupErrors.email}]"
                    class="form-control userForm"
                    :placeholder="$t('register.enterEmail')"
                    v-model="signup.email"
                  />
                </div>
                  <div class="text-danger mt-1" v-show="signupErrors.email">
                     {{ signupErrors.email ? $t('errorMessages.'+ signupErrors.email) : '' }}
                  </div>
              </div>
              <div class="form-group">
                <label class="mb-1">{{ $t('register.password') }}</label>
                <div class="position-relative icon-form-control">
                  <input
                    ref="passwordRef"
                    type="password"
                    class="form-control userForm position-relative"
                    :class="[{ 'border-danger ': signupErrors.password },{'border-success': !signupErrors.password}]"
                    :placeholder="$t('register.enterPassword')"
                    v-model="signup.password"
                  />
                  <i class="mdi mdi-key-variant position-absolute" style="left:0"></i>
                  <i @click="toggleVisibility"  class="mdi position-absolute cursor-pointer" 
                     :class="`${eyeIcon}`" style="right:0"></i>
                </div>
                
                  <div class="text-danger mt-1" v-show="signupErrors.password">
                     {{ signupErrors.password ? $t('errorMessages.'+ signupErrors.password) : '' }}
                  </div>
              </div>
              <div class="form-group">
                <label class="mb-1">{{ $t('register.confirmPassword') }}</label>
                <div class="position-relative icon-form-control">
                  <i class="mdi mdi-key-variant position-absolute"></i>
                  <input
                    ref="passwordConRef"
                    type="password"
                    :class="[{ 'border-danger ': signupErrors.password_confirmation },{'border-success': !signupErrors.password_confirmation}]"
                    class="form-control userForm position-relative"
                    :placeholder="$t('register.confirmPassword')"
                    v-model="signup.password_confirmation"
                  />
                  <i class="mdi mdi-key-variant position-absolute" style="left:0"></i>
                  <i @click="toggleVisSignupConPass"  class="mdi position-absolute cursor-pointer" 
                     :class="`${eyeIcon2}`" style="right:0"></i>                  
                </div>
                  <div class="text-danger mt-1" v-show="signupErrors.password_confirmation">
                     {{ signupErrors.password_confirmation ? $t('errorMessages.'+ signupErrors.password_confirmation) : '' }}
                  </div>
              </div>
              <div class="form-group">
                <label class="mb-1"
                  > {{ $t('register.registerLastDesc') }} <a href="#">{{ $t('register.userAgreement') }}</a>,
                  <a href="#">{{ $t('register.privacyPolicy') }}</a>, {{ $t('register.and') }}
                  <a href="#">{{ $t('register.cookiePolicy') }}</a>.</label
                >
              </div>
              <button
                class="btn btn-success btn-block text-uppercase"
                type="submit"
                @click="handleRegister"
                :disabled="!Object.values(signupErrors).every(value => !value) || registerStatus==2"
                >
              {{registerStatus == 2 ? $t('loader.loading') : $t('register.registerBtn')}} 
              </button>
              <div class="py-3 d-flex align-item-center justify-content-center">
                <span>
                  {{ $t('register.alreadyOnProelean') }}?
                  <router-link to="/login">{{ $t('register.signIn') }}</router-link></span
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
import { useStore } from "vuex";
import useAuth from "@/composables/useAuth";
import { computed, onBeforeMount } from "vue";
import { useRouter } from 'vue-router';
export default {
  name: "Register",
  setup() {
    const {
      signup,
      signupErrors,
      passwordRef,
      passwordConRef,
      eyeIcon,
      eyeIcon2,
      toggleVisibility,
      toggleVisSignupConPass
      } = useAuth();

    const store = useStore();
    const router = useRouter();

    onBeforeMount(() => {
      // if user already login return back to '/'
      if (localStorage.getItem("PROELEAN_TOKEN")) {
        router.push({ name: "Home" });
      }
    });

    const handleRegister = (e) => {
      e.preventDefault();
      store.dispatch("register", signup.value);
    };

    
    const registerStatus = computed( () => {
      return   store.getters.getRegisterStatus;
    });

    return {
      signup,
      signupErrors,
      toggleVisibility,
      toggleVisSignupConPass,
      passwordRef,
      passwordConRef,
      eyeIcon,
      eyeIcon2,
      handleRegister,
      registerStatus
      // message,
    };
  },
};
</script>

<style scoped>
   .cursor-pointer{
      cursor: pointer;
   }
</style>
