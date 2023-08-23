import { computed, ref,watch } from "vue";
import { useStore } from "vuex";

export default function useBecomeSeller() {

        const subCategories = ref(null);
    
        const data = ref({
            title: '',
            language: '',
            availability: '',
            portfolio: '',
            bio: '',
            cinic: '',
            categoryId: '',
            subcategoryId: '',
            insta: '',
            fb: '',
            twitter: ''
        });

    
        const dataErrors = ref({
            title: null,
            language: null,
            availability: null,
            portfolio: null,
            bio: null,
            categoryId: null,
            subcategoryId: null,
            insta: null,
            fb: null,
            twitter: null
        });
    
        watch(data.value,(value) => {
            if(!value.title) {
                dataErrors.value.title = 'title is required'
            } else if(value.title.length < 6) {
                dataErrors.value.title = 'title is required'
            } else {
                dataErrors.value.title = null
            }
            if(!value.language) {
                dataErrors.value.language = 'language is required'
            }
            if(!value.availability) {
                dataErrors.value.availability = 'availability is required'
            }
            if(!value.portfolio) {
                dataErrors.value.portfolio = 'portfolio is required'
            }
            if(!value.bio) {
                dataErrors.value.bio = 'bio is required'
            }
            if(!value.categoryId) {
                dataErrors.value.categoryId = 'category is required'
            }
            if(!value.subcategoryId) {
                dataErrors.value.subcategoryId = 'subcategory is required'
            }
            if(!value.insta) {
                dataErrors.value.insta = 'insta is required'
            }
            if(!value.fb) {
                dataErrors.value.fb = 'fb is required'
            }
            if(!value.twitter) {
                dataErrors.value.twitter = 'twitter is required'
            }
    
        })


    const store = useStore();
    const createJob = ref({
        description: "",
        category_id: "",
        sub_category_id: "",
        delivery_time: "",
        budget:"",
    });

    const handleCredentials = () =>{
        data.value.categoryId = document.getElementById("category_id").value;
        data.value.subcategoryId = document.getElementById("sub_category_id").value;
        data.value.delivery_time = document.getElementById("delivery_time").value;
        console.log("categoryId", data.value.categoryId);
        console.log("subcategoryId", data.value.subcategoryId);
        console.log("delivery_time", data.value.delivery_time);
    }

    const jobCreation = () => {
        console.log("Create Job Value", createJob.value);
        // store.dispatch('createAJob',createJob.value)
        // createJob.value = '';
        // document.getElementById("sub_category_id").value = '';
        // document.getElementById("delivery_time").value = '';

    }


    return {
        service: computed(() => store.getters.getSingleService),
        data,
        subCategories,
        createJob,
        jobCreation,
        handleCredentials,
    }

}