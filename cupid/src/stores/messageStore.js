import axios from 'axios';
import { defineStore } from 'pinia';
import { ref } from 'vue';

export const useMessageStore = defineStore('message', () => {
    const token = ref(localStorage.getItem('token') || null);
    const messageData = ref([]);
    const isShowInputMessage = ref(false);

    const index = async () => {
        try {
            const res = await axios.get('/api/message', {
                headers: {
                    Authorization: `Bearer ${token.value}`
                }
            });

            if(res.data.success) {
                messageData.value = res.data.result
            }
        }catch(error) {
            console.log('Something went wrong: ', error);
        }
    }

    index();

    const store = async (formDataMessage) => {
        try {
            const res = await axios.post('/api/message', formDataMessage, {
                headers: {
                    Authorization: `Bearer ${token.value}`
                }
            });

            if(res.data.success) {
                isShowInputMessage.value = false;
                index();
            }
        }catch(error) {
            console.log('Something went wrong: ', error);
        }
    }

    return {
        // functions
        store,

        // variables
        messageData, isShowInputMessage
    }
})
