<template>
  <a
    class="dropdown-item dropdown-notifications-item"
    href="#!"
  >
    <img
      class="dropdown-notifications-item-img"
      src="/assets/images/user/s7.png"
    />
    <div class="dropdown-notifications-item-content">
      <div class="dropdown-notifications-item-content-text">
       {{conversation.lastMessage}}
      </div>
      <div class="dropdown-notifications-item-content-details">
        {{conversation.senderName}} · 58m
      </div>
    </div>
  </a>
  <router-link class="dropdown-item dropdown-notifications-footer" to="/chat"
    >Read All Messages</router-link
  >
</template>

<script>
export default {
    props:{
        conversation: {
            type: Object,
            required: true,
        }
    },
};
</script>