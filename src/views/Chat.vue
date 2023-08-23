<template>
  <div :class="$store.getters.isBuyerMode && 'py-2 '">
    <div>
      <div :class="$store.getters.isBuyerMode && `container-fluid`">
        <div class="row">
          <!-- Main Content -->
          <main class="
              col col-xl-12
              order-xl-2
              col-lg-12
              order-lg-1
              col-md-12 col-sm-12 col-12
            ">
            <div class="box shadow-sm rounded bg-white  osahan-chat">
              <!-- <h5 class="pl-3 pt-3 pr-3 border-bottom mb-0 pb-3">Messaging</h5> -->
              <div class="row m-0">
                <div class="border-right  col-lg-4 col-xl-4  ">
                  <div class="osahan-chat-left">
                    <div v-if="
                      mode == 'conversation' ||
                      $store.getters.getScreenWidth > 999
                    " class="
                        position-relative
                        icon-form-control
                        p-3
                        border-bottom
                      ">
                      <i class="fa fa-search position-absolute"></i>
                      <input
                        type="text"
                        id="search-orders"
                        name="searchorders"
                        v-model="searchQuery"
                        class="form-control search-orders"
                        :placeholder="$t('find.searchUsers')"
                      />

                    </div>
                    <div v-if="
                      $store.getters.getConversationListStatus === 'LOADING'
                    ">
                      <p>Loading...</p>
                    </div>
                    <div class="osahan-chat-list" v-else-if="
                      (mode == 'conversation' || $store.getters.getScreenWidth > 999) 
                    ">
                      <ConversationList @showChat="toggleMode" v-for="conversation in conversations"
                        :conversation="conversation" :key="conversation.id" />


                      <div class="d-flex justify-content-center align-items-center" style="height:70vh"
                        v-if="!conversations.length">
                        <p>{{ $t('conversation.noConversation') }}</p>
                      </div>

                    </div>

                  </div>
                </div>
                <!-- CHAT SECTION -->
                <MessagesSection @showConversation="toggleMode"
                  v-if="mode == 'chat' || $store.getters.getScreenWidth > 999" />
              </div>
            </div>
          </main>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import ConversationList from "../components/chat/ConversationList.vue";
import MessagesSection from "../components/chat/MessagesSection.vue";
import { useStore } from "vuex";
import { computed, onBeforeMount, onMounted } from "@vue/runtime-core";
import { useRoute } from "vue-router";
import { ref } from "vue";
export default {
  components: { ConversationList, MessagesSection },
  setup() {
    const store = useStore();
    const route = useRoute();
    const searchQuery = ref();
    computed(() => console.log(searchQuery.value));

    const mode = ref("conversation");
    const toggleModeStatus = ref(false);

    onBeforeMount(() => {
      store.dispatch("lookForConversationChanges");
      if (route.query.gig) {
        store.dispatch("getRefererService", route.query.gig);
      }

    });
    onMounted(() => {
      store.commit("setNewConversationStatus", true);

      store.getters.getConversations.forEach((conversation) => {
        if (route.params.id && conversation.members.includes(route.params.id)) {
          store.dispatch("openSelectedConversation", conversation.id);
        }
      });

      setTimeout(() => {
        if (route.params.id && store.getters.isConversationNew) {
          store.dispatch("getUserDataFromApi", route.params.id);
        }
      }, 1500);
    });
    const handleSelectedChat = (conversationID) => {
      store.dispatch("openSelectedChat", conversationID);
    };

    const toggleMode = () => {
      toggleModeStatus.value = mode.value == "conversation" ? true : false;
      mode.value = mode.value == "conversation" ? "chat" : "conversation";
    };

    
    const conversations = computed(() => {
      if (!searchQuery.value?.trim()) {
        return store.getters.getConversations;
      }
      return store.getters.getConversations.filter((conversation) => {
      const otherMember = conversation.membersInfo.find(
        (member) => member.id != store.getters.getAuthUser.id
      );
      return otherMember.name.toLowerCase().includes(searchQuery.value.toLowerCase());
      });
    });

    return {
      mode: computed(() => store.getters.getSelectedConversation != null && !toggleModeStatus.value ? "chat" : "conversation"),
      toggleMode,
      handleSelectedChat,
      searchQuery,
      conversations
    };
  },
};
</script>

<style lang="scss" scoped>
 

// Medium devices (tablets, less than 992px)
@media (max-width: 991.98px) { 
  .osahan-chat-list{
     height:calc(100vh - 199px);
  }
  .container-fluid{
    padding:  0px;
  }
}
</style>