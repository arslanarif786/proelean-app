<template>
  <div class="container-xl">
      <div class="review-section">
      <div class="d-flex align-items-center justify-content-between mb-1">
        <h4 class="m-0">
          {{ $t('review.reviewAs', { type }) }}
          <!-- {{ $t('nav.switchModeBtn', { mode: "Seller" }) }} -->
        </h4>
          <!-- <small
            ><span class="star-rating-s15"></span
            ><span
              ><span
                class="total-rating-out-five header-average-rating"
                data-impression-collected="true"
                >{{ user.user_rating }}</span
              ></span
            ><span
              ><span
                class="total-rating header-total-rating"
                data-impression-collected="true"
                >({{ user.total_reviews }})</span
              ></span
            ></small
          > -->

        <!-- <select class="custom-select custom-select-sm border-0 shadow-sm ml-2">
          <option>Most Relevant</option>
          <option>Most Recent</option>
        </select> -->
      </div>
      <!-- <div class="breakdown">
        <ul class="header-stars">
          <li>
            Seller communication level
            <small>
              <span class="star-rating-s15"></span>
              <span class="total-rating-out-five">{{ user.user_rating }}</span>
            </small>
          </li>
          <li>
            Recommend to a friend
            <small>
              <span class="star-rating-s15"></span>
              <span class="total-rating-out-five">{{ user.user_rating }}</span>
            </small>
          </li>
          <li>
            Service as described
            <small>
              <span class="star-rating-s15"></span>
              <span class="total-rating-out-five">{{ user.user_rating }}</span>
            </small>
          </li>
        </ul>
      </div> -->
      <div class="no-review text-center" v-if="!reviews.length">
        <p>{{ $t('review.noReviewsYet') }}</p>
      </div>
    </div>

    <div class="" v-for="(review, index) in reviews" :key="index">
      <div class="review-list">
        <ul>
          <li>
            <div class="d-flex">
              <div class="left">
                <span>
                  <img
                :src="`${imgURL}/${ review.user.image ? review.user.image : '/assets/images/avator.png'
                }`"
                class="profile-pict-img img-full"
                alt="img"
              />
                </span>
              </div>
              <div class="right">
                <h4>
                  {{ review.user.username }}
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
                    {{ review.rating }}
                  </span>
                </h4>

                <div class="review-description">
                  <p>
                    {{ review.description }}
                  </p>
                </div>
                <span class="publish py-3 d-inline-block w-100"
                  ><p>{{ $filters.timeAgo(user.created_at) }}</p>
                  <!-- expected output :  a few seconds ago  --></span
                >
              </div>
            </div>
            <span
              class="publish d-inline-block w-100 d-flex justify-content-center"
              v-if="
                reviews.length - 1 === index && $store.state.reviewsHasNextPage
              "
            >
              <a class="see_more" href="#" @click.prevent="handleReviews"
                >{{ $t('review.seeMore') }}</a
              ></span
            >
          </li>
        </ul>
      </div>
    </div>

  </div>
</template>

<script>
import { computed, onMounted } from "vue";
import { useStore } from "vuex";
import { useRoute } from "vue-router";

export default {
  setup() {
    const store = useStore();
    const route = useRoute();

    var payload = {
      id:
        route.path === "/profile"
          ? store.getters.getAuthUser.id
          : route.params.id,
      type: route.path === "/profile" ? "seller" : "service",
    };

    onMounted(store.dispatch("getReviews", payload));
    const handleReviews = () => {
      store.dispatch("getReviews");
    };
    return {
      type: payload.type,
      user: computed(() => store.getters.getAuthUser),
      reviews: computed(() => payload.type === 'seller' ? store.getters.getSellerReviews : store.getters.getServiceReviews),
      handleReviews,
      imgURL: process.env.VUE_APP_URL,
    };
  },
};
</script>

<style scoped>
.see_more {
  cursor: pointer;
}
</style>