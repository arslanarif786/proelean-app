<template>
  <section class="py-5 bg-dark upper-box inner-header">
         <div class="container">
            <div class="row">
               <div class="col-md-12 text-center">
                  <h1 class="mt-0 mb-3 text-white">{{ $t('service.productList') }}</h1>
                  <div class="breadcrumbs">
                    <form @submit.prevent="handleSearch" class="d-md-none d-sm-inline-block form-inline mr-auto my-2 my-md-0 mw-100 navbar-search">
                      <div class="input-group">
                        <input type="text" v-model="keywords" class="form-control bg-white small" :placeholder="$t('find.findServices')" aria-label="Search" aria-describedby="basic-addon2">
                          <div class="input-group-append">
                            <button class="btn btn-success" @click.prevent="handleSearch" type="button">
                              <i class="fa fa-search fa-sm"></i>
                            </button>
                          </div>
                      </div>
                    </form>
                  </div>
               </div>
            </div>
         </div>
      </section>
</template>

<script>
import { ref } from '@vue/reactivity';
import { useRouter } from 'vue-router';
export default {
   name:'serviceListNav',
   setup(){
   const router = useRouter();
   const keywords = ref('');
   const handleSearch = () => {
         let url = keywords.value ? `/gigs/${slugify(keywords.value)}` : '/gigs';
         router.push(url)
         keywords.value=''
      }

     // /* Encode string to slug */
      /* eslint-disable */
      function slugify(text) {
         return text
            .toString()                           
            .normalize('NFKD')           
            .toLowerCase()                  
            .trim()                                
            .replace(/\s+/g, '-')           
            .replace(/[^\w\-]+/g, '')     
            .replace(/\-\-+/g, '-');
      }
      
      return{
         handleSearch,
         keywords
      }
   }
}
</script>

<style scoped>
.upper-box{
   position:relative;
}

</style>