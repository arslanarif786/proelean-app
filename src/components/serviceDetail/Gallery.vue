<template>
  <div class="slider" v-if="serviceMedia">
    <div class="gallery-container">
      <div id="aniimated-thumbnials" class="slider-for slick-slider-single">
        <img
          class="img-fluid img-thumbnail gm-image"
          :src="
            `${imgURL}/${serviceMedia[imageIndex].media}` ??
            '/assets/images/banner.png'
          "
        />
      </div>
    </div>
    <div
      v-if="serviceMedia[1]"
      class="slider-nav slick-slider-single d-flex flex-wrap py-3 mr-2"
    >
      <div
        class="item-slick"
        v-for="(banner, index) in serviceMedia"
        :key="banner.id"
      >
        <img
          @click="setImageIndex(index)"
          class="img-thumbnail g-image cursor-pointer"
          :src="`${imgURL}/${banner.media}` ?? '/assets/images/banner.png'"
        />
      </div>
    </div>
  </div>
</template>

<script>
import { ref } from "@vue/reactivity";

export default {
  props: {
    serviceMedia: {
      type: Array,
      required: true,
    },
  },
  setup() {
    const imageIndex = ref(0);

    const setImageIndex = (index) => {
      imageIndex.value = index;
    };
    return {
      imageIndex,
      setImageIndex,
      imgURL: process.env.VUE_APP_URL,
    };
  },
};
</script>
<style scoped>
.gm-image {
  object-fit: cover;
  height: 100%;
  width: 100%;
}

.g-image {
  max-height: 230px;
}
.item-slick {
  height: 120px;
  width: 120px;
  margin-bottom: 5px;
}
.slider-nav .item-slick img {
  width: 100%;
  height: 100%;
  object-fit: cover;
}

#aniimated-thumbnials {
  height: 350px;
  width: 100%;
}

/* Small devices (landscape phones, less than 768px) */
@media (max-width: 767.98px) {
  .item-slick {
    height: 56px;
    width: 100px;
  }

  #aniimated-thumbnials {
    height: 178px;
    width: 100%;
  }
}

/* // Extra small devices   */
@media (max-width: 300px) {
  #aniimated-thumbnials {
    height: 120px;
  }
}
</style>