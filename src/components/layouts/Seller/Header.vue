<template>
  <header class="app-header fixed-top">
    <div class="app-header-inner">
      <div class="container-fluid py-2">
        <div class="app-header-content">
          <div class="row justify-content-between align-items-center">
            <div class="col-auto">
              <a id="sidepanel-toggler" class="sidepanel-toggler d-inline-block d-xl-none"
                @click="sidePanelOpened = !sidePanelOpened" href="#">
                <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" viewBox="0 0 30 30" role="img">
                  <title>Menu</title>
                  <path stroke="currentColor" stroke-linecap="round" stroke-miterlimit="10" stroke-width="2"
                    d="M4 7h22M4 15h22M4 23h22"></path>
                </svg>
              </a>
            </div>
            <!--//col-->
            <div class="app-utilities col-auto">
              <span class="mr-2">
                 <button type="button" class="btn btn-success" @click="handleUserMode">   {{ $t('nav.switchModeBtn', { mode: "Buyer" }) }}</button>
                <!-- <a class="cursor-pointer" @click="handleUserMode">
                  {{ $t('nav.switchModeBtn', { mode: "Buyer" }) }}
                </a> -->
              </span>
              <div class="
                  app-utility-item app-notifications-dropdown
                  dropdown
                  sm-fold-none
                ">
                <a class="dropdown-toggle no-toggle-arrow" id="notifications-dropdown-toggle" data-bs-toggle="dropdown"
                  href="#" role="button" aria-expanded="false" title="Notifications">
                  <!--//Bootstrap Icons: https://icons.getbootstrap.com/ -->
                  <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-bell icon" fill="currentColor"
                    xmlns="http://www.w3.org/2000/svg">
                    <path d="M8 16a2 2 0 0 0 2-2H6a2 2 0 0 0 2 2z" />
                    <path fill-rule="evenodd"
                      d="M8 1.918l-.797.161A4.002 4.002 0 0 0 4 6c0 .628-.134 2.197-.459 3.742-.16.767-.376 1.566-.663 2.258h10.244c-.287-.692-.502-1.49-.663-2.258C12.134 8.197 12 6.628 12 6a4.002 4.002 0 0 0-3.203-3.92L8 1.917zM14.22 12c.223.447.481.801.78 1H1c.299-.199.557-.553.78-1C2.68 10.2 3 6.88 3 6c0-2.42 1.72-4.44 4.005-4.901a1 1 0 1 1 1.99 0A5.002 5.002 0 0 1 13 6c0 .88.32 4.2 1.22 6z" />
                  </svg>
                  <!-- <span class="icon-badge">3</span> -->
                </a>
                <!--//dropdown-toggle-->

                <div class="dropdown-menu p-0" aria-labelledby="notifications-dropdown-toggle">
                  <div class="dropdown-menu-header p-3">
                    <h5 class="dropdown-menu-title mb-0">Notifications</h5>
                  </div>
                  <!--//dropdown-menu-title-->
                  <div class="dropdown-menu-content" data-v-777096b7="">
                    <div class="item p-3" data-v-777096b7="" v-for="notification in userNotification"
                      :key="notification.index" @click="handleNotification(notification)">
                      <div class="
                          row
                          gx-2
                          justify-content-between
                          align-items-center cursor-pointer
                        " data-v-777096b7="">
                        <div class="col-auto" data-v-777096b7="">
                          <img :src="`${imgURL}/${notification.sender_pic
                          ? notification.sender_pic
                          : '/assets/images/avator.png'
                          }`" class="profile-image img-full rounded-circle" alt="profile_img" />
                        </div>
                        <!--//col-->
                        <div class="col margn">
                          <div class="info">
                            <div class="desc">
                              <b> {{ notification.name }} </b>
                            </div>
                            <div class="desc">
                              {{ notification.body.substr(0, 22)
                              }}{{
    notification.body.length > 22 ? ".." : ""
}}
                            </div>
                          </div>
                          <div class="meta align-baseline mr-2">
                            {{ $filters.timeAgo(notification.created_at) }}
                          </div>
                        </div>
                        <!--//col-->
                      </div>
                      <!--//row-->
                      <!-- <a
                        href="/dashboard/notifications"
                        class="link-mask"
                        data-v-777096b7=""
                      ></a> -->
                    </div>
                  </div>
                  <!--//dropdown-menu-content-->

                  <div class="dropdown-menu-footer p-2 text-center">
                    <router-link to="/dashboard/notifications">View all</router-link>
                  </div>
                </div>
                <!--//dropdown-menu-->
              </div>


              <LanguageSwitcher />

            

              <div class="app-utility-item app-user-dropdown dropdown">
                <a class="dropdown-toggle" id="user-dropdown-toggle" data-bs-toggle="dropdown" href="#" role="button"
                  aria-haspopup="true" aria-expanded="false"><img :src="`${imgURL}/${user.image}`"
                    class="dropdown-user-img img-full rounded-circle" alt="profile_img" /></a>
                <ul class="dropdown-menu" aria-labelledby="user-dropdown-toggle">
                  <li>
                    <div class="dropdown-item d-flex">
                      <img :src="`${imgURL}/${user.image}`" class="dropdown-user-img img-full rounded-circle"
                        alt="profile_img" />
                      <div class="dropdown-user-details ml-1">
                        <div class="dropdown-user-details-name">
                          <b>{{ user.username }}</b>
                        </div>
                        <div>
                          {{ user.email }}
                        </div>
                      </div>
                    </div>
                  </li>
                  <li>
                    <hr class="dropdown-divider" />
                  </li>
                  <li>
                    <router-link class="dropdown-item" to="/dashboard/account"><i class="mdi mdi-account"></i> Account
                    </router-link>
                  </li>
                  <li>
                    <router-link class="dropdown-item" to="/dashboard/change_password">
                      <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                        class="bi bi-shield-lock" viewBox="0 0 16 16">
                        <path
                          d="M5.338 1.59a61.44 61.44 0 0 0-2.837.856.481.481 0 0 0-.328.39c-.554 4.157.726 7.19 2.253 9.188a10.725 10.725 0 0 0 2.287 2.233c.346.244.652.42.893.533.12.057.218.095.293.118a.55.55 0 0 0 .101.025.615.615 0 0 0 .1-.025c.076-.023.174-.061.294-.118.24-.113.547-.29.893-.533a10.726 10.726 0 0 0 2.287-2.233c1.527-1.997 2.807-5.031 2.253-9.188a.48.48 0 0 0-.328-.39c-.651-.213-1.75-.56-2.837-.855C9.552 1.29 8.531 1.067 8 1.067c-.53 0-1.552.223-2.662.524zM5.072.56C6.157.265 7.31 0 8 0s1.843.265 2.928.56c1.11.3 2.229.655 2.887.87a1.54 1.54 0 0 1 1.044 1.262c.596 4.477-.787 7.795-2.465 9.99a11.775 11.775 0 0 1-2.517 2.453 7.159 7.159 0 0 1-1.048.625c-.28.132-.581.24-.829.24s-.548-.108-.829-.24a7.158 7.158 0 0 1-1.048-.625 11.777 11.777 0 0 1-2.517-2.453C1.928 10.487.545 7.169 1.141 2.692A1.54 1.54 0 0 1 2.185 1.43 62.456 62.456 0 0 1 5.072.56z" />
                        <path
                          d="M9.5 6.5a1.5 1.5 0 0 1-1 1.415l.385 1.99a.5.5 0 0 1-.491.595h-.788a.5.5 0 0 1-.49-.595l.384-1.99a1.5 1.5 0 1 1 2-1.415z" />
                      </svg>
                      Change Password
                    </router-link>
                  </li>
                  <li>
                    <button class="dropdown-item" @click="handleLogout()">
                      <i class="mdi mdi-logout"></i> Log Out
                    </button>
                  </li>
                </ul>
              </div>
              <!--//app-user-dropdown-->
            </div>
            <!--//app-utilities-->
          </div>
          <!--//row-->
        </div>
        <!--//app-header-content-->
      </div>
      <!--//container-fluid-->
    </div>

    <SidePanel :sidePanelOpen="sidePanelOpened" @sidPanelClose="sidePanelOpened = false" />
  </header>
</template>

<script>
import Api from "@/services/API";
import SidePanel from "./SidePanel.vue";
import { onMounted, computed, ref } from "vue";
import { useStore } from "vuex";
import { useRouter } from "vue-router";
import LanguageSwitcher from '@/components/LanguageSwitcher.vue'
export default {
  components: { SidePanel,LanguageSwitcher },
  setup() {
    const store = useStore();
    const router = useRouter();
    const sidePanelOpened = ref(false);

    const isBuyerMode = computed(() => store.getters.isBuyerMode);

    const handleLogout = async () => {
      const response = await Api.post("logout");
      if (response.status === 200) {
        localStorage.clear();
        window.location.href = '/login';
      }
    };

    onMounted(() => {
      if (isBuyerMode.value) {
        store.commit("toggleUserMode");
      }
    });
    function handleNotification(notification) {
      console.log(notification.type)
      switch (notification.type) {
        case "ORDER": {
          router.push(`/dashboard/order-details/${notification.content_id}`);
          break;
        }
        case "OFFER": {
          router.push(`/dashboard/buyer/view-offers/${notification.content_id}`);
          break;
        }
        case "MESSAGE": {
          router.push("/dashboard/chat");
          break;
        }
        default: {
          router.push("/dashboard/notifications");
        }
      }
    }
    const handleUserMode = () => {
      store.commit("toggleUserMode");
      if (isBuyerMode.value) {
        router.push({ name: "Home" });
      } else {
        router.push({ name: "sellerDashboard" });
      }
    };

    return {
      sidePanelOpened,
      handleNotification,
      userNotification: computed(() => store.getters.getRecentNotifications),
      user: computed(() => store.getters.getAuthUser),
      imgURL: process.env.VUE_APP_URL,
      isBuyerMode,
      handleUserMode,
      handleLogout,
    };
  },
};
</script>

<style scoped>
.app-utilities {
  display: flex;
  align-items: center;
}

.app-user-dropdown>a::after {
  display: none;
}

@media (max-width: 280px) {
  .sm-fold-none {
    display: none;
  }
}

.margn {
  margin-left: -15px;
}
</style>