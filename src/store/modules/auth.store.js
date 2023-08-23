import Api from '@/services/API'
import router from '@/router';
import useToast from '@/composables/useToast.js'

export const state = {
  status: { isLoggedIn: false },
  error: null,
  setPasswordSection: false,
  loginStatus: 1,
  registerStatus: 1,
  user: JSON.parse(localStorage.getItem("userInfo")),
  firebaseUID: localStorage.getItem('proelean_firebase_uid'),
  stripeConnectLoader: false
}

export const mutations = {
  setRegisterStatus(state, status) {
    state.registerStatus = status;
  },
  setFirebaseUID(state,uid){
    state.firebaseUID = uid;
  },

  setError(state, error) {
    state.error = error;
  },

  setForgotPasswordSection(state, value) {
    state.setPasswordSection = value
  },

  setUser(state, value) {
    state.user = value
  },

  setUserAsSeller(state) {
    state.user.isFreelancer = 1;
    console.log(state.user)
    localStorage.setItem("userInfo", JSON.stringify(state.user))
  },
  setStripeConnectLoader(state, status) {
    state.stripeConnectLoader = status;
  }
}

export const actions = {
  async login({ commit }, payload) {
    commit('setRegisterStatus', 2);
    const resp = await Api.post('login', payload)
    if (resp.status == 200) {
      useToast(resp.message,'success');

      ///////     date conversion
      const monthNames = ["January", "February", "March", "April", "May", "June",
        "July", "August", "September", "October", "November", "December"];
      const dateObj = new Date(resp.data.created_at);
      const month = monthNames[dateObj.getMonth()];
      const day = String(dateObj.getDate()).padStart(2, '0');
      const year = dateObj.getFullYear();
      const output = day + ' ' + month + ', ' + year;
      ///////     date conversion end
      localStorage.setItem("userInfo", JSON.stringify(resp.data))

      var userAuthDate = JSON.parse(localStorage.getItem("userInfo"))
      userAuthDate.created_at = output;
      localStorage.setItem("userInfo", JSON.stringify(userAuthDate))
      

      localStorage.setItem("PROELEAN_TOKEN", resp.token)
      commit('setRegisterStatus', 3);
      router.go(-1)
      setTimeout(() => location.reload(),300)
      
    }
    else {
      commit('setRegisterStatus', 4);
      useToast(resp.message);

    }
    return resp;
  },
  async register({ commit }, payload) {
    commit('setRegisterStatus', 2);
    const resp = await Api.post('register', payload);
    if (resp.status == 201) {
      useToast(resp.message,'success');
      commit('setRegisterStatus', 3);
      router.push('login');
    }
    else {
      commit('setRegisterStatus', 4);
      useToast(resp.message);
    }
    return resp;
  },

  async updateProfile({ commit,getters }, payload) {
    console.log("profile",payload)
    commit('setRegisterStatus', 2);
    const resp = await Api.formData('update_profile', payload);
    if (resp.status == 200) {
      useToast("Profile Has been Successfully Updated", 'success');
      commit('setRegisterStatus', 3);
      localStorage.setItem('userInfo',JSON.stringify(resp))
      commit('setUser',resp)
      if (getters.isBuyerMode) {
        window.location.href = `/buyer-account`
      } else {
        window.location.href = `/dashboard/account`
      }
    }
    else {
      commit('setRegisterStatus', 4);
      useToast(resp.message);
    }

    return resp;
  },

  async forgotPassword({ commit }, payload) {
    console.log("Email", payload)
    commit('setRegisterStatus', 2);
    const resp = await Api.post('forgot_password', payload)
    if (resp.status == 200) {
      useToast(resp.message,'success');
      commit('setRegisterStatus', 3);
      commit('setForgotPasswordSection', true)
    }
    else {
      commit('setRegisterStatus', 4);
      useToast(resp.message);
    }
  },

  async updatePassword({ commit }, payload) {
    console.log("Email", payload)
    commit('setRegisterStatus', 2);
    const resp = await Api.post('update_password', payload)
    if (resp.status == 200) {
      useToast(resp.message,'success');
      commit('setRegisterStatus', 3);
    } else {
      commit('setRegisterStatus', 4);
      useToast(resp.message);
    }
  },

  async changePassword({ commit }, payload) {
    commit('setRegisterStatus', 2);
    const resp = await Api.post('change_password', payload)
    if (resp.status == 200) {
      useToast(resp.message,'success');
      commit('setRegisterStatus', 3);
      router.push('login');
    } else {
      commit('setRegisterStatus', 4);
      useToast(resp.message,'success');
    }
  },
  
  async connectStripeAccount({commit, getters}) {
    commit("setStripeConnectLoader", true);
    const response  = await Api.get("connect_stripe_account");
    commit("setStripeConnectLoader", false);

    if(response.status === 200) {
      window.open(
        response.data.url, "_blank");
        commit('setUser', getters.getAuthUser);
        return;
    }
    
  }
}

export const getters = {
  getAuthUser: (state) => state.user,
  getRegisterStatus: state => state.registerStatus,
  getPasswordSection: state => state.setPasswordSection,
  amILoggedInOnFirebase: state => state.firebaseUID ? true : false,
  stripeConnectStatus: state => state.stripeConnectLoader,
}


