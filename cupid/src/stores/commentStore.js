import axios from 'axios';
import { defineStore } from 'pinia';
import { ref } from 'vue';

export const useCommentStore = defineStore('comment', () => {
    const token = ref(localStorage.getItem('token') || null);
    const isShowComment = ref(false);

    const index = async () => {
        try {
            const res = await axios.get('/api/comment', {
                headers: {
                    Authorization: `Bearer ${token.value}`
                }
            });

            if(res.data.success) {
                console.log(res.data.result);
            }
        }catch(error) {
            console.log('Something went wrong: ', error);
        }
    }

    index();

    const store = async (formDataComment) => {
        try {
            const res = await axios.post('/api/comment', formDataComment, {
                headers: {
                    Authorization: `Bearer ${token.value}`
                }
            });

            if(res.data.success) {
                console.log(res.data.result);
            }
        }catch(error) {
            console.log('Something went wrong: ', error);
        }
    }

    const show = async (msgID) => {
        try {
            const res = await axios.get(`/api/comment/${msgID}`, {
                headers: {
                    Authorization: `Bearer ${token.value}`
                }
            });

            if(res.data.success) {
                console.log(res.data.result);
            }
        }catch(error) {
            console.log('Something went wrong: ', error);
        }
    }

    return {
        // functions
        store, show,

        // variables
        isShowComment
    }
})
