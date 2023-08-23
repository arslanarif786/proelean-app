import { computed, ref } from "vue";
import { useStore } from "vuex";

export default function seller() {

  const store = useStore();
  const bannersBase64 = ref([]);
  const preview = ref(null);
  const updateGig = computed(()=>store.getters.getSingleService);

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

  const createGig = ref({
    s_description: "",
    description: "",
    banner: [],
    category_id: "",
    sub_category_id: "",
    delivery_time: '',
    price: "",
  });

  const getBanners = computed(() =>
    updateGig.value.service_media ? [...bannersBase64.value, ...updateGig.value.service_media] : bannersBase64.value);

  const gigCreation = () => {
    createGig.value.sub_category_id = document.getElementById("subCategory").value
    createGig.value.delivery_time = document.getElementById("deliveryTime").value
    console.log(createGig.value)
    store.dispatch('createGig', createGig.value)
  }

  const selectThumbnail = (e) => {
    const files = e.target.files;
    for (let i = 0; i < files.length; i++) {
      createGig.value.banner.push(files[i]);
    }
    document.querySelector('#bannerInput').value = '';
    console.log(createGig.value);
    bannersBase64.value = [];
    createGig.value.banner.forEach(img => {
      encodeImageFileAsURL(img);
    });
  };
  const encodeImageFileAsURL = file => {
    const reader = new FileReader();
    reader.onloadend = function () {
      bannersBase64.value.push(reader.result);
    }
    reader.readAsDataURL(file);
  }

  const removeImage = index => {
    bannersBase64.value.splice(index, 1);
    createGig.value.banner.splice(index, 1);
  }

  const getCategory = () => {
    data.value.category_id = document.getElementById("category").value;
    console.log("Catogry id", data.value.category_id)
    createGig.value.category_id = data.value.category_id;
    store.dispatch("loadSubCategories", data.value.category_id);
  };


  return {
    data,
    getCategory,
    gigCreation,
    selectThumbnail,
    removeImage,
    encodeImageFileAsURL,
    createGig,
    updateGig,
    bannersBase64,
    getBanners,
    convertFileToBase64

  }
}