import { computed, ref, watch } from "vue";
import { useRouter } from "vue-router";
import { useStore } from "vuex";

export default function useCreateJob() {

    const subCategories = ref(null);
    
    const store = useStore();
    const route = useRouter();
    const createJob = ref({
        description: "",
        category_id: "",
        sub_category_id: "",
        delivery_time: "",
        budget:"",
    });

    const createJobError = ref({
        description: "",
        category_id: "",
        sub_category_id: "",
        delivery_time: "",
        budget:"",
    });

    watch(createJob.value,(current) => {
        if(!current.description){
            createJobError.value.description = "Description is required"
        }else if(current.description.length < 15){
            createJobError.value.description = "Description must be at least 15 characters"
        }else{
            createJobError.value.description = null
        }
        if(!current.category_id){
            createJobError.value.category_id = "Category is required"
        }else{
            createJobError.value.category_id = null
        }
        if(!current.sub_category_id){
            createJobError.value.sub_category_id = "Sub Category is required"
        }else{
            createJobError.value.sub_category_id = null
        }
        if(!current.delivery_time){
            createJobError.value.delivery_time = "Delivery Days is required"
        }else{
            createJobError.value.delivery_time = null
        }
        if(!current.budget){
            createJobError.value.budget = "Budget is required"
        } else if(current.budget < 5){
            createJobError.value.budget = "Minimum budget $5"
        } else {
            createJobError.value.budget = null
        }
      })


    const jobCreation = () => {
        createJob.value.category_id = document.getElementById("category_id").value;
        createJob.value.sub_category_id = document.getElementById("sub_category_id").value;
        createJob.value.delivery_time = document.getElementById("delivery_time").value;
        console.log("Create Job Value", createJob.value);
        store.dispatch('createAJob',createJob.value).then(res => {
             if(res.status === 201){
                route.push({name: "Jobs"})
                console.log("Responese",res)
            } 
        })
    }

    const getCategory = () => {
        let category_id = document.getElementById("category_id").value;
        console.log("Catogry id", category_id)
        store.dispatch("loadSubCategories", category_id);
      };

    return {
        service: computed(() => store.getters.getSingleService),
        createJobError,
        subCategories,
        getCategory,
        createJob,
        jobCreation,
    }

}