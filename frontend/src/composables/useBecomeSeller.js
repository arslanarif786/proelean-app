import { ref, watch } from "vue";
import { useStore } from "vuex";
import { onBeforeMount } from '@vue/runtime-core';
import router from "../router";
import compressImage from "./useImageCompression";

export default function useBecomeSeller() {

    const store = useStore();
    const subCategories = ref(null);
    let subCatLoader=ref(false);
    const bannersBase64= ref([]);
    const preview = ref(null);
    const user = JSON.parse(localStorage.getItem('userInfo'));

    const data = ref({
        freelancer_title: '',
        lang: '',
        availability: '',
        description: '',
        cinic: '',
        category_id: '',
        sub_category_id: '',
        country_id: '',
        portfolio:'',
        instagram: '',
        facebook: '',
        twitter: ''
    });

    const dataErrors = ref({
        freelancer_title: null,
        lang: null,
        availability: null,
        cinic:null,
        country_id:null,
        description: null,
        category_id: null,
        sub_category_id: null,
    });


   
    watch(data.value,(value) => {

        if(!value.freelancer_title) {  
        dataErrors.value.freelancer_title = 'Title is required'                               
        } else{
        dataErrors.value.freelancer_title = null                               
        }

        if(!value.lang) {
            dataErrors.value.lang = 'Language is required'
        } else{
            dataErrors.value.lang  = null                               
        }
        
        if(!value.availability) {
            dataErrors.value.availability = 'Availability is required'
        } else{
            dataErrors.value.availability  = null                               
        }

        if(!value.country_id) {
            dataErrors.value.country_id = 'Country is required'
        } else{
            dataErrors.value.country_id = null                               
        }

        if(!value.description) {
            dataErrors.value.description = ' Description is required'
        }else if(value.description.length < 15){
            dataErrors.value.description = "Description must be at least 15 characters"
        } else{
            dataErrors.value.description  = null                               
        }
        if(!value.category_id) {
            dataErrors.value.category_id = 'Category is required'
        } else{
            dataErrors.value.category_id  = null                               
        }
        if(!value.sub_category_id) {
            dataErrors.value.sub_category_id = 'Subcategory is required'
        }else{
            dataErrors.value.sub_category_id  = null                               
        }
        if(!value.cinic) {
            dataErrors.value.cinic = 'CNIC image is required'
        }else{
            dataErrors.value.cinic  = null                               
        }
    })

    const convertFileToBase64 = (file) => {
        data.value.cinic = file;
        const reader = new FileReader();
        reader.onloadend = function() {
            preview.value = reader.result;
        }
        reader.readAsDataURL(file);
    }

    const removeImage = () => {
        console.log("Remove Image")
        preview.value = ''
        bannersBase64.value = '';
        data.value.cinic = '';
      }

    const encodeImageFileAsURL =file => {    
        const reader = new FileReader();  
        reader.onloadend = function() {  
            bannersBase64.value.push(reader.result);  
        }  
        reader.readAsDataURL(file);  
    }

    onBeforeMount(()=>{
        // check if user is already seller
        if(user.isFreelancer) {
            router.push('/')
        } else {
            store.dispatch('getCountriesLanguage')
        }
    });

    const onCategorySelected = () => {
        data.value.category_id = document.getElementById("category").value;
        store.dispatch("loadSubCategories", data.value.category_id);
    };

    const handleCinic = async (e) => {
        const file = await compressImage(e.target.files[0]);
        convertFileToBase64(file);
    };

    const handleBecomeSeller = () => {
        
        if(!data.value.freelancer_title) {  
        dataErrors.value.freelancer_title = 'Title is required'                               
        }else{
            console.log(data.value)
            store.dispatch('handleBecomeSeller',data.value);
        }
    };
    const btnStatus = ref(store.getters.getRegisterStatus)

    return {
        data,
        preview,
        dataErrors,
        subCategories,
        subCatLoader,
        bannersBase64,
        convertFileToBase64,
        removeImage,
        encodeImageFileAsURL,
        handleBecomeSeller,
        onCategorySelected,
        handleCinic,
        btnStatus

    }

}