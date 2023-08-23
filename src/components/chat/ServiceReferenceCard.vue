<template>
    <div class="row">
        <div class="col-md-10">
          <div
            class="gig-refrence-main py-5"
          >
            <p class="m-0 text-muted p-1">This message is related to:</p>
            <div class="card">
              <img
                class="card-img-top"
                :src="`${imgUrl}/` + message.messageGig.gigImage"
                alt="Card image cap"
              />
              <div class="card-body">
                <h6 class="card-title">
                  {{ message.messageGig.gigTitle }}
                </h6>
                <p class="card-text">
                  <i class="mdi mdi-account"> </i>
                  {{ message.messageGig.gigUsername }}
                </p>
              </div>
            </div>
          </div>
        </div>
      </div>
</template>

<script>
export default {
  props: {
    message: {
      type: Object,
      required: true,
    },
  },
  setup() {
      return {
          imgUrl: process.env.VUE_APP_URL,
      }
  }
}
</script>

<style scoped>

.card-img-top {
  width: 100%;
  max-height: 200px;
  object-fit: cover;
}


</style>