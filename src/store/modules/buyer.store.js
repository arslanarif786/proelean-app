import Api from '@/services/API';
import { ref } from 'vue';
import useToast from '@/composables/useToast.js'
// import { useRoute } from 'vue-router';
// const route = useRoute();

export const state = {
  createJob: [],
  allJobs: [],
  service: {},
  cardStripe: {},
  offers: [],
  purchaseLoadingStatus: {}
}

export const getters = {
  getCreateJob: state => state.createJob,
  getAllJobs: state => state.allJobs,
  getService: state => state.service,
  getCardStripe: state => state.cardStripe,
  getViewOffers: state => state.offers,
  getOfferPurchaseStatus: state => state.purchaseLoadingStatus
}

export const mutations = {
  setCreateJob(state, job) {
    state.createJob = job;
  },
  setAllJobs(state, job) {
    state.allJobs = job;
  },
  setService(state, service) {
    state.service = service;
  },
  setCardStripe(state, stripe) {
    state.cardStripe = stripe;
  },
  setViewOffers(state, offers) {
    state.offers = offers;
  },
  setOfferPurchaseLoadingStatus(state, status) {
    state.purchaseLoadingStatus = status;
  },
}

export const actions = {

  async createAJob({ commit }, payload) {
    commit('setRegisterStatus', 2);
    const res = await Api.post('buyer/jobs', payload);
    if (res.status === 201) {
      console.log("Create Job Response", res.data)
      useToast("Your request is submitted", 'success');
      commit("setCreateJob", res)
      commit('setRegisterStatus', 3);
    }
    else {
      useToast(res.message);
      commit('setRegisterStatus', 4);
    }
    return res;
  },

  async showAllJobs({ commit }, jobType) {
    commit('setLoader', 1);
    const res = await Api.get(`buyer/jobs?status=${jobType}`);
    if (res.status === 200) {
      console.log("All Jobs Response", res.data)
      commit("setAllJobs", res.data);
    }
    else {
      console.log("Error All Jobs");
    }
    commit('setLoader', 0);
  },

  async deleteAJob({ commit, state }, id) {
    const res = await Api.delete(`buyer/jobs/${id}`);
    if (res.status === 200) {
      console.log("delete Job successfully", res.message)
      useToast(res.message, 'success');
      const afterRemoveJob = ref(state.allJobs.filter(job => job.id !== id))
      commit("setAllJobs", afterRemoveJob.value);
    }
    else {
      console.log("Error delete Job");
      useToast(res.message);
    }
  },

  async purchaseService({ commit, state, getters }, payload) {

    commit('setRegisterStatus', 2);
    const res = await Api.post('token', payload.paymentElements);
    if (res.status === 200) {
      commit("setCardStripe", res.token);
      console.log("token", state.cardStripe);
      payload.descriptionData.token = state.cardStripe;
      const resp = await Api.post('buyer/custom_order', payload.descriptionData);
      if (resp.status === 201) {
        commit("setService", resp.data);
        commit('setRegisterStatus', 3);
        useToast(resp.message, 'success');
        window.location.href = `/chat/${getters.getSingleService.service_user.id}`
      }
      else {
        useToast(resp.message);
        commit('setRegisterStatus', 4);
        console.log("Error custom Order");
      }
      return resp.status;
    }
    else {
      console.log("Error of Card Stripe");
    }
  },

  async purchaseOfferedService({ commit, getters, dispatch }, payload) {

    const offer = getters.getSelectedCustomOffer;

    commit("setOfferPurchaseLoadingStatus", { status: "LOADING", offerId: offer.id })

    const res = await Api.post('token', payload);
    if (res.status === 200) {

      var offerPayload = offer.messageOffer;

      payload = {
        service_id: offerPayload.serviceId,
        description: offerPayload.description,
        price: offerPayload.totalOffer,
        revision: offerPayload.revisions,
        delivery_time: offerPayload.deliveryDays,
        token: res.token
      }

      const response = await Api.post('buyer/chat_order', payload);

      if (response.status === 201) {

        offerPayload = {
          'docId': offer.id,
          'status': 1
        };

        dispatch("withdrawOffer", offerPayload).then(() => {
          useToast(response.message, 'success');
          commit("setOfferPurchaseLoadingStatus", { status: "COMPLETED", offerId: offer.id })
        })

      } else {
        useToast(JSON.stringify(response), 'error');
        console.log(response)
      }
    }

  },

  async viewOffers({ commit }, id) {
    commit('setLoader', 1);
    const res = await Api.get(`buyer/jobs/${id}/offers`);
    if (res.status === 200) {
      console.log("View Offers: ", res.data)
      commit("setViewOffers", res.data);
    }
    else {
      console.log("Error All Jobs");
    }
    commit('setLoader', 0);
  },

  async purchaseJobOfferedService({ commit, getters }, [payload, offerId]) {

    let placeOrderBtn = document.getElementById(offerId);
    disabledPlaceOrderBtn(placeOrderBtn);

    const res = await Api.post('token', payload);
    if (res.status === 200) {

      const offerOrder = {
        token: res.token,
        offer_id: offerId
      };

      const response = await Api.post("buyer/offer_order", offerOrder);

      if (response.status == 201) {
        let remainingOffers = getters.getViewOffers.filter(offer => offer.id != offerId);
        commit("setViewOffers", remainingOffers);
        useToast(response.message, 'success');
      } else {
        enabledPlaceOrderBtn(placeOrderBtn);
        useToast(response.message, 'error');
      }

    } else {
      enabledPlaceOrderBtn(placeOrderBtn);
      useToast(res.message, 'error');
    }
    commit('setLoader', 0);
  }

}

function disabledPlaceOrderBtn(placeOrderBtn) {
  placeOrderBtn.innerText = "Loading...";
  placeOrderBtn.disabled = true;
}

function enabledPlaceOrderBtn(placeOrderBtn) {
  placeOrderBtn.innerText = "Place order";
  placeOrderBtn.disabled = false;
}