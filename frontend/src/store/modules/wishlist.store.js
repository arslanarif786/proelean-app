import Api from '@/services/API'
import useToast from '@/composables/useToast.js'
import { ref } from 'vue'

export const state = {
  wishlist: [],
  wishlistServices: [],
  error: null,
}

export const getters = {
  getWishlist: state => state.wishlist,
  getWishlistServices: state => state.wishlistServices,
}

export const mutations = {
  setWishlist(state, data) {
    state.wishlist = data
  },
  setAllWishlistServices(state, data) {
    state.wishlistServices = data
  },
  setError(state, error) {
    state.error = error;
  },
  toggleFavourite(state,serviceId){
    state.wishlistServices.forEach(service => {
      if(service.id==serviceId){
        service.favourite = service.favourite == 1 ? 0 : 1;
      }
    });
  }
}

export const actions = {
  async wishlist({ commit, getters }, payload) {
    commit('setRegisterStatus', payload.service_id);
    const resp = await Api.post('wishlist', payload)
    if (resp.status == 200) {
      commit('setRegisterStatus', 3);
      if(payload.favourite == 0){
        useToast(resp.message, 'success');
      } else{
        useToast(resp.message);
      }

      if(payload.type === 'offeredServices')
      {
        commit('toggleOfferedService', payload.service_id);
      }
      else if (payload.type === 'gigs'){
        commit('toggleGigsFavourite', payload.service_id);
      } else{
        let favouriteServices = ref(getters.getWishlistServices.filter( service => service.id !== payload.service_id))
        commit('setAllWishlistServices',favouriteServices.value)
      }
    }
    else {
      useToast(resp.message);
      commit('setRegisterStatus', 4);
    }

  },
  async allWishlistServices({ commit }, payload) {
    commit('setLoader', 1);
    const resp = await Api.get('get_wishlist', payload)
    if (resp.status == 200) {
      commit('setAllWishlistServices',resp.data)
      commit('setLoader', 0);
    }
  },

  async showWishlist({ commit }) {
    const resp = await Api.get('get_wishlist')
    if (resp.status == 200) {
      commit('setWishlist', resp.data)
      console.log("Wishlist Service", resp.data)
    }
    else {
      console.log(resp.message)
    }
  },

}