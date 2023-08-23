import { useStore } from 'vuex'
import { getAuth, signInAnonymously, onAuthStateChanged } from "firebase/auth";

export default function useAuth() {

    const auth = getAuth();

    const firebaseLocalKey='proelean_firebase_uid';
    const loginAnonymously = () => {
        signInAnonymously(auth)
            .then((res) => {
                // Signed in..
                localStorage.setItem(firebaseLocalKey, res.user.uid);
            })
            .catch((error) => {
                const errorCode = error.code;
                // const errorMessage = error.message;
                console.log(errorCode);
                // ...
            });
    }

    const checkAuthStatus = () => {
        const store = useStore();
        onAuthStateChanged(auth, (user) => {

            if (user) {
                const uid = user.uid;
                localStorage.setItem(firebaseLocalKey, uid);
                console.log('user logged in');
                store.commit('setFirebaseUID',uid);

            } else {
                store.commit('setFirebaseUID',null);
                localStorage.removeItem(firebaseLocalKey);
                console.log('user logged out')
            }
        });
    }

    return {
        loginAnonymously,
        checkAuthStatus,
    }
}