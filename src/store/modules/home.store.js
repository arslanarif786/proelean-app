import Api from '@/services/API'

export const state = {
    featGigs:[],
    error: null,
  }

export const  mutations = {
  setFeatGigs(state,featGigs) {
    state.featGigs=featGigs;
  },
  setError(state,error) {
    state.error=error;
  }
}

export const  actions = {
    async getHomeList({ commit }){
      const response = await Api.get('home');
      if(response.status===200){ 
        commit("setCategories",response.data.categories);
        commit("setFeatGigs",response.data.featGigs);
      } else{
        console.log("HomeList error");
      }
    },

}

export const getters = {
  getFeatGigs: (state) => state.featGigs
}