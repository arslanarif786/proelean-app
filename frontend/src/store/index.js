import { createStore } from "vuex";
import Api from "@/services/API";
import * as auth from "./modules/auth.store";
import * as home from "./modules/home.store";
import * as services from "./modules/services.store";
import * as seller from "./modules/seller.store";
import * as categories from "./modules/categories.store";
import * as buyer from "./modules/buyer.store";
import * as become_seller from "./modules/become_seller.store";
import * as wishlist from "./modules/wishlist.store";
import * as chat from "./modules/chat.store";
import * as order from "./modules/order.store";
import { ref } from "vue";
import useToast from '@/composables/useToast.js'

let user = JSON.parse(localStorage.getItem("userInfo"));

export default createStore({
  state: {
    isLoggedIn: localStorage.getItem("PROELEAN_TOKEN") ? true : false,
    isSeller: user && user.isFreelancer ? true : false,
    userNotifications: {},
    recentNotifications: [],
    allNotifications: [],
    usermode: localStorage.getItem("USER_MODE") || "BUYER",
    loader: 0,
    screenWidth: window.innerWidth,
  },
  getters: {
    getUserNotifications: (state) => state.userNotifications,
    isBuyerMode: (state) => (state.usermode == "BUYER" ? true : false),
    getLoaderVal : state => state.loader,
    getScreenWidth: (state) => state.screenWidth,  
    getAllNotifications: (state) => state.allNotifications,
    getRecentNotifications: (state) => state.recentNotifications = state.allNotifications.slice(0, 4),
  },
  mutations: {

    setAllNotification(state, notification) {
      state.allNotifications = notification;
    },
    setScreenWidth(state, width) {
      state.screenWidth = width;
    },
    toggleUserMode(state) {
      state.usermode = state.usermode == "BUYER" ? "SELLER" : "BUYER";
      localStorage.setItem('USER_MODE',state.usermode);
    },
    setLoader(state,loader){
      state.loader=loader;
    }
  },
  actions: {
    async getNotification({ commit, getters }) {
      commit('setLoader',1);
      if(!getters.getAllNotifications.length > 0){
        const res = await Api.get("notification");
        if (res.status === 200) {
          commit("setAllNotification", res.data);
        } else {
          commit("setNotification", res);
        }
      }
      commit('setLoader',0);
    },


    async deleteNotification({ commit, getters },id) {
              const res = await Api.delete(`notifications/${id}/delete`);
        if (res.message === "Notification removed") {
          const notifications = ref(getters.getAllNotifications.filter(notification => notification.id != id))
          commit("setAllNotification", notifications.value);
          useToast("Notification Deleted", 'success');
        }
    },

    updateScreenWidthOnResize({ commit }) {
      commit("setScreenWidth", window.innerWidth);
      window.addEventListener("resize", () => {
        commit("setScreenWidth", window.innerWidth);
      });
    },
  },
  modules: {
    auth,
    home,
    services,
    seller,
    categories,
    buyer,
    become_seller,
    wishlist,
    chat,
    order
  },
});
