import { computed, ref, watch } from "vue";
import { useStore } from "vuex";
import compressImage from "../useImageCompression";

export default function useEditProfile(){

    const store = useStore()
    const user = ref(store.getters.getAuthUser)

    const imageBase64 = ref()

    const editUser = ref({
        name: user.value.name,
        email: user.value.email,
        phone: user.value.phone,
        address: user.value.address,
        description: user.value.description,
        image: user.value.image,
    })
    const editUserError = ref({
        name: '',
        email: '',
        phone: '',
        address: '',
        description: '',
        image: '',
    })

    const nameRegex = /^[a-zA-Z ]{3,20}$/;
    const phoneRegex = /^[0-9+]{7,20}$/;

    watch(editUser.value,(current) => {
        if(!current.name){
            editUserError.value.name = "Name is Requird"
        }else if(!current.name.match(nameRegex)){
            editUserError.value.name = "Name is not valid"
        }else{
            editUserError.value.name = null
        }
        if(!current.phone){
            editUserError.value.phone = "Phone number is Requird"
        }else if(!current.phone.match(phoneRegex)){
            editUserError.value.phone = "Phone number is not valid"
        }else{
            editUserError.value.phone = null
        }

    })

    const handleProfileImage = async (e) => {
        const file = await compressImage(e.target.files[0]);
        convertFileToBase64(file,'profile-img');
    };

    const convertFileToBase64 = (file) => {
        editUser.value.image = file;
        const reader = new FileReader();
        reader.onloadend = function() {
            imageBase64.value = reader.result;
        }
        reader.readAsDataURL(file);
    }

    const update = () => {
        console.log("Update Value",editUser.value)
        store.dispatch('updateProfile',editUser.value)
      }

    return{
        update,
        editUserError,
        imageBase64,
        handleProfileImage,
        editUser,
        btnStatus: computed(() => store.getters.getRegisterStatus)

    }

}