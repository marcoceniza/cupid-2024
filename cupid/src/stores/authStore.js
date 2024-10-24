import axios from 'axios';
import { defineStore } from 'pinia';
import { ref } from 'vue';

export const useAuthStore = defineStore('auth', () => {
    const token = ref(localStorage.getItem('token') || null);
    const user = ref(localStorage.getItem('user') || null);

    const authenticate = async (apiRoute, formData) => {
        try {
            const res = await axios.post(`/api/${apiRoute}`, formData);

            if(res.data.success) {
                localStorage.setItem('user', JSON.stringify(res.data.result));
                localStorage.setItem('token', res.data.token);
                user.value = res.data.result;
                token.value = res.data.token;
            }
        }catch(error) {
            console.log('Something went wrong: ', error);
        }
    }

    return {
        // functions
        authenticate,

        // variables
        token, user
    }
})
