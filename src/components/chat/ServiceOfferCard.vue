<template>
  <div class="row">
    <div class="col-md-10">
      <div class="card shadow-none">
        <div class="card-body">
          <p class="offer-title">
            {{ message.messageOffer.serviceTitle }}
          </p>
          <p class="offer-description">
            {{ message.messageOffer.description }}
          </p>
          <div class="d-md-flex justify-content-around py-2 flex-wrap">
            <article>
              <div>
                <div class="delivery">
                  <i class="mdi mdi-currency-eur" aria-hidden="true"></i>
                  <p class="mr-2">Price :</p>
                  {{ message.messageOffer.totalOffer }}
                </div>
              </div>
            </article>
            <article>
              <div class="delivery">
                <i class="mdi mdi-clock" aria-hidden="true"></i>
                <p class="mr-2">Delivery Time:</p>
                {{ message.messageOffer.deliveryDays }}
              </div>
            </article>
            <article>
              <div class="delivery">
                <i class="mdi mdi-sync" aria-hidden="true"></i>
                <p class="mr-2">Revision:</p>
                {{ message.messageOffer.revisions }}
              </div>
            </article>
          </div>
          <button
            class="btn app-btn-primary"
            v-if="
              message.messageOffer.offerSenderId ===
                $store.getters.getAuthUser.id &&
              (message.messageOffer.status === 2 ||
                message.messageOffer.status === 0)
            "
            @click="withdrawOffer($event, message.id)"
            :disabled="message.messageOffer.status === 2"
          >
            {{
              message.messageOffer.status === 2
                ? "offer withdrawn"
                : "Withdraw the offer"
            }}
          </button>
          <button
            aria-hidden="true"
            data-toggle="modal"
            data-target="#placeorder"
            class="btn app-btn-primary btn-sm"

            id="accept_offer"
            v-else
            @click="acceptCustomOffer(message)"
            :disabled="
              message.messageOffer.status === 1 ||
              (loading.status === 'LOADING' && loading.offerId === message.id)"
          >
            <!-- <i class="fa fa-spin" v-if="loading.status === 'LOADING' && loading.offerId === message.id"></i> -->
            {{
              message.messageOffer.status === 1
                ? "Offer accepted"
                : "Accept offer"
            }}
          </button>
        </div>
      </div>
    </div>
  </div>

  <AcceptServiceOffer v-if="acceptOffer" />
</template>

<script>
import { computed, ref } from "@vue/runtime-core";
import { useStore } from "vuex";
import AcceptServiceOffer from "@/components/modals/PurchaseService.vue";

export default {
  components: { AcceptServiceOffer },
  props: {
    message: {
      type: Object,
      required: true,
    },
  },
  setup() {
    const store = useStore();
    const acceptOffer = ref(false);

    const withdrawOffer = (event, messageID) => {
      const offerPayload = {
        docId: messageID,
        status: 2,
      };

      store.dispatch("withdrawOffer", offerPayload).then(() => {
        event.target.innerText = "offer withdrawn";
      });
    };

    const acceptCustomOffer = (offer) => {
      acceptOffer.value = true;
      store.commit("setCustomOffer", offer);
    };
    return {
      acceptOffer,
      acceptCustomOffer,
      withdrawOffer,
      loading: computed(() => store.getters.getOfferPurchaseStatus),
    };
  },
};
</script>

<style scoped>
.offer-title {
  font-weight: 500;
  font-size: 17px;
  padding-bottom: 10px;
  border-bottom: 1px solid #e7e9ed;
}

.mdi {
  color: #15a362;
}
.offer-description {
  font-weight: 400;
  color: #8396ab;
  word-wrap: break-word;
  word-break: break-all;
}
.delivery {
  display: flex;
}
.delivery p {
  font-weight: 500;
}

</style>