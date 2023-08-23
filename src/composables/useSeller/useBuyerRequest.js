import { ref, watch } from "vue";
import { useStore } from "vuex";

export default function useBuyerRequest(){
    const store = useStore();

    const requestType = ref ({
      status:'',
      current_page:1,
    })
    console.log("Object",requestType.value)

    const jobId = ref("");
    const sendRequest = ref({
        job_id: "",
        service_id: "",
        description: "",
        price: "",
        delivery_time: "",
    });
    const sendRequestError = ref({
        job_id: "",
        service_id: "",
        description: "",
        price: "",
        delivery_time: "",
    });

    watch(sendRequest.value,(current) => {
      if(!current.description){
        sendRequestError.value.description = "Description is required"
      }else if(current.description.length < 30){
        sendRequestError.value.description = "Description minimum 30 character"
      }else{
        sendRequestError.value.description = null
      }

      if(!current.price){
        sendRequestError.value.price = "Price is required"
      }else if(current.price < 5){
        console.log(current.price)
        sendRequestError.value.price = "Minimum price is €5"
      }else{
        sendRequestError.value.price = null
      }
      if(!current.delivery_time){
        sendRequestError.value.delivery_time = "Delivery time is required"
      }else{
        sendRequestError.value.delivery_time = null
      }
      if(!current.service_id){
        sendRequestError.value.service_id = "Service is required"
      }else{
        sendRequestError.value.service_id = null
      }
    })

    // const buyerRequestType = [
    //     { value: 0, name: "Buyer Request" },
    //     { value: 1, name: "Sent Offer" },
    // ];

    function defineOffer(jobID) {
        sendRequest.value.job_id = jobID;
    }
    function sendOffer() {
        store.dispatch("sendOffer", sendRequest.value);
        sendRequest.value = {};
    }
    
    function showFilter() {
        let value = document.getElementById("requestValue").value;
        if (value == 1) {
          requestType.value.status = "sent_offers"
          requestType.value.current_page = 1
          loadOtherRequest(requestType.value.current_page)
        }
        else {
          requestType.value.status = ''
          requestType.value.current_page = 1
          loadOtherRequest(requestType.value.current_page)
        }
    }

    function deleteJob(id) {
        store.dispatch("deleteBuyerJob", id);
        console.log("delete request id: ", id);
    }

    const loadOtherRequest = (page) => {
      requestType.value.current_page = page
      store.dispatch("showBuyerRequests",requestType.value);
    }

    const previous = () => {
      requestType.value.current_page = requestType.value.current_page-1
      loadOtherRequest(requestType.value.current_page)
    }

    const next = () => {
      requestType.value.current_page = requestType.value.current_page+1
      loadOtherRequest(requestType.value.current_page)
    }

    return{
        requestType,
        previous,
        next,
        // buyerRequestType,
        showFilter,
        sendRequest,
        sendRequestError,
        loadOtherRequest,
        defineOffer,
        sendOffer,
        deleteJob,
        jobId,
    }
}