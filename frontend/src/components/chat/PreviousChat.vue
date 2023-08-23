<template>
  <div class="text-center my-3">
    <span class="px-3 py-2 small bg-white shadow-sm rounded">DEC 21, 2020</span>
  </div>
  <div class="d-flex align-items-center osahan-post-header" >
    <div class="dropdown-list-image mr-3 mb-auto">
      <img class="rounded-circle" :src="chat.photo" alt="" />
    </div>
    <div class="mr-1">
      <div class="text-truncate h6 mb-3">{{chat.name}}</div>
      <p>
        {{chat.lastMessage}}
        <!-- <a href="#">iamosahan@gmail.com</a> -->
      </p>
    </div>
    <span class="ml-auto mb-auto">
      <div class="text-right text-muted pt-1 small">{{chat.sent_at}}</div>
    </span>
  </div>
</template>

<script>
import { computed } from '@vue/runtime-core';
import { useStore } from 'vuex';
export default {
  setup() {
    const store = useStore();
    return {
      chat: computed(()=> store.getters.getSelectedConversation)
    }
  }
}; 
</script>

<style>
</style>