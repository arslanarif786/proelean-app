<template>
  <nav class="
      navbar navbar-expand-lg navbar-light
      topbar
      static-top
      shadow-sm
      bg-white
      osahan-nav-top
      px-0
    ">
    <div class="container-fluid mobile-p-0">
      <!-- Sidebar Toggle (Topbar) -->
      <a class="navbar-brand">
        <router-link to="/"><img src="/assets/images/Pro-eLean-.png" alt="Proelean logo" /> </router-link>
      </a>
      <!-- Topbar Search -->
      <form @submit.prevent="handleSearch" class="
          d-none d-sm-inline-block
          form-inline
          mr-auto
          my-2 my-md-0
          mw-100
          navbar-search
        " style="width: 34%">
        <div class="input-group">
          <input type="text" v-model="keywords" class="form-control bg-white small" :placeholder="$t('find.findServices')"
            aria-label="Search" aria-describedby="basic-addon2" />
          <div class="input-group-append">
            <button class="btn btn-success" @click.prevent="handleSearch" type="button">
              <i class="fa fa-search fa-sm"></i>
            </button>
          </div>
        </div>
        <!-- <div>
          <h4 class="text-muted">Pro Elean</h4>
        </div> -->
      </form>
      <!-- Topbar Navbar -->
      <ul class="navbar-nav align-items-center ml-auto">
        <li class="
            nav-item
            dropdown
            no-arrow no-caret
            mr-3
            dropdown-notifications
            d-sm-none
          ">
          <a class="
              btn btn-icon btn-transparent-dark
              dropdown-toggle
              d-none d-sm-block
            " href="#" id="searchDropdown" role="button" data-toggle="dropdown" aria-haspopup="true"
            aria-expanded="false">
            <i class="fa fa-search fa-fw"></i>
          </a>
          <!-- Dropdown - Messages -->
          <div class="
              dropdown-menu dropdown-menu-right
              p-3
              shadow-sm
              animated--grow-in
            " aria-labelledby="searchDropdown">
            <form class="form-inline mr-auto w-100 navbar-search">
              <div class="input-group">
                <input type="text" class="form-control bg-light border-0 small" :placeholder="$t('find.findServices')"
                  aria-label="Search" aria-describedby="basic-addon2" />
                <div class="input-group-append">
                  <button class="btn btn-primary" type="button">
                    <i class="fa fa-search fa-sm"></i>
                  </button>
                </div>
              </div>
            </form>
          </div>
        </li>

        <ul class="navbar-nav align-items-center ml-auto" v-if="$store.state.isLoggedIn">
          <span class="mr-2" v-if="user.isFreelancer">
            <button type="button" class="btn btn-success" @click="handleUserMode">  {{ $t('nav.switchModeBtn', { mode: "Seller" }) }}</button>
            <!-- <a class="cursor-pointer" @click="handleUserMode">
              {{ $t('nav.switchModeBtn', { mode: "Seller" }) }}
            </a> -->
          </span>

          <!-- Buyer Requests-->
          <li v-if="!isBuyerMode" class="
              nav-item
              dropdown
              no-arrow no-caret
              mr-3
              dropdown-notifications
              show
              d-none d-lg-block
            " :disabled="userInfo.isFreelancer">
            <router-link to="/seller/buyer_requests" class="btn btn-icon btn-transparent-dark dropdown-toggle"
              data-bs-toggle="tooltip" data-bs-placement="top" title="Buyer Requests">
              <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                class="bi bi-person-lines-fill" viewBox="0 0 16 16">
                <path
                  d="M6 8a3 3 0 1 0 0-6 3 3 0 0 0 0 6zm-5 6s-1 0-1-1 1-4 6-4 6 3 6 4-1 1-1 1H1zM11 3.5a.5.5 0 0 1 .5-.5h4a.5.5 0 0 1 0 1h-4a.5.5 0 0 1-.5-.5zm.5 2.5a.5.5 0 0 0 0 1h4a.5.5 0 0 0 0-1h-4zm2 3a.5.5 0 0 0 0 1h2a.5.5 0 0 0 0-1h-2zm0 3a.5.5 0 0 0 0 1h2a.5.5 0 0 0 0-1h-2z" />
              </svg>
            </router-link>
          </li>




          <!--===================== Buyer Module============== -->
          <!-- Manage Jobs -->
          <li v-if="isBuyerMode" class="
              nav-item
              dropdown
              no-arrow no-caret
              mr-3
              dropdown-notifications
              show
              d-none d-lg-block
            ">
            <router-link to="/buyer/jobs" class="btn btn-icon btn-transparent-dark dropdown-toggle "
              data-bs-toggle="tooltip" data-bs-placement="top" :title="$t('nav.manageJobs')"
              :class="{ focus: $route.path === '/buyer/jobs' }">
              <!-- :focus-link="$route.path ==='/buyer/jobs'"
              @focus="$route.path ==='/buyer/jobs'" -->
              <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-briefcase"
                viewBox="0 0 16 16">
                <path
                  d="M6.5 1A1.5 1.5 0 0 0 5 2.5V3H1.5A1.5 1.5 0 0 0 0 4.5v8A1.5 1.5 0 0 0 1.5 14h13a1.5 1.5 0 0 0 1.5-1.5v-8A1.5 1.5 0 0 0 14.5 3H11v-.5A1.5 1.5 0 0 0 9.5 1h-3zm0 1h3a.5.5 0 0 1 .5.5V3H6v-.5a.5.5 0 0 1 .5-.5zm1.886 6.914L15 7.151V12.5a.5.5 0 0 1-.5.5h-13a.5.5 0 0 1-.5-.5V7.15l6.614 1.764a1.5 1.5 0 0 0 .772 0zM1.5 4h13a.5.5 0 0 1 .5.5v1.616L8.129 7.948a.5.5 0 0 1-.258 0L1 6.116V4.5a.5.5 0 0 1 .5-.5z" />
              </svg>
            </router-link>
          </li>
          <!-- Create Jobs -->
          <li v-if="isBuyerMode" class="
              nav-item
              dropdown
              no-arrow no-caret
              mr-3
              dropdown-notifications
              show
              d-none d-lg-block
            ">
            <router-link to="/buyer/create_job" class="btn btn-icon btn-transparent-dark dropdown-toggle"
              data-bs-toggle="tooltip" data-bs-placement="top" :title="$t('nav.createJobs')"
              :class="{ focus: $route.path === '/buyer/create_job' }">
              <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-bag-plus"
                viewBox="0 0 16 16">
                <path fill-rule="evenodd"
                  d="M8 7.5a.5.5 0 0 1 .5.5v1.5H10a.5.5 0 0 1 0 1H8.5V12a.5.5 0 0 1-1 0v-1.5H6a.5.5 0 0 1 0-1h1.5V8a.5.5 0 0 1 .5-.5z" />
                <path
                  d="M8 1a2.5 2.5 0 0 1 2.5 2.5V4h-5v-.5A2.5 2.5 0 0 1 8 1zm3.5 3v-.5a3.5 3.5 0 1 0-7 0V4H1v10a2 2 0 0 0 2 2h10a2 2 0 0 0 2-2V4h-3.5zM2 5h12v9a1 1 0 0 1-1 1H3a1 1 0 0 1-1-1V5z" />
              </svg>
            </router-link>
          </li>
          <!-- Manage Order -->
          <li class="
              nav-item
              dropdown
              no-arrow no-caret
              mr-3
              dropdown-notifications
              show
              d-none d-lg-block
            ">
            <router-link to="/buyer/manage_order" class="btn btn-icon btn-transparent-dark dropdown-toggle"
              data-bs-toggle="tooltip" data-bs-placement="top" :title="$t('nav.manageOrders')"
              :class="{ focus: $route.path === '/buyer/manage_order' }">
              <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-bag-check"
                viewBox="0 0 16 16">
                <path fill-rule="evenodd"
                  d="M10.854 8.146a.5.5 0 0 1 0 .708l-3 3a.5.5 0 0 1-.708 0l-1.5-1.5a.5.5 0 0 1 .708-.708L7.5 10.793l2.646-2.647a.5.5 0 0 1 .708 0z" />
                <path
                  d="M8 1a2.5 2.5 0 0 1 2.5 2.5V4h-5v-.5A2.5 2.5 0 0 1 8 1zm3.5 3v-.5a3.5 3.5 0 1 0-7 0V4H1v10a2 2 0 0 0 2 2h10a2 2 0 0 0 2-2V4h-3.5zM2 5h12v9a1 1 0 0 1-1 1H3a1 1 0 0 1-1-1V5z" />
              </svg>
            </router-link>
          </li>
          <!-- Favourite Services -->
          <li v-if="isBuyerMode" class="
              nav-item
              dropdown
              no-arrow no-caret
              mr-3
              dropdown-notifications
              show
              d-none d-lg-block
            ">
            <router-link to="/buyer/favourite_services" class="btn btn-icon btn-transparent-dark dropdown-toggle"
              data-bs-toggle="tooltip" data-bs-placement="top" :title="$t('nav.favouriteServices')"
              :class="{ focus: $route.path === '/buyer/favourite_services' }">
              <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-heart"
                viewBox="0 0 16 16">
                <path
                  d="m8 2.748-.717-.737C5.6.281 2.514.878 1.4 3.053c-.523 1.023-.641 2.5.314 4.385.92 1.815 2.834 3.989 6.286 6.357 3.452-2.368 5.365-4.542 6.286-6.357.955-1.886.838-3.362.314-4.385C13.486.878 10.4.28 8.717 2.01L8 2.748zM8 15C-7.333 4.868 3.279-3.04 7.824 1.143c.06.055.119.112.176.171a3.12 3.12 0 0 1 .176-.17C12.72-3.042 23.333 4.867 8 15z" />
              </svg>
            </router-link>
          </li>

          <!-- @if(isset($user) && !is_null($user)) -->
          <li class="
              nav-item
              dropdown
              no-arrow no-caret
              mr-1
              dropdown-notifications
            ">
            <a class="btn btn-icon btn-transparent-dark dropdown-toggle" id="navbarDropdownAlerts"
              href="javascript:void(0);" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"
              data-bs-toggle="tooltip" data-bs-placement="top" :title="$t('nav.notifications')"
              :class="{ focus: $route.path === '/buyer/notifications' }">
              <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                class="feather feather-bell">
                <path d="M18 8A6 6 0 0 0 6 8c0 7-3 9-3 9h18s-3-2-3-9"></path>
                <path d="M13.73 21a2 2 0 0 1-3.46 0"></path>
              </svg>
            </a>
            <div class="
                dropdown-menu dropdown-menu-right
                border-0
                shadow
                animated--fade-in-up
              " aria-labelledby="navbarDropdownAlerts">
              <h6 class="dropdown-header dropdown-notifications-header">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                  stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                  class="feather feather-bell mr-2">
                  <path d="M18 8A6 6 0 0 0 6 8c0 7-3 9-3 9h18s-3-2-3-9"></path>
                  <path d="M13.73 21a2 2 0 0 1-3.46 0"></path>
                </svg>
                {{ $t('notifications.recentNotification') }}
              </h6>
              <router-link v-for="notification in userNotification" :key="notification.index" class="
                  dropdown-item dropdown-notifications-item
                  d-flex
                  justify-content-between
                " to="#" @click.prevent="handleNotification(notification)">
                <div class="d-flex justify-content-start">
                  <div class="dropdown-notifications-item-icon bg-warning">
                    <img :src="`${imgURL}/${notification.sender_pic
                      ? notification.sender_pic
                      : '/assets/images/avator.png'
                    }`" class="profile-image img-full rounded-circle" alt="profile_img" />
                  </div>
                  <div class="dropdown-notifications-item-content">
                    <b>{{ notification.name }}</b>
                    <div class="text-muted small">
                      {{ notification.body.substr(0, 29) }}
                    </div>
                  </div>
                </div>
                <div class="text-muted small ml-2">
                  {{ $filters.timeAgo(notification.created_at) }}
                </div>
              </router-link>
              <router-link class="dropdown-item dropdown-notifications-footer" to="/buyer/notifications">
                {{ $t('notifications.viewAllNotification') }}
              </router-link>
            </div>
          </li>
          <!-- Chat   -->
          <li class="
              nav-item
              dropdown
              no-arrow no-caret
              dropdown-user
              mx-2
              d-none d-lg-block
            ">
            <router-link class="btn btn-icon btn-transparent-dark dropdown-toggle" id="navbarDropdownMessages"
              aria-haspopup="true" aria-expanded="false" data-bs-toggle="tooltip" data-bs-placement="top" :title="$t('nav.chat')"
              to="/chat" :class="{ focus: $route.path === '/chat' }">
              <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                class="feather feather-mail">
                <path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"></path>
                <polyline points="22,6 12,13 2,6"></polyline>
              </svg>
            </router-link>
            <!-- <div
              class="
                dropdown-menu dropdown-menu-right
                border-0
                shadow
                animated--fade-in-up
              "
              aria-labelledby="navbarDropdownMessages"
            >
              <h6 class="dropdown-header dropdown-notifications-header">
                <svg
                  xmlns="http://www.w3.org/2000/svg"
                  width="24"
                  height="24"
                  viewBox="0 0 24 24"
                  fill="none"
                  stroke="currentColor"
                  stroke-width="2"
                  stroke-linecap="round"
                  stroke-linejoin="round"
                  class="feather feather-mail mr-2"
                >
                  <path
                    d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"
                  ></path>
                  <polyline points="22,6 12,13 2,6"></polyline>
                </svg>
                Message Center
              </h6>

              <MessageCenter
                v-for="conversation in $store.getters.getConversations"
                :conversation="conversation"
                :key="conversation.id"
              />
            </div> -->
          </li>
          <!-- languages li start -->

          <LanguageSwitcher />

          <!-- languages li end -->
          <li class="nav-item dropdown no-arrow no-caret dropdown-user">
            <a class="btn btn-icon btn-transparent-dark dropdown-toggle" id="navbarDropdownUserImage"
              href="javascript:void(0);" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"
              data-bs-toggle="tooltip" data-bs-placement="top" :title="$t('nav.profile')">
              <img :src="`${imgURL}/${user.image ? user.image : '/assets/images/avator.png'
              }`" class="dropdown-user-img img-full" alt="profile_img" />
            </a>
            <div class="
                dropdown-menu dropdown-menu-right
                border-0
                shadow
                animated--fade-in-up
              " aria-labelledby="navbarDropdownUserImage">
              <h6 class="dropdown-header px-3 py-1 d-flex align-items-center">
                <img :src="`${imgURL}/${user.image}`" class="dropdown-user-img img-full mr-1" alt="profile_img" />
                <div class="dropdown-user-details ml-1">
                  <div class="dropdown-user-details-name">
                    {{ userInfo.username }}
                  </div>
                  <div class="dropdown-user-details">
                    {{ userInfo.email }}
                  </div>
                </div>
              </h6>
              <div class="dropdown-divider"></div>
              <router-link class="dropdown-item" to="/buyer-account">
                <div class="dropdown-item-icon">
                  <i class="mdi mdi-account"></i>
                </div>
                {{ $t('nav.account') }}
              </router-link>
              <router-link class="dropdown-item" to="/buyer/change_password">
                <div class="dropdown-item-icon">
                  <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                    class="bi bi-shield-lock" viewBox="0 0 16 16">
                    <path
                      d="M5.338 1.59a61.44 61.44 0 0 0-2.837.856.481.481 0 0 0-.328.39c-.554 4.157.726 7.19 2.253 9.188a10.725 10.725 0 0 0 2.287 2.233c.346.244.652.42.893.533.12.057.218.095.293.118a.55.55 0 0 0 .101.025.615.615 0 0 0 .1-.025c.076-.023.174-.061.294-.118.24-.113.547-.29.893-.533a10.726 10.726 0 0 0 2.287-2.233c1.527-1.997 2.807-5.031 2.253-9.188a.48.48 0 0 0-.328-.39c-.651-.213-1.75-.56-2.837-.855C9.552 1.29 8.531 1.067 8 1.067c-.53 0-1.552.223-2.662.524zM5.072.56C6.157.265 7.31 0 8 0s1.843.265 2.928.56c1.11.3 2.229.655 2.887.87a1.54 1.54 0 0 1 1.044 1.262c.596 4.477-.787 7.795-2.465 9.99a11.775 11.775 0 0 1-2.517 2.453 7.159 7.159 0 0 1-1.048.625c-.28.132-.581.24-.829.24s-.548-.108-.829-.24a7.158 7.158 0 0 1-1.048-.625 11.777 11.777 0 0 1-2.517-2.453C1.928 10.487.545 7.169 1.141 2.692A1.54 1.54 0 0 1 2.185 1.43 62.456 62.456 0 0 1 5.072.56z" />
                    <path
                      d="M9.5 6.5a1.5 1.5 0 0 1-1 1.415l.385 1.99a.5.5 0 0 1-.491.595h-.788a.5.5 0 0 1-.49-.595l.384-1.99a1.5 1.5 0 1 1 2-1.415z" />
                  </svg>
                </div>
                {{ $t('nav.changePassword') }}
              </router-link>

              <button class="dropdown-item" @click="handleLogout">
                <div class="dropdown-item-icon">
                  <i class="mdi mdi-logout"></i>
                </div>
                {{ $t('nav.logout') }}
              </button>
            </div>
          </li>
        </ul>
        

        <!-- Before Login Nav Start -->
        <ul class="navbar-nav align-items-center ml-auto" v-else>
          <!-- @else -->
          <LanguageSwitcher />
          
          <!-- login Button -->
          <li class="nav-item dropdown no-arrow no-caret dropdown-user m-2">
            <router-link class="btn btn-success" to="/login">Login</router-link>
          </li>

          <!-- Signup Button -->
          <li class="nav-item dropdown no-arrow no-caret dropdown-user">
            <router-link class="btn btn-success" to="/register">Register</router-link>
          </li>
          <!-- @endif -->
        </ul>
        <!-- Before Login Nav End -->
      </ul>
    </div>
  </nav>
</template>

<script>
import Api from "@/services/API";
import { useRouter } from "vue-router";
import { computed, onMounted, ref } from "@vue/runtime-core";
import { useStore } from "vuex";
import LanguageSwitcher from "../LanguageSwitcher.vue";

export default {
  setup() {
    const store = useStore();
    const router = useRouter();
    const keywords = ref(null);
    const isBuyerMode = computed(() => store.getters.isBuyerMode);
    // const activeItem = ref()
    const handleLogout = async () => {
      const response = await Api.post("logout");
      if (response.status === 200) {
        localStorage.clear();
        window.location.href = "/login";
      }
    };
    onMounted(() => {
      const isLoggedIn = localStorage.getItem("PROELEAN_TOKEN");
      if (isLoggedIn) {
        store.dispatch("getNotification");
      }
      // tooltip
      // const tooltipTriggerList = [].slice.call(
      //   document.querySelectorAll('[data-bs-toggle="tooltip"]')
      // );
      // tooltipTriggerList.map(function (tooltipTriggerEl) {
      //   return new window.bootstrap.Tooltip(tooltipTriggerEl);
      // });
    });
    const handleSearch = () => {
      let url = keywords.value ? `/gigs/${slugify(keywords.value)}` : "/gigs";
      router.push(url);
      keywords.value = "";
    };
    const handleUserMode = () => {
      store.commit("toggleUserMode");
      if (isBuyerMode.value) {
        router.push({ name: "Home" });
      }
      else {
        router.push({ name: "sellerDashboard" });
      }
    };
    function handleNotification(notification) {
      switch (notification.type) {
        case "ORDER":
          router.push(`/order-details/${notification.content_id}`);
          break;
        case "OFFER":
          router.push(`/buyer/view-offers/${notification.content_id}`);
          break;
        case "MESSAGE":
          router.push("/chat");
          break;
      }
    }
    // /* Encode string to slug */
    /* eslint-disable */
    function slugify(text) {
      return text
        .toString()
        .normalize("NFKD")
        .toLowerCase()
        .trim()
        .replace(/\s+/g, "-")
        .replace(/[^\w\-]+/g, "")
        .replace(/\-\-+/g, "-");
    }
    return {
      handleLogout,
      handleSearch,
      keywords,
      userInfo: computed(() => store.getters.getAuthUser),
      userNotification: computed(() => store.getters.getRecentNotifications),
      user: computed(() => store.getters.getAuthUser),
      imgURL: process.env.VUE_APP_URL,
      handleUserMode,
      isBuyerMode,
      handleNotification,
    };
  },
  components: { LanguageSwitcher }
};
</script>

<style lang="scss" scoped>
.mobile-p-0 {
  @media screen and (max-width: 568px) {
    padding: 0;
  }
}

.focus {
  background: orangered;
  color: white;

}

.btn.focus,
.btn:focus {
  // background: orangered;
  //   color: white;
  box-shadow: none;
}
 
</style>

