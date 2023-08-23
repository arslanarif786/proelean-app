<template>
  <div class=" col-lg-8 col-xl-8 ">
    <div class="p-3 d-flex align-items-center border-bottom osahan-post-header">
      <div class="font-weight-bold mr-1 overflow-hidden">
        <div class="text-truncate d-flex align-items-center">
          <span @click="$emit('showConversation', true)" class="d-block d-lg-none"><i
              class="mdi mdi-arrow-left mr-2"></i></span>
          {{ otherMember ? otherMember.name : "" }}
        </div>
        <!-- <div class="small text-truncate overflow-hidden text-black-50">
          Askbootstap.com - Become a Product Manager with super power
        </div> -->
      </div>
    </div>


    <div v-if="
      $store.getters.getSelectedConversation || $store.getters.getNewConversationUser
    ">


      <div id="messages-section" class="osahan-chat-box p-3 border-top border-bottom bg-light chat-hieght"
        @scroll="handleScroll">
        <Message v-for="(message, index) in $store.getters.getChatMessages" :key="message.id" :message="message"
          :showDateBar="
            index == 0 ||
            new Date(message.sentAt).getDate() !==
            new Date($store.getters.getChatMessages[index - 1].sentAt).getDate()
          " />
        <!-- Gig Refrence -->
        <!-- <div class="container">
        <p class="m-0 text-muted p-1">This Service is related to:</p>
        <div class="card p-3">
          <div class="row">
            <div class="col-md-3">
              <div class="offer-img-holder">
                <img
                  src="https://api.dex.proelean.com/uploads/SellerMedia/123416456141564.jpg"
                  alt=""
                  class="img-fluid"
                />
              </div>
            </div>
            <div class="col-md-8">
              <div class="card-body">
                <h5 class="card-title">
                  I will design front end web development using react,
                  bootstrap, CSS
                </h5>
                <p class="card-text">
                  I will design front end web development using react,
                  bootstrap, CSS
                </p>
              </div>
            </div>
          </div>
        </div>
      </div> -->
      </div>

      <WriteAMessage />

    </div>

    <div class="d-flex justify-content-center align-items-center no_chat_section" v-else>
      <!-- <img src="../../public/images/chat.svg" alt="chat" width="30%" /> -->

      <h4 class="text-secondary">
        {{ $t('conversation.selectConversation') }}
      </h4>
    </div>

  </div>




</template>

<script>
import WriteAMessage from "./WriteAMessage.vue";
import Message from "./Message.vue";
import { useStore } from "vuex";
import { computed } from "vue";

export default {
  components: { Message, WriteAMessage },
  setup() {
    const store = useStore();

    const otherMember = computed(() => {
      if (store.getters.getNewConversationUser) {
        return store.getters.getNewConversationUser;
      } else {
        return store.getters.getSelectedConversation &&
          store.getters.getSelectedConversation.membersInfo
          ? store.getters.getSelectedConversation.membersInfo.find(
            (member) => store.getters.getAuthUser.id != member.id
          )
          : null;
      }
    });

    const handleScroll = (e) => {
      if (e.target.scrollTop == 0) {
        store.dispatch("reversePaginate");
      }
    };
    return {
      otherMember,
      handleScroll,
    };
  },
};
</script>

<style lang="scss" scoped>
 

// .osahan-chat-box{
//     height:calc(100vh - 100px);
// }



@media (max-width: 991.98px) { 
  .osahan-chat-box{
     height:calc(100vh - 220px);
  }
  .container-fluid{
    padding: 10px 0px;
  }
}
</style>