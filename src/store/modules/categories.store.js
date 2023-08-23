import Api from '@/services/API'

export const state = {
  categories: [],
  subcategories: [],
  error: null,
  categoriesStatus:''
}

export const mutations = {
  setCategories(state, categories) {
    state.categories = categories;
  },
  setSubCategories(state, subcategories) {
    state.subcategories = subcategories;
  },
  setSelectedSubCategories(state, subcategories) {
    state.selectedSubCategories = subcategories;
  },
  setLoadingStatus(state, status) {
    state.categoriesStatus = status
  },
  setError(state, error) {
    state.error = error;
  }
}

export const getters = {
  getCategories: (state) => state.categories,
  getSubCategories: (state) => state.subcategories,
  getCategoriesStatus: state => state.categoriesStatus,
}

export const actions = {

  loadCategories: async ({ commit, state }) => {

    commit('setLoadingStatus','LOADING');    

    if (!state.categories.length) {
      const response = await Api.get(`categories`)
      if (response.status === 200) {
        commit('setCategories', response.data);
      }
    }

    commit('setLoadingStatus','COMPLETED');    
  },

  loadSubCategories: async ({ commit }, categoryId) => {
    // if (state.subcategories.length) {
      const response = await Api.get(`subcategories/${categoryId}`)
      if (response.status === 200) {
        commit('setSubCategories', response.data);
        console.log(response.data);
    }
  },
};