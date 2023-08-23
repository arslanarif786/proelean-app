import Api from '@/services/API'
import useToast from '@/composables/useToast.js'
import router from '@/router';


export const state = {
  countries: [],
  languages: [],
  deliveryDays: [],
  revisions: [],
  error: null,
  buyerLoader: '',
  withdrawRequests: [],
  sellerIban: {},
  paymentLoadingStatus: '',
  preWithdrawRequest: ''
}

export const mutations = {
  setCountries(state, countries) {
    state.countries = countries;
  },
  setLanguages(state, languages) {
    state.languages = languages;
  },
  setDeliveryDays(state, deliveryDays) {
    state.deliveryDays = deliveryDays;
  },
  setRevisions(state, revisions) {
    state.revisions = revisions;
  },
  setError(state, error) {
    state.error = error;
  },
  setBuyerOrderDetailLoader(state, loaderValue) {
    state.buyerLoader = loaderValue;
  },
  setWithdrawRequests(state, requests) {
    state.withdrawRequests = requests;
  },
  setSellerBankAccount(state, iban) {
    state.sellerIban = iban;
  },
  setPaymentLoadingStatus(state, status) {
    state.paymentLoadingStatus = status;
  },
  setPreWithdrawRequest(state, status) {
    state.preWithdrawRequest = status;
  },
}

export const getters = {
  getCountries: state => state.countries,
  getBuyerOrderDetailLoader: state => state.buyerLoader,
  getLanguages: state => state.languages,
  getRevisions: state => state.revisions,
  getDeliveryDays: state => state.deliveryDays,
  getWithdrawRequest: state => state.withdrawRequests,
  getPaymentLoadingStatus: state => state.paymentLoadingStatus,
  getSellerBankAccount: state => state.sellerIban,
  getPreWithdrawRequest: state => state.preWithdrawRequest
}

export const actions = {
  getCategories({ commit }, payload) {
    return Api.get('categories', payload).then(
      resp => {
        console.log(resp);
        commit('setAuthUser', resp.data);
        return Promise.resolve(resp);
      },
      error => {
        commit('setError', error);
        return Promise.reject(error);
      });
  },

  async getCountriesLanguage({ commit, getters }) {
    commit("setBuyerOrderDetailLoader", 1)
    if (!getters.getLanguages.length) {
      const response = await Api.get('countries&categories');
      if (response.status === 200) {
        commit('setCountries', response.data.countries);
        commit('setLanguages', response.data.languages);
        commit('setDeliveryDays', response.data.delivery_days);
        commit('setRevisions', response.data.revisions);
      }
    }
    commit("setBuyerOrderDetailLoader", 0)
  },

  async handleBecomeSeller({ commit }, payload) {
    commit('setRegisterStatus', 2);
    console.log(payload)
    const res = await Api.formData('become_freelancer', payload);
    if (res.status === 201) {
      commit('setUserAsSeller');
      useToast(res.message, 'success');
      commit('setRegisterStatus', 3);
      router.go()
    } else {
      useToast(res.message);
    }

  },

  async saveBankAccount({ commit }, payload) {
    console.log("payload" + JSON.stringify(payload))
    const res = await Api.post("seller/withdrawal_account", payload);
    if (res.status === 200) {
      commit("setSellerBankAccount", payload);
      useToast(res.message, 'success');
    } else {
      useToast(res.message);
    }
  },

  async getWithdrawRequest({ commit }) {
    commit("setPaymentLoadingStatus", "LOADING");
    const res = await Api.get("seller/withdrawRequest");
    if (res.status === 200) {
      commit("setWithdrawRequests", res.data);
    }
    commit("setPaymentLoadingStatus", "COMPLETED");
  },
  
  async getSellerWithdrawalAccount({commit}) {
    commit("setPaymentLoadingStatus", "LOADING");
    const res = await Api.get("seller/withdrawal_account");
    if (res.status === 200) {
      commit("setSellerBankAccount", res);
    } else {
      commit("setSellerBankAccount", null);
    }
    commit("setPaymentLoadingStatus", "COMPLETED");
  },

  async withdrawCashRequest({commit}) {
    commit("setPreWithdrawRequest", "LOADING");
    const res = await Api.get("seller/payout");
    if (res.status === 200) {
      useToast(res.message, 'success');
    } else {
      useToast(res.message);
    }
    commit("setPreWithdrawRequest", "COMPLETED");
  },

  async withdrawBalance() {
    const res = await Api.get("withdraw");
    console.log(res);
  }
}
