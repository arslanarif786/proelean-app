<template>
    <div class="slider mt-4" v-if="serviceMedia">
        <div class="gallery-container">
        <div id="aniimated-thumbnials" class="slider-for slick-slider-single">
        <img  class="img-fluid img-thumbnail gm-image" 
            :src="`${imgURL}/${serviceMedia[imageIndex].media}` ?? '/assets/images/banner.png'"
            />
        </div>
        </div>
        <div v-if="serviceMedia[1]" class="slider-nav slick-slider-single d-flex flex-row py-3">
        <div class="item-slick" v-for="(banner,index) in serviceMedia" :key="banner.id">
        <img @click="setImageIndex(index)"  class="img-thumbnail g-image cursor-pointer" 
            :src="`${imgURL}/${banner.media}` ?? '/assets/images/banner.png'"
            />
        </div>
        </div>
    </div>
</template>

<script>
import { ref } from '@vue/reactivity'

export default {
    props: {
        serviceMedia: {
            type: Array,
            required: true
        }
    },
    setup(){
        const imageIndex = ref(0)

        const setImageIndex = (index) => {
            imageIndex.value = index;
        }
        return{
            imageIndex,
            setImageIndex,
            imgURL: process.env.VUE_APP_URL
        }
    }
}
</script>
<style scoped>
.gm-image{
    object-fit: cover;
    height: 350px;
    width:650px;
}

.g-image{
    max-height: 230px;
}
</style>