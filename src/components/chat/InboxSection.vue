<template>
  <div class="col-lg-7 col-xl-8 px-0">
    <div class="p-3 d-flex align-items-center border-bottom osahan-post-header">
      <div class="font-weight-bold mr-1 overflow-hidden">
        <div class="text-truncate">{{$store.getters.getSelectedConversation.senderName}}</div>
        <!-- <div class="small text-truncate overflow-hidden text-black-50">
          Askbootstap.com - Become a Product Manager with super power
        </div> -->
      </div>
    </div>
    <div class="osahan-chat-box p-3 border-top border-bottom bg-light">
      <PreviousChat />
    </div>

    <WriteAMessage />
  
  </div>
</template>

<script>

import WriteAMessage from "./WriteAMessage.vue";
import PreviousChat from "./PreviousChat.vue";

export default {
  components: { PreviousChat, WriteAMessage },
};
</script>

<style>
</style>