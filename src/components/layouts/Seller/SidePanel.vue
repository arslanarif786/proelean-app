<template>
  <div
    id="app-sidepanel"
    class="app-sidepanel"
    :class="`${
      sidePanelOpen || $store.getters.getScreenWidth > 1200
        ? 'sidepanel-visible'
        : 'sidepanel-hidden'
    }`"
  >
    <div
      id="sidepanel-drop"
      @click="$emit('sidPanelClose')"
      class="sidepanel-drop"
    ></div>
    <div class="sidepanel-inner d-flex flex-column">

      <div class="app-branding">
        <router-link class="app-logo" to="/dashboard"
          >
          <img
            class="logo-icon me-2"
            :src="`${imgURL}/${'/assets/images/Pro-eLean-.png'}`"
            alt="logo"
          /><span class="logo-text"> Pro eLean</span></router-link
        >
      </div>
      <!--//app-branding-->

      <nav id="app-nav-main" class="app-nav app-nav-main flex-grow-1">
        <ul class="app-menu list-unstyled accordion" id="menu-accordion">
          <li class="nav-item" v-for="(item, index) in items" :key="index">
            <!--//Bootstrap Icons: https://icons.getbootstrap.com/ -->
            <router-link
              class="nav-link"
              :class="{ active: item.path == $route.path }"
              :to="item.path"
              @click="handleCloseSideBar(item.path)"
            >
              <span class="nav-icon">
                <svg
                  width="1em"
                  height="1em"
                  viewBox="0 0 16 16"
                  class="bi bi-house-door"
                  fill="currentColor"
                  xmlns="http://www.w3.org/2000/svg"
                >
                  <path
                    v-for="(path, index) in item.svgPaths"
                    :key="index"
                    fill-rule="evenodd"
                    :d="path"
                  />
                </svg>
              </span>
              <span class="nav-link-text">{{ $t('sidebar.'+item.titleKey) }}</span> </router-link
            ><!--//nav-link-->
          </li>
        </ul>
        <!--//app-menu-->
      </nav>
      <!--//app-nav-->
      <div class="app-sidepanel-footer">
        <nav class="app-nav app-nav-footer">
          <ul class="app-menu footer-menu list-unstyled">
            <li class="nav-item">
              <!--//Bootstrap Icons: https://icons.getbootstrap.com/ -->
              <!-- <router-link class="nav-link" to="/dashboard/settings">
                <span class="nav-icon">
                  <svg
                    width="1em"
                    height="1em"
                    viewBox="0 0 16 16"
                    class="bi bi-gear"
                    fill="currentColor"
                    xmlns="http://www.w3.org/2000/svg"
                  >
                    <path
                      fill-rule="evenodd"
                      d="M8.837 1.626c-.246-.835-1.428-.835-1.674 0l-.094.319A1.873 1.873 0 0 1 4.377 3.06l-.292-.16c-.764-.415-1.6.42-1.184 1.185l.159.292a1.873 1.873 0 0 1-1.115 2.692l-.319.094c-.835.246-.835 1.428 0 1.674l.319.094a1.873 1.873 0 0 1 1.115 2.693l-.16.291c-.415.764.42 1.6 1.185 1.184l.292-.159a1.873 1.873 0 0 1 2.692 1.116l.094.318c.246.835 1.428.835 1.674 0l.094-.319a1.873 1.873 0 0 1 2.693-1.115l.291.16c.764.415 1.6-.42 1.184-1.185l-.159-.291a1.873 1.873 0 0 1 1.116-2.693l.318-.094c.835-.246.835-1.428 0-1.674l-.319-.094a1.873 1.873 0 0 1-1.115-2.692l.16-.292c.415-.764-.42-1.6-1.185-1.184l-.291.159A1.873 1.873 0 0 1 8.93 1.945l-.094-.319zm-2.633-.283c.527-1.79 3.065-1.79 3.592 0l.094.319a.873.873 0 0 0 1.255.52l.292-.16c1.64-.892 3.434.901 2.54 2.541l-.159.292a.873.873 0 0 0 .52 1.255l.319.094c1.79.527 1.79 3.065 0 3.592l-.319.094a.873.873 0 0 0-.52 1.255l.16.292c.893 1.64-.902 3.434-2.541 2.54l-.292-.159a.873.873 0 0 0-1.255.52l-.094.319c-.527 1.79-3.065 1.79-3.592 0l-.094-.319a.873.873 0 0 0-1.255-.52l-.292.16c-1.64.893-3.433-.902-2.54-2.541l.159-.292a.873.873 0 0 0-.52-1.255l-.319-.094c-1.79-.527-1.79-3.065 0-3.592l.319-.094a.873.873 0 0 0 .52-1.255l-.16-.292c-.892-1.64.902-3.433 2.541-2.54l.292.159a.873.873 0 0 0 1.255-.52l.094-.319z"
                    />
                    <path
                      fill-rule="evenodd"
                      d="M8 5.754a2.246 2.246 0 1 0 0 4.492 2.246 2.246 0 0 0 0-4.492zM4.754 8a3.246 3.246 0 1 1 6.492 0 3.246 3.246 0 0 1-6.492 0z"
                    />
                  </svg>
                </span>
                <span class="nav-link-text">Settings</span> </router-link
              >//nav-link -->
            </li>
            <!--//nav-item-->
          </ul>
          <!--//footer-menu-->
        </nav>
      </div>
      <!--//app-sidepanel-footer-->
    </div>
    <!--//sidepanel-inner-->
  </div>
</template>

<script>
import { useRouter } from "vue-router";
const items = [
  {
    titleKey: "dashboard",
    svgPaths: [
      "M7.646 1.146a.5.5 0 0 1 .708 0l6 6a.5.5 0 0 1 .146.354v7a.5.5 0 0 1-.5.5H9.5a.5.5 0 0 1-.5-.5v-4H7v4a.5.5 0 0 1-.5.5H2a.5.5 0 0 1-.5-.5v-7a.5.5 0 0 1 .146-.354l6-6zM2.5 7.707V14H6v-4a.5.5 0 0 1 .5-.5h3a.5.5 0 0 1 .5.5v4h3.5V7.707L8 2.207l-5.5 5.5z",
      "M13 2.5V6l-2-2V2.5a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5z",
    ],
    path: "/dashboard",
    hasSubMenu: false,
  },
  {
    titleKey: "services",
    svgPaths: [
      "M9.828 4a3 3 0 0 1-2.12-.879l-.83-.828A1 1 0 0 0 6.173 2H2.5a1 1 0 0 0-1 .981L1.546 4h-1L.5 3a2 2 0 0 1 2-2h3.672a2 2 0 0 1 1.414.586l.828.828A2 2 0 0 0 9.828 3v1z",
      "M13.81 4H2.19a1 1 0 0 0-.996 1.09l.637 7a1 1 0 0 0 .995.91h10.348a1 1 0 0 0 .995-.91l.637-7A1 1 0 0 0 13.81 4zM2.19 3A2 2 0 0 0 .198 5.181l.637 7A2 2 0 0 0 2.826 14h10.348a2 2 0 0 0 1.991-1.819l.637-7A2 2 0 0 0 13.81 3H2.19z",
    ],
    path: "/dashboard/sellers-services",
    hasSubMenu: false,
  },
  {
    titleKey: "orders",
    svgPaths: [
      "M8.186 1.113a.5.5 0 0 0-.372 0L1.846 3.5 8 5.961 14.154 3.5 8.186 1.113zM15 4.239l-6.5 2.6v7.922l6.5-2.6V4.24zM7.5 14.762V6.838L1 4.239v7.923l6.5 2.6zM7.443.184a1.5 1.5 0 0 1 1.114 0l7.129 2.852A.5.5 0 0 1 16 3.5v8.662a1 1 0 0 1-.629.928l-7.185 2.874a.5.5 0 0 1-.372 0L.63 13.09a1 1 0 0 1-.63-.928V3.5a.5.5 0 0 1 .314-.464L7.443.184z",
    ],

    path: "/dashboard/orders",
    hasSubMenu: false,
  },
  {
    titleKey: "analytics",
    svgPaths: [
      "M0 0h1v15h15v1H0V0Zm10 3.5a.5.5 0 0 1 .5-.5h4a.5.5 0 0 1 .5.5v4a.5.5 0 0 1-1 0V4.9l-3.613 4.417a.5.5 0 0 1-.74.037L7.06 6.767l-3.656 5.027a.5.5 0 0 1-.808-.588l4-5.5a.5.5 0 0 1 .758-.06l2.609 2.61L13.445 4H10.5a.5.5 0 0 1-.5-.5Z",
    ],

    path: "/dashboard/analytics",
    hasSubMenu: false,
  },
  {
    titleKey: "notifications",
    svgPaths: [
      "M8 16a2 2 0 0 0 2-2H6a2 2 0 0 0 2 2zM8 1.918l-.797.161A4.002 4.002 0 0 0 4 6c0 .628-.134 2.197-.459 3.742-.16.767-.376 1.566-.663 2.258h10.244c-.287-.692-.502-1.49-.663-2.258C12.134 8.197 12 6.628 12 6a4.002 4.002 0 0 0-3.203-3.92L8 1.917zM14.22 12c.223.447.481.801.78 1H1c.299-.199.557-.553.78-1C2.68 10.2 3 6.88 3 6c0-2.42 1.72-4.44 4.005-4.901a1 1 0 1 1 1.99 0A5.002 5.002 0 0 1 13 6c0 .88.32 4.2 1.22 6z",
    ],
    path: "/dashboard/notifications",
    hasSubMenu: false,
  },
  {
    titleKey: "chat",
    svgPaths: [
      "M2 1a1 1 0 0 0-1 1v8a1 1 0 0 0 1 1h9.586a2 2 0 0 1 1.414.586l2 2V2a1 1 0 0 0-1-1H2zm12-1a2 2 0 0 1 2 2v12.793a.5.5 0 0 1-.854.353l-2.853-2.853a1 1 0 0 0-.707-.293H2a2 2 0 0 1-2-2V2a2 2 0 0 1 2-2h12z",
      "M5 6a1 1 0 1 1-2 0 1 1 0 0 1 2 0zm4 0a1 1 0 1 1-2 0 1 1 0 0 1 2 0zm4 0a1 1 0 1 1-2 0 1 1 0 0 1 2 0z",
    ],
    path: "/dashboard/chat",
    hasSubMenu: false,
  },
  {
    titleKey: "buyerRequest",
    svgPaths: [
      "M15 14s1 0 1-1-1-4-5-4-5 3-5 4 1 1 1 1h8zm-7.978-1A.261.261 0 0 1 7 12.996c.001-.264.167-1.03.76-1.72C8.312 10.629 9.282 10 11 10c1.717 0 2.687.63 3.24 1.276.593.69.758 1.457.76 1.72l-.008.002a.274.274 0 0 1-.014.002H7.022zM11 7a2 2 0 1 0 0-4 2 2 0 0 0 0 4zm3-2a3 3 0 1 1-6 0 3 3 0 0 1 6 0zM6.936 9.28a5.88 5.88 0 0 0-1.23-.247A7.35 7.35 0 0 0 5 9c-4 0-5 3-5 4 0 .667.333 1 1 1h4.216A2.238 2.238 0 0 1 5 13c0-1.01.377-2.042 1.09-2.904.243-.294.526-.569.846-.816zM4.92 10A5.493 5.493 0 0 0 4 13H1c0-.26.164-1.03.76-1.724.545-.636 1.492-1.256 3.16-1.275zM1.5 5.5a3 3 0 1 1 6 0 3 3 0 0 1-6 0zm3-2a2 2 0 1 0 0 4 2 2 0 0 0 0-4z",
    ],
    path: "/dashboard/buyer_requests",
    hasSubMenu: false,
  },
  {
    titleKey: "withdrawal",
    svgPaths: [
      "M4 9.42h1.063C5.4 12.323 7.317 14 10.34 14c.622 0 1.167-.068 1.659-.185v-1.3c-.484.119-1.045.17-1.659.17-2.1 0-3.455-1.198-3.775-3.264h4.017v-.928H6.497v-.936c0-.11 0-.219.008-.329h4.078v-.927H6.618c.388-1.898 1.719-2.985 3.723-2.985.614 0 1.175.05 1.659.177V2.194A6.617 6.617 0 0 0 10.341 2c-2.928 0-4.82 1.569-5.244 4.3H4v.928h1.01v1.265H4v.928z",
    ],
    path: "/dashboard/payments",
    hasSubMenu: false,
    subMenus: [
      {
        titleKey: "payments",
        path: "/payments",
      },
      {
        titleKey: "notification",
        path: "/dashboard/notifications",
      },
    ],
  },
  {
    titleKey: "account",
    svgPaths: [
      "M8 8a3 3 0 1 0 0-6 3 3 0 0 0 0 6zm2-3a2 2 0 1 1-4 0 2 2 0 0 1 4 0zm4 8c0 1-1 1-1 1H3s-1 0-1-1 1-4 6-4 6 3 6 4zm-1-.004c-.001-.246-.154-.986-.832-1.664C11.516 10.68 10.289 10 8 10c-2.29 0-3.516.68-4.168 1.332-.678.678-.83 1.418-.832 1.664h10z",
    ],
    path: "/dashboard/account",
    hasSubMenu: false,
  },
];
export default {
  props: {
    sidePanelOpen: {
      Type: Boolean,
      default: false,
    },
  },

  setup() {
    const router = useRouter();
    function handleCloseSideBar(path) {
      document.getElementById("sidepanel-close").click();
      router.push(path);
    }
    return {
      items,
      imgURL: process.env.VUE_APP_URL,
      handleCloseSideBar,
    };
  },
};
</script>

<style>
</style>