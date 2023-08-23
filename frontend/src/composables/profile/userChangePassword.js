import { computed, ref, watch } from "vue";
import { useStore } from "vuex";

export default function useChangePassword () {
    const store = useStore()
    const currentPasswordRef = ref(null)
    const passwordRef = ref(null)
    const confirmPasswordRef = ref(null)

    const eyeIconCurrentPassword = ref('mdi-eye');
    const eyeIconPassword = ref('mdi-eye');
    const eyeIconConfirmPassword = ref('mdi-eye');


    const changePassword = ref({
      current_password: '',
      password:'',
      password_confirmation:''
    })

    const changePasswordError = ref({
      current_password: '',
      password:'',
      password_confirmation:''
    })

     const toggleVisiCurrentPassword = () => {
        if (currentPasswordRef.value.type == 'text') {
            currentPasswordRef.value.type = 'password';
           eyeIconCurrentPassword.value = 'mdi-eye';
        }
        else {
            currentPasswordRef.value.type = 'text';
           eyeIconCurrentPassword.value = 'mdi-eye-off';
        }
     }
     const toggleVisiPassword = () => {
        if (passwordRef.value.type == 'text') {
           passwordRef.value.type = 'password';
           eyeIconPassword.value = 'mdi-eye';
        }
        else {
           passwordRef.value.type = 'text';
           eyeIconPassword.value = 'mdi-eye-off';
        }
     }
     const toggleVisiConfirmPassword = () => {
        if (confirmPasswordRef.value.type == 'text') {
            confirmPasswordRef.value.type = 'password';
           eyeIconConfirmPassword.value = 'mdi-eye';
        }
        else {
            confirmPasswordRef.value.type = 'text';
           eyeIconConfirmPassword.value = 'mdi-eye-off';
        }
     }

    watch(changePassword.value,(current) => {
        if (!current.current_password) {
            changePasswordError.value.current_password = "Current Password is required";
            } else if (current.current_password.length < 6 ) {
            changePasswordError.value.current_password = "Current Password is not Valid";
            } else {
            changePasswordError.value.current_password = null;
        }
        if (!current.password) {
            changePasswordError.value.password = "Password is required";
            } else if (current.password.length < 6) {
            changePasswordError.value.password = "Password must be atleast 6 characters";
            } else if (current.password === current.current_password) {
            changePasswordError.value.password = "This password is already used";
            } else {
            changePasswordError.value.password = null;
        }
        if (!current.password_confirmation) {
            changePasswordError.value.password_confirmation = "Confirm Password is required";
            } else if (current.password_confirmation != current.password ) {
            changePasswordError.value.password_confirmation = "Confirm Password doesn't match";
            } else {
            changePasswordError.value.password_confirmation = null;
        }
    })

    const updatePassword = () => {
      store.dispatch('updatePassword',changePassword.value);
    }

    return{
        eyeIconCurrentPassword,
        eyeIconPassword,
        eyeIconConfirmPassword,
        currentPasswordRef,
        passwordRef,
        confirmPasswordRef,
        toggleVisiCurrentPassword,
        toggleVisiPassword,
        toggleVisiConfirmPassword,
        changePassword,
        changePasswordError,
        updatePassword,
        user: computed(() => store.getters.getAuthUser),
        btnStatus: computed(() => store.getters.getRegisterStatus)
    }
}