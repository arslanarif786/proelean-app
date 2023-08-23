import { ref, watch } from 'vue'

export default function useAuth() {

   //    Login
   let loginLoading = ref(false);
   // const btnVisibilty = ref(false)

   const login = ref({
      email: '',
      password: '',
      fcm_token: localStorage.getItem('FCM_TOKEN')
   });

   const loginErrors = ref({
      email: null,
      password: null
   })

   const emailRegex = /[a-z0-9._%+-]+@[a-z0-9.-]+.[a-z]{2,3}$/;
   watch(login.value, (current /*old*/) => {
      if (!current.email) {
         loginErrors.value.email = "Email is required";
      } else if (!current.email.match(emailRegex)) {
         loginErrors.value.email = "Email is not valid";
      } else {
         loginErrors.value.email = null;
      }

      if (!current.password) {
         loginErrors.value.password = "Password is required";
      } else if (current.password.length < 6) {
         loginErrors.value.password = "Password must be atleast 6 characters";
      } else {
         loginErrors.value.password = null;
      }
   });

   
   const passwordRef = ref(null)
   const eyeIcon = ref('mdi-eye');
   const toggleVisibility = () => {
      if (passwordRef.value.type == 'text') {
         passwordRef.value.type = 'password';
         eyeIcon.value = 'mdi-eye';
      }
      else {
         passwordRef.value.type = 'text';
         eyeIcon.value = 'mdi-eye-off';
      }
   }





   // Signup

   const signup=ref({
      name:'',
      username: '',
      email:'',
      password:'',
      password_confirmation:''
    });

    const signupErrors = ref({
      name: null,
      username: null,
      email: null,
      password: null,
      password_confirmation: null
   })


   const usernameRegex = /^[a-zA-Z_.]{3,30}$/;
   const nameRegex = /^[a-zA-Z ]{3,20}$/;
   // const tokenRegex = /^[0-9]{6}$/;

   watch(signup.value,(current /*old*/) => {
      if(!current.name){
         signupErrors.value.name = "Name is required"
      }
      else if(!current.name.match(nameRegex)){
         signupErrors.value.name = "Name is not Valid"
      }
      else{
         signupErrors.value.name = null
      }
      
      if(!current.username){
         signupErrors.value.username = "Username is required"
      }
      else if(!current.username.match(usernameRegex)){
         signupErrors.value.username = "Username is not Valid"
      }
      else{
         signupErrors.value.username = null
      }

      if (!current.email) {
         signupErrors.value.email = "Email is required";
      } else if (!current.email.match(emailRegex)) {
         signupErrors.value.email = "Email is not valid";
      } else {
         signupErrors.value.email = null;
      }

      if (!current.password) {
         signupErrors.value.password = "Password is required";
      } else if (current.password.length < 6) {
         signupErrors.value.password = "Password must be atleast 6 characters";
      } else {
         signupErrors.value.password = null;
      }

      if (!current.password_confirmation) {
         signupErrors.value.password_confirmation = "Confirm Password is required";
      } else if (current.password_confirmation != current.password ) {
         signupErrors.value.password_confirmation = "Confirm Password dosn't match";
      } else {
         signupErrors.value.password_confirmation = null;
      }
   });

   
   const passwordConRef = ref(null)
   const eyeIcon2 = ref('mdi-eye');

   const toggleVisSignupConPass = () => {
      if (passwordConRef.value.type == 'text') {
         passwordConRef.value.type = 'password';
         eyeIcon2.value = 'mdi-eye';
      }
      else {
         passwordConRef.value.type = 'text';
         eyeIcon2.value = 'mdi-eye-off';
      }
   }

   // Forgot

   const forgot = ref({
      email: '',
      token:'',
      password:'',
      password_confirmation:''
   });

   const forgotErrors = ref({
      email: null,
      token:null,
      password:null,
      confirmation_password:null
   })

   watch(forgot.value, (current)  => {
      if (!current.email) {
         forgotErrors.value.email = "Email is required";
      } else if (!current.email.match(emailRegex)) {
         forgotErrors.value.email = "Email is not valid";
      } else {
         forgotErrors.value.email = null;
      }

      if (!current.token) {
         forgotErrors.value.token = "Token is required";
      } 
      // else if (!current.token.length.match(tokenRegex)) {
      //    console.log(current.token)
      //    forgotErrors.value.token = "Token is not valid";
      // } 
      else {
         forgotErrors.value.token = null;
      }

      if (!current.password) {
         forgotErrors.value.password = "Password is required";
      } else if (current.password.length < 6) {
         forgotErrors.value.password = "Password must be atleast 6 characters";
      } else {
         forgotErrors.value.password = null;
      }

      if (!current.confirmation_password) {
         forgotErrors.value.confirmation_password = "Confirm Password is required";
      } else if (current.confirmation_password != current.password ) {
         forgotErrors.value.confirmation_password = "Confirm Password dosn't match";
      } else {
         forgotErrors.value.confirmation_password = null;
      }
   })


   return {
      signup,
      signupErrors,
      
      passwordConRef,
      eyeIcon2,
      toggleVisSignupConPass,


      toggleVisibility,
      eyeIcon,
      passwordRef,
      loginErrors,
      login,
      loginLoading,

      forgotErrors,
      forgot
   }
}