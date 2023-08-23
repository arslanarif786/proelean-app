import Api from '@/services/API';

export const state = {
  services: [],
  sellerOfferedServices: [],
  servicesStatus: null,
  error: null,
  pages: [],
  links: {},
  currentPage: 0,
  isSearchBySubCategory:false,
  loadingStatus: ''
}

export const getters = {
  getServices: state => state.services,
  getSellerOfferedServices: state => state.sellerOfferedServices,
  getLoadingStatus: state => state.loadingStatus,
  getCurrentPage: state => state.currentPage,
  getSearchBySubCategory: state => state.isSearchBySubCategory,
  getPages: state => state.pages,
  getLinks: state => state.links,
}

export const mutations = {

  setServices(state, services) {
    state.services = services;
  },
  setError(state, error) {
    state.error = error;
  },
  setLinks(state, links) {
    state.links = links;
  },
  setPagination(state, pages) {
    state.pages = pages;
  },
  setCurrentPage(state, page) {
    state.currentPage = page;
  },
  setSearchBySubCategory(state, status) {
    state.isSearchBySubCategory = status;
  },
  setLoadingStatus(state, status) {
    state.loadingStatus = status;
  },
  setSellerOfferedServices(state, services) {
    state.sellerOfferedServices = services;
  },
  toggleGigsFavourite(state, serviceId) {
    state.services.forEach(service => {
      if (service.id == serviceId) {
        service.favourite = service.favourite == 1 ? 0 : 1;
      }
    });
  }
}

export const actions = {


  async searchServices({ commit, state }, search) {
    state.services = [];
    commit('setLoadingStatus', 'LOADING');
    const res = await Api.get(search);
    if (res.status === 200) {
      commit('setSearchBySubCategory', false);
      commit("setServices", res.data);
      commit('setCurrentPage', res.meta.current_page);
      commit('setLinks', res.links);
      commit('setPagination', res.meta);
    }
    commit('setLoadingStatus', 'COMPLETED');
  },

  async searchServicesByCategoryId({ commit }, endpoint) {

    const res = await Api.get(endpoint);
    if (res.status === 200) {
      commit("setServices", res.data);
      commit('setSearchBySubCategory', true);
      commit('setCurrentPage', res.meta.current_page);
      commit('setLinks', res.links);
      commit('setPagination', res.meta);
    } else {
      commit("setServicesStatus", false);
    }
  },


}
