<template>
  <nav aria-label="Page navigation example">
    <ul class="pagination d-flex justify-content-center">
      <li class="page-item">
        {{hasNextPage}}
        <a class="page-link"  @click.prevent="prev()" href="#"> Previous</a>
      </li>

       <li class="page-item">
        <a class="page-link" @click.prevent="next()" href="#" :style="{'pointer-events': hasNextPage==='' ? 'none' : ''}"> Next</a>
      </li>
      <!-- <li class="page-item"><a class="page-link" @click.prevent="empty()" href="#">1</a></li>
      <li class="page-item"><a class="page-link" @click.prevent="next()" href="#">2</a></li>
      <li class="page-item"><a class="page-link" @click.prevent="next()" href="#">3</a></li>
      <li class="page-item"><a class="page-link" @click.prevent="next()" href="#">4</a></li>
      <li class="page-item"><a class="page-link" @click.prevent="next()" href="#">5</a></li> -->
     
    </ul>
  </nav>
</template>

<script>
import { computed } from "vue";
import { useStore } from 'vuex';

export default {
  setup() {
    const store = useStore()
    function next(){
      store.dispatch("userServices","next");
    }
    function prev(){
        store.dispatch("userServices","prev");
    }
    
    function empty(){
        store.dispatch("userServices","");
    }
    return {
      review: computed(() => store.getters.getSellerReview),
      next,prev,empty,
      hasNextPage: computed(() =>store.getters.servicesHasNextPage)
    };
  },
};
</script>

<style scoped>
.pointer-event{
  pointer-events: none;
}
</style>