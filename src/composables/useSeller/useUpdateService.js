import { computed, ref } from "vue";
import { useRouter } from "vue-router";
import { useStore } from "vuex";
import compressImage from '@/composables/useImageCompression'


export default function useCreateService() {

  const store = useStore();
  const route = useRouter();
  const bannersBase64 = ref([]);
  const updateGig = ref(computed(() => store.getters.getSingleService));

  const data = ref({
    description: '',
    category_id: '',
    sub_category_id: '',
  });


  const getUpdateGig = ref({
    s_description: "",
    description: "",
    banner: [],
    delete: [],
    category_id: "",
    sub_category_id: "",
    delivery_time: '',
    price: "",
    id:"",
    revision:'',
    additional_info:''
  });
  const setUpdateValue = () => {
    getUpdateGig.value.sub_category_id = document.getElementById("subCategory").value
    getUpdateGig.value.category_id = document.getElementById("category").value
    getUpdateGig.value.delivery_time = document.getElementById("deliveryTime").value
    getUpdateGig.value.revision = document.getElementById("revision").value
    getUpdateGig.value.s_description = updateGig.value.s_description
    getUpdateGig.value.description = updateGig.value.description
    getUpdateGig.value.additional_info = updateGig.value.additional_info
    getUpdateGig.value.price = updateGig.value.price
    getUpdateGig.value.id = updateGig.value.id
    getUpdateGig.value._method= 'PUT'
  }

  const getUpdateGigError = ref({
    s_description: "",
    description: "",
    price: "",
  });

  const updateService = () => {
    setUpdateValue();
    console.log("Update Service",getUpdateGig.value)
    store.dispatch('updateService', getUpdateGig.value).then(res => {
      if(res.status == 200){
        route.push({name: "SellerServices"});
      }
    })
  }

  const getBanners = computed(() =>
  updateGig.value.service_media ? [...bannersBase64.value, ...updateGig.value.service_media] : bannersBase64.value);

  const selectThumbnail = async (e) => {
    const files = e.target.files;
    for (let i = 0; i < files.length; i++)
    {
      if(!files[i].type.includes('image')){
        alert(files[i].type + ' extension is not allowed');
        return;
      }

      const image=await compressImage(files[i]);
      getUpdateGig.value.banner.push(image);
    }



    document.querySelector('#bannerInput').value = '';
    bannersBase64.value = [];
    getUpdateGig.value.banner.forEach( img => {
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

  const removeOldImage = (index, path) => {
    console.log("Image Index",index,path)
    getUpdateGig.value.delete.push(path)
    updateGig.value.service_media.splice(index,1)
  }


  const removeNewImage = (index) => {
    console.log("Image Index",index)
    bannersBase64.value.splice(index, 1);
    getUpdateGig.value.banner.splice(index, 1);
  }

  const getCategory = () => {
    data.value.category_id = document.getElementById("category").value;
    store.dispatch("loadSubCategories", data.value.category_id);
  };

  return {
    data,
    getCategory,
    updateService,
    selectThumbnail,
    removeOldImage,
    encodeImageFileAsURL,
    updateGig,
    getUpdateGigError,
    getBanners,
    removeNewImage,
    bannersBase64
  }
}
