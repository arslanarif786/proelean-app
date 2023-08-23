import { getFirestore, collection, query, where, getDocs } from "firebase/firestore";
import { useStore } from 'vuex'
import { ref } from 'vue'


export default function useChat() {
    const db = getFirestore();
    const store = useStore();

    const conversations = ref([]);

    const lookForConversationChanges = async () => {
        const user = store.getters.getAuthUser;
        const conversationRef = collection(db, "Conversations");
        const q = query(conversationRef, where('members', 'array-contains', user.id));
        const querySnapshot = await getDocs(q);
        querySnapshot.forEach((doc) => {
            let conversation = doc.data();
            conversation.id = doc.id;
            conversations.value.push(conversation);

            console.log(conversation);
        });
    }

    return {
        lookForConversationChanges,
    }
}