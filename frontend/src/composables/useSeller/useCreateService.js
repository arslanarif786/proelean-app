import { ref, watch } from "vue";
import { useRouter } from "vue-router";
import { useStore } from "vuex";
import compressImage from '@/composables/useImageCompression'

export default function useCreateService() {

  const store = useStore();
  const route = useRouter();
  const bannersBase64 = ref([]);
  const preview = ref(null);

  const data = ref({
    description: '',
    category_id: '',
    sub_category_id: '',
  });

  const convertFileToBase64 = (file) => {
    data.value.cinic = file;
    const reader = new FileReader();
    reader.onloadend = function () {
      preview.value = reader.result;
    }
    reader.readAsDataURL(file);
  }

  const createService = ref({
    s_description: "",
    description: "",
    banner: [],
    category_id: "",
    sub_category_id: "",
    delivery_time: '',
    price: "",
    revision:"",
    additional_info:''
  });

  const createServiceError = ref({
    s_description: "",
    description: "",
    banner: "",
    category_id: "",
    sub_category_id: "",
    delivery_time: '',
    price: "",
    revision:"",
    additional_info:''
  });

  watch(createService.value,(current) => {
    if(!current.s_description){
        createServiceError.value.s_description = "Title is required"
    }else if(current.s_description.length < 5){
      createServiceError.value.s_description = "Title must be at least 5 characters"
    }else{
        createServiceError.value.s_description = null
    }
    if(!current.description){
        createServiceError.value.description = "Description is required"
    }else if(current.description.length < 20){
        createServiceError.value.description = "Description must be at least 20 characters"
    }else{
        createServiceError.value.description = null
    }

    if(!current.category_id){
        createServiceError.value.category_id = "Category is required"
    }else{
        createServiceError.value.category_id = null
    }
    if(!current.banner){
        createServiceError.value.banner = "Thumbnail is required"
    }else{
        createServiceError.value.banner = null
    }
    if(!current.sub_category_id){
        createServiceError.value.sub_category_id = "Sub Category is required"
    }else{
        createServiceError.value.sub_category_id = null
    }
    if(!current.delivery_time){
        createServiceError.value.delivery_time = "Delivery Days is required"
    }else{
        createServiceError.value.delivery_time = null
    }
    if(!current.price){
      createServiceError.value.price = "Budget is required"
    } else if(current.price < 5){
      createServiceError.value.price = "Minimum budget is €5 "
    } else {
      createServiceError.value.price = null
    }
    if(!current.revision){
        createServiceError.value.revision = "Revision is required"
    }else{
        createServiceError.value.revision = null
    }
  })

  const gigCreation = () => {
    createService.value.sub_category_id = document.getElementById("subCategory").value
    createService.value.delivery_time = document.getElementById("deliveryTime").value
    createService.value.revision = document.getElementById("revision").value
    console.log(createService.value)
    store.dispatch('createService', createService.value)
    .then(res => {
      if(res.status === 201) {
        route.push({name: "SellerServices"});
      }
    })
  }


  const selectThumbnail = async (e) => {
    const files = e.target.files;

    for (let i = 0; i < files.length; i++)
    {
      if(!files[i].type.includes('image')){
        alert(files[i].type + ' extension is not allowed');
        return;
      }

      const image=await compressImage(files[i]);
      createService.value.banner.push(image);
    }
       

    document.querySelector('#bannerInput').value = '';
    bannersBase64.value = [];
      createService.value.banner.forEach( img => {
        encodeImageFileAsURL(img);
      })
  }
    
  const encodeImageFileAsURL = file => {
    const reader = new FileReader();
    reader.onloadend = function () {
      bannersBase64.value.push(reader.result);
    }
    reader.readAsDataURL(file);
  }

  const removeImage = index => {
    bannersBase64.value.splice(index, 1);
    createService.value.banner.splice(index, 1);
  }

  const getCategory = () => {
    data.value.category_id = document.getElementById("category").value;
    console.log("Catogry id", data.value.category_id)
    store.dispatch("loadSubCategories", data.value.category_id);
    createService.value.category_id = data.value.category_id;
  };


  return {
    data,
    getCategory,
    gigCreation,
    selectThumbnail,
    removeImage,
    encodeImageFileAsURL,
    createService,
    createServiceError,
    bannersBase64,
    convertFileToBase64
  }
}
