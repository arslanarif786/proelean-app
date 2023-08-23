<template>
  <div class="col-lg-4 left">
    <div class="profile_info">
      <div class="seller-card">
        <div>
          <div class="user-online-indicator is-online" data-user-id="1152855">
            <i class="fa fa-circle"></i>online
          </div>
        </div>
  
        <div class="user-profile-info">
          <div>
            <div class="user-profile-image">
              <label class="user-pict">
                <img
                  :src="`${imgURL}/${user.image}`"
                  class="img-full"
                  alt="profile_img"
                />
              </label>
            </div>
          </div>
          <div class="user-profile-label">
            <div class="username-line">
              <a href="#" class="seller-link">{{ user.username }}</a>
            </div>
            <div class="oneliner-wrapper">
              <small class="oneliner"> Web Developer </small>
              <div class="content-info">
                <div class="rating-wrapper">
                  <span class="gig-rating text-body-2">
                    <svg
                      xmlns="http://www.w3.org/2000/svg"
                      viewBox="0 0 1792 1792"
                      width="15"
                      height="15"
                    >
                      <path
                        fill="currentColor"
                        d="M1728 647q0 22-26 48l-363 354 86 500q1 7 1 20 0 21-10.5 35.5t-30.5 14.5q-19 0-40-12l-449-236-449 236q-22 12-40 12-21 0-31.5-14.5t-10.5-35.5q0-6 2-20l86-500-364-354q-25-27-25-48 0-37 56-46l502-73 225-455q19-41 49-41t49 41l225 455 502 73q56 9 56 46z"
                      ></path>
                    </svg>
                    {{ user.user_rating }}
                    <span>({{ user.total_reviews }})</span>
                  </span>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="buttons-wrapper">
          <router-link
            to="/chat"
            class="
              btn-lrg-standard btn-contact-me
              js-contact-me js-open-popup-join
            "
            >Contact Me</router-link
          >
          <div class="btn-lrg-standard btn-white btn-custom-order">
            Get a Quote
          </div>
        </div>
        <div class="user-stats-desc">
          <ul class="user-stats">
            <li class="location">
              From<strong>
                {{user.address.substr(0, 20)}}{{user.address.length > 20 ? '..' : ''}}
              </strong>
            </li>
            <li class="member-since">
              Member since<strong>
                {{ user.created_at }}
                </strong>
            </li>
            <li class="response-time">
              Avg. Response Time<strong>2 hours</strong>
            </li>
            <li class="recent-delivery">
              Recent Delivery<strong>{{user.recent_delivery.substr(0, 16)}}{{user.recent_delivery.length > 16 ? '..' : ''}}
              </strong>
            </li>
          </ul>
        </div>
      </div>
    </div>
             <!----------------   for Mobile Screen   ------------------>
    <div class="d-lg-none card shadow-none mb-3 py-3">
       <div class="container routes">
         <!-- buyer Modes -->
         <div class="text-muted mx-2 mb-3" style="font-size:14px;font-family:inter,sans-serif;"> {{ $store.getters.isBuyerMode == true ? 'Buyer': 'Seller'}} </div>
          <div v-if="$store.getters.isBuyerMode" class="px-2 mb-2">
           <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-bag-plus" viewBox="0 0 16 16">
            <path fill-rule="evenodd" d="M8 7.5a.5.5 0 0 1 .5.5v1.5H10a.5.5 0 0 1 0 1H8.5V12a.5.5 0 0 1-1 0v-1.5H6a.5.5 0 0 1 0-1h1.5V8a.5.5 0 0 1 .5-.5z"/>
           <path d="M8 1a2.5 2.5 0 0 1 2.5 2.5V4h-5v-.5A2.5 2.5 0 0 1 8 1zm3.5 3v-.5a3.5 3.5 0 1 0-7 0V4H1v10a2 2 0 0 0 2 2h10a2 2 0 0 0 2-2V4h-3.5zM2 5h12v9a1 1 0 0 1-1 1H3a1 1 0 0 1-1-1V5z"/>
          </svg>

            <span class="ml-2">
                <router-link
                class="text-dark"
                to="/buyer/create_job"
                >
                  Post a Job
                </router-link>
            </span>
          </div>
          <div v-if="$store.getters.isBuyerMode" class="px-2 mb-2">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-gear-wide-connected" viewBox="0 0 16 16">
             <path d="M7.068.727c.243-.97 1.62-.97 1.864 0l.071.286a.96.96 0 0 0 1.622.434l.205-.211c.695-.719 1.888-.03 1.613.931l-.08.284a.96.96 0 0 0 1.187 1.187l.283-.081c.96-.275 1.65.918.931 1.613l-.211.205a.96.96 0 0 0 .434 1.622l.286.071c.97.243.97 1.62 0 1.864l-.286.071a.96.96 0 0 0-.434 1.622l.211.205c.719.695.03 1.888-.931 1.613l-.284-.08a.96.96 0 0 0-1.187 1.187l.081.283c.275.96-.918 1.65-1.613.931l-.205-.211a.96.96 0 0 0-1.622.434l-.071.286c-.243.97-1.62.97-1.864 0l-.071-.286a.96.96 0 0 0-1.622-.434l-.205.211c-.695.719-1.888.03-1.613-.931l.08-.284a.96.96 0 0 0-1.186-1.187l-.284.081c-.96.275-1.65-.918-.931-1.613l.211-.205a.96.96 0 0 0-.434-1.622l-.286-.071c-.97-.243-.97-1.62 0-1.864l.286-.071a.96.96 0 0 0 .434-1.622l-.211-.205c-.719-.695-.03-1.888.931-1.613l.284.08a.96.96 0 0 0 1.187-1.186l-.081-.284c-.275-.96.918-1.65 1.613-.931l.205.211a.96.96 0 0 0 1.622-.434l.071-.286zM12.973 8.5H8.25l-2.834 3.779A4.998 4.998 0 0 0 12.973 8.5zm0-1a4.998 4.998 0 0 0-7.557-3.779l2.834 3.78h4.723zM5.048 3.967c-.03.021-.058.043-.087.065l.087-.065zm-.431.355A4.984 4.984 0 0 0 3.002 8c0 1.455.622 2.765 1.615 3.678L7.375 8 4.617 4.322zm.344 7.646.087.065-.087-.065z"/>
            </svg>
            <span class="ml-2">
                <router-link
                class="text-dark"
                to="/buyer/jobs"
                >
                  Views All Jobs
                </router-link>
            </span>
          </div>
          <!-- buyer Modes end -->

          <!-- seller mode -->
          <div v-if="!($store.getters.isBuyerMode)" class="px-2 mb-2">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-list-task" viewBox="0 0 16 16">
             <path fill-rule="evenodd" d="M2 2.5a.5.5 0 0 0-.5.5v1a.5.5 0 0 0 .5.5h1a.5.5 0 0 0 .5-.5V3a.5.5 0 0 0-.5-.5H2zM3 3H2v1h1V3z"/>
             <path d="M5 3.5a.5.5 0 0 1 .5-.5h9a.5.5 0 0 1 0 1h-9a.5.5 0 0 1-.5-.5zM5.5 7a.5.5 0 0 0 0 1h9a.5.5 0 0 0 0-1h-9zm0 4a.5.5 0 0 0 0 1h9a.5.5 0 0 0 0-1h-9z"/>
             <path fill-rule="evenodd" d="M1.5 7a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5H2a.5.5 0 0 1-.5-.5V7zM2 7h1v1H2V7zm0 3.5a.5.5 0 0 0-.5.5v1a.5.5 0 0 0 .5.5h1a.5.5 0 0 0 .5-.5v-1a.5.5 0 0 0-.5-.5H2zm1 .5H2v1h1v-1z"/>
            </svg>
            <span class="ml-2">
                <router-link
                class="text-dark"
                to='/seller/manage_service'
                >
                  Manage Services
                </router-link>
            </span>
          </div>
          <div v-if="!($store.getters.isBuyerMode)" class="px-2 mb-2">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-person-lines-fill" viewBox="0 0 16 16">
             <path d="M6 8a3 3 0 1 0 0-6 3 3 0 0 0 0 6zm-5 6s-1 0-1-1 1-4 6-4 6 3 6 4-1 1-1 1H1zM11 3.5a.5.5 0 0 1 .5-.5h4a.5.5 0 0 1 0 1h-4a.5.5 0 0 1-.5-.5zm.5 2.5a.5.5 0 0 0 0 1h4a.5.5 0 0 0 0-1h-4zm2 3a.5.5 0 0 0 0 1h2a.5.5 0 0 0 0-1h-2zm0 3a.5.5 0 0 0 0 1h2a.5.5 0 0 0 0-1h-2z"/>
            </svg>
            <span class="ml-2">
                <router-link
                class="text-dark"
                to='/seller/buyer_requests'
                >
                  Buyer Requests
                </router-link>
            </span>
          </div>
          <!-- seller modes end -->

           <div class="px-2 mb-2">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-bag-check" viewBox="0 0 16 16">
              <path fill-rule="evenodd" d="M10.854 8.146a.5.5 0 0 1 0 .708l-3 3a.5.5 0 0 1-.708 0l-1.5-1.5a.5.5 0 0 1 .708-.708L7.5 10.793l2.646-2.647a.5.5 0 0 1 .708 0z"/>
              <path d="M8 1a2.5 2.5 0 0 1 2.5 2.5V4h-5v-.5A2.5 2.5 0 0 1 8 1zm3.5 3v-.5a3.5 3.5 0 1 0-7 0V4H1v10a2 2 0 0 0 2 2h10a2 2 0 0 0 2-2V4h-3.5zM2 5h12v9a1 1 0 0 1-1 1H3a1 1 0 0 1-1-1V5z"/>
            </svg>
            <span class="ml-2">
                <router-link
                class="text-dark"
                to='/buyer/manage_order'
                >
                  Manage Orders
                </router-link>
            </span>
          </div>
        </div>
    </div>
            <!----------------   Mobile Screen end   ------------------>

    <div class="seller-profile">
      <div v-if="user.description.length > 0" class="description">
        <h3>Description</h3>
        <p>{{ user.description }}</p>
      </div>
      <div v-if="user.user_languages.length > 0" class="languages">
        <h3>Languages</h3>
        <ul>
          <li>
            {{ user.user_languages }}
            <span>Fluent</span>
          </li>
          
        </ul>
      </div>
      <div class="linked-accounts">
        <h3>Linked Accounts</h3>
        <ul>
          <li class="platform social-account facebook">
            <i
              class="platform-icon facebook hint--top"
              aria-hidden="true"
              data-hint="facebook"
            ></i
            ><span class="text">facebook</span>
          </li>
          <li class="platform social-account google">
            <i
              class="platform-icon google hint--top"
              aria-hidden="true"
              data-hint="google"
            ></i
            ><span class="text">google</span>
          </li>
        </ul>
      </div>
      <div v-if="user.user_skills.length > 0" class="skills">
        <h3>Skills</h3>
        <ul>
          <li>
            <!-- {{ ( user.user_skills }} -->
            {{ ( user.user_skills.length == 0) ? '' : user.user_skills }}
          </li>
        </ul>
      </div>
      <div class="education-list list">
        <h3>Education</h3>
        <ul>
          <li>
            <p>B.A. - communication studies</p>
            <p>Clayton State University, United States, Graduated 2006</p>
          </li>
        </ul>
      </div>
    </div>

    <div class="d-lg-none card shadow-none mb-3 py-3">
       <div class="container routes">
         <div class="text-muted mx-2 mb-3" style="font-size:14px;font-family:inter,sans-serif;"> General</div>
          <div @click="handleLogout" class="px-2">
                      <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-log-out">
                         <path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"></path>
                         <polyline points="16 17 21 12 16 7"></polyline>
                         <line x1="21" y1="12" x2="9" y2="12"></line>
                      </svg>
                    <span class="ml-2"> Logout </span>
                </div>
            </div>
    </div>
  </div>
</template>



<script>
import Api from "@/services/API";
import { computed } from "vue";
import { useStore } from 'vuex';
import { useRouter } from 'vue-router';

export default {
  setup() {
    const store = useStore();
    const router = useRouter();
    const handleLogout = async() => {
         const response = await Api.post("logout");
         if(response.status===200){
            localStorage.removeItem('PROELEAN_TOKEN');
            localStorage.removeItem('userInfo');
            router.go()
         }
      }
    return {
      user: computed(() => store.getters.getAuthUser),
      imgURL: process.env.VUE_APP_URL,
      handleLogout
    };
  },
};
</script>
<style scoped>

.user-profile-image{
    height: 120px;
    width: 120px;

}
.img-full{
  height: 100%;
  width: 100%;
  object-fit: cover;
  overflow: hidden;
}
.user-profile-info{
  display: flex;
  justify-content: center;
  align-items: center;
  flex-direction: column;
}
</style>
