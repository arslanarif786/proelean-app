<template>
  <!--selected media preview  -->
  <div class="container">
    <div
      class="row shadow-sm d-flex justify-content-between align-items-center px-3 py-2 img-attachment-bg"
      v-if="chatMedia.media.type"
    >
      <div>
        <i class="mdi mdi-image" v-if="chatMedia.media.type.includes('image')">
          <span class="ml-2">{{ chatMedia.media.name }}</span></i
        >
      </div>
      <div>
        <p class="m-0">{{ chatMedia.media.size }}</p>
      </div>
      <div id="upload-progress"></div>
      <div>
        <a href="#" @click="removeMedia($event, chatMedia.media.name)"
          ><i class="mdi mdi-close-box"></i
        ></a>
      </div>
    </div>
  </div>
  <!-- WRITE A MESSAGE -->
  <div class="w-100">
    <div class="input-group pb-1">
      <div class="input-group-prepend">
        <!-- Imge Attach Button -->
        <button
          class="btn btn-light btn-sm"
          type="button"
          :disabled="
            !$store.getters.getSelectedConversation &&
            !$store.getters.getNewConversationUser
          "
          @click="$refs.mediaInput.click()"
        >
          <input
            type="file"
            ref="mediaInput"
            id="mediaInput"
            style="display: none"
            @change="selectMedia"
            required
          />
          <i class="mdi mdi-image"></i>
        </button>

        <!-- File Attach Button -->
        <button
          class="btn btn-light btn-sm"
          type="button"
          :disabled="
            !$store.getters.getSelectedConversation &&
            !$store.getters.getNewConversationUser
          "
        >
          <i class="mdi mdi-paperclip"></i>
        </button>
      </div>

      <!-- Message Wite Field-->
      <input
        type="text"
        class="form-control"
        placeholder=""
        aria-label=""
        aria-describedby="basic-addon1"
        v-model="newMessage.text"
        :readonly="
          !$store.getters.getSelectedConversation &&
          !$store.getters.getNewConversationUser
        "
        @keyup.enter="sendMsg($event)"
      />
      <div class="input-group-append">
        <!-- Send Button-->
        <button
          class="btn btn-light btn-sm rounded"
          type="button"
          :style="$store.getters.getIsMessageBeingSent && 'cursor:not-allowed'"
          @click.prevent="sendMsg($event)"
          :disabled="$store.getters.getIsMessageBeingSent"
        >
          <i class="mdi mdi-send send-icon cursor-pointer"  :style="$store.getters.getIsMessageBeingSent && 'cursor:not-allowed'"></i>
        </button>
      </div>
    </div>
  </div>

  <SendOffer />
</template>

<script>
import SendOffer from "../modals/CreateOfferOnChat.vue";
import { useStore } from "vuex";
import useFirebaseMedia from "@/composables/useFirebaseMedia";
import compressImage from "@/composables/useImageCompression";
import { ref } from "@vue/reactivity";

export default {
  components: { SendOffer },
  setup() {
    const { uploadAttachment } = useFirebaseMedia();

    const store = useStore();

    const chatMedia = ref({
      message: "",
      media: "",
    });

    const showOfferModal = ref(false);
    const newMessage = ref({
      text: "",
      attachment: "",
      attachmentType: 0,
      offer: null,
      refererGig: false,
    });

    // select media file's
    async function selectMedia(e) {
      const file = e.target.files[0];
      const image = await compressImage(file);
      chatMedia.value.media = image;
    }

    const removeMedia = (e) => {
      e.preventDefault();
      chatMedia.value.media = {};
    };

    const sendMsg = (event) => {
      event.preventDefault();

      if (chatMedia.value.media) {
        uploadAttachment(chatMedia, newMessage.value);
      } else {
        if (!newMessage.value.text) {
          return;
        }
        store.dispatch("sendMessage", newMessage.value).then(() => {
          newMessage.value.text = "";
        });
      }
    };

    return {
      newMessage,
      sendMsg,
      showOfferModal,
      selectMedia,
      chatMedia,
      removeMedia,
    };
  },
};
</script>

<style lang="scss" scoped>
.form-control {
  height: auto;
}

.img-attachment-bg {
  background: azure;
}
.mdi-close-box {
  color: red;
  font-size: 20px;
}
</style>
