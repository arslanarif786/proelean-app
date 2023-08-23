<template>

  <div class="market-wrapper py-5 bg-white">
    <div class="container-fluid content-row">
      <h2 class="text-center">{{ $t('home.marketplace') }}</h2>

      <section>
        <div class="row">
          <!--ADD CLASSES HERE d-flex align-items-stretch-->
          <div
            class="col-sm-12 col-lg-3 mb-3"
            v-for="category in $store.getters.getCategories"
            :key="category.id"
          >
            <div class="card h-100 shadow-none">
              <router-link
                :to="{ name: 'Gigs', params: { slug: category.slug } }"
              >
            <div class="img_holder">
                  <img
                  :src="`${
                    category.banner.includes('https') ||
                    category.banner.includes('http')
                      ? category.banner
                      : imgURL + '/' + category.banner
                  }`"
                  class="card-img-top"
                  alt="Card Image"
                />
            </div>
                <div class="card-body d-flex flex-column margn text-center">
                  <h5 class="card-title">{{ category.title }}</h5>
                </div>
              </router-link>
            </div>
          </div>
        </div>
      </section>

      <!-- <ul class="categories-list mb-0">
            <li>
               <a href="#">
               <img src="assets/images/graphics.svg" alt="" loading="lazy">Graphics &amp; Design
               </a>
            </li>
            <li>
               <a href="#">
               <img src="assets/images/online-marketing.svg" alt="Digital Marketing" loading="lazy">Digital Marketing
               </a>
            </li>
            <li>
               <a href="#">
               <img src="assets/images/writing-translation.svg" alt="Writing &amp; Translation" loading="lazy">Writing &amp; Translation
               </a>
            </li>
            <li>
               <a href="#">
               <img src="assets/images/video-animation.svg" alt="Video &amp; Animation" loading="lazy">Video &amp; Animation
               </a>
            </li>
            <li>
               <a href="#">
               <img src="assets/images/music-audio.svg" alt="Music &amp; Audio" loading="lazy">Music &amp; Audio</a>
            </li>
            <li>
               <a href="#">
               <img src="assets/images/programming.svg" alt="Programming &amp; Tech" loading="lazy">Programming &amp; Tech
               </a>
            </li>
            <li>
               <a href="#">
               <img src="assets/images/business.svg" alt="Business" loading="lazy">Business</a>
            </li>
            <li>
               <a href="#">
               <img src="assets/images/lifestyle.svg" alt="Lifestyle" loading="lazy">Lifestyle
               </a>
            </li>
         </ul> -->
    </div>
  </div>
</template>

<script setup>
const imgURL = process.env.VUE_APP_URL;
</script>

<style scoped>

.card{
  background: #e4e4e4c7;
 
}

.img_holder{
  height: 150px;
  width:100%;
}
.card img {
  height: 100%;
  width: 100%;
  object-fit: cover;
  transition: 0.5s;
}

.card img:hover{
transform: scale(0.9);
}

.margn {
  margin-bottom: -10px;
}
</style>