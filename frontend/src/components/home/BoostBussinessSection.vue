<template>
   <div class="about-border bg-white ">
      <div class="container ">
         <div class="about-section py-5 ">
            <div class="row align-items-center">
               <div class="col-md-6">
                  <h2>{{ $t('home.yourBussiness') }}
                  </h2>
                  <ul>
                     <li><span><img src="assets/images/checkmark.png"> {{ $t('home.point1') }}</span>
                        <!-- Payment is released to the freelancer once you’re pleased and approve the work you get. -->
                     </li>
                     <li><span><img src="assets/images/checkmark.png"> {{ $t('home.point2') }}
                        </span>
                     </li>
                     <li><span><img src="assets/images/checkmark.png"> {{ $t('home.point3') }}</span>
                     </li>
                     <li><span><img src="assets/images/checkmark.png"> {{ $t('home.point4') }}</span>
                     </li>
                  </ul>
               </div>
               <div class="col-md-6">
                  <img src="assets/images/video.jpg" class="video-img w-100" >
               </div>
            </div>
         </div>
      </div>
   </div>
</template>

<script>
export default {

}
</script>

<style>

</style>